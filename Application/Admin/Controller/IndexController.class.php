<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function indexAction(){
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
        //获取产品数量
        $cloudnum1=M('cloudlog')->where("UserID=%d AND State='%s'",$userid,'正常服务')->count();
        $cloudnum2=M('jdcloudlog')->where("UserID=%d AND State='%s'",$userid,'正常服务')->count();
        //获取15天内到期产品数量
        $where=array(
            "UserID" => array('eq',$userid),
            "State" => array('eq','正常服务'),
            "DueTime" => array('lt',strtotime("+".'15'." month",time())),
        );
        $cloudnumdq1=M('cloudlog')->where($where)->count();
        $cloudnumdq2=M('jdcloudlog')->where($where)->count();
        $this->assign('userinfolist',$userinfolist);
        $this->assign('balance',$balance);
        $this->assign('shouye',1);
        $this->assign('cloudnum1',$cloudnum1);
        $this->assign('cloudnum2',$cloudnum2);
        $this->assign('cloudnumdq1',$cloudnumdq1);
        $this->assign('cloudnumdq2',$cloudnumdq2);
    	$this->display();
    }

    //充值页面
    public function payAction()
    {
    	//获取当前用户余额
    	$paylogModel=M('paylog');
    	$userid=session('loginuser.userid');
        //先获取当前用户的总充值金额
        $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,0))->select();
        
        $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($userid,1))->select();
        $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
        $this->assign('balance',$balance);
        $this->display();
    }
    //退出
    public function exitedAction(){
        $_SESSION["loginuser"]="";
        $this->redirect('Home/Index/index');
    }
}