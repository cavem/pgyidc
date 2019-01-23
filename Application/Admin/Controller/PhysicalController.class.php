<?php
namespace Admin\Controller;
use Think\Controller;
class PhysicalController extends BaseController {
    public function ordercontrolAction(){
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $cpage=I('p/d',1);
        $cpage=$cpage==1?0:($cpage-1)*15;
        //$key=I('keyword/s');
        //获取主机数据列表       
        $url = "http://222.187.238.120:80/api/client/order/".$crmid."?skip=".$cpage."&limit=15&search=".urlencode($key);
        $bodydata=self::get($url);
        $output = json_decode(json_encode(json_decode($bodydata)),TRUE);
        $page= new \Extend\Page($output['data']['count'],15);
        //$page->parameter['keyword'] =$key;
        $show = $page->show();
        $this->assign("orderlst",$output['data']);
        $this->assign("page",$show);
        $this->assign("physical",1);
        $this->assign("ordercontrol",1);
        $this->display();
    }
    public function servercontrolAction(){
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $cpage=I('p/d',1);
        $cpage=$cpage==1?0:($cpage-1)*10;
        $key=I('keyword/s');
        $productkind=I('productkind/s');
        $devicetype=I('devicetype/s');
        //获取主机数据列表       
        $url = "http://222.187.238.120:80/api/client/server/".$crmid."?skip=".$cpage."&limit=10&prodcat=".urlencode($productkind)."&devicetype=".urlencode($devicetype)."&search=".urlencode($key);
        $bodydata=self::get($url);
        $serverdata = json_decode(json_encode(json_decode($bodydata)),TRUE);
        foreach ($serverdata['data']['list'] as $k=>$s)
        {
            $servip=$s['ipaddr'];
            $servip=explode('/', $servip);
            array_pop($servip);//移除结尾空字符串
            $serverdata['data']['list'][$k]['ipaddr']=$servip;
        }

        $page= new \Extend\Page($serverdata['data']['count'],10);        
        $page->parameter['keyword'] =$key;
        $page->parameter['productkind'] =$productkind;
        $page->parameter['devicetype'] =$devicetype;
        $show = $page->show();
        $this->assign("serverdata",$serverdata['data']['list']);
        $this->assign("productkind",$productkind);
        $this->assign("devicetype",$devicetype);
        $this->assign("keyword",$key);
        $this->assign("page",$show);
        //获取产品类型接口
        $url1 = "http://222.187.238.120:80/api/category";
        $pkdata=self::get($url1);
        $productkind = json_decode(json_encode(json_decode($pkdata)),TRUE);
        $this->assign("pkdata",$productkind['data']);
        $this->assign("physical",1);
        $this->assign("servercontrol",1);
        $this->display();
    }
    public function workingsheetAction(){
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $cpage=I('p/d',1);
        $cpage=$cpage==1?0:($cpage-1)*10;
        //获取主机数据列表       
        $url = "http://222.187.238.120:80/api/client/task/".$crmid."?skip=".$cpage."&limit=10&search=".urlencode($key);
        $bodydata=self::get($url);
        $sheetdata = json_decode(json_encode(json_decode($bodydata)),TRUE);
        foreach ($sheetdata['data']['list'] as $k=>$s)
        {
            $servip=$s['ipaddr'];
            //根据用户id获取接口信息
            $url = "http://222.187.238.120:80/api/client/server/".$crmid."?prodcat=&devicetype=&search=".urlencode($servip);
            $serverdata=self::get($url);
            $serverdata = json_decode(json_encode(json_decode($serverdata)),TRUE);
            $sheetdata['data']['list'][$k]['password']=trim($serverdata['data']['list'][0]['password']);
             
            $servip=explode('/', $servip);
            array_pop($servip);//移除结尾空字符串
            $sheetdata['data']['list'][$k]['ipaddr']=$servip;
        }
        // print"<pre>";
        // print_r($sheetdata);exit;
        // print"</pre>";
        $page= new \Extend\Page($sheetdata['data']['count'],15);
        $show = $page->show();
        $this->assign("sheetdata",$sheetdata['data']);
        $this->assign("page",$show);


        $this->assign("physical",1);
        $this->assign("workingsheet",1);
        $this->display();
    }
    public function attacktowAction(){
        parent::nosession();
        $userid=session('loginuser.userid');
        $crmid=session('loginuser.crmid');
        $qyModel=M('qy','','ym');
        $qyrecordModel=M('delqyrecord');
        $sql="SELECT * FROM qy WHERE (qytype LIKE '%流量牵引%' AND time !=0) OR userid = ".$userid;
        $myqyip=$qyModel->query($sql);
        $myip=array();
        foreach ($myqyip as $qy)
        {
            //判断当前ip是否属于该用户
            $ip=$qy['ip'];
            $url = "http://222.187.238.120:80/api/ip/".$ip."/belong2/1137".$crmid;
            $isuser=self::get($url);
            $isuser = json_decode(json_encode(json_decode($isuser)),TRUE);
            if (!empty($isuser['data']))
            {  
                //查询当前用户当天解除牵引次数
                $datetime=date('Y-m-d');
                $where="SELECT ID FROM delqyrecord WHERE IP='".$qy['ip']."' AND UserID=".$userid." AND from_unixtime(Time) LIKE '%".$datetime."%'";
                $qyrecord=$qyrecordModel->query($sql);
                $qy['num']=count($qyrecord);
                //将属于当前用户的ip列出
                $myip[]=$qy;
            }
        }
        $this->assign("myip",$myip);
        $this->assign("userid",$userid);
        $this->assign("physical",1);
        $this->assign("attacktow",1);
        $this->display();
    }

