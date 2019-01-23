<?php
namespace Admin\Controller;
use Think\Controller;
class UserinfoController extends BaseController {
    public function userinfoAction(){
        parent::nosession();
        //获取当前用户余额
    	$paylogModel=M('paylog');
        $userid=session('loginuser.userid');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();       
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        //获取用户信息
        $usermodel=M('users');
        $userinfolist=$usermodel->where("UserID=%d",$userid)->find();
        $this->assign('balance',$balance);
        $this->assign('user',session('loginuser'));
    	$this->assign('usercenter',1);
        $this->assign('data',1);
        $this->assign('userinfolist',$userinfolist);
    	$this->display();
    }

    //账户管理
    public function accountAction(){
        parent::nosession();
        //获取当前用户余额
        $paylogModel=M('paylog');
        $userid=session('loginuser.userid');
        $cpage=I('p/d',1);
        //$key=I('keyword/s');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        //查询消费记录
        $count = $paylogModel->where("userid=%d ",$userid)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        //$Page->parameter['keyword'] =  $key;
        $show = $Page->show();// 分页显示输出
        $res=$paylogModel->limit($Page->firstRow.','.$Page->listRows)->where("userid=%d ",$userid)->order('id DESC')->select();
        $this->assign('record', $res);
        $this->assign('page',$show);
        $this->assign('balance',$balance);
        $this->assign('usercenter',1);
        $this->assign('account',1);
        $this->display();
    }

    //安全设置
    public function securityAction(){
        parent::nosession();
        $infoModel=M('trueinfo');
        $status=$infoModel->where("userid=%d",session('loginuser.userid'))->getfield('status');
        $this->assign('status',$status);
        $this->assign('user',session('loginuser'));
        $this->assign('usercenter',1);
        $this->assign('security',1);
        $this->display();
    }
    //安全设置  > 用户认证
    public function identificatAction(){
        parent::nosession();
        //获取用户信息
        $userid=session('loginuser.userid');
        $usermodel=M('users');
        $userinfolist=$usermodel->where("UserID=%d",$userid)->find();
        $infoModel=M('trueinfo');
        $status=$infoModel->where("UserID=%d",$userid)->getfield('status');
        $identlist=$infoModel->where("userid=%d",$userid)->find();
        $imageurls=$infoModel->where("userid=%d",$userid)->getfield('pics');
        $imageurls=explode(";",$imageurls);
        $this->assign('status',$status);
        $this->assign('userinfolist',$userinfolist);
        $this->assign('identlist',$identlist);
        $this->assign('imageurls',$imageurls);  
        $this->display();
    }
    //提交认证操作
    public function authAction()
    { 
        $usertype=I('usertype/d');
        $companyname=I('companyname/s');
        $username=I('username/s');
        $linkmail=I('linkmail/s');
        $address=I('address/s');
        $certtype=I('certtype/d');
        $certnum=I('certnum/s');
        $phone=I('phone/s');
        $code=I('code/d');
        $img=I('img/s');
        $img1=I('img1/s');
        $img2=I('img2/s');
        $img3=I('img3/s');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =  2097152;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Public/upload/image/';
        $upload->savePath  =      ''; // 设置附件上传目录
        $info=array();
        $pics="";
        foreach ($_FILES['file']['name'] as $key=>$value){           
            $file1=array();
            if (!empty($value)) {
                $file1["file"]['name']=$value;
                $file1["file"]['type']=$_FILES['file']["type"][$key];
                $file1["file"]['tmp_name']=$_FILES['file']["tmp_name"][$key];
                $file1["file"]['error']=$_FILES['file']["error"][$key];
                $file1["file"]['size']=$_FILES['file']["size"][$key];
                $info   =   $upload->upload($file1);
                if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功
                    foreach($info as $file){
                        $pics.=$file['savepath'].$file['savename'].";";
                    }
                }
            }
        }

