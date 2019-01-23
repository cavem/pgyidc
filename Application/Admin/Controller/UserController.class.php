<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function loginAction(){
        session_destroy();
        session_start();
        $_SESSION['token'] = self::getToken();
        $this->assign('token', $_SESSION['token']);
        $this->display();
    }

    public function verifyAction()
    {
        $config = array(
            'fontSize' => 18, // 验证码字体大小
            'length' => 4, // 验证码位数4
            'imageH' => 45,
            'useImgBg' => true,//是否使用背景图片
            'bg' => array(200,200,200),
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
 
    /* 验证码校验 */
    public function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        $res = $verify->check($code, $id);
        return $res;
    }


    //登陆验证
    public function logininAction(){
        $checktoken=I('token/s');
        //
        if(!IS_POST || ($checktoken != $_SESSION['token']))
        {
            $this->ajaxReturn(3);exit;
        }
        $usermodel = D('User');
        $username =I('username','','addslashes');
        $password =I('password','','md5');
        $code=I('code/s');
        //检测验证码是否输入正确 返回1=成功  0=失败
        $flag=$this->check_verify($code);
        //验证码正确
        if($flag==0)
        {
            $this->ajaxReturn(4);exit;
        }
        //验证账号密码是否正确
        $map['UserName']=array('eq',$username);
        $map['LinkMail']=array('eq',$username);
        $map['_logic'] = 'OR';
        $where['_complex'] = $map;
        //$where['UserPwd']=array('eq',$password);
        $userauth = $usermodel->field('UserID')->where($where)->where("UserPsw ='%s'",$password)->find();
        if(!$userauth) 
        {
            $have = $usermodel->field('UserID')->where($where)->find();
            if ($have) {
                $this->ajaxReturn(2);
                exit;
            }

            $token=self::token();
            //判断user平台账户登录
            $usersModel=M('users','','user');
            $userinfo=$usersModel->where("UserName ='%s' AND UserPsw='%s'",array($username,$password))->find();
            if ($userinfo) {
                //验证云谷账号是否存在
                $ygid=self::ygauth($username,I('pwd'));
                //将user平台账号同步到新的数据表
                $userdata=array(
                    "UserName"=>$username,
                    "UserPsw"=>$password,
                    "LinkMail"=>$userinfo['linkmail'],
                    "UserClearPwd"=>I('pwd'),
                    "RegTime"=>time(),
                    "CrmID"=>$userinfo['crmuserid'],
                    "YungoID"=>$ygid,
                );
                if (!$usermodel->create($userdata)) {
                    $this->error($usermodel->getError());
                }else{
                    $usermodel->add($userdata);
                }
            }
            else
            {
                $yginfo=static::yglogin($username,I('password'));
                if (!empty($yginfo)) {
                    $this->ajaxReturn(1);
                    exit;
                }
            }
        }
        $user = $usermodel->field('userid,effectivetime')->where($where)->where("UserPsw ='%s'",$password)->find();
        //生成用户token并存入数据库
        if(strtotime($user['effectivetime'])<time())
        {
             $res=$usermodel->settoken($user['userid']);    
        }

        //如果数据更新成功  跳转到后台主页
        if(empty($res)){
            session_start();
            $info = $usermodel->where($where)->where("UserPsw ='%s'",$password)->find();
            session('loginuser',$info);
            $this->ajaxReturn(0);
            exit;
        }
    }

    public function registerAction(){
        $this->display();
    }

    public function yungopost($postdata)
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
        $outres=explode("|", $output);
        return $outres;
    }

    public function regingAction(){
        if(!IS_POST)$this->error("非法请求");
        $usermodel = D('User');
        $cusName =I('cusName/s');
        $nickname =I('nickname/s');
        $email =I('email/s');
        $password =I('password','','md5');
        $mobile =I('mobile');
        $phoneCaptcha =I('phoneCaptcha/d');
        $crmid=I('crmid/d');
        //验证码校准
        $codeModel=M('emailcode');
        $newcode = $codeModel->field('CodeID')->where("EmailCaptcha = %d",$phoneCaptcha)->order(' CodeID DESC')->find(); 
        if (!$newcode) {
            $this->error('验证码输入有误') ;
        }
        //查询该用户名或邮箱是否存在
        $map['phone']=array('eq',$mobile);
        $map['LinkMail']=array('eq',$email);
        $map['_logic'] = 'OR';
        $user = $usermodel->where($map)->find();
        if ($user) {
        	$this->error('个人信息已存在，如有必要可联系管理员') ;
        }
        else
        {
            $data=array(
                "UserName"=>$nickname,
                "UserPsw"=>$password,
                "LinkMail"=>$email,
                "UserClearPwd"=>I('password'),
                "RegTime"=>time(),
                "company"=>$cusName,
                "phone"=>$mobile,
                "CrmID"=>$crmid
            );
            //如果数据更新成功  跳转到后台主页
            if($lastinsid=$usermodel->add($data)){
                $post_data = array 
                (
                    "identity" => "system",
                    "api_username" => "e08ce2094689f5fe129",
                    "api_key" => "JFSDFIEWOIFU098fds008f",
                    "Action" => "user_add",
                    "userid" => $lastinsid,
                    "username"=>$nickname,
                    "password"=>I('password'),
                    "name"=>$nickname,
                    "email"=>$email,
                    "tel"=>$mobile
                );
                $outres=$this->yungopost($post_data);
                if (!empty($outres[0])) {
                    $this->error('云数据同步失败，请联系管理员处理') ;
                }else{
                    $usermodel->where('UserID=%d',$lastinsid)->save(array('YungoID'=>$lastinsid));
                    $loginuser = $usermodel->where("UserID = %d",$lastinsid)->find();
                    session('loginuser',$loginuser);
                    $this->success("注册成功",U('Index/index'));
                }
            }
        }
    }

    //验证码
    public function yzcodeAction(){
    	$mobile=I('mobile/s');
    	$email=I('email/s');
    	try 
    	{
    		$crmid=$this->releasecrm($email);
    		$captcha=$this->captchacode();
    		$content="【蒲公英网络】".$captcha."(注册验证码),验证码30分钟内有效。";
			$this->sendsms($mobile,$content);

    		//同时将验证码保存到数据库
    		$code=M('emailcode');
			$data=array(
				"EmailCaptcha"=>$captcha,
				"Email"=>$mobile,
				"CodeDate"=>time(),
				"CodeType"=>0
			);
			$code->add($data);
			$this->ajaxReturn($crmid);
            exit;
    	} catch (Exception $e) {
    		$this->ajaxReturn(1);
            exit;
    	}
    	
    }

    //随机生成验证码方法
    function captchacode()
    {
    	$uuid = '';
    	$chars = "0123456789";
    	$char_len = strlen($chars);
    	for($i=0;$i<6;$i++){
    		$loop = mt_rand(0, ($char_len-1));
    		$uuid .= $chars[$loop];
    	}
    	return $uuid;
    }

    function sendsms($phone,$content){
		$url="http://www.api.zthysms.com/sendSms.do";
		$datetime=date("YmdHis");
		$pwd="O6YoYN";
		$postarr=array(
			"username"=>"pugongyinghy",
			"tkey"=>$datetime,
			"password"=>md5(md5($pwd).$datetime),
			"mobile"=>$phone,
			"content"=>$content,
			"xh"=>""
		);
	    $curl = curl_init(); // 启动一个CURL会话      
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址                  
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查      
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在      
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器      
		curl_setopt($curl, CURLOPT_POST, true); // 发送一个常规的Post请求
		curl_setopt($curl, CURLOPT_POSTFIELDS,  http_build_query($postarr)); // Post提交的数据包
		curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环      
		curl_setopt($curl, CURLOPT_HEADER, false); // 显示返回的Header区域内容      
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // 获取的信息以文件流的形式返回
		$result = curl_exec($curl); // 执行操作      
		if (curl_errno($curl)) {      
			echo 'Error POST'.curl_error($curl);      
		}      
		curl_close($curl); // 关键CURL会话   
		return $result;
	}

	public function releasecrm($email){
        $url = "http://222.187.238.120:80/api/client/id/".$email;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$output = curl_exec($ch);
		curl_close($ch);
		$info = json_decode(json_encode(json_decode($output)),TRUE);
		return $info['data'];
    }

    //找回密码
    public function findpwd(){
        if(IS_POST){
            $usermodel = D('User');
            $linkmail=I('post.linkmail');
            session('linkmail',$linkmail);
            $user=$usermodel->where("LinkMail ='%s'",$linkmail)->find();
            if($user==''){
                $this->error("该邮箱未注册");
            }else{
                $this->redirect('Subpage/changepwd');
            }
        }
        $this->display();
    }
    //修改密码
    public function changepwd(){
        if(IS_POST){
            $usermodel = D('User');
            $pwd=I('post.password');
            $linkmail=session('linkmail');
            $data['UserClearPwd']=$pwd;
            $data['UserPwd']=md5($pwd);
            $usermodel->where("LinkMail ='%s'",$linkmail)->save($data);
            $this->success("修改成功",U('Subpage/login'));
        }
        $this->display();
    }

    //生成token
    static function token()
    {
        //生成用户token
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        $token=$userid.$uuid;
        return $token;
    }

    static function ygauth($username,$password)
    {
        //判断云谷平台账号登录
        try 
        {
            $url = "http://180.101.72.213:2525/apiyungoing/userauth?username=".urlencode($username)."&password=".urlencode($password);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $output=json_decode($output);
            if ($output[0]==0) {
                return $output[1];
            }else{
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    static function yglogin($username,$password)
    {
        $usermodel = D('User');
        //判断云谷平台账号登录
        try 
        {
            $url = "http://180.101.72.213:2525/apiyungoing/userauth?username=".urlencode($username)."&password=".urlencode($password);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            $output=json_decode($output);
            if ($output[0]==0) {
                //获取用户资料
                $infourl = "http://180.101.72.213:2525/apiyungoing/userinfo?userid=".$output[1];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $infourl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $res = curl_exec($ch);
                curl_close($ch);
                $res=json_decode(json_encode(json_decode($res)),TRUE);
                $res=json_decode(json_encode(json_decode($res[0])),TRUE);
                //将云谷账号同步到新的数据表
                $token=self::token();
                $ygdata=array(
                    "UserName"=>$username,
                    "UserPsw"=>md5($password),
                    "LinkMail"=>$res[0]['email'],
                    "UserClearPwd"=>$password,
                    "RegTime"=>time(),
                    "company"=>'',
                    "phone"=>$res[0]['tel'],
                    "YungoID"=>$res[0]['uid'],
                    // 'LastTime'=>time(),
                    // 'WebGuid'=>$token,
                    // 'EffectiveTime'=>date("Y-m-d H:i:s",strtotime("+1 day"))
                );
                $usermodel->add($ygdata);
                return 0;
            }
            else
            {
                return 1;
            }
        } catch (Exception $e) {
            return 1;
        }
    }

    static function getToken($len = 32, $md5 = true) {
      # Seed random number generator
      # Only needed for PHP versions prior to 4.2
      mt_srand((double) microtime() * 1000000);
      # Array of characters, adjust as desired
      $chars = array (
        'Q',
        '@',
        '8',
        'y',
        '%',
        '^',
        '5',
        'Z',
        '(',
        'G',
        '_',
        'O',
        '`',
        'S',
        '-',
        'N',
        '<',
        'D',
        '{',
        '}',
        '[',
        ']',
        'h',
        ';',
        'W',
        '.',
        '/',
        '|',
        ':',
        '1',
        'E',
        'L',
        '4',
        '&',
        '6',
        '7',
        '#',
        '9',
        'a',
        'A',
        'b',
        'B',
        '~',
        'C',
        'd',
        '>',
        'e',
        '2',
        'f',
        'P',
        'g',
        ')',
        '?',
        'H',
        'i',
        'X',
        'U',
        'J',
        'k',
        'r',
        'l',
        '3',
        't',
        'M',
        'n',
        '=',
        'o',
        '+',
        'p',
        'F',
        'q',
        '!',
        'K',
        'R',
        's',
        'c',
        'm',
        'T',
        'v',
        'j',
        'u',
        'V',
        'w',
        ',',
        'x',
        'I',
        '$',
        'Y',
        'z',
        '*'
      );
      # Array indice friendly number of chars;
      $numChars = count($chars) - 1;
      $token = '';
      # Create random token at the specified length
      for ($i = 0; $i < $len; $i++)
        $token .= $chars[mt_rand(0, $numChars)];
      # Should token be run through md5?
      if ($md5) {
        # Number of 32 char chunks
        $chunks = ceil(strlen($token) / 32);
        $md5token = '';
        # Run each chunk through md5
        for ($i = 1; $i <= $chunks; $i++)
          $md5token .= md5(substr($token, $i * 32 - 32, 32));
        # Trim the token
        $token = substr($md5token, 0, $len);
      }
      return $token;
    }
}