    public function addqyAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid');
        $crmid=session('loginuser.crmid');
        $ip=I('ip/s');
        $time=I('time/d');
        $ne=I('note/s');
        if (empty($ip)||empty($time)||empty($ne)||$time>4320)
        {
            echo "<script>window.parent.window.stopupload(1); </script>";
            exit();
        }
        $url = "http://222.187.238.120:80/api/ip/".$ip."/belong2/".$crmid;
        $isuser=self::get($url);
        $isuser = json_decode(json_encode(json_decode($isuser)),TRUE);
        if (empty($isuser['data']))
        {
            echo "<script>window.parent.window.stopupload(3); </script>";
            exit();
        }
        $qyModel=M('qy','','ym');
        $ishave=$qyModel->field('ip')->where("ip ='%s'",$ip)->find();
        if (!empty($ishave['ip']))
        {
            echo "<script>window.parent.window.stopupload(4); </script>";
            exit();
        }
        $t='dx';
        if (self::check_bgp($ip)){
            $t='sx';
        }
        if (self::check_lt_ip($ip)){
            $t='lt';
        }
        if (self::check_yz_ip($ip)){
            $t='yz';
        }
        $now=time();
        $ne="user平台-".$ne."[ $t ]";
        $sql="INSERT INTO `qy` (`ip`, `pps`, `bps`, `start`, `time`, `qytype`, `note`, `userid`)
                VALUES  ('$ip', 0, 0, $now, $time, '手动添加','$ne',$userid)";
        $qyModel->query($sql);
        $res=$this->do_add3($ip,$t,0,$userid);
        if ($res==60)
        {
            echo "<script>window.parent.window.stopupload(0); </script>";
            exit();
        }
        else 
        {
            echo "<script>window.parent.window.stopupload(1); </script>";
            exit();
        }    
    }

    public function do_add3($ip,$force,$bps=0,$userid){   //新  空路由添加
        $desc=date("Ymd-H:i:s");
        $add=ceil($bps/1024);
        $add=$add."G";
        if ($force == 'dx'){
            $tag="tag 101";
        }elseif ($force == 'yz'){
            $tag="tag 103";
        }elseif ($force == 'lt'){
            $tag="tag 102";
        }elseif ($force == 'sx'){
            $tag="tag 104";
        }else{
            $tag="";
        }
        $desc=$desc."_".$add;

        $url = "http://180.101.72.210:1992/pushcomm.php";
        $command = array(
            "0"=>"ip route-static $ip 255.255.255.255 null 0 pre 5 $tag desc $desc"
        );
        self::post($url,$command);
        //bgp/lt telnet
        if ($force=='sx'||$force=='lt')
        {
            $url1 = "http://180.101.72.210:1992/pushcommqy_user.php";
            $command1 = array(
                "comm"=>"ip route $ip 255.255.255.255 null 0"
            );
            self::post($url1,$command1);
        }
        $res=$this->adminrecord($userid, $ip, 12);
        return $res;
    }

    public function delqyAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid');
        $crmid=session('loginuser.crmid');
        $id=I('id/s');
        $pay=I('pay/d');
        $qyModel=M('qy','','ym');
        $qyrecordModel=M('delqyrecord');
        $myqyip=$qyModel->field('id,ip,bps')->where('id=%d',$id)->order('id DESC')->find();
        if (!empty($myqyip['id']))
        {
            if (intval($myqyip['bps'])>200000)
            {
                //系统出错
                echo json_encode(1);
                exit;
            }
            //判断当前ip是否属于该用户
            $url = "http://222.187.238.120:80/api/ip/".$myqyip['ip']."/belong2/".$crmid;
            $isuser=self::get($url);
            $isuser = json_decode(json_encode(json_decode($isuser)),TRUE);
            if (!empty($isuser['data']))
            {
                //查询当前用户当天解除牵引次数
                $datetime=date('Y-m-d');

                $where="SELECT ID FROM delqyrecord WHERE IP='".$myqyip['ip']."' AND UserID=".$userid." AND from_unixtime(Time) LIKE '%".$datetime."%'";
                $qyrecord=$qyrecordModel->query($sql);
                $num=count($qyrecord);
                if ($num>10)
                {
                    //系统出错
                    echo json_encode(1);
                    exit;
                }
                if ($num>=3)
                {
                    //说明需要扣钱喽，10块一次哦
                    $paylogModel=M('paylog');
                    //先获取当前用户的总充值金额
                    $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
                    $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
                    $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
                    if ($balance>10) {
                        //扣费记录
                        $data=array(
                            "ordernum"=>"pgy".date('YmdHis'),
                            "money"=>10,
                            "userid"=>$userid,
                            "addtime"=>time(),
                            "typename"=>"解封扣费",
                            "datatype"=>1
                        );
                        $paylogModel->add($data);
                    }
                    else
                    {
                        //余额不足
                        echo json_encode(3);
                        exit;
                    }
                }
                //执行解除牵引操作
                self::do_del3($myqyip['ip']);
                //删除表中的记录
                $qyModel->where("id =%d",$id)->delete();
                //同时将用户操作记录保存到记录表中
                $data = array(
                    "IP"=>$myqyip['ip'],
                    "Time"=>time(),
                    "UserID"=>$userid
                );
                // if ($userid!=24)
                // {
                    $qyModel->add($data);
                // }
                echo json_encode(0);//执行成功
                exit;
            }
            else 
            {
                echo json_encode(3);//执行成功
                exit;
            }
        }
        else 
        {
            //系统出错
            echo json_encode(1);
            exit;
        }
    }

    //后台操作记录封装
    public function adminrecord($userid,$ip,$operatetype,$releasetime)
    {
        if ($releasetime>30)
        {
            $releasetime=30;
        }
        $res=0;
        try
        {
            //保存日志
            $data = array(
                "RecordIP"=>$ip,
                "RecordType"=>0,//暂时默认为0
                "RecordTime"=>time(),
                "ReleaseTime"=>strtotime('+'.$releasetime.' day'),
                "UserID"=>$userid,
                "OperateType"=>$operatetype,
                "IsRelease"=>empty($releasetime)?0:2
            );
            $grModel=M('goldenrecord');
            $grModel->add($data);
            $res=60;
            return $res;
        }
        catch (Exception $e)
        {
            $res=61;//系统出错
            return $res;
        }
    }

    public function attackrecordAction(){
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $attacklogModel=M('attack_log','','ym');
        $userModel=D('users');
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $map['crmid']=array('eq',$crmid);
        if (!empty($key)) {
            $map['ip']=array('eq',$key);
        }
        $count = $attacklogModel->field('id')->where($map)->count();
        $p = getpage($count,15);  
        $p->parameter['keyword'] =  $key;
        $show = $p->show();// 分页显示输出
        $res=$attacklogModel->field('ip,type,dport,bps,pps,status,start,end,note')->limit($p->firstRow.','.$p->listRows)->where($map)->order('id DESC')->select();
        $this->assign('model', $res);
        $this->assign('page',$show);
        $this->assign('keyword',$key);

        $this->assign("physical",1);
        $this->assign("attackrecord",1);
        $this->display();
    }

    //检查ip
    static function check_lt_ip($ip){
        if (substr($ip,0,3) == "58.") return true;
        if (substr($ip,0,6) == "112.83") return true;
        if (substr($ip,0,7) == "122.195") return true;
        if (substr($ip,0,6) == "153.36") return true;
        //  if (substr($ip,0,9) == "43.241.50") return false;
        if (substr($ip,0,7) == "103.205") return true;
        if (substr($ip,0,7) == "111.223") return true;
        if (substr($ip,0,9) == "43.241.49") return true;
        return false;
    }
    static function check_bgp($ip){
        if (substr($ip,0,9) == "43.241.50") return true;
        if (substr($ip,0,6) == "103.37") return true;
        if (substr($ip,0,7) == "103.239") return true;
        if (substr($ip,0,9) == "43.241.48") return true;
        if (substr($ip,0,9) == "43.241.51") return true;
        return false;
    }
    static function check_yz_ip($ip){
        if (substr($ip,0,10) == "61.147.247") return false;
        if (substr($ip,0,6) =="61.147") return true;
        if (substr($ip,0,7) =="222.189") return true;
        return false;
    }
    //解除牵引
    static function do_del3($ip){  //解除空路由牵引
        $url = "http://180.101.72.210:1992/pushcomm.php";
        $command = array(
            "0"=>"undo ip route-static $ip 255.255.255.255 null 0"
        );
        self::post($url,$command);

        $t='';
        if (self::check_bgp($ip)){
            $t='sx';
        }
        if (self::check_lt_ip($ip)){
            $t='lt';
        }
        if (!empty($t))
        {
            $url1 = "http://180.101.72.210:1992/pushcommqy_user.php";
            $command1 = array(
                "comm"=>"no ip route $ip 255.255.255.255 null 0"
            );
            self::post($url1,$command1);
        }
    } 

    function get($url){
        //$url=str_replace('&amp;','&',$url);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $xml = curl_exec ($ch);
        curl_close ($ch);
        return $xml;
    }

    function post($url,$postdata,$cookie=''){
        //$url=str_replace('&amp;','&',$url);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,2);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, 1); 
        if ($cookie <> '' ) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); 
        $xml = curl_exec ($ch);
        curl_close ($ch);
        return $xml;
    }
}