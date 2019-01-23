<?php
namespace Home\Controller;
use Think\Controller;
class HdcloudController extends Controller {
    function   _empty(){
		header( " HTTP/1.0  404  Not Found" );
        $this->display( 'Public:404' );
    }
    /*-------------------------------------京东云---------------------------------------------*/
    public function jdcloudAction(){
        $this->assign("title","云主机线路2-蒲公英网络");
        $this->display();
    }
    public function jdcloudbuyAction(){
        $this->assign("current","jdcloudbuy");
        $this->assign("title","云主机线路2购买-蒲公英网络");
        $this->display();
    }
    public function vhostAction(){
        $this->assign("current","cloud");
        $this->assign("title","虚拟主机购买-蒲公英网络");
        $this->display();
    }
    //获取镜像列表
    public function getimageAction(){
        header('content-type:textml;charset=utf-8;');
        $imagesource=I('post.imagesource');
        $platform=I('post.platform');
        $regionid=I('post.regionid');
        $url = "http://43.240.1.2:2333/images/";
        $post_data = array (
            "regionid" => $regionid,
            "imagesource" => $imagesource,
            "platform" => $platform
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        //$output=json_decode(json_encode(json_decode($output)),TRUE);
        //$output=json_decode(json_encode(json_decode($output[0])),TRUE);
        print_r($output);exit;
    }
    //获取规格
    public function getstandardAction(){
        header('content-type:textml;charset=utf-8;');
        $url = "http://43.240.1.2:2333/instancetypes/";
        $post_data = array (
            "keyword" => I('post.keyword'),
            "regionid" =>I('post.regionidid')
        );
        //print_r($post_data);exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_GET, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        print_r($output);exit;
    }
    //获取价格
    public function getpriceAction(){
        $isbgp=I('post.provider');//是否为bgp带宽
        $bandwidth=I('post.bandwidth');//带宽大小
        $standard=I('post.instancetype');//规格
        $highpan=I('post.highpan');//高效盘
        $ssdpan=I('post.ssdpan');//ssd盘
        $duration=I('post.duration');//购买时长
        $number=I('post.number');//购买量
        $this->ajaxReturn(self::gettotalprice($standard,$isbgp,$bandwidth,$highpan,$ssdpan,$duration));
    }
    //购买
    public function buynowAction(){
        if(session("loginuser")==""){
            $this->ajaxReturn("请先登录！");exit;
        }
        $regionid=I('post.regionid');
        $area=I('post.area');
        $imageid=I('post.imageid');
        $isbgp=I('post.provider');
        $provider=I('post.provider');
        $bandwidth=I('post.bandwidth');
        $servername=I('post.servername');
        $description=I('post.description');
        $password=I('post.password');
        $duration=I('post.duration');
        $number=I('post.number');
        $instancetype=I('post.instancetype');
        $highpan=I('post.highpan');
        $ssdpan=I('post.ssdpan');
        $duration=I('post.duration');//购买时长
        $imagename=I('post.imagename');
        //$number=I('post.number');//购买量
        //$totalprice=I('post.totalprice');
        //计算总价
        $totalprice=self::gettotalprice($instancetype,$isbgp,$bandwidth,$highpan,$ssdpan,$duration);
        //获取用户余额
        $balance=self::getbalance();
        //判断余额是否足够
        if($balance<$totalprice){
            $this->ajaxReturn('余额不足，请前往控制台充值后购买！');exit;
        }
        //创建云主机数组传递
        $post_create_data = array (
            "instancetype"=>$instancetype,
            "area"=>$regionid.$area,
            "imageid"=>$imageid,
            "yunname"=>$servername,
            "password"=>$password,
            "regionid"=>$regionid,
            "bandwidth"=>$bandwidth,
            "provider"=>$provider,
            "description"=>$description,
            "ssdpan"=>empty($ssdpan)?"":$ssdpan,
            "highpan"=>empty($highpan)?"":$highpan,
        );
        if ($regionid=='cn-east-1') {
            self::creatip($post_create_data,$totalprice,$duration,$regionid,$imagename);
        }
        else
        {
            //创建云主机
            $createurl = "http://43.240.1.2:2333/create/";
            $res=self::post($createurl,$post_create_data);
            $instanceIds=$res['msg']['result']['instanceIds'][0];//创建主机id

            if(empty($res['msg']['error'])){
                self::minusbalance($totalprice);//扣款
                self::saveinfo($instanceIds,"",$totalprice,$duration,$regionid,$imagename);//保存信息
                $this->ajaxReturn(0);//创建成功
            }
            else
            {
                $this->ajaxReturn($res['msg']['error']['message']);//创建主机失败提示
            }
        }        
    }
    //创建ip
    function creatip($postcreatedata,$totalprice,$duration,$regionid,$imagename){
        header('content-type:textml;charset=utf-8;');
        $jdiplistmodel=M('jdiplist');
        $ipcount=$jdiplistmodel->count();
        for($i=1;$i<=$ipcount;$i++){
            $ip=$jdiplistmodel->where("status=%d",0)->getfield("ip");
            //print_r($ip);exit;
            $url = "http://43.240.1.2:2333/jd/createelasticips/";
            $post_data = array (
                "ip" => $ip,
            );
            $output=self::post($url,$post_data);
            if(empty($output['msg']['error'])){
                $elasticIpIds=$output['msg']['result']['elasticIpIds'][0];//弹性ip id
                //说明该ip可用 1改变数据库状态
                $data["status"]=1;
                $jdiplistmodel->where("ip='%s'",$ip)->save($data);
                //创建云主机
                $createurl = "http://43.240.1.2:2333/create/";
                $res=self::post($createurl,$postcreatedata);
                if(empty($res['msg']['error'])){
                    $instanceIds=$res['msg']['result']['instanceIds'][0];//创建主机id
                    $assurl = "http://43.240.1.2:2333/associateelasticip/";
                    $post_ass_data = array (
                        "instanceid" => $instanceIds,
                        "elasticIpid" => $elasticIpIds
                    );
                    $assres=self::post($assurl,$post_ass_data);
                    if (!empty($assres['msg']['requestId'])) {
                        self::minusbalance($totalprice);//扣款
                        self::saveinfo($instanceIds,$ip,$totalprice,$duration,$regionid,$imagename);//保存信息
                        $this->ajaxReturn(0);//创建成功
                    }
                    else
                    {
                        $this->ajaxReturn(1);//绑定失败，联系管理员处理
                    }
                }
                else
                {
                    $this->ajaxReturn($res['msg']['error']['message']);//创建主机失败提示
                }
            }
            else
            {
                $this->ajaxReturn(2);//无可用ip，联系管理员处理
            }
        }
    }
    //post方法
    function post($url,$postdata)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        $output = curl_exec($ch);
        curl_close($ch);
        $output=json_decode(json_encode(json_decode($output)),TRUE);
        return $output;
    }
    //计算价格方法
    function gettotalprice($standard,$isbgp,$bandwidth,$highpan,$ssdpan,$duration){
        $jdcstandardmodel=M('jdcstandard');
        $jdcprice=M('jdcprice');
        //规格价格
        $standardprice=$jdcstandardmodel->where("standard='%s'",$standard)->getField('price');
        //带宽价格
        if($isbgp=='BGP'){
            //初始价格
            $bandwidthprice=$jdcprice->where("id=1")->getField('bgp')*$bandwidth+15;
            if($bandwidth>1||$bandwidth<=5){
                $bandwidthprice=$bandwidthprice+($bandwidth-1)*25.25+15;
            }else if($bandwidth==6){
                $bandwidthprice=205+15;
            }else{
                $bandwidthprice=205+($bandwidth-6)*80+15;
            }
        }else{
            $bandwidthprice=$jdcprice->where("id=1")->getField('notbgp')*$bandwidth;
        }
        //存储价格
        $highpanprice=0;//高效盘价格
        $ssdpanprice=0;//ssd盘价格
        if(!empty($highpan)){
            $highpanarr=explode(",",$highpan);
            foreach($highpanarr as $val){
                $highpanprice+=$val*$jdcprice->where("id=1")->getField('highpan');
            }
        }else{
            $highpanprice=0;
        }
        if(!empty($ssdpan)){
            $ssdpanarr=explode(",",$ssdpan);
            foreach($ssdpanarr as $val){
                $ssdpanprice+=$val*$jdcprice->where("id=1")->getField('ssdpan');
            }
        }else{
            $ssdpanprice=0;
        }
        $jdctotalprice=($standardprice+$bandwidthprice+$highpanprice+$ssdpanprice)*$duration;
        return $jdctotalprice;
    }
    //获取账户余额方法
    function getbalance(){
        //获取当前用户余额
        $paylogModel=M('paylog');
        $userid=session('loginuser.userid');
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        return $balance;
    }
    //扣款方法
    function minusbalance($price){
        $paylogModel=M('paylog');
        $paylogdata['ordernum']='pgy'.date('YmdHis',time());
        $paylogdata['money']=$price;
        $paylogdata['userid']=session("loginuser.userid");
        $paylogdata['addtime']=time();
        $paylogdata['typename']="购买云主机";
        $paylogdata['datatype']=1;
        $paylogModel->add($paylogdata);
    }
    //保存云主机信息
    function saveinfo($cloudno,$ip,$price,$duration,$regionid,$imagename){
        $jdcloudlogmodel=M('jdcloudlog');
        $jdcloudlogdata=array(
            "UserID" => session("loginuser.userid"),
            "CloudNo" => $cloudno,
            "ip" => $ip,
            "Price" => $price."元/".$duration."月",
            "Disprice" => $price."元/".$duration."月",
            "BuyTime" => time(),
            "DueTime" => strtotime(date('Y-m-d',strtotime('+'.$duration.'month'))),
            "regionid" => $regionid,
            "imagename" => $imagename
        );
        $jdcloudlogmodel->add($jdcloudlogdata);
    }

}