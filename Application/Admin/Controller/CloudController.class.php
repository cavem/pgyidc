<?php
namespace Admin\Controller;
use Think\Controller;
class CloudController extends BaseController {
    //我的云主机
    public function cloudmanageAction(){
        parent::nosession();
        $userid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $cloudlog=M('cloudlog');
        //获取主机数据列表       
        $url = "http://180.101.72.213:2525/apiyungoing/vminfo?userid=".$userid."&usertoken=".$usertoken;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);
        if(!empty($output)){
            foreach ($output as $k => $v) {
                $info=$cloudlog->where("CloudNo ='%s' AND logicdel=%d",$v['vid'],0)->find();
                if (empty($info)) {
                    unset($output[$k]);
                }
                else
                {
                    $output[$k]['id']=$info['id'];
                    $output[$k]['disprice']=$info['disprice'];
                    $output[$k]['duetime']=$info['duetime'];
                    $output[$k]['autorenew']=$info['autorenew'];
                }  
            }
            $page= new \Extend\Page(count($output),15);
            $output=array_slice($output,$page->firstRow,$page->listRows);
            $page->parameter['keyword']=$key;
            $show = $page->show();
        }
        $this->assign("model",$output);
        $this->assign("page",$show);
        $this->assign("usertype",session('loginuser.usertype'));
        $this->assign("cloud",1);
        $this->assign("cloudmanage",1);
        $this->display();
    }

    //云主机信息
    public function manageupAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $usertype=session('loginuser.usertype');
        $vid=I('vid/d');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->error('主机不存在');
        }
        $cloudlog=M('cloudlog');
        $info=$cloudlog->field('Disprice,DueTime')->where("CloudNo ='%s'",$vid)->find();
        $paylogModel=M('paylog');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);

        //获取主机数据列表       
        $url = "http://180.101.72.213:2525/apiyungoing/vminfo?userid=".$yungoid."&usertoken=".$usertoken."&vpsid=".$vid."&usertype=".$usertype;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $outres=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);
        if (empty($outres)) {
            $this->error('主机不存在');
        }
        // print"<pre>";
        // print_r($outres);exit;
        $this->assign("info",$outres[0]);
        $this->assign('cloudlog',$info);
        $this->assign('balance',$balance);
        $this->display();
    }

    public function vmstateAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $vid=I('vid/d');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->error('主机不存在');
        }
        $url = "http://180.101.72.213:2525/apiyungoing/vmstate?userid=".$yungoid."&usertoken=".$usertoken."&vpsid=".$vid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $hoststatus = curl_exec($ch);
        curl_close($ch);
        $hoststatus=json_decode(json_encode(json_decode($hoststatus)),TRUE);
        $this->ajaxReturn($hoststatus[0]);
        exit;
    }

    public function packingAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $gid=I('gid/d');
        $url = "http://180.101.72.213:2525/apiyungoing/servergroups?userid=".$yungoid."&usertoken=".$usertoken."&groupid=".$gid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $hoststatus = curl_exec($ch);
        curl_close($ch);
        $hoststatus=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($hoststatus)),TRUE))),TRUE);
        $this->ajaxReturn($hoststatus[0]['dname']);
        exit;
    }

    //主机操作 0软重启 1软关机 2开机 3硬重启 4硬关机
    public function operateAction()
    {
        parent::nosession();
        $vid=I('vid/d');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->ajaxReturn(2);
            exit;
        }
        $datatype=I('datatype/d',0);
        switch ($datatype) {
            case '0':
                $action="vm_reboot";
                break;
            case '1':
                $action="vm_shutdown";
                break;
            case '2':
                $action="vm_start";
                break;
            case '3':
                $action="vm_hreboot";
                break;
            case '4':
                $action="vm_hshutdown";
                break;
        }
        //获取当前主机状态
        $status_data = array
        (
            "identity" => "system",
            "api_username" => "e08ce2094689f5fe129",
            "api_key" => "JFSDFIEWOIFU098fds008f",
            "Action" => $action,
            "vpsid" => $vid
        );
        $hoststatus=self::yungopost($status_data);
        $this->ajaxReturn($hoststatus);
        exit;
    }
    /**
     * 更新主机资源配置
     */
    public function upgradeAction(){
        parent::nosession();
        //实例化数据库 缓存memcache
        $cloudlog=M('cloudlog');
        $corepricemodel=D('Coreprice');
        $pricemodel=D('Price');
        $paylogModel=M('paylog');
        S(array('type'=>'memcache','host'=>'127.0.0.1','port'=>'11211','prefix'=>'think','expire'=>300));// 缓存初始化
        //获取userid usertoken vpsid
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $usertype=session('loginuser.usertype');
        $vpsid=I('vpsid/d');
        //判断是否是本人名下机器
        $myhost=self::myhost($vpsid);
        if (empty($myhost)) {
            $this->error('主机不存在');
            exit;
        }

        if(S('vpsinfo'.$vpsid)!=false){
            $output=S('vpsinfo'.$vpsid);
        }else{
            //获取主机数据列表       
            $url = "http://180.101.72.213:2525/apiyungoing/vminfo?userid=".$yungoid."&usertoken=".$usertoken."&vpsid=".$vpsid."&usertype=".$usertype;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $output=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);
            S('vpsinfo'.$vpsid,$output);//存入缓存
        }
        
        //获取云主机配置信息
        $vid=$output[0]['vid'];//云主机编号
        $oldvcpu=$output[0]['vcpu'];//CPU核数
        $oldvram=$output[0]['vram'];//ram大小
        $oldvdisk=$output[0]['vdisk'];//disk大小
        $oldvport=$output[0]['vport'];//port大小
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        //获取云主机购买信息
        $info=$cloudlog->field('Price,BuyTime,DueTime,CID')->where("CloudNo ='%s'",$vid)->find();
        $price=explode('/', $info['price']);
        $info['cycle']=$price[1];
        $info['cyc']=1;
        switch ($info['cycle']) {
            case '天':
                $info['cyc']=0.03;
                break;
            case '月':
                $info['cyc']=1;
                break;
            case '季':
                $info['cyc']=3;
                break;
            case '半年':
                $info['cyc']=6;
                break;
            case '年':
                $info['cyc']=9;
                break;
        }

        if(IS_POST){
            $isbuy=I('post.isbuy');//是否购买0不1买
            $vcpu=I('post.cpu');//CPU核数
            $vram=I('post.ram_max');//ram大小
            $vdisk=I('post.disk');//disk大小
            $vport=I('post.port');//port大小
            //计算出新增的配置
            $newvcpu=(int)$vcpu-$oldvcpu;
            if ($newvcpu>0&&$newvcpu<=14) {
                $cpuprice=$newvcpu*30;
            }
            $newvram=(int)$vram-$oldvram;
            if ($newvram>0&&$newvcpu<=15360) {
                $ramprice=$newvram*0.03;
            }
            $newvdisk=(int)$vdisk-$oldvdisk;
            if ($newvdisk>0&&$newvdisk<=50) {
                $diskprice=$newvdisk*10;
            }
            $newvport=(int)$vport-$oldvport;
            if ($newvport>0&&$newvport<=90) {
                $portprice=$newvport*50;
            }
            $updateprice=(float)$cpuprice+$ramprice+$diskprice+$portprice;//升级价格
            $updateprice=round($updateprice,2);
            if($isbuy==0){
                $this->ajaxReturn($updateprice);
            }else{
                try 
                {
                    $updateprice=(int)$info['cyc']*$updateprice;
                    //判断余额是否足够
                    $remaining=(int)$balance-$updateprice;
                    if ($remaining<0) {
                        $this->ajaxReturn(2);
                    }
                    //先通过接口升级配置
                    $url = "http://180.101.72.213:2525/apiyungoing/vmupdate";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    // post数据
                    $post_data = array(
                        "vpsid" => $vid,
                        "userid" => $yungoid,
                        "cpu" => $vcpu,
                        "ram_max" => $vram,
                        "ram_min" => 1024,
                        "disk" => $vdisk,
                        "bandwidth" => 0,
                        "port" => $vport
                    );
                    // post的变量
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $output = json_decode(json_encode(json_decode($output)),TRUE);
                    if ($output[0]==0) {
                        //扣费记录
                        $data=array(
                            "ordernum"=>"pgy".date('YmdHis'),
                            "money"=>$updateprice,
                            "userid"=>$userid,
                            "addtime"=>time(),
                            "typename"=>"升级扣费",
                            "datatype"=>1
                        );
                        $paylogModel->add($data);
                        //升级记录
                        $datalog=array(
                            "cpu"=>$oldvcpu."->".$vcpu,
                            "ram"=>$oldvram."->".$vram,
                            "disk"=>$oldvdisk."->".$vdisk,
                            "port"=>$oldvport."->".$vport,
                            "userid"=>$userid,
                            "addtime"=>time()
                        );
                        $upgradelog=M('upgradelog');
                        $upgradelog->add($datalog);
                        //修改购买价格
                        $newprice=(int)($price[0]+$updateprice)."/".$price[1];
                        $cloudlog->where("CloudNo ='%s'",$vid)->setField('Price',$newprice);
                    }
                    $this->ajaxReturn($output[0]);
                } catch (Exception $e) {
                     $this->ajaxReturn(1);
                }
            }
            
        }
        //计算续费周期 
        $curdate=time();//当前时间戳
        //获取购买日期和到期日期
        $buydate=$info['buytime'];//购买日期时间戳
        $bwdate=$info['duetime'];//下次续费日期时间戳
        //计算天数
        $timediff = $bwdate-$buydate;
        $days = intval($timediff/86400);
        //计算小时数
        $remain = $timediff%86400;
        $hours = intval($remain/3600);
        //计算分钟数
        $remain = $remain%3600;
        $mins = intval($remain/60);
        //计算秒数
        $secs = $remain%60;
        $zq=$days.'.'.$hours;
        $this->assign("zq",$zq);
        //模板输出
        $this->assign("vpsinfo",$output[0]);
        $this->assign("balance",$balance);
        $this->assign("info",$info);
        $this->display();
    }

    /**
     * 重装系统
     * int $userid  用户id
     * int $usertoken  token
     * int $vpsid  云主机id
     * int $osid  系统id
     * int $rot   格式化类型 0格c 1全格
     */
    public function osselectAction(){
        parent::nosession();
        $osmodel=D('Os');
        //获取系统类型
        $winos=$osmodel->where('ostype=%d',0)->select();//windows
        $linuxos=$osmodel->where('ostype=%d',1)->select();//linux
        //获取需要post的值
        if(IS_POST){
            $userid=session('loginuser.userid');
            $yungoid=session('loginuser.yungoid');
            $usertoken=session('loginuser.webguid');
            $vpsid=I('post.vpsid');
            $osid=I('post.osid');
            $rot=I('post.roottype');
            //判断是否是本人名下机器
            $myhost=self::myhost($vpsid);
            if (empty($myhost)) {
                $this->ajaxReturn(2);
                exit;
            }
            //POST
            $url = "http://180.101.72.213:2525/apiyungoing/vmreload";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "vpsid" => $vpsid,
                "userid" => $yungoid,
                "usertoken" => $usertoken,
                "osid" => $osid,
                "rot" => $rot,
            );
            //print_r($post_data);exit;
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            curl_close($ch);
            
            $this->ajaxReturn($output);
        }
        //模板输出
        $this->assign("winos",$winos);
        $this->assign("linuxos",$linuxos);
        $this->display();
    }

    /**
     * 备份/还原
     */
    // public function bankAction(){
    //     $userid=session('loginuser.userid');
    //     $usertoken=session('loginuser.webguid');
    //     $vpsid=I('vpsid/d');
    //     //获取主机数据列表       
    //     $url = "http://180.101.72.213:2525/apiyungoing/vminfo?userid=".$userid."&usertoken=".$usertoken."&vpsid=".$vpsid;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     $output = curl_exec($ch);
    //     curl_close($ch);
    //     $output=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);

    //     //获取备份列表
    //     $url = "http://180.101.72.213:2525/apiyungoing/vmbackup";
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     // post数据
    //     $post_data = array(
    //         "userid" => $userid,
    //         "usertoken" => $usertoken,
    //         "vpsid" => $vpsid,
    //         "subaction" => "list",
    //     );
    //     //print_r($post_data);exit;
    //     // post 变量
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //     $banklist = curl_exec($ch);
    //     curl_close($ch);
    //     $banklist=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($banklist)),TRUE))),TRUE);
    //     // print"<pre>";
    //     // print_r($banklist);exit;
    //     //$banklist=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);

    //     if(IS_POST){
    //         if(I('post.subaction')=='bankup'){
    //             $subaction=I('post.subaction');
    //             $bkname=I('post.bkname');
    //             $bktype=I('post.bktype');
    //             $vpsid=I('post.vpsid');
    //             //POST
    //             $url = "http://180.101.72.213:2525/apiyungoing/vmbackup";
    //             $ch = curl_init();
    //             curl_setopt($ch, CURLOPT_URL, $url);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //             curl_setopt($ch, CURLOPT_POST, 1);
    //             // post数据
    //             $post_data = array(
    //                 "userid" => $userid,
    //                 "usertoken" => $usertoken,
    //                 "vpsid" => $vpsid,
    //                 "subaction" => $subaction,
    //                 "bkname" => $bkname,
    //                 "bktype" => $bktype,
    //             );
    //             //print_r($post_data);exit;
    //             // post 变量
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //             $output = curl_exec($ch);
    //             curl_close($ch);
                
    //             $this->ajaxReturn($output);
    //         }else{
    //             $subaction=I('post.subaction');
    //             $bkid=I('post.bkid');
    //             $vpsid=I('post.vpsid');
    //             //POST
    //             $url = "http://180.101.72.213:2525/apiyungoing/vmbackup";
    //             $ch = curl_init();
    //             curl_setopt($ch, CURLOPT_URL, $url);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //             curl_setopt($ch, CURLOPT_POST, 1);
    //             // post数据
    //             $post_data = array(
    //                 "userid" => $userid,
    //                 "usertoken" => $usertoken,
    //                 "vpsid" => $vpsid,
    //                 "subaction" => $subaction,
    //                 "bkid" => $bkid,
    //             );
    //             //print_r($post_data);exit;
    //             // post 变量
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //             $output = curl_exec($ch);
    //             curl_close($ch);
                
    //             $this->ajaxReturn($output);
    //         }
            
    //     }
    //     $this->assign("vpsinfo",$output[0]);
    //     $this->assign("banklist",$banklist);
    //     $this->display();
    // }
    /**
     * 光驱管理
     */
    public function cdromAction(){
        parent::nosession();
        $vpsid=I('vpsid/d');
        //判断是否是本人名下机器
        $myhost=self::myhost($vpsid);
        if (empty($myhost)) {
            $this->error('主机不存在');
            exit;
        }
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        //POST
        $url = "http://180.101.72.213:2525/apiyungoing/vmcdmanage";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // post数据
        $post_data = array(
            "userid" => $yungoid,
            "usertoken" => $usertoken,
            "subaction" => "state",
            "vpsid" => $vpsid,
        );
        // post 变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $output=json_decode(json_decode($output));
        $image=self::object2array($output[0]);
        $image=self::object2array($image['images']);
        $curcdrom=self::object2array($output[1]);
        $curcdrom=$curcdrom["current"];
        if(IS_POST){
            $subaction=I('post.subaction');
            $cd_image=I('post.cd_image');
            $vpsid=I('post.vpsid');
            //判断是否是本人名下机器
            $myhost=self::myhost($vpsid);
            if (empty($myhost)) {
                $this->ajaxReturn(2);
                exit;
            }
            //POST
            $url = "http://180.101.72.213:2525/apiyungoing/vmcdmanage";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "userid" => $yungoid,
                "usertoken" => $usertoken,
                "subaction" => "change",
                "cd_image" => $cd_image,
                "vpsid" => $vpsid,
            );
            // post 变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            curl_close($ch);
            $this->ajaxReturn($output);
        }
        
        $this->assign("image",$image);
        $this->assign("current",$curcdrom);
        $this->display();
    }
    /**
     * 续费
     */
    public function renewalAction(){
        parent::nosession();
        $userid=session('loginuser.userid');
        $vpsid=I('vpsid/d');
        $paylogModel=M('paylog');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        $cloudlog=M('cloudlog');
        $info=$cloudlog->field('Price,Disprice,DueTime')->where("CloudNo ='%s'",$vpsid)->find();
        $price=explode('/', $info['price']);
        $disprice=explode('/', $info['disprice']);
        //获取到每月多少钱
        //季9折 半年8折 一年7折
        switch ($price[1]) {
            case '天':
                $oneday=$disprice[1]==$price[1]?$disprice[0]:$price[0];
                $month=$price[0]*30*0.4;//4折
                break;
            case '月':
                $month=$disprice[1]==$price[1]?$disprice[0]:$price[0];
                $ji=$price[0]*3*0.9;
                $bannian=$price[0]*6*0.8;
                $nian=$price[0]*12*0.7;
                break;
            case '季':
                $month=$price[0]/0.9/3;
                $ji=$disprice[1]==$price[1]?$disprice[0]:$price[0];
                $bannian=$month*6*0.8;
                $nian=$month*12*0.7;
                break;
            case '半年':
                $month=$price[0]/0.8/6;
                $ji=$month*3*0.9;
                $bannian=$disprice[1]==$price[1]?$disprice[0]:$price[0];
                $nian=$month*12*0.7;
                break;
            case '年':
                $month=$price[0]/0.7/12;
                $ji=$month*3*0.9;
                $bannian=$month*6*0.8;
                $nian=$disprice[1]==$price[1]?$disprice[0]:$price[0];
                break;
        }
        $info['oneday']=ceil($oneday);
        $info['month']=ceil($month);
        $info['ji']=ceil($ji);
        $info['bannian']=ceil($bannian);
        $info['nian']=ceil($nian);
        $this->assign("balance",$balance);
        $this->assign("info",$info);
        $this->assign("price",$price);
        $this->assign("vpsid",$vpsid);
        $this->display();
    }

    //续费
    public function renewAction()
    {
        parent::nosession();
        $chval=I('chval/d');
        $datatype=I('datatype/d');
        $vpsid=I('vpsid/d');
        //根据vpsid获取价格
        $cloudlog=M('cloudlog');
        $info=$cloudlog->field('UserID,Price,DueTime')->where("CloudNo ='%s'",$vpsid)->find();
        //判断是否为本人操作
        if(session('loginuser.userid')!=$info['userid']){
            $this->ajaxReturn('非法操作');
        }
        $price=explode('/', $info['price']);
        switch ($price[1]) {
            case '天':
                $oneday=$price[0];
                $month=$price[0]*30*0.4;//4折
                break;
            case '月':
                $month=$price[0];
                $ji=$price[0]*3*0.9;
                $bannian=$price[0]*6*0.8;
                $nian=$price[0]*12*0.7;
                break;
            case '季':
                $month=$price[0]/0.9/3;
                $ji=$price[0];
                $bannian=$month*6*0.8;
                $nian=$month*12*0.7;
                break;
            case '半年':
                $month=$price[0]/0.8/6;
                $ji=$month*3*0.9;
                $bannian=$price[0];
                $nian=$month*12*0.7;
                break;
            case '年':
                $month=$price[0]/0.7/12;
                $ji=$month*3*0.9;
                $bannian=$month*6*0.8;
                $nian=$price[0];
                break;
        }
        $info['oneday']=ceil($oneday);
        $info['month']=ceil($month);
        $info['ji']=ceil($ji);
        $info['bannian']=ceil($bannian);
        $info['nian']=ceil($nian);
        switch ($datatype) {
            case '0'://天
                if ($info['oneday']==$chval) {
                    self::xf($vpsid,$chval,$datatype);
                }
                else
                {
                    $this->ajaxReturn(1);
                    exit;
                }
                break;
            case '1'://月
                if ($info['month']==$chval) {
                   self::xf($vpsid,$chval,$datatype);
                }
                else
                {
                    $this->ajaxReturn(1);
                    exit;
                }
                break;
             case '2'://季
                if ($info['ji']==$chval) {
                    self::xf($vpsid,$chval,$datatype);
                }
                else
                {
                    $this->ajaxReturn(1);
                    exit;
                }
                break;
             case '3'://半年
                if ($info['bannian']==$chval) {
                    self::xf($vpsid,$chval,$datatype);
                }
                else
                {
                    $this->ajaxReturn(1);
                    exit;
                }
                break;
             case '4'://年
                if ($info['nian']==$chval) {
                    self::xf($vpsid,$chval,$datatype);
                }
                else
                {
                    $this->ajaxReturn(1);
                    exit;
                }
                break;
        }
    }

    static function xf($vpsid,$chval,$datatype)
    {
        $userid=session('loginuser.userid'); 
        $paylog=M('paylog');
        //获取当前用户余额
        //先获取当前用户的总充值金额
        $plusm=$paylog->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylog->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plusm[0]['my'],2)-round($minus[0]['my'],2);
        if ($balance<$chval) {
            echo json_encode(2);
            exit;
        }
        $data=array(
            "ordernum"=>"pgy".date('YmdHis'),
            "money"=>$chval,
            "userid"=>$userid,
            "addtime"=>time(),
            "datatype"=>1,
            "typename"=>"云主机线路一续费"
        );
        if ($paylog->add($data)) {
            $cloudlog=M('cloudlog');
            //先查询原记录的到期时间
            $duetime=$cloudlog->field('DueTime')->where('CloudNo = %d',$vpsid)->find();
            //修改支付方式和到期时间
            $dt="";
            switch ($datatype) {
                case '0':
                    $dt="/天";
                    $plus="+1day";
                    break;
                case '1':
                    $dt="/月";
                    $plus="+1month";
                    break;
                case '2':
                    $dt="/季";
                    $plus="+3month";
                    break;
                case '3':
                    $dt="/半年";
                    $plus="+6month";
                    break;
                case '4':
                    $dt="/年";
                    $plus="+1year";
                    break;
            }
            $data1=array(
                "Price"=>$chval.$dt,
                "State"=>"正常服务",
                "DueTime"=>strtotime($plus,$duetime['duetime'])
            );
            if ($cloudlog->where('CloudNo = %d',$vpsid)->save($data1)) {
                echo json_encode(0);
                exit;
            } else {
                echo json_encode(1);
                exit;
            } 
        } else {
           echo json_encode(1);
           exit;
        } 
    }

    /**
     * 图表chart
     */
    public function chartAction(){
        parent::nosession();
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $vpsid=I('vpsid/d');
        if(IS_POST){
            $charttype=I('post.charttype');
            $chartinterval=I('post.chartinterval');
            $vpsid=I('post.vpsid');
            //POST
            $url = "http://180.101.72.213:2525/apiyungoing/vmstat";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "userid" => $yungoid,
                "usertoken" => $usertoken,
                "vpsid" => $vpsid,
                "charttype" => $charttype,
                "chartinterval" => $chartinterval,
            );
            // post 变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            curl_close($ch);
            $output=json_decode($output);
            $output=self::trimall($output);
            $this->ajaxReturn($output);
        }
    }
    /**
     * 管理/添加ip地址
     */
    public function ipaddrAction(){
        parent::nosession();
        //获取userid usertoken vpsid
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $vpsid=I('vpsid/d');
        $paylogModel=M('paylog');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        //判断是否是本人名下机器
        $myhost=self::myhost($vpsid);
        if (empty($myhost)) {
            $this->error('主机不存在');
            exit;
        }

        $url = "http://180.101.72.213:2525/apiyungoing/vpsips?vpsid=".$vpsid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output=json_decode(json_encode(json_decode($output)),TRUE);
        $output=json_decode(json_encode(json_decode($output[0])),TRUE);

        if(IS_POST){
            $cloudlog=M('cloudlog');
            $vpsid=I('post.vpsid');
            if((int)$balance<200){
                $this->ajaxReturn(3);exit;
            }
            $cid=$cloudlog->where('CloudNo=%d',$vpsid)->getField('CID');//获取服务器节点id
            //POST
            $url = "http://180.101.72.213:2525/apiyungoing/addip";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "userid" => $yungoid,
                "usertoken" => $usertoken,
                "vpsid" => $vpsid,
                "cid" => $cid,
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $outres = curl_exec($ch);
            curl_close($ch);
            $outres=json_decode(json_encode(json_decode($outres)),TRUE);
            if (empty($outres[0])&&$outres!=2) {
                //扣费记录
                $data=array(
                    "ordernum"=>"pgy".date('YmdHis'),
                    "money"=>200,
                    "userid"=>$userid,
                    "addtime"=>time(),
                    "typename"=>"添加IP扣费",
                    "datatype"=>1
                );
                $paylogModel->add($data);
            }
            $this->ajaxReturn($outres);
        }
        $this->assign("balance",$balance);//余额
        $this->assign("output",$output);
        $this->assign("outputnum",count($output));
        $this->assign("netcardlist",$netcardlist);
        $this->display();
    }

    public function setipsAction(){
        parent::nosession();
        if(IS_POST){
            //获取userid usertoken vpsid
            $userid=session('loginuser.userid');
            $yungoid=session('loginuser.yungoid');
            $usertoken=session('loginuser.webguid');
            $vpsid=I('post.vpsid');

            $nicCount=I('post.nicCount');
            $mac_0=I('post.mac_0');
            $ip_0=I('post.ip_0');
            //POST
            $url = "http://180.101.72.213:2525/apiyungoing/vmsetips";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "userid" => $yungoid,
                "usertoken" => $usertoken,
                "vpsid" => $vpsid,
                "nicCount" => $nicCount,
                "mac_0" => $mac_0,
                "ip_0" => $ip_0,
            );
            // print_r($post_data);exit;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            curl_close($ch);
            $this->ajaxReturn($output);
        }
    }

    /**
     * 网卡控制
     */
    public function nccontrolAction(){
        parent::nosession();
        //获取userid usertoken vpsid
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $vpsid=I('vpsid/d');
        $myhost=self::myhost($vpsid);
        if (empty($myhost)) {
            $this->error('主机不存在');
            exit;
        }
        $paylogModel=M('paylog');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);

        $url = "http://180.101.72.213:2525/apiyungoing/vpsips?vpsid=".$vpsid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $output=json_decode(json_encode(json_decode($output)),TRUE);
        $output=json_decode(json_encode(json_decode($output[0])),TRUE);

        //获取主机网卡列表
        //POST
        $url = "http://180.101.72.213:2525/apiyungoing/vmvif";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // post数据
        $post_data = array(
            "userid" => $yungoid,
            "usertoken" => $usertoken,
            "vpsid" => $vpsid,
            "subaction" => "list",
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $netcardlist = curl_exec($ch);
        $netcardlist = json_decode(json_decode($netcardlist));
        $netcardlist = self::object2array($netcardlist);
        curl_close($ch);
        if(IS_POST){
            if(I('post.subaction')!=""){
                $vpsid=I('post.vpsid');
                $subaction=I('post.subaction');
                $vfid=I('post.vfid');
                //POST
                $url = "http://180.101.72.213:2525/apiyungoing/vmvif";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                // post数据
                $post_data = array(
                    "userid" => $yungoid,
                    "usertoken" => $usertoken,
                    "vpsid" => $vpsid,
                    "subaction" => empty($subaction)?'plug':'unplug',
                    "vfid" => $vfid,
                );
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                $output = curl_exec($ch);
                curl_close($ch);
                $this->ajaxReturn($output);
            }
        }
        $this->assign("netcardlist",$netcardlist);
        $this->assign("output",$output);
        $this->display();
    }

    function yungopost($postdata)
    {
        $url = "http://xen.pgyidc.com/process.aspx?c=api";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $output = curl_exec($ch);
        curl_close($ch);
        //$output=explode("|", $output);
        return $output;
    }
    /**
     * 对象 转 数组
     *
     * @param object $obj 对象
     * @return array
     */
    function object2array($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        }
        else {
            $array = $object;
        }
        return $array;
    }
    //此函数可以去掉空格，及换行。
    function trimall($str)
    {
        $qian=array('swin.dialog("option", "title", cTitle);',"  ","\t","\n","\r");
        $hou=array("","","","","");
        return str_replace($qian,$hou,$str); 
    }

    static function myhost($vpsid)
    {
        $userid=session('loginuser.userid');
        $usertype=session('loginuser.usertype');
        if (empty($usertype)) {
            $cloudlog=M('cloudlog');
            $info=$cloudlog->where("CloudNo ='%s' and UserID= %d",array($vpsid,$userid))->find();
            if (empty($info)) {
                return 0;
            }else{
                return 1;
            }
        }
        else
        {
            return 1;
        }
    }


    /*----------------------管理员云主机后台--------------------------*/
    public function admincdmgAction(){
        parent::nosession();
        $userid=session('loginuser.userid');
        $usertoken=session('loginuser.webguid');
        $usertype=session('loginuser.usertype');
        if (empty($usertype)) {
            $this->error('非法访问');
        }
        $cloudlogModel=M('cloudlog');
        $userModel=D('users');
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        if (!empty($key)) {
            $map['UserID']=array('eq',$key);
            $map['CloudNo']=array('eq',$key);
            $map['ip']=array('eq',$key);
            $map['_logic'] = 'OR';
        }
        $count = $cloudlogModel->where($map)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $Page->parameter['keyword'] =  $key;
        $show = $Page->show();// 分页显示输出
        $res=$cloudlogModel->limit($Page->firstRow.','.$Page->listRows)->where($map)->where("logicdel=%d",0)->order('id DESC')->select();
        // foreach ($res as $k => $val) {
        //     //查询余额
        //     //先获取当前用户的总充值金额
        //     $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($val['userid'],0))->select(); 
        //     $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($val['userid'],1))->select();
        //     $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        //     $res[$k]['balance']=$balance;
        // }
        $this->assign('model', $res);
        $this->assign('page',$show);
        $this->assign('keyword',$key);
        $this->assign("cloud",1);
        $this->assign("cloudmanage",1);
        $this->display();
    }

    //编辑用户产品服务
    public function proeditAction(){
        parent::nosession();
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $usertype=session('loginuser.usertype');
        if (empty($usertype)) {
            $this->error('非法访问');
        }
        $vid=I('vid/d');
        $cloudlog=M('cloudlog');
        $info=$cloudlog->where("CloudNo ='%s'",$vid)->find();
        //获取主机数据列表       
        $url = "http://180.101.72.213:2525/apiyungoing/vminfo?userid=".$yungoid."&usertoken=".$usertoken."&vpsid=".$vid."&usertype=".$usertype;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $outres=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);
        if (empty($outres)) {
            $this->error('主机不存在');
        }
        //所属产品
        $configinfo=M('configinfo');
        $proinfo=$configinfo->field('Title')->where("CID =%d",$info['cid'])->find();
        $this->assign("info",$outres[0]);
        $this->assign('cloud',$info);
        $this->display();
    }

    //编辑用户产品服务信息保存
    public function cloudsaveAction(){
        parent::nosession();
        $userid=session('loginuser.userid');
        $usertoken=session('loginuser.webguid');
        $usertype=session('loginuser.usertype');
        if (empty($usertype)) {
            $this->error('非法访问');
        }
        $cloudid=I('cloudid/d');
        $customid=I('customid/d');
        $state=I('state/s');
        $starttime=I('starttime/s');
        $price=I('price/s');
        $disprice=I('disprice/s');
        $endtime=I('endtime/s');
        $remarks=I('remarks/s');
        $oldstate=I('oldstate/s');
        $cloudno=I('cloudno/d');

        $cloudlog=M('cloudlog');
        $data=array(
            "UserID"=>$customid,
            "Price"=>$price,
            "Disprice"=>$disprice,
            "BuyTime"=>strtotime($starttime),
            "DueTime"=>strtotime($endtime),
            "State"=>$state,
            "Remarks"=>$remarks,
        );
        if (!$cloudlog->create($data)) {
            $this->error($cloudlog->getError());
        }else{
            if ($cloudlog->where('id = %d',$cloudid)->save($data)) {
                //需要调用接口改变云主机状态
                $url = "http://180.101.72.213:2525/apiyungoing/vmupdate";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                // post数据
                $ygid=self::getygid($customid);
                $post_data = array(
                    "vpsid" => $cloudno,
                    "userid" => $ygid,
                    "status" => $state=="正常服务"?2:1
                );
                // post的变量
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                $output = curl_exec($ch);
                curl_close($ch);
                $this->success('提交成功'); 
            } else {
                $this->error('更新失败');
            }        
        }
    }
    
    //管理子服务配置
    public function subeditAction(){
        parent::nosession();
        //获取ip列表
        if(IS_POST){
            $sid=I('post.serverid');
            //POST
            $url = "http://180.101.72.213:2525/apiyungoing/vpsips";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "serverid" => $sid,
            );
            //print_r($post_data);exit;
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            $output = json_decode($output);
            curl_close($ch);
            
            $this->ajaxReturn($output);
        }
        //实例化数据模型
        $cloudlogmodel=M('cloudlog');
        $configinfomodel=M('configinfo');
        //获取userid usertoken vpsid
        $userid=session('loginuser.userid');
        $yungoid=session('loginuser.yungoid');
        $usertoken=session('loginuser.webguid');
        $usertype=session('loginuser.usertype');
        $vid=I('vpsid/d');
        //获取主机数据列表       
        $url = "http://180.101.72.213:2525/apiyungoing/vminfo?userid=".$yungoid."&usertoken=".$usertoken."&vpsid=".$vid."&usertype=".$usertype;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $outres=json_decode(json_encode(json_decode(json_decode(json_encode(json_decode($output)),TRUE))),TRUE);
        //获取服务器分组
        $cid=$cloudlogmodel->where("CloudNo=%d",$vid)->getField("CID");//获取cid
        $servergroup=$configinfomodel->where("CID=%d",$cid)->getField("Title");//获取服务器分组
        //获取云主机编号
        $vpsno=$cloudlogmodel->where("CloudNo=%d",$vid)->getField("id");//获取云主机编号
        //模板赋值
        $this->assign("info",$outres[0]);
        $this->assign("servergroup",$servergroup);
        $this->assign("vpsno",$vpsno);
        $this->display();
    }
    //保存子服务配置
    public function subeditsaveAction(){
        if(IS_POST){
            $ygid=self::getygid(I('post.customid'));
            $vid=I('post.vid');
            $vcpu=I('post.cpunum');
            $vram=I('post.ramnum');
            $vdisk=I('post.disknum');
            $vport=I('post.port');
            $status=I('serverstate');
            $ip=I('post.serverip');
            $additionalips=I('post.additionalips');

            $url = "http://180.101.72.213:2525/apiyungoing/vmupdate";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            // post数据
            $post_data = array(
                "vpsid" => $vid,
                "userid" => $ygid,
                "cpu" => $vcpu,
                "ram_max" => $vram,
                "ram_min" => 1024,
                "disk" => $vdisk,
                "bandwidth" => 0,
                "port" => $vport,
                "status" => $status,
                "ip" => $ip,
                "additionalips" => $additionalips,
            ); 
            //print_r($post_data);exit; 
            //$this->ajaxReturn($post_data);exit;
            // post的变量
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            curl_close($ch);
            $this->ajaxReturn($output);
        }
    }
    //删除用户产品
    public function deleteAction(){
        $vid=I('post.vpsid');
        $userid=session('loginuser.userid');
        $usertoken=session('loginuser.webguid');
        $cloudlogmodel=M('cloudlog');
        //获取当前云主机价格
        $vpsprice=$cloudlogmodel->where("CloudNo=%d",$vid)->getField("Price");
        //获取当前云主机购买时间
        $buytime=$cloudlogmodel->where("CloudNo=%d",$vid)->getField("BuyTime");
        //获取当前云主机到期时间
        $duetime=$cloudlogmodel->where("CloudNo=%d",$vid)->getField("DueTime");
        //获取当前时间
        $curtime=time();
        //计算出返现金额 返现金额=（到期时间-当前时间）/（到期时间-购买时间）*价格
        $cashback=($duetime-$curtime)/($duetime-$buytime)*$vpsprice;
        //将返现存入数据库
        $paylogModel=M('paylog');
        $data=array(
            "ordernum"=>"pgy".date('YmdHis'),
            "money"=>$cashback,
            "userid"=>$userid,
            "addtime"=>time(),
            "typename"=>"云主机返现",
            "datatype"=>0
        );
        $paylogModel->add($data);
        //删除云主机在本地数据库中信息
        $cloudlogmodel->where("CloudNo=%d",$vid)->save(array("logicdel" => 1));
        //删除云谷服务器信息
        $url = "http://180.101.72.213:2525/apiyungoing/vmdelete";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // post数据
        $post_data = array(
            "vpsid" => $vid,
            "userid" => $userid,
            "usertoken" => $usertoken,
        ); 
        // post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode(json_encode(json_decode($output)),TRUE);
        if ($output[0]==0) {
            $this->ajaxReturn("success");
        }else{
            $this->ajaxReturn("error");
        }
    }
    /**
     * 重置密码
     */
    public function pswresetAction(){
        //$newpsw=I('post.newpwd');
        $vpsid=I('post.vid');
        //删除云谷服务器信息
        $url = "http://180.101.72.213:2525/apiyungoing/vmresetps";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // post数据
        $post_data = array(
            "vpsid" => $vpsid,
            "userid" => session('loginuser.yungoid'),
            "usertoken" => session('loginuser.webguid'),
        ); 
        // post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        
        $output = json_decode(json_encode(json_decode($output)),TRUE);
        if($output=="0"){
            $this->ajaxReturn("success");
        }else{
            $this->ajaxReturn("error");
        }
    }

    //根据客户id获取客户的云谷id
    static function getygid($userid)
    {
        $user=M('users');
        $ygid=$user->field('YungoID')->where('UserID=%d',$userid)->find();
        return $ygid['yungoid'];
    }
}