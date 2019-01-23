<?php
namespace Admin\Controller;
use Think\Controller;
class FirewallController extends BaseController {
    public function goldenshieldAction(){
        parent::nosession();
        $ccModel=M('ccparam');
        $cc=$ccModel->field('id,name')->order('px ASC')->select();
        $this->assign("ccparam",$cc);
        $this->assign("firewall",1);
        $this->assign("goldenshield",1);
        $this->display();
    }
    public function goldfightingAction()
    {
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $userid=session('loginuser.userid');
        $address=I('address/s');//用户输入的ip地址
        $mode=I('mode/d');//防护类型
        $releasetime=I('releasetime/d');//释放时间
        $db=Zend_Db_Table::getDefaultAdapter();
        //判断当前ip是否属于该用户
        $url = "http://222.187.238.120:80/api/ip/".$address."/belong2/".$crmid;
        $isuser=self::get($url);
        $isuser = json_decode(json_encode(json_decode($isuser)),TRUE);
        if (empty($isuser['data']))
        {
            echo json_encode(65);
            exit;
        }
        //判断该ip段是否已被拉入黑名单
        $goldblacklst=M('goldblacklst','','user');
        $isblack=$goldblacklst->where("BlackIP ='%s' and LogicDel=%d",array($address,0))->find();
        if (!empty($isblack))
        {
            echo json_encode(64);//ip已被拉黑
            exit;
        }
        //限制用户一分钟之内只能操作一次防火墙
        //1、首先查询上一次用户操作的防御时间
        $grModel=M('goldenrecord');
        $lasttime=$grModel->field('RecordTime')->where('OperateType=%d',0)->order('RecordID DESC')->find();

        if (!empty($lasttime['recordtime']))
        {
            //时间差=当前时间-最新一条记录时间
            $timediff=intval(time()-$lasttime['recordtime']);
            if ($timediff<60)
            {               
                echo json_encode($timediff);//一分钟之内禁止操作
                exit;
            }
        }
        try 
        {
            $matches=$this->wangguan($address);
            if (empty($matches[1][2])) 
            {
                echo json_encode(61);//ip有误
                exit;
            }
            else 
            {
                try 
                {
                    //执行防御操作
                    $gateway=$matches[1][5];//网关
                    $recordtype=$this->postinfo($address, $mode, $gateway);
                    //修改当前操作ip的之前的释放状态
                    $data1['IsRelease'] = 0;
                    $grModel->where("RecordIP='%s'",$address)->save($data1);
                    //同时将用户操作记录存入数据库
                    $data=array(
                        "RecordIP"=>$address,
                        "RecordType"=>$recordtype,
                        "RecordTime"=>time(),
                        "ReleaseTime"=>$recordtype==1?0:strtotime('+'.$releasetime.' day'),
                        "UserID"=>$userid,
                        "IsRelease"=>$recordtype==1?0:1
                    );
                    $grModel->add($data); 
                    echo json_encode(60);//防御已启动
                    exit;
                } 
                catch (Exception $e) 
                {
                    echo json_encode(62);//系统出错
                    exit;
                }
            }
        } 
        catch (Exception $e) 
        {
            echo json_encode(62);//系统出错
            exit;
        }
    }
    public function blacklistAction(){
        parent::nosession();
        $this->assign("firewall",1);
        $this->assign("blacklist",1);
        $this->display();
    }

