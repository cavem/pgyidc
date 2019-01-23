<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    function   _empty(){
		header( " HTTP/1.0  404  Not Found" );
        $this->display( 'Public:404' );
    }
    /**
     *     首页
     */
    public function indexAction(){
        $this->assign("current","index");
        $this->assign("title","宿迁蒲公英网络有限公司");
        $this->display();
    }
    /**
     *     云产品
     * 云服务器serverbuy
     * 云虚拟主机vhost
     */
    public function cloudAction(){
        $this->assign("title","云服务器-蒲公英网络");
        $this->display();
    }
    public function cloudbuyAction(){
        $configlistmodel=D('Configlist');
        $configinfomodel=D('Configinfo');
        $corepricemodel=D('Coreprice');
        $pricemodel=D('Price');
        $osmodel=D('Os');
        $id=I('id/d');
        $cid=I('cid/d');
        //获取当前用户余额
        $paylogModel=M('paylog');
        $userid=session('loginuser.userid');
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        
        //获取主机id cid
        if(empty($cid)&&empty($id)){
            $id=1;$cid=1;
        }
        if(empty($cid)){
            $cid=$configinfomodel->where("NavData=%d AND DataName=%d",$id,0)->getField("CID");
        }
        if(empty($id)){
            $id=$configinfomodel->where("CID=%d AND DataName=%d",$cid,0)->getField("NavData");
        }
        
        //获取云主机配置信息
        $cloudtypelist=$configlistmodel->where("Property=%d",0)->select();
        $this->assign("cloudtypelist",$cloudtypelist);//云主机

        $configtypelist=$configinfomodel->where("NavData=%d AND DataName=%d",$id,0)->select();
        $this->assign("configtypelist",$configtypelist);//配置

        $bandwidth=$configinfomodel->where("FatherID=%d AND DataName=%d",$cid,1)->getField("Title");//带宽
        $bandwidth=explode("/",$bandwidth);

        $ssd=$configinfomodel->where("FatherID=%d AND DataName=%d",$cid,2)->getField("Title");//存储
        $ssd=explode("/",$ssd);

        $ip=$configinfomodel->where("FatherID=%d AND DataName=%d",$cid,3)->getField("Title");//ip
        $ip=explode("/",$ip);
        //print_r($ip);exit;

        $cpu=$corepricemodel->where('CID=%d',$cid)->group('Kernel')->getField('ID,Kernel',true);//cpu

        $mmr=$corepricemodel->where('CID=%d',$cid)->group('Gigabyte')->getField('ID,Gigabyte',true);//内存

        $bdssdiparr=array("cpu"=>$cpu,
                          "mmr"=>$mmr,
                          "bandwidth"=>array("bdmin"=>$bandwidth[0],"bdmax"=>$bandwidth[1]),
                          "ssd"=>array("ssd30"=>$ssd[0],"ssd50"=>$ssd[1]),
                          "ip"=>array("ip1"=>$ip[0],"ip2"=>$ip[1]));
        $winos=$osmodel->where('ostype=%d',0)->select();//windows
        $linuxos=$osmodel->where('ostype=%d',1)->select();//linux
        $this->assign("bdssdiparr",$bdssdiparr);//带宽+存储+ip
        $this->assign("id",$id);
        $this->assign("cid",$cid);
        $this->assign("winos",$winos);
        $this->assign("linuxos",$linuxos);
        $this->assign("current","cloudbuy");
        $this->assign("balance",$balance);
        $this->assign("title","云服务器弹性购买-蒲公英网络");
        $this->display();
    }
    public function cloudbuyreqAction(){
        $corepricemodel=D('Coreprice');
        $pricemodel=D('Price');
        // 缓存初始化
        S(array('type'=>'memcache','host'=>'127.0.0.1','port'=>'11211','prefix'=>'think','expire'=>60));
        if(IS_POST){
            //request
            //$isbuy=I('post.isbuy');//是否购买0不1买
            $cloudtype=(int)I('post.cloudtype');//云主机类型id
            $config=(int)I('post.config');//配置cid
            $cpu=(int)I('post.cpu');//cpu 2,4,8
            $mmr=(int)I('post.mmr');//内存 1,2,4,8
            $ssd=I('post.ssd');//存储 30G,50G
            $ssd=(int)substr($ssd,0,2);
            $port=(int)I('post.port');//端口 10
            $os=I('post.os');//系统
            // $shotbank=(int)I('post.shotbank');//快照备份0,1
            // $fullbank=(int)I('post.fullbank');//完整备份0,1
            $ip=I('post.ip');//ip 1个，2个
            $ip=(int)substr($ip,0,1);
            $dur=I('post.dur');//时长 1个月，1天
            //查询各项价格
            if(S('basepricecid'.$config)!=false){
                $baseprice=S('basepricecid'.$config);
            }else{
                $baseprice=$pricemodel->where("CID=%d AND DataName=%d",$config,3)->getField("Prix");//基础价格
                S('basepricecid'.$config,$baseprice);//存入缓存
            }
            if(S('ssdpricecid'.$config)!=false){
                $ssdprice=S('ssdpricecid'.$config);
            }else{
                $ssdprice=$pricemodel->where("CID=%d AND DataName=%d",$config,4)->getField("Prix");//存储价格
                S('ssdpricecid'.$config,$ssdprice);//存入缓存
            }
            if(S('portpricecid'.$config)!=false){
                $portprice=S('portpricecid'.$config);
            }else{
                $portprice=$pricemodel->where("CID=%d AND DataName=%d",$config,0)->getField("Prix");//端口价格
                S('portpricecid'.$config,$portprice);//存入缓存
            }
            if(S('ippricecid'.$config)!=false){
                $ipprice=S('ippricecid'.$config);
            }else{
                $ipprice=$pricemodel->where("CID=%d AND DataName=%d",$config,5)->getField("Prix");//ip价格
                S('ippricecid'.$config,$ipprice);//存入缓存
            }
            if(S('salepricecid'.$config)!=false){
                $saleprice=S('salepricecid'.$config);
            }else{
                $saleprice=$pricemodel->where("CID=%d AND DataName=%d",$config,2)->getField("Prix");//折扣价格
                S('salepricecid'.$config,$saleprice);//存入缓存
            }
            if(S('cpummrpricecid'.$config.$cpu.$mmr)!=false){
                $cpummrprice=S('cpummrpricecid'.$config.$cpu.$mmr);
            }else{
                $cpummrprice=$corepricemodel->where("CID=%d AND Kernel=%d AND Gigabyte=%d",$config,$cpu,$mmr)->getField("Prix");//cpu内存价格
                S('cpummrpricecid'.$config.$cpu.$mmr,$cpummrprice);//存入缓存
            }
            //计算总价
            if($cpu==2&&$mmr==1&&$ssd==30&&$port==10&&$ip==1){
                $totalprice=$baseprice*$dur;
            }else{
                $totalprice=($baseprice+$ssdprice*($ssd-30)+$portprice*($port-10)+$ipprice*($ip-1)+$cpummrprice)*$dur;//总价
            }

            $this->ajaxReturn((int)$totalprice);   
            
        }
    }
    public function isbuyreqAction(){
        if(IS_POST){
            $userid=base64_decode(I('post.userid'));
            $yungoid=base64_decode(I('post.yungoid'));
            $cpu=base64_decode(I('post.cpu'));
            $ram_max=base64_decode(I('post.ram_max'));
            $ram_min=base64_decode(I('post.ram_min'));
            $disk=base64_decode(I('post.disk'));
            $bandwidth=base64_decode(I('post.bandwidth'));
            $port=base64_decode(I('post.port'));
            $additionalips=base64_decode(I('post.additionalips'));
            $osid=base64_decode(I('post.osid'));
            $cid=base64_decode(I('post.cid'));
            $dur=base64_decode(I('post.dur'));//时长
            $price=base64_decode(I('post.totalprice'));//总价
            //初始化curl
            $curl = curl_init();
            //设置抓取的url
            curl_setopt($curl, CURLOPT_URL, 'http://180.101.72.213:2525/apiyungoing/poweroff');
            //设置头文件的信息作为数据流输出
            curl_setopt($curl, CURLOPT_HEADER, 0);
            //设置获取的信息以文件流的形式返回，而不是直接输出。
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //设置post方式提交
            curl_setopt($curl, CURLOPT_POST, 1);
            //设置post数据
            $post_data = array(
                "userid" => $yungoid,
                "cpu" => $cpu,
                "ram_max" => $ram_max,
                "ram_min" => $ram_min,
                "disk" => $disk,
                "bandwidth" => $bandwidth,
                "port" => $port,
                "additionalips" => $additionalips,
                // "backup_snapshot" => $backup_snapshot,
                // "backup_full" => $backup_full,
                "osid" => $osid,
                "cid" => $cid,
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
            //执行命令
            $data = curl_exec($curl);
            //关闭URL请求
            curl_close($curl);
            $dataarr=json_decode($data);//将返回数据转换为数组
            //如果返回数据正确
            if($dataarr[0]=="0"){
                //将数据存入数据库
                $cloudlogmodel=M('cloudlog');
                $cloudno=$dataarr[1];//云主机编号
                $buytime=time();//购买时间
                $duetime=strtotime(date('Y-m-d',strtotime('+'.$dur.'month')));//到期时间
                $durarr=array(1=>'月',3=>'季',6=>'半年',12=>'一年');
                $cloudlogdata['UserID']=$userid;
                $cloudlogdata['CloudNo']=$cloudno;
                $cloudlogdata['ip']=$dataarr[2];
                $cloudlogdata['Price']=$price.'/'.$durarr[$dur];
                $cloudlogdata['Disprice']=$price.'/'.$durarr[$dur];
                $cloudlogdata['BuyTime']=$buytime;
                $cloudlogdata['DueTime']=$duetime;
                $cloudlogdata['CID']=$cid;
                $cloudlogmodel->add($cloudlogdata);
                //订单信息存入数据库
                $paylogModel=M('paylog');
                $paylogdata['ordernum']='pgy'.date('YmdHis',time());
                $paylogdata['money']=$price;
                $paylogdata['userid']=$userid;
                $paylogdata['addtime']=time();
                $paylogdata['typename']="购买云主机";
                $paylogdata['datatype']=1;
                $paylogModel->add($paylogdata);
                //返回获得的数据
                $this->ajaxReturn("success");
            }else{
                $this->ajaxReturn("data_error");
            }
            
        }
    }
    public function cloudlogAction(){
        $cloudlogmodel=M('cloudlog');
        $userid=I('userid/d');//userid
        $cloudno=I('cloudno/d');//云主机编号
        $dur=I('dur/s');//时长
        $buytime=time();//购买时间
        if(strlen($dur)>6){
            if(strlen($dur)==7){
                $dur=substr($dur,0,1);
                $duetime=strtotime(date('Y-m-d',strtotime('+'.$dur.'month')));
            }else{
                $dur=substr($dur,0,2);
                $duetime=strtotime(date('Y-m-d',strtotime('+'.$dur.'month')));
            }
        }else{
            $dur=substr($dur,0,1);
            $duetime=strtotime(date('Y-m-d',strtotime('+'.$dur.'day')));
        }
        $data['UserID']=$userid;
        $data['CloudNo']=$cloudno;
        $data['BuyTime']=$buytime;
        $data['DueTime']=$duetime;
        $cloudlogmodel->add($data);
    }
    /**
     *    服务器租用与托管
     */
    public function serverbuyAction(){
        $this->assign("current","cloud");
        $this->assign("title","服务器租用与购买-蒲公英网络");
        $this->display();
    }
    //获取租用价格
    public function getrentpriceAction(){
        $rentpricemodel=M("rentprice");
        $road=I('post.area').I('post.defense');//机房
        $cpu=I('post.cpu');//cpu
        $ram=I('post.ram');//ram
        $ssd=I('post.ssd');//ssd
        $cnip=I('post.cnip')=="0"?0:1;
        $cmip=I('post.cmip')=="0"?0:1;
        $cuip=I('post.cuip')=="0"?0:1;
        if($cnip+$cmip+$cuip!=0){
            $ip=$cnip+$cmip+$cuip."个";
        }else if(I('post.area')=='福州双线'){
            $ip="2个";
        }else{
            $ip="1个";
        }
        $bd=I('post.bandwidth')."M";//带宽
        $dur=I('post.duration_y')*12+I('post.duration_m');//时长
        $map=array(
            "road" => $road,
            "cpu" => $cpu,
            "ram" => $ram,
            "ssd" => $ssd,
            "ip" => $ip,
        );
        //print_r($map);exit;
        //计算基础价格
        $totalprice=$rentpricemodel->where($map)->getfield("price");
        //$this->ajaxReturn($totalprice);exit;
        //判断产品线路类型
        if(I('post.area')=="宿迁多线"){
            if($cnip+$cmip+$cuip==0){
                $this->ajaxReturn("请至少添加一个ip");
            }
            $bdprice=0;$cnipprice=0;$cmipprice=0;$cuipprice=0;
            //带宽价格
            if($ip==1){
                $bdprice=(I('post.bandwidth')-30)*12;
            }else if($ip==2){
                $bdprice=(I('post.bandwidth')-30)*20;
            }else{
                $bdprice=(I('post.bandwidth')-30)*25;
            }
            /*--ip价格--*/
            //电信ip价格
            if(I('post.defense')=="100G"){
                $cnipprice=I('post.cnip')>1?(I('post.cnip')-1)*150:0;
            }else if(I('post.defense')=="150G"){
                $cnipprice=I('post.cnip')>1?(I('post.cnip')-1)*400:0;
            }else{
                $cnipprice=I('post.cnip')>1?(I('post.cnip')-1)*800:0;
            }
            //移动ip价格
            $cmipprice=I('post.cmip')>1?(I('post.cmip')-1)*150:0;
            //联通ip价格
            $cuipprice=I('post.cuip')>1?(I('post.cuip')-1)*150:0;
            //计算总价
            $totalprice=($totalprice+$dfprice+$bdprice+$cnipprice+$cmipprice+$cuipprice)*$dur;
        }else if(I('post.area')=="宿迁BGP"){
            if(I('post.bgpip')==0){
                $this->ajaxReturn("请至少添加一个ip");
            }
            //判断是否是bgp20G 30M带宽的特价商品
            if(I('post.defense')=="20G"&&I('post.bandwidth')=="30"){
                $bgpipprice=0;
                //ip价格
                if(I('post.defense')=="20G"){
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*150:0;
                }else if(I('post.defense')=="100G"){
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*400:0;
                }else{
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*900:0;
                }
                //总价
                $totalprice=($totalprice+$bgpipprice)*$dur;
            }else if(I('post.defense')=="300G"&&I('post.bandwidth')=="100"){
                $bgpipprice=0;
                //ip价格
                if(I('post.defense')=="20G"){
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*150:0;
                }else if(I('post.defense')=="100G"){
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*400:0;
                }else{
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*900:0;
                }
                //总价
                $totalprice=($totalprice+$bgpipprice-200)*$dur;
            }else{
                $bdprice=0;$bgpipprice=0;
                //带宽价格
                $bdprice=(I('post.bandwidth')-30)*40;
                //ip价格
                if(I('post.defense')=="20G"){
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*150:0;
                }else if(I('post.defense')=="100G"){
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*400:0;
                }else{
                    $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*900:0;
                }
                //总价
                $totalprice=($totalprice+$bdprice+$bgpipprice-200)*$dur;
            }
        }else{
            if(I('post.fhip')==0){
                $this->ajaxReturn("请至少添加一个ip");
            }
            $fhipprice=0;
            switch(I('post.defense')){
                case '120G':case '100G独立清洗':case '200G独立清洗':case '300G独立清洗':case '400G独立清洗':case '500G独立清洗':case '云堤死扛定制':$fhipprice=(I('post.fhip')-1)*300;break;
                case '260G集群':case '300G集群':$fhipprice=(I('post.fhip')-2)*300;break;
                case '180G':$fhipprice=(I('post.fhip')-1)*500;break;
                case '320G':$fhipprice=(I('post.fhip')-1)*800;break;
                case '400G':$fhipprice=(I('post.fhip')-1)*1000;break;
            }
            $totalprice=($totalprice+$fhipprice)*$dur;
            if($totalprice>=90000){
                $totalprice='9W+';
            }
        }
        $this->ajaxReturn($totalprice);
    }
    //获取托管价格
    public function gettrustpriceAction(){
        $road=I('post.area');
        $unum=I('post.unum');
        $defense=I('post.defense');
        $bd=I('post.bandwidth');
        $cnip=I('post.cnip')=="0"?0:1;
        $cmip=I('post.cmip')=="0"?0:1;
        $cuip=I('post.cuip')=="0"?0:1;
        $ip=$cnip+$cmip+$cuip==0?1:$cnip+$cmip+$cuip;//ip线数
        $dur=I('post.duration_y')*12+I('post.duration_m');//时长
        $totalprice=0;
        //判断线路类型
        if($road=="宿迁多线"){
            if($cnip+$cmip+$cuip==0){
                $this->ajaxReturn("请至少添加一个ip");
            }
            $baseprice=0;$dfprice=0;$bdprice=0;$cnipprice=0;$cmipprice=0;$cuipprice=0;$uprice=0;
            //先算出基础价格
            switch($ip){
                case "1":$baseprice=450;break;
                case "2":$baseprice=550;break;
                case "3":$baseprice=700;break;
            }
            //防御价格
            switch($defense){
                case "100":$dfprice=0;break;
                case "150":$dfprice=300;break;
                case "200":$dfprice=800;break;
            }
            //带宽价格
            if($ip==1){
                $bdprice=(I('post.bandwidth')-30)*12;
            }else if($ip==2){
                $bdprice=(I('post.bandwidth')-30)*20;
            }else{
                $bdprice=(I('post.bandwidth')-30)*25;
            }
            //ip价格
            /*--ip价格--*/
            //电信ip价格
            if(I('post.defense')=="100"){
                $cnipprice=I('post.cnip')>1?(I('post.cnip')-1)*150:0;
            }else if(I('post.defense')=="150"){
                $cnipprice=I('post.cnip')>1?(I('post.cnip')-1)*400:0;
            }else{
                $cnipprice=I('post.cnip')>1?(I('post.cnip')-1)*800:0;
            }
            //移动ip价格
            $cmipprice=I('post.cmip')>1?(I('post.cmip')-1)*150:0;
            //联通ip价格
            $cuipprice=I('post.cuip')>1?(I('post.cuip')-1)*150:0;
            //机器u 节点价格
            $uprice=$unum>1?($unum-1)*300:0;
            //总价
            $totalprice=($baseprice+$dfprice+$bdprice+$cnipprice+$cmipprice+$cuipprice+$uprice)*$dur;
        }else{
            if(I('post.bgpip')==0){
                $this->ajaxReturn("请至少添加一个ip");
            }
            $baseprice=700;$dfprice=0;$bdprice=0;$bgpipprice=0;$uprice=0;
            //防御价格
            switch($defense){
                case "20":$dfprice=0;break;
                case "100":$dfprice=500;break;
                case "300":$dfprice=2000;break;
            }
            //带宽价格
            $bdprice=(I('post.bandwidth')-30)*40;
            //ip价格
            if(I('post.defense')=="20G"){
                $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*150:0;
            }else if(I('post.defense')=="100G"){
                $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*400:0;
            }else{
                $bgpipprice=I('post.bgpip')>1?(I('post.bgpip')-1)*900:0;
            }
            //机器u 节点价格
            $uprice=$unum>1?($unum-1)*300:0;
            //判断是否是bgp20G 30M带宽的特价商品
            if(I('post.defense')=="20"&&I('post.bandwidth')=="30"){
                $totalprice=($baseprice+$dfprice+$bdprice+$bgpipprice+$uprice)*$dur;
            }else{
                $totalprice=($baseprice+$dfprice+$bdprice+$bgpipprice+$uprice-200)*$dur;
            }
        }
        $this->ajaxReturn($totalprice);
    }
    public function servertrustAction(){
        $this->assign("current","cloud");
        $this->assign("title","服务器租用与购买-蒲公英网络");
        $this->display();
    }
    public function newserverAction(){
        $this->assign("current","server");
        $this->assign("title","最新产品-蒲公英网络");
        $this->display();
    }
    public function sqidcAction(){
        $this->assign("current","server");
        $this->assign("title","宿迁机房-蒲公英网络");
        $this->display();
    }
    public function jdidcAction(){
        $this->assign("current","server");
        $this->assign("title","京东机房-蒲公英网络");
        $this->display();
    }
    public function wzidcAction(){
        $this->assign("current","server");
        $this->assign("title","温州机房-蒲公英网络");
        $this->display();
    }
    public function gzidcAction(){
        $this->assign("current","server");
        $this->assign("title","广州机房-蒲公英网络");
        $this->display();
    }
    /**
     *解决方案 
     */
    public function automateAction(){
        $this->display();
    }
    /**
     * 最新活动
     */
    public function newactiveAction(){
        $this->assign("title","最新活动-蒲公英网络");
        $this->display();
    }
    /**
     * 合作伙伴
     */
    public function cooperateAction(){
        $this->assign("title","合作伙伴-蒲公英网络");
        $this->display();
    }
    /*公司*/
    //关于我们
    public function aboutAction(){
        $this->assign("current","about");
        $this->assign("title","关于我们-蒲公英网络");
        $this->display();
    }
    //新闻动态
    public function newsAction(){
        $cpage=I('p/d',1);
        $count=M('newslist')->count();
        $Page = new \Extend\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $show = $Page->show();// 分页显示输出
        $newslist=M('newslist')->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
        $this->assign("newslist",$newslist);
        $this->assign("current","news");
        $this->assign("title","新闻动态-蒲公英网络");
        $this->assign("page",$show);
        $this->display();
    }
    //新闻内容
    public function newscontainAction(){
        $id=I('id/d');
        $newslist=M('newslist')->where("ID=%d",$id)->find();
        $this->assign("newslist",$newslist);
        $this->assign("current","newscontain");
        $this->assign("title","新闻动态-蒲公英网络");
        $this->display();
    }
    //文档中心
    public function documentAction(){
        $this->assign("current","document");
        $this->assign("title","文档中心-蒲公英网络");
        $this->display();
    }
    //下载中心
    public function downloadAction(){
        $this->assign("current","download");
        $this->assign("title","下载中心-蒲公英网络");
        $this->display();
    }
    //支付方式
    public function paytypeAction(){
        $this->assign("current","paytype");
        $this->assign("title","付款方式-蒲公英网络");
        $this->display();
    }
    //荣誉资质
    public function honerAction(){
        $this->assign("current","honer");
        $this->assign("title","公司荣誉-蒲公英网络");
        $this->display();
    }

}