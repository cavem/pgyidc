<?php
namespace Admin\Controller;
use Think\Controller;
class jdcloudController extends BaseController {
    public function jdcloudmanageAction(){
        header('content-type:textml;charset=gb2312;');
        parent::nosession();
        $regionid=I('regionid/s','cn-east-1');
        $cpage=I('p/d',1);
        $count=M('jdcloudlog')->where("UserID=%d and regionid='%s'",array(session("loginuser.userid"),$regionid))->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $show = $Page->show();// 分页显示输出
        $cloudnolist=M('jdcloudlog')->field('CloudNo')->limit($Page->firstRow.','.$Page->listRows)->where("UserID=%d and regionid='%s'",array(session("loginuser.userid"),$regionid))->select();
        $cloudnostr="";
        
        for($i=0;$i<count($cloudnolist);$i++){
            $cloudnostr.=$cloudnolist[$i]['cloudno'].',';
        }
        $postdata=array(
            "instanceids" => substr($cloudnostr,0,strlen($cloudnostr)-1),
            "regionid" => $regionid
        );        
        $output=self::post("http://43.240.1.2:2333/describeinstances/",$postdata);
        $cloudlist=$output['msg']['result']['instances'];
        for($i=0;$i<count($cloudlist);$i++){
            $instanceid=$cloudlist[$i]['instanceId'];
            $duetime=M('jdcloudlog')->where("CloudNo='%s'",$instanceid)->getField("DueTime");
            $cloudlist[$i]['duetime']=$duetime;
        }
        $this->assign("regionid",$regionid);
        $this->assign("cloud",1);
        $this->assign("jdcloudmanage",1);
        $this->assign("cloudlist",$cloudlist);
        $this->assign('page',$show);
        $this->display();
    }
    //后台管理
    public function jdadmincdmgAction(){
        header('content-type:textml;charset=gb2312;');
        parent::nosession();
        $regionid=I('regionid/s','cn-north-1');
        $cpage=I('p/d',1);
        $count=M('jdcloudlog')->where("regionid='%s'",$regionid)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $show = $Page->show();// 分页显示输出
        $cloudnolist=M('jdcloudlog')->field('CloudNo')->limit($Page->firstRow.','.$Page->listRows)->where("regionid='%s'",$regionid)->select();
        $cloudnostr="";
        
        for($i=0;$i<count($cloudnolist);$i++){
            $cloudnostr.=$cloudnolist[$i]['cloudno'].',';
        }
        $postdata=array(
            "instanceids" => substr($cloudnostr,0,strlen($cloudnostr)-1),
            "regionid" => $regionid
        );
        
        $output=self::post("http://43.240.1.2:2333/describeinstances/",$postdata);
        $cloudlist=$output['msg']['result']['instances'];
        for($i=0;$i<count($cloudlist);$i++){
            $instanceid=$cloudlist[$i]['instanceId'];
            $userid=M('jdcloudlog')->where("CloudNo='%s'",$instanceid)->getField("UserID");
            $cloudlist[$i]['userid']=$userid;
        }
        $this->assign("regionid",$regionid);
        $this->assign("cloud",1);
        $this->assign("jdcloudmanage",1);
        $this->assign("cloudlist",$cloudlist);
        $this->assign('page',$show);
        $this->display();
    }
    //重置系统
    public function resetosAction(){
        parent::nosession();
        $regionid=I('regionid/s');
        $instanceids=I('instanceid/s');
        $postdata=array(
            "instanceids" => $instanceids,
            "regionid" => $regionid
        );
        $output=self::post("http://43.240.1.2:2333/describeinstances/",$postdata);
        $imagename=M('jdcloudlog')->where("CloudNo='%s'",$instanceids)->getField('imagename');
        $this->assign("cloudlist",$output['msg']['result']['instances'][0]);
        $this->assign("imagename",$imagename);
        $this->display();
    }
    public function reosAction(){
        $postdata=array(
            "instanceid" => I('post.instanceid'),
            "imageid" => I('post.imageid'),
            "password" => I('post.password'),
            "regionid" => I('post.regionid'),
        );
        //print_r($postdata);
        $output=self::post("http://43.240.1.2:2333/rebuildinstance/",$postdata);
        if(empty($output['msg']['error'])){
            $data["imagename"]=I('post.imagename');
            if(M('jdcloudlog')->where("CloudNo='%s'",I('post.instanceid'))->save($data)){
                $this->ajaxReturn(0);//成功
            }else{
                $this->ajaxReturn(1);//失败
            }
        }else{
            $this->ajaxReturn($res['msg']['error']['message']);//错误信息
        }
    }
    //调整配置
    public function restandAction(){
        $postdata=array(
            "instanceid" => I('post.instanceid'),
            "instancetype" => I('post.instancetype'),
            "regionid" => I('post.regionid')
        );
        $output=self::post("http://43.240.1.2:2333/resizeinstance/",$postdata);
        if(empty($output['msg']['error'])){
            $this->ajaxReturn(0);//成功
        }else{
            //print_r($output);
            $this->ajaxReturn($output['msg']['error']['message']);//错误信息
        }
    }
    //续费页面
    public function renewAction(){
        parent::nosession();
        $regionid=I('regionid/s');
        $instanceids=I('instanceid/s');
        $info=M('jdcloudlog')->field('Price,DueTime,CloudNo')->where("CloudNo='%s'",$instanceids)->find();
        $price=explode('/', $info['price']);
        $month=explode('月', $price[1]);
        $info['price']=ceil($price[0]/$month[0]);//获取到客户每月的价格
        $postdata=array(
            "instanceids" => $instanceids,
            "regionid" => $regionid
        );
        $output=self::post("http://43.240.1.2:2333/describeinstances/",$postdata);
        $this->assign("cloudlist",$output['msg']['result']['instances'][0]);
        $this->assign("info",$info);
        $this->display();
    }
    //执行续费操作
    public function renewnowAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid'); 
        $duration=I('duration/d',1);//续费时间（月份）
        $cloudno=I('cloudno/s');//主机id
        if (empty($cloudno)) {
            $this->ajaxReturn('非法访问');
        }
        //计算总价
        $info=M('jdcloudlog')->field('UserID,Price,DueTime')->where("CloudNo='%s'",$cloudno)->find();
        $price=explode('/', $info['price']);
        $month=explode('月', $price[1]);
        $trueprice=ceil($price[0]/$month[0]);//获取到客户每月的价格
        $truetotalprice=(int)$trueprice*$duration;
        //获取用户余额
        $balance=self::getbalance();
        //判断是否为本人操作
        if(session('loginuser.userid')!=$info['userid']){
            $this->ajaxReturn('非法操作！');
        }
        //判断余额是否足够
        if($balance<$truetotalprice){
            $this->ajaxReturn('余额不足，请前往控制台充值后购买！');
        }