    public function blacklistoperateAction()
    {
        parent::nosession();
        $crmid=session('loginuser.crmid');
        $userid=session('loginuser.userid');
        $address=I('ipaddr/s');//ip地址
        //判断当前ip是否属于该用户
        $url = "http://222.187.238.120:80/api/ip/".$address."/belong2/".$crmid;
        $isuser=self::get($url);
        $isuser = json_decode(json_encode(json_decode($isuser)),TRUE);
        if (empty($isuser['data']))
        {
            echo json_encode(62);
            exit;
        }
        //限制用户一分钟之内只能操作一次防火墙
        //1、首先查询上一次用户操作的防御时间
        $grModel=M('goldenrecord');
        $lasttime=$grModel->field('RecordTime')->where('OperateType=%d',7)->order('RecordID DESC')->find();
        
        if (!empty($lasttime['RecordTime']))
        {
            //时间差=当前时间-最新一条记录时间
            $timediff=intval(time()-$lasttime['RecordTime']);
            if ($timediff<60)
            {
                echo json_encode($timediff);//一分钟之内禁止操作
                exit;
            }
        }
        try 
        {
            $ch = curl_init();//初始化
            //设置抓取的url
            $url = 'http://222.187.226.199:28099/cgi-bin/status_fblink.cgi';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            curl_setopt($ch,CURLOPT_COOKIE,'sid=G9%C5%CE%9E%D3%D1%8A%AFD%9C%B0S%FF%C3%F0%97%20%14%BE0%B9%E9%B0%5C%CF%AF%90%3Fp%0D%D4Um%F6%5C%18%18%DAx%A4%8BN%8D%7C%D6%EA%FF');         
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //设置post方式提交
            curl_setopt($ch, CURLOPT_POST, 1);
            //设置post数据          
            $post_data = array(
                "param_submit_type" => "reset",
                "param_page" => "",
                "param_this_sort" => "1",
                "param_filter" => "$address"
            );
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $data = curl_exec($ch);                 
            //sleep(10);        
            //关闭URL请求
            curl_close($ch);
            //保存日志
            $recorddata = array(
                "RecordIP"=>$address,
                "RecordType"=>0,//暂时默认为0
                "RecordTime"=>time(),
                "ReleaseTime"=>0,
                "UserID"=>$userid,
                "OperateType"=>7
            );
            $grModel->add($recorddata);              
            echo json_encode(60);
            exit;
        } 
        catch (Exception $e) 
        {
            echo json_encode(61);
            exit;
        }
    }

    //获取网关信息
    public function wangguan($addr)
    {
        $url = 'http://222.187.226.199:28099/cgi-bin/status_hostset.cgi?hostaddr='.$addr;       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt ($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch,CURLOPT_COOKIE,'sid=G9%C5%CE%9E%D3%D1%8A%AFD%9C%B0S%FF%C3%F0%97%20%14%BE0%B9%E9%B0%5C%CF%AF%90%3Fp%0D%D4Um%F6%5C%18%18%DAx%A4%8BN%8D%7C%D6%EA%FF');     
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $p='/>(.*?)<\//i';
        preg_match_all($p,$head,$matches);  
        return $matches;
    }

    //将防御信息post给远程服务器
    public function postinfo($address,$mode,$gateway)
    {
        //根据cc设置参数id获取参数
        $ccModel=M('ccparam');
        $ccparam=$ccModel->where('id =%d',$mode)->find();
        
        header("Content-type: text/html; charset=gb2312");
        //初始化
        $ch = curl_init();
        //设置抓取的url
        $url = 'http://222.187.226.199:28099/cgi-bin/status_hostset.cgi';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch,CURLOPT_COOKIE,'sid=G9%C5%CE%9E%D3%D1%8A%AFD%9C%B0S%FF%C3%F0%97%20%14%BE0%B9%E9%B0%5C%CF%AF%90%3Fp%0D%D4Um%F6%5C%18%18%DAx%A4%8BN%8D%7C%D6%EA%FF');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($ch, CURLOPT_POST, 1);
        
        $post_data = array(
                "param_setting_addr" => "$address",
                "param_exist" => "ON",
                "param_prefix" => "24",
                "param_gateway_ip" => "$gateway",
                "param_gateway_mac" => "",
                "param_flowlimit_incoming_bps" => "",
                "param_flowlimit_incoming_pps" => "",
                "param_flowlimit_outgoing_bps" => "",
                "param_flowlimit_outgoing_pps" => "",
                "param_param_set" => $ccparam['fanghu'],
                "param_filter_set" => $ccparam['guolv'],
                "param_portpro_set_tcp" => $ccparam['tcp'],
                "param_portpro_set_udp" => $ccparam['udp'],
                "param_plugin_tcp_0"=>empty($ccparam['webservice'])?'':"ON",
                "param_plugin_tcp_1"=>empty($ccparam['gameservice'])?'':"ON",
                "param_plugin_tcp_2"=>empty($ccparam['miscservice'])?'':"ON",
                "param_plugin_tcp_3"=>empty($ccparam['tcpdnsservice'])?'':"ON",
                "param_plugin_udp_1"=>empty($ccparam['udpdnsservice'])?'':"ON",
                "param_plugin_udp_4"=>empty($ccparam['udpapp'])?'':"ON"
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $data = curl_exec($ch);
        //关闭URL请求
        curl_close($ch);
        return $mode;
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