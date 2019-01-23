<?php
namespace Admin\Controller;
use Think\Controller;
class BlockabroadipController extends BaseController {
    public function blockabroadipAction(){
        parent::nosession();
        $this->assign("blockabroadip",1);
        $this->assign("baip",1);
        $this->display();
    }

    public function blockdefenseAction()
    {
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $userid=session('loginuser.userid');
        $datatype=I('datatype/d');
        $ip=I('ipaddr/s');
        $releasetime=I('releasetime/d');
        //判断当前ip是否属于该用户
        $url = "http://222.187.238.120:80/api/ip/".$ip."/belong2/".$crmid;
        $isuser=self::get($url);
        $isuser = json_decode(json_encode(json_decode($isuser)),TRUE);
        if (empty($isuser['data']))
        {
            echo json_encode(65);
            exit;
        }

        $url='http://180.101.72.210:1992/pushcomm.php';
        switch ($datatype)
        {
            case 9:
                $command = array(
                    "0"=>"ip route-static $ip 32 10.0.99.200 preference 8 des to_deny-gwip",
                    "1"=>"undo ip route-static $ip 32 10.0.99.201",
                    "2"=>"undo ip route-static $ip 32 10.0.99.202",
                    "3"=>"undo ip route-static $ip 32 10.0.99.203",
                    "4"=>"undo ip route-static $ip 32 10.0.99.204"
                );
                break;
            case 2:
                $command = array(
                    "0"=>"ip route-static $ip 32 10.0.99.204 preference 8 des to_deny-gwip-xg",
                    "1"=>"undo ip route-static $ip 32 10.0.99.200",
                    "2"=>"undo ip route-static $ip 32 10.0.99.201",
                    "3"=>"undo ip route-static $ip 32 10.0.99.202",
                    "4"=>"undo ip route-static $ip 32 10.0.99.203"
                );
                break;
            case 3:
                $command = array(
                    "0"=>"ip route-static $ip 32 10.0.99.201 preference 8 des to_no-deny-gwip",
                    "1"=>"undo ip route-static $ip 32 10.0.99.200",
                    "2"=>"undo ip route-static $ip 32 10.0.99.202",
                    "3"=>"undo ip route-static $ip 32 10.0.99.203",
                    "4"=>"undo ip route-static $ip 32 10.0.99.204"
                );
                break;
            case 4:
                $command = array(
                    "0"=>"ip route-static $ip 32 10.0.99.202 preference 8 des to_deny-udp",
                    "1"=>"undo ip route-static $ip 32 10.0.99.200",
                    "2"=>"undo ip route-static $ip 32 10.0.99.201",
                    "3"=>"undo ip route-static $ip 32 10.0.99.203",
                    "4"=>"undo ip route-static $ip 32 10.0.99.204"
                );
                break;
            case 5:
                $command = array(
                    "0"=>"ip route-static $ip 32 10.0.99.203 preference 8 des to_deny-udp-gwip",
                    "1"=>"undo ip route-static $ip 32 10.0.99.200",
                    "2"=>"undo ip route-static $ip 32 10.0.99.201",
                    "3"=>"undo ip route-static $ip 32 10.0.99.202",
                    "4"=>"undo ip route-static $ip 32 10.0.99.204"
                );
                break;
            case 6:
                $command = array(
                    "0"=>"undo ip route-static $ip 32 10.0.99.200",
                    "1"=>"undo ip route-static $ip 32 10.0.99.201",
                    "2"=>"undo ip route-static $ip 32 10.0.99.202",
                    "3"=>"undo ip route-static $ip 32 10.0.99.203",
                    "4"=>"undo ip route-static $ip 32 10.0.99.204"
                );
                break;
        }
        self::post($url,$command);
        $res=$this->adminrecord($userid, $ip, $datatype,$releasetime);
        echo json_encode($res);
        exit;
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
        }
        catch (Exception $e)
        {
            $res=61;//系统出错
        }
        return $res;
    }

    public function setipsAction(){
        parent::nosession();
        $this->assign("blockabroadip",1);
        $this->assign("setips",1);
        $this->display();
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