        $data=array(
            "ordernum"=>"pgy".date('YmdHis'),
            "money"=>$truetotalprice,
            "userid"=>$userid,
            "addtime"=>time(),
            "typename"=>"云主机线路二续费",
            "datatype"=>1
        );
        $data1=array(
            "Price"=>$truetotalprice.'元/'.$duration.'月',
            "Disprice"=>$truetotalprice.'元/'.$duration.'月',
            "DueTime"=>strtotime("+".$duration." month",$info['duetime'])
        );
        $paylog=M('paylog');
        if ($paylog->add($data)) {
            if (M('jdcloudlog')->where("CloudNo='%s'",$cloudno)->save($data1)) {
                $this->ajaxReturn(0);
            } else {
                $this->ajaxReturn('系统出错');
            } 
        } else {
           $this->ajaxReturn('系统出错');
        }
    }
    //管理员删除云主机操作
    public function deleteinstanceAction()
    {
        parent::nosession();
        $usertype=session('loginuser.usertype');
        if (empty($usertype)) {
           $this->ajaxReturn('非法访问');
        }        
        $url = "http://43.240.1.2:2333/deleteinstance";
        $data = json_encode(array(
            "instanceid" => I('instanceid/s'),
            "regionid" => I('regionid/s')
        ));
        $output=self::delete($url,$data);
        if(empty($output['msg']['error'])){
            $this->ajaxReturn(0);//成功
        }else{
            $this->ajaxReturn($output['msg']['error']['message']);//错误信息
        }
    }
    public function startAction()
    {
        parent::nosession();
        $vid=I('cloudno/s');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->ajaxReturn(2);
            exit;
        }
        $postdata=array(
            "instanceid" => $vid,
            "regionid" => $myhost['regionid']
        );
        $output=self::post("http://43.240.1.2:2333/startinstance/",$postdata);
        sleep(10);
        $this->ajaxReturn($output['msg']['requestId']);
    }
    public function stopAction()
    {
        parent::nosession();
        $vid=I('cloudno/s');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->ajaxReturn(2);
            exit;
        }
        $postdata=array(
            "instanceid" => $vid,
            "regionid" => $myhost['regionid']
        );
        $output=self::post("http://43.240.1.2:2333/stopinstance/",$postdata);
        sleep(10);
        $this->ajaxReturn($output['msg']['requestId']);
    }
    public function restartAction()
    {
        parent::nosession();
        $vid=I('cloudno/s');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->ajaxReturn(2);
            exit;
        }
        $postdata=array(
            "instanceid" => $vid,
            "regionid" => $myhost['regionid']
        );
        $output=self::post("http://43.240.1.2:2333/rebootinstance/",$postdata);
        sleep(10);
        $this->ajaxReturn($output['msg']['requestId']);
    }
    public function resetpswAction()
    {
        $vid=I('vid/s');
        $this->assign("vid",$vid);
        $this->display();
    }
    public function pwchangeAction()
    {
        parent::nosession();
        $vid=I('vid/s');
        $newpwd=I('newpwd/s');
        //判断是否是本人名下机器
        $myhost=self::myhost($vid);
        if (empty($myhost)) {
            $this->ajaxReturn(2);
            exit;
        }
        $postdata=array(
            "instanceid" => $vid,
            "regionid" => $myhost['regionid'],
            "password" => $newpwd
        );
        $output=self::post("http://43.240.1.2:2333/modifyinstancepassword/",$postdata);
        $this->ajaxReturn($output['msg']['requestId']);
    }

    static function myhost($vpsid)
    {
        $userid=session('loginuser.userid');
        $usertype=session('loginuser.usertype');
        $cloudlog=M('jdcloudlog');
        if (empty($usertype)) {
            $info=$cloudlog->field('regionid')->where("CloudNo ='%s' and UserID= %d",array($vpsid,$userid))->find();  
        }
        else
        {
           $info=$cloudlog->field('regionid')->where("CloudNo ='%s'",array($vpsid))->find(); 
        }
        return $info;
    }
    //获取镜像列表
    public function getimageAction(){
        header('content-type:textml;charset=utf-8;');
        $imagesource=I('post.imagesource');
        $platform=I('post.platform');
        $regionid=I('regionid/s');
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
    //公网ip列表
    public function ipmanageAction(){
        header('content-type:textml;charset=gb2312;');
        parent::nosession();
        $regionid=I('regionid/s','cn-north-1');
        $url = "http://43.240.1.2:2333/jd/elasticips/";
        $post_data = array (
            "regionid" => $regionid,
            'ip' =>'',
        );
        $output=self::post($url,$post_data);
        $iplist=$output['msg']['result']['elasticIps'];
        for($i=0;$i<count($iplist);$i++){
            $instanceid=$iplist[$i]['instanceId'];
            $postdata=array(
                "instanceids" => $instanceid,
                "regionid" => $regionid
            );        
            $output=self::post("http://43.240.1.2:2333/describeinstances/",$postdata);
            $iplist[$i]['instanceName']=$output['msg']['result']['instances'][0]['instanceName'];
        }
        $this->assign("cloud",1);
        $this->assign("jdcloudmanage",1);
        $this->assign("regionid",$regionid);
        $this->assign("iplist",$iplist);
        $this->display();
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
    //get方法
    function get($url){
        $url=str_replace('&amp;','&',$url);
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,2);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $xml = curl_exec ($ch);
        curl_close ($ch);
        return $xml;
    }
    //delete方法
    function delete($url,$data){
        header('content-type:text/html;charset=utf-8;');
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );
        $handle = curl_init(); 
        curl_setopt($handle, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($handle,CURLOPT_HEADER,0); // 是否显示返回的Header区域内容
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers); //设置请求头
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data); //设置请求体，提交数据包
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $response = curl_exec($handle); // 执行操作
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE); // 获取返回的状态码
        curl_close ($handle); // 关闭CURL会话
        //$output=json_decode(json_encode(json_decode($output)),TRUE);
        return $response;
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
}