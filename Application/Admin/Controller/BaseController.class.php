<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {
    public function _initialize(){
        session_start();
        $sid = session('loginuser');
        //print_r($sid);exit;
        //判断用户是否登陆
        if(!$sid) {
            redirect(U('/admin/login'));
        }
    }

    public function nosession()
    {
        session_start();
        $sid = session('loginuser');
        if(!$sid) {
            session_destroy();
            echo "<script>alert('sesion过期,请重新登录');parent.location.reload();</script>";
            exit;
        }
        else
        {
            $state=0;
            $userModel=M('users');
            $info=$userModel->field('UserID,EffectiveTime')->where("UserName ='%s' AND WebGuid  ='%s'",array($sid['username'],$sid['webguid']))->find();
            if(count($info)>0)
            {
                $now=date('Y-m-d H:i:s');
                if($now>$info['effectivetime'])
                {
                    session_destroy();
                    echo "<script>parent.location.reload();</script>";
                    exit;
                }
            }
            else
            {
                session_destroy();
                echo "<script>parent.location.reload();</script>";
                exit;
            }
        }



    }

}
