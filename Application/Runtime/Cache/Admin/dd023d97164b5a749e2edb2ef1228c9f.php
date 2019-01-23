<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<title>后台管理</title>
<link href="/Application/Admin/View/Public/css/login.css" rel="stylesheet" type="text/css" />
</head>
<style>
a {color: #4B556A;text-decoration: none;cursor: pointer;}
a:hover, a.active {color: #5FAEF5;}
.mt15 {margin-top: 15px;}
</style>
<body>
<div class="login_box">
      <div class="login_l_img"><img src="/Application/Admin/View/Public/img/login-img.png" /></div>
      <div class="login">
          <div class="login_logo"><a href="#"><img src="/Application/Admin/View/Public/img/login_logo.png" /></a></div>
          <div class="login_name">
               <p>后台管理系统</p>
          </div>
          <form id="mform" method="post" action="">
              <input id="uid" name="username" type="text" placeholder="用户名">
              <input id="pwd" name="password" type="password" id="password"  placeholder="密码"/>
              <input id="uid" name="code" type="text" placeholder="验证码" style="width: 140px;">
              <img src="<?php echo U('verify');?>" style="cursor: pointer;vertical-align: middle;padding-bottom: 15px;" title="看不清，点击换一张" alt="看不清，点击换一张"  onclick="this.src=this.src+'?time='"+ Math.random() >
              <input type="button" id="loginin" value="登录" style="width:100%;" />
              <input type="hidden" name="token" value="<?php echo ($token); ?>">
              <div class="mt15">
                <a href="<?php echo U('User/register');?>">还没账号？立即注册>></a>
            </div>
          </form>
      </div>
      <div class="copyright">蒲公英网络科技有限公司 版权所有©2018-2020 技术支持电话：0527-84224055</div>
</div>
<script type="text/javascript" src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/layer/layer.js"></script>
<script type="text/javascript" src="/Application/Admin/View/Public/script/login.js"></script>
</body>
</html>