        $infoModel=M('trueinfo');
        //先获取原图片
        $info = $infoModel->field('pics')->where("userid = %d",session('loginuser.userid'))->find();
        if (!empty($info)) {
            //说明已经提交过 这次是修改
            $oldpics="";
            if (empty($img)) {
                $oldpics.=$pics;
            }else{
                $oldpics.=$img.';';
            }

            if (empty($img1)) {
                $oldpics.=$pics;
            }else{
                $oldpics.=$img1.';';
            }

            if (empty($img2)) {
                $oldpics.=$pics;
            }else{
                $oldpics.=$img2.';';
            }

            if (empty($img3)) {
                $oldpics.=$pics;
            }else{
                $oldpics.=$img3.';';
            }
            $pics=$info['pics'];
            $picarr1=explode(';', $pics);
            array_pop($picarr1);

            $picarr2=explode(';', $oldpics);
            array_pop($picarr2);
            $delpic=array_diff($picarr1, $picarr2);
            foreach ($delpic as $k => $v) {
                //删除原图片
                unlink($_SERVER['DOCUMENT_ROOT'].'/public/upload/image/'.$v);
            }
        }

        $data=array(
            "userid"=>session('loginuser.userid'),
            "usertype"=>$usertype,
            "companyname"=>$companyname,
            "username"=>$username,
            "linkmail"=>$linkmail,
            "address"=>$address,
            "certtype"=>$certtype,
            "certnum"=>$certnum,
            "phone"=>$phone,
            "pics"=>!empty($info)?$oldpics:$pics,
            "status"=>1,
        );
        if(empty($info)){
            if ($infoModel->add($data)) {
                $this->success('信息提交成功，请等待管理员审核！',"security"); 
            } else {
                $this->error('提交失败');
            }
        }else{
            if ($infoModel->where('userid=%d',session('loginuser.userid'))->save($data)) {
                $this->success('信息提交成功，请等待管理员审核！',"security"); 
            } else {
                $this->error('提交失败');
            }
        }
          
    }
    //退出
    public function exitedAction(){
        $_SESSION["loginuser"]="";
        $this->redirect('Home/Index/index');
    }

    //修改密码
    public function pwchangeAction(){
        $userid=session('loginuser.userid');
        $usermodel=M('users');
        if(IS_POST){
            //修改密码
            if(isset($_POST['oldpwd'])){
                $postpwd=I('post.oldpwd');
                $userpwd = $usermodel->where("userid='%d'",$userid)->getField('UserClearPwd');
                if($userpwd==$postpwd){
                    $this->ajaxReturn('correct');
                }else{
                    $this->ajaxReturn('incorrect');
                }
            }
            if(isset($_POST['newpwd'])){
                $newpwd=I('post.newpwd');
                $data['UserClearPwd']=$newpwd;
                $data['UserPsw']=md5($newpwd);
                $usermodel->where("userid ='%d'",$userid)->save($data);
                $this->ajaxReturn("success");
            }
        }
    }
    //验证码
    public function yzcodeAction(){
        $mobile=I('post.mobile');
    	//$email=I('email/s');
    	try 
    	{
            $captcha=$this->captchacode();
            $content="【蒲公英网络】".$captcha."(注册验证码),验证码30分钟内有效。";
            self::sendsms($mobile,$content);

            //同时将验证码保存到数据库
            $code=M('emailcode');
            $data=array(
                "EmailCaptcha"=>$captcha,
                "Email"=>$mobile,
                "CodeDate"=>time(),
                "CodeType"=>0
            );
            $code->add($data);
            $this->ajaxReturn('success');
            exit;

    	} catch (Exception $e) {
    		$this->ajaxReturn(1);
            exit;
    	}
    	
    }
    //修改手机号
    public function telchangeAction(){
        if(IS_POST){
            $userid=session('loginuser.userid');
            $mobile=I('post.mbile');
            $checkcode=I('post.checkcode');
            //验证码校准
            $codeModel=M('emailcode');
            $newcode = $codeModel->field('CodeID')->where("EmailCaptcha = %d",$checkcode)->order(' CodeID DESC')->find(); 
            if (!$newcode) {
                $this->ajaxReturn('error');
            }else{
                $usermodel=M('users');
                $userdata['phone']=$mobile;
                $usermodel->where("UserID=%d",$userid)->save($userdata);
                $this->ajaxReturn('success');
            }
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
    //发送验证码方法
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
}