<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>蒲公英自动化</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="/Application/Admin/View/Public/css/style.css" rel="stylesheet" type="text/css"  />
<link title="blue" href="/Application/Admin/View/Public/css/dermadefault.css" rel="stylesheet" type="text/css"/>
<link title="green" href="/Application/Admin/View/Public/css/dermagreen.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link title="orange" href="/Application/Admin/View/Public/css/dermaorange.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link href="/Application/Admin/View/Public/css/templatecss.css" rel="stylesheet" title="" type="text/css" />
<link href="/Public/layui/css/layui.css" rel="stylesheet" title="" type="text/css" />
<link href="/Public/font-awesome/css/font-awesome.min.css" rel="stylesheet" title="" type="text/css" />
<link href="/Application/Admin/View/Public/css/paging.css" rel="stylesheet" title="" type="text/css" />
<script src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.cookie.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Public/layui/layui.all.js" type="text/javascript"></script>
<style type="text/css">
body{font-size:14px !important;}
.left-main{background-color: #2f323a;}
.left-full{width: 230px;}
.right-full{left: 230px;}
.navbar-brand{padding: 0;width: 230px;}
.brand-bef-bg{background-image: url(/Application/Admin/View/Public/img/logo.png);background-size: auto 50px;background-repeat: no-repeat;background-position: center;}
.brand-aft-bg{width:48px !important;background-image: url(/Application/Admin/View/Public/img/logo.png);background-size: auto 50px;background-repeat: no-repeat;background-position-x:-6px;}
.sBox .sublist-title,.sBox .sub-title{padding-left: 20px;}
.sBox{cursor: pointer;}
.sBox .sublist-up {background-color: #2f323a;}
.sBox .sublist-down {background-color: #2f323a;}
.sBox ul .active{background: #000;color: fff;}
.sBox ul .active a{color: #fff !important;}
.sBox .subNav:hover{background: transparent;}
.sBox ul li .showtitle{background-color: #1b1d23;}
.sBox ul li{background-color: #1b1d23;}
.sBox ul li:hover{background: #000;color: #fff;}
.sBox ul li a{color: #a5a7ab}
.sBox ul li a:hover{color: #fff;}
.main-table tr:hover {background-color: #e3f2fc;}
.main-table th,.main-table td {padding-left: 15px;text-align: left;}
.main-table th {background-color: #f0f4f7;line-height: 32px;color: #666;border-left: 1px solid #e6e6e6;}
.main-table td {padding-left: 15px;line-height: 35px;border-top: 1px solid #e6e6e6;}
.main-table .style-stripe {background-color: #fafafa;}
.multiple-table thead td {background-color: #F0F4F7;border-left: 1px solid #e6e6e6;line-height: 25px;}
.border-left-none {border-left: 0;}
.navbar-mystyle {background-color: #fff;color: #333;box-shadow: 0 2px 6px rgba(220,223,228,.5);}
.navbar-default .navbar-nav>li>a, .navbar-default .navbar-nav>li>a:focus {color: #333;}
.navbar-mystyle .navbar-nav li .mystyle-color:hover {background-color: #fff;color: #098cba;}
.li-border {border-right: 0px solid #008fbf;}
.navbar-default .navbar-brand:hover {background-color: #008fbf;}
.rdot{position:relative;top:18px;width:6px;height:6px;float: right;margin-right: 5px;background-color: #515660;border-radius:6px;}
.dotactive{background: #008fbf !important;}
</style>
</head>

<body>
<nav class="nav navbar-default navbar-mystyle navbar-fixed-top">
  <div class="navbar-header">
    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
    </button>
    <a href="<?php echo U('Home/Index/index');?>"class="navbar-brand mystyle-brand brand-bef-bg" title="官网首页"></a> </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="li-border"><a class="mystyle-color" href="<?php echo U('Index/index');?>"><i class="fa fa-television"></i> 控制台首页</a></li>
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">产品与服务<span class="caret"></span></a></li>
      
        <!----下拉框选项---->
         <div class="dropdown-menu topbar-nav-list">
             <div class="topbar-nav-col">
               <div class="topbar-nav-item">
               <p class="topbar-nav-item-title">用户中心</p>
               <ul>
                 <li><a href="<?php echo U('Userinfo/account');?>">
                     <span class="glyphicon glyphicon-usd"></span> 
                     <span class="">账户管理</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Userinfo/userinfo');?>">
                     <span class="glyphicon glyphicon-user"></span> 
                     <span class="">用户资料</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Userinfo/security');?>">
                     <span class="glyphicon glyphicon-fire"></span> 
                     <span class="">安全设置</span> 
                 </a>
                 </li>
                </ul>
               </div>
               
               <div class="">
               <p class="topbar-nav-item-title">云计算</p>
               <ul>
                 <li><a href="<?php echo U('Cloud/cloudmanage');?>">
                     <span class="glyphicon glyphicon-cloud"></span> 
                     <span class="">云主机管理</span> 
                 </a>
                 </li>
               </ul>
               </div> 
             </div>
             
             
             <div class="topbar-nav-col">
               <div class="topbar-nav-item">
               <p class="topbar-nav-item-title">官网管理</p>
               <ul>
                 <li><a href="<?php echo U('Officweb/navlist');?>">
                     <span class="glyphicon glyphicon-th-list"></span> 
                     <span class="">导航列表</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Officweb/newslist');?>">
                     <span class="glyphicon glyphicon-list-alt"></span> 
                     <span class="">模块列表</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Officweb/memberlist');?>">
                     <span class="glyphicon glyphicon-user"></span> 
                     <span class="">会员信息</span> 
                 </a>
                 </li>
                </ul>
               </div>
               
               <div class="">
               <p class="topbar-nav-item-title">产品管理</p>
               <ul>
                 <li><a href="<?php echo U('Officweb/cloudlist');?>">
                     <span class="glyphicon glyphicon-tags"></span> 
                     <span class="">云架构</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Officweb/serverlist');?>">
                     <span class="glyphicon glyphicon-tags"></span> 
                     <span class="">物理架构</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Officweb/physicslist');?>">
                     <span class="glyphicon glyphicon-tags"></span> 
                     <span class="">物理价格</span> 
                 </a>
                 </li>
               </ul>
               </div>
               
             </div>
             
         </div>
      </li>
    </ul>
    
    <ul class="nav navbar-nav pull-right">
       <li class="li-border">
          <a href="#" class="mystyle-color">
            <span class="glyphicon glyphicon-bell"></span>
            <span class="topbar-num">0</span>
          </a>
      </li>
       <li class="li-border dropdown"><a href="#" class="mystyle-color" data-toggle="dropdown">
      <span class="glyphicon glyphicon-search"></span> 搜索</a>
         <div class="dropdown-menu search-dropdown">
            <div class="input-group">
                <input type="text" class="form-control">
                 <span class="input-group-btn">
                   <button type="button" class="btn btn-default">搜索</button>
                </span>
            </div>
         </div>
      </li>
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">帮助与文档<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">帮助与文档</a></li>
          <li class="divider"></li>
          <li><a href="#">论坛</a></li>
          <li class="divider"></li>
          <li><a href="#">博客</a></li>
        </ul>
      </li>
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown"><?php echo ($_SESSION['loginuser']['username']); ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo U('Index/exited');?>">退出</a></li>
        </ul>
      </li>
      <!-- <li class="dropdown"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">换肤<span class="caret"></span></a>
        <ul class="dropdown-menu changecolor">
          <li id="blue"><a href="#">蓝色</a></li>
          <li class="divider"></li>
          <li id="green"><a href="#">绿色</a></li>
          <li class="divider"></li>
          <li id="orange"><a href="#">橙色</a></li>
        </ul>
      </li> -->
    </ul>
  </div>
</nav>
<div class="down-main">
  <div class="left-main left-full">
    <div class="sidebar-fold"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
    <div class="subNavBox">
      <!-- 云主机管理 -->
      <div class="sBox">
        <div class="subNav"><span class="sublist-icon glyphicon glyphicon-cloud"></span><span class="sublist-title">云计算</span><span class="rdot <?php if($cloud != ''): ?>dotactive<?php endif; ?>"></span></div>
        <ul class="navContent" style="<?=empty($cloud)?"display:none":"display:block"?>">
          <li <?=empty($cloudmanage)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />云主机线路1管理</div>
            <a href="<?php echo U('Cloud/cloudmanage');?>"><span class="sublist-icon glyphicon glyphicon-cloud"></span><span class="sub-title">云主机线路1管理</span></a></li>
          <li <?=empty($jdcloudmanage)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />云主机线路2管理</div>
            <a href="<?php echo U('Jdcloud/jdcloudmanage');?>"><span class="sublist-icon glyphicon glyphicon-cloud"></span><span class="sub-title">云主机线路2管理</span></a></li>
        </ul>
      </div>
      <!-- 物理机管理-->
      <div class="sBox">
        <div class="subNav"><span class="sublist-icon fa fa-server"></span><span class="sublist-title">物理机管理</span><span class="rdot <?php if($physical != ''): ?>dotactive<?php endif; ?>"></span></div>
        <ul class="navContent" style="<?=empty($physical)?"display:none":"display:block"?>">
          <li <?=empty($ordercontrol)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />我的订单</div>
            <a href="<?php echo U('Physical/ordercontrol');?>"><span class="sublist-icon fa fa-list-alt"></span><span class="sub-title">我的订单</span></a></li>
          <li <?=empty($servercontrol)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />我的服务器</div>
            <a href="<?php echo U('Physical/servercontrol');?>"><span class="sublist-icon fa fa-server"></span><span class="sub-title">我的服务器</span></a></li>
          <li <?=empty($workingsheet)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />正在处理工单</div>
            <a href="<?php echo U('Physical/workingsheet');?>"><span class="sublist-icon fa fa-th-list"></span><span class="sub-title">正在处理工单</span></a></li>
          <li <?=empty($attacktow)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />攻击解封</div>
            <a href="<?php echo U('Physical/attacktow');?>"><span class="sublist-icon fa fa-unlock"></span><span class="sub-title">攻击解封</span></a></li>
          <li <?=empty($attackrecord)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />攻击记录</div>
            <a href="<?php echo U('Physical/attackrecord');?>"><span class="sublist-icon fa fa-file-text-o"></span><span class="sub-title">攻击记录</span></a></li>        
        </ul>
      </div>
      <div class="sBox">
        <div class="subNav"><span class="sublist-icon fa fa-fire-extinguisher"></span><span class="sublist-title">防火墙相关设置</span><span class="rdot <?php if($firewall != ''): ?>dotactive<?php endif; ?>"></span></div>
        <ul class="navContent" style="<?=empty($firewall)?"display:none":"display:block"?>">
          <li <?=empty($goldenshield)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />金盾网页CC</div>
            <a href="<?php echo U('Firewall/goldenshield');?>"><span class="sublist-icon fa fa-shield"></span><span class="sub-title">金盾网页CC</span></a></li>
          <li <?=empty($blacklist)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />防火墙IP释放</div>
            <a href="<?php echo U('Firewall/blacklist');?>"><span class="sublist-icon fa fa-fire-extinguisher"></span><span class="sub-title">防火墙IP释放</span></a></li>
          <li title="域名白名单(宿迁)" <?=empty($whitelistadd)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />域名白名单(宿迁)</div>
            <a href="<?php echo U('Firewall/whitelistadd');?>"><span class="sublist-icon fa fa-file"></span><span class="sub-title">域名白名单(宿迁)</span></a></li>
          <li title="域名白名单(扬州)" <?=empty($whitelistaddyz)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />域名白名单(扬州)</div>
            <a href="<?php echo U('Firewall/whitelistaddyz');?>"><span class="sublist-icon fa fa-file"></span><span class="sub-title">域名白名单(扬州)</span></a></li>
        </ul>
      </div>
      <div class="sBox">
        <div class="subNav"><span class="sublist-icon fa fa-shield"></span><span class="sublist-title">防御相关设置</span><span class="rdot <?php if($blockabroadip != ''): ?>dotactive<?php endif; ?>"></span></div>
        <ul class="navContent" style="<?=empty($blockabroadip)?"display:none":"display:block"?>">
          <li <?=empty($baip)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />防御阻断</div>
            <a href="<?php echo U('Blockabroadip/blockabroadip');?>"><span class="sublist-icon fa fa-ban"></span><span class="sub-title">防御阻断</span></a></li>
          <li <?=empty($setips)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />牵引策略设置</div>
            <a href="<?php echo U('Blockabroadip/setips');?>"><span class="sublist-icon fa fa-sliders"></span><span class="sub-title">牵引策略设置</span></a></li>
        </ul>
      </div>
      <!-- 官网管理-->
      <?php if($_SESSION['loginuser']['usertype']== 1): ?><div class="sBox">
        <div class="subNav"><span class="sublist-icon fa fa-globe"></span><span class="sublist-title">官网管理</span><span class="rdot <?php if($guanwang != ''): ?>dotactive<?php endif; ?>"></span></div>
        <ul class="navContent" style="<?=empty($guanwang)?"display:none":"display:block"?>">
          <li <?=empty($daohang)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">导航列表</div>
            <a href="<?php echo U('officweb/navlist');?>"><span class="sublist-icon glyphicon glyphicon-th-list"></span><span class="sub-title">导航列表</span></a></li>
          <li <?=empty($mokuai)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">模块列表</div>
            <a href="<?php echo U('officweb/newslist');?>"><span class="sublist-icon glyphicon glyphicon-list-alt"></span><span class="sub-title">模块列表</span></a></li>
          <li <?=empty($member)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">会员信息</div>
            <a href="<?php echo U('officweb/memberlist');?>"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">会员信息</span></a></li>
        </ul>
      </div><?php endif; ?>
      <!-- 产品管理 -->
      <?php if($_SESSION['loginuser']['usertype']== 1): ?><div class="sBox">
        <div class="subNav"><span class="sublist-icon fa fa-shopping-bag"></span><span class="sublist-title">产品管理</span><span class="rdot <?php if($product != ''): ?>dotactive<?php endif; ?>"></span></div>
        <ul class="navContent" style="<?=empty($product)?"display:none":"display:block"?>">
          <li <?=empty($quote)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">云架构</div>
            <a href="<?php echo U('officweb/cloudlist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">云架构</span></a></li>
          <li <?=empty($jdquote)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">京东云架构</div>
            <a href="<?php echo U('officweb/jdcloudlist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">京东云架构</span></a></li>
          <li <?=empty($server)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">物理架构</div>
            <a href="<?php echo U('officweb/serverlist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">物理架构</span></a></li>
          <li <?=empty($physics)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">物理价格</div>
            <a href="<?php echo U('officweb/physicslist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">物理价格</span></a></li>
        </ul>
      </div><?php endif; ?>
      <!-- 用户中心 -->
      <div class="sBox">
          <div class="subNav"><span class="sublist-icon fa fa-user"></span><span class="sublist-title">用户中心</span><span class="rdot <?php if($usercenter != ''): ?>dotactive<?php endif; ?>"></span></div>
           <ul class="navContent" style="<?=empty($usercenter)?"display:none":"display:block"?>">
             <li <?=empty($account)?'':"class='active'"?>>
               <div class="showtitle" style="width:100px;"><img src="" />资金账户</div>
               <a href="<?php echo U('Userinfo/account');?>"><span class="sublist-icon glyphicon glyphicon-usd"></span><span class="sub-title">账户管理</span></a> </li>
             <li <?=empty($data)?'':"class='active'"?>>
               <div class="showtitle" style="width:100px;"><img src="" />用户资料</div>
               <a href="<?php echo U('Userinfo/userinfo');?>"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">用户资料</span></a> </li>
               <li <?=empty($security)?'':"class='active'"?>>
               <div class="showtitle" style="width:100px;"><img src="" />安全设置</div>
               <a href="<?php echo U('Userinfo/security');?>"><span class="sublist-icon glyphicon glyphicon-fire"></span><span class="sub-title">安全设置</span></a> </li>
             <!-- <li <?=empty($news)?'':"class='active'"?>>
               <div class="showtitle" style="width:100px;"><img src="" />消息中心</div>
               <a href="message.html"><span class="sublist-icon glyphicon glyphicon-envelope"></span><span class="sub-title">消息中心</span></a> </li>
             <li <?=empty($cert)?'':"class='active'"?>>
               <div class="showtitle" style="width:100px;"><img src="" />实名认证</div>
               <a href="identify.html"><span class="sublist-icon glyphicon glyphicon-credit-card"></span><span class="sub-title">实名认证</span></a></li> -->
           </ul>
      </div>
    </div>
  </div>
<style>
	.base-info{padding:0 10px;}
	.binfo-title{color: #09c;font-size: 15px;margin: 20px 0 10px 0;}
	.binfo-title .circle{width: 10px;height: 10px;background: #09c;border-radius: 10px;display: inline-block;}
    .binfo-panel{padding-left: 30px;}
	.flabel{margin-left: 10px;}
    .form-group{color: #4b556a !important}
    label{width: 100px;text-align: right;color: #4b556a !important}
    .certified-item {display: inline-block;vertical-align: middle;width: 32.33%;margin: 10px 0;}
    .form-control{height: 32px;font-size: 12px;border-radius:0px;width: 145px;display: inline-block;}
    .imgwrap{display: inline-block;text-align: center;}
    .imgwrap p{font-size: 12px;color: #888;}
    .layui-upload-img {width: 30px;height: 30px;cursor: pointer;}
    a:hover{color: #098cba;}
    .getcode{font-size: 13px;padding: 8px 10px;border: 1px solid #ccc;border-radius: 4px;color: #098cba;cursor: pointer;}
    .getcode:hover{background-color: #bee0ec;border: 1px solid #098cba}
    .btn-mybtn{background-color: #098cba;color: #fff;padding: 10px 36px;}
    .btn-mybtn:hover{background:linear-gradient(180deg,#5dc9ef,#098cba);color: #fff;}
    .layui-input-inline{width: 90px !important;}
    .layui-upload-list img{width: 40px;height: 40px;}
</style>
<script>
    $(function(){
        if($('.sel-usertype').children('option:selected').val()=='1'){
            $('.certified-item-com').show();
        }else{
            $('.certified-item-com').hide();
        }
        $('.sel-usertype').change(function(){
            var val=$(this).children("option:selected").val();
            switch(val){
                case "0":$('.certified-item-com').hide();break;
                case "1":$('.certified-item-com').show();break;
            }
        })
    })
    
</script>
  <div class="right-product view-product right-full">
    <div class="container-fluid">
		<div class="manage account-manage info-center">
			<div class="page-header">
				<div class="pull-left">
					<h4>安全设置  <span style="color: #aaa;"><i class="glyphicon glyphicon-chevron-right"></i> 用户认证</span></h4>      
				</div>
			</div>
			<div class="page-body">
                <form name="authform" enctype="multipart/form-data" method="post" action="<?php echo U('Userinfo/auth');?>" target="" onsubmit="return checkform(this)">
				<div class="base-info">
					<div class="binfo-title"><span class="circle"></span> 账号信息</div>
					<div class="binfo-panel">
                        <div class="form-group">
                            <label for="name">当前登录账号：</label>
                            <span><?php echo ($userinfolist["username"]); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="name">认证状态：</label>
                            <span>
                                <?php switch($status): case "0": ?><span class="text-danger">未通过认证</span><?php break;?>
                                    <?php case "1": ?><span class="text-warning">审核中</span><?php break;?>
                                    <?php case "2": ?><span class="text-success">已认证</span><?php break;?>
                                    <?php default: ?><span class="text-warning">未认证</span><?php endswitch;?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="name">用户身份：</label>
                            <select class="form-control sel-usertype" name="usertype">
                                <option value="0" <?php if($identlist["usertype"] == '0'): ?>selected<?php endif; ?>>个人用户</option>
                                <option value="1" <?php if($identlist["usertype"] == '1'): ?>selected<?php endif; ?>>企业用户</option>
                            </select>
                        </div>
					</div>
				</div>
				<div class="base-info">
					<div class="binfo-title"><span class="circle"></span> 认证内容</div>
					<div class="binfo-panel">
						<div style="background: #eee;padding:4px 0;">要求：手持身份证/护照，将证件的人像面对准镜头，确保能够清晰看见您本人人像和身份证/护照上的全部信息。<a href="javascript:void(0);" style="color: #337ab7;">查看样张</a></div>
                        <div class="certified-item certified-item-com" style="display: none;">
                            <label><span style="color: #e2003b;">*</span>企业名称：</label>
                            <input type="text" class="form-control" value="<?php echo ($identlist["companyname"]); ?>" name="companyname">
                            <p class="companynamep" style="margin-left: 100px;color: #e2003b;visibility: hidden;">企业名称不能为空！</p>
                        </div>
                        <div class="certified-item certified-item-com" style="display: none;">
                            <label style="position: relative;bottom: 40px;"><span style="color: #e2003b;">*</span>营业执照：</label>
                            <div class="layui-form-item compic" style="display: inline-block;">
                                <div class="layui-input-inline" style="text-align: center;">
                                <div class="layui-upload-list" id="preview3" style="border: 1px solid #ececec;width: 40px;height: 40px;margin: 10px auto;">
                                    <img src="<?='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Public/upload/image/'.$imageurls[3]?>"/>
                                </div>
                                <div class="file-box" style="margin:0 auto;">
                                    <input type="file" id="f4" name="file[]" accept="iamge/gif,image/jpeg,image/jpg,image/png" onchange="document.getElementById('preview').value=this.value" style="width:70px;display:none;" />
                                    <a href="javascript:void(0);" onclick="$('#f4').click();" style="color: #098cba;"><i class="fa fa-cloud-upload"></i>营业执照</a>
                                    <input type="hidden" name="img3" value="<?php echo ($imageurls[3]); ?>"></div>
                                </div>
                            </div>
                            <p class="comp" style="margin-left: 100px;color: #e2003b;">请上传证件照片！</p>
                        </div>
                        <div class="certified-item">
                            <label><span style="color: #e2003b;">*</span>联系人姓名：</label>
                            <input type="text" class="form-control" value="<?php echo ($userinfolist["username"]); ?>" name="username">
                            <p class="usernamep" style="margin-left: 100px;color: #e2003b;visibility: hidden;">联系人姓名不能为空！</p>
                        </div>
                        
                        <div class="certified-item">
                            <label><span style="color: #e2003b;">*</span>联系人邮箱：</label>
                            <input type="text" class="form-control" value="<?php echo ($userinfolist["linkmail"]); ?>" name="linkmail">
                            <p class="linkmailp" style="margin-left: 100px;color: #e2003b;visibility: hidden;">联系人邮箱不能为空！</p>
                        </div>
                        <div class="certified-item">
                            <label><span style="color: #e2003b;">*</span>联系地址：</label>
                            <input type="text" class="form-control" name="address" value="<?php echo ($identlist["address"]); ?>">
                            <p class="addressp" style="margin-left: 100px;color: #e2003b;visibility: hidden;">联系地址不能为空！</p>
                        </div>
                        <div class="certified-item">
                            <label><span style="color: #e2003b;">*</span>证件类型：</label>
                            <select class="form-control" name="certtype">
                                <option value="">请选择</option>
                                <option value="0" <?php if($identlist["usertype"] == 0): ?>selected<?php endif; ?>>身份证</option>
                                <option value="1" <?php if($identlist["usertype"] == 1): ?>selected<?php endif; ?>>护照</option>
                            </select>
                            <p class="certtypep" style="margin-left: 100px;color: #e2003b;visibility: hidden;">请选择证件类型！</p>
                        </div>
                        <div class="certified-item">
                            <label><span style="color: #e2003b;">*</span>证件号码：</label>
                            <input type="text" class="form-control" name="certnum" value="<?php echo ($identlist["certnum"]); ?>">
                            <p class="certnump" style="margin-left: 100px;color: #e2003b;visibility: hidden;">证件号码格式不正确！</p>
                        </div>
                        <div class="certified-item">
                            <label style="position: relative;bottom: 40px;"><span style="color: #e2003b;">*</span>证件照片：</label>
                            <div class="layui-form-item cerpic" style="display: inline-block;">
                                <div class="layui-input-inline" style="text-align: center;">
                                <div class="layui-upload-list" id="preview" style="border: 1px solid #ececec;width: 40px;height: 40px;margin: 10px auto;">
                                    <img src="<?='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Public/upload/image/'.$imageurls[0]?>"/>
                                </div>
                                <div class="file-box" style="margin:0 auto;">
                                    <input type="file" id="f1" name="file[]" accept="iamge/gif,image/jpeg,image/jpg,image/png" onchange="document.getElementById('preview').value=this.value" style="width:70px;display:none;" />
                                    <a href="javascript:void(0);" onclick="$('#f1').click();" style="color: #098cba;"><i class="fa fa-cloud-upload"></i>证件正面</a>
                                    <input type="hidden" name="img" value="<?php echo ($imageurls[0]); ?>"></div>
                                </div>

                                <div class="layui-input-inline" style="text-align: center;" id="fan">
                                <div class="layui-upload-list" id="preview1" style="border: 1px solid #ececec;width: 40px;height: 40px;margin: 10px auto;">
                                    <img src="<?='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Public/upload/image/'.$imageurls[1]?>"/>
                                </div>
                                <div class="file-box" style="margin:0 auto;">
                                    <input type="file" id="f2" name="file[]" accept="iamge/gif,image/jpeg,image/jpg,image/png" onchange="document.getElementById('preview1').value=this.value" style="width:70px;display:none;" />
                                    <a href="javascript:void(0);" onclick="$('#f2').click();" style="color: #098cba;"><i class="fa fa-cloud-upload"></i>证件反面</a>
                                    <input type="hidden" name="img1" value="<?php echo ($imageurls[1]); ?>"></div>
                                </div>
                                
                                <div class="layui-input-inline" style="text-align: center;">
                                <div class="layui-upload-list" id="preview2" style="border: 1px solid #ececec;width: 40px;height: 40px;margin: 10px auto;">
                                    <img src="<?='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/Public/upload/image/'.$imageurls[2]?>"/>
                                </div>
                                <div class="file-box" style="margin:0 auto;">
                                    <input type="file" id="f3" name="file[]" accept="iamge/gif,image/jpeg,image/jpg,image/png" onchange="document.getElementById('preview2').value=this.value" style="width:70px;display:none;" />
                                    <a href="javascript:void(0);" onclick="$('#f3').click();" style="color: #098cba;"><i class="fa fa-cloud-upload"></i>手持证件照</a>
                                    <input type="hidden" name="img2" value="<?php echo ($imageurls[2]); ?>"></div>
                                </div>
                            </div>
                            <p class="certpicp" style="margin-left: 100px;color: #e2003b;visibility: hidden;">请上传证件照片！</p>   
                        </div>
                    </div>
				</div>
				<div class="base-info">
					<div class="binfo-title"><span class="circle"></span> 认证手机信息</div>
					<div class="binfo-panel">
						<div class="form-group">
                            <label for="name">手机号码：</label>
                            <input type="text" class="form-control phone" value="<?php echo ($userinfolist["phone"]); ?>" name="phone">
                            <span class="getcode">获取验证码</span><span class="codetip" style="padding-left: 20px;color:red"></span>
                        </div>
                        <p style="color: #8b9196;margin-left: 100px;">非中国大陆号码请输入“区号-手机号”</p>
                        <div class="form-group">
                            <label for="name">验证码：</label>
                            <input type="text" class="form-control code" name="code">
                        </div>
					</div>
                </div>
                <input type="submit" class="btn btn-mybtn" value="立即认证">
                </form>
            </div>
		</div>
	</div>
  </div>
</div>
</div>
<style>
	label{width: 100px;text-align: right;display: inline-block;}
</style>
<!-- 模态框 修改密码 -->
<div class="modal fade" id="pwModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					修改密码
				</h4>
			</div>
			<div class="modal-body">
				<div style="width: 460px;margin: 0 auto;">
					<p><label for="old-password">旧密码：</label><input id="old-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请输入旧密码"><span class="oldtip" style="padding-left: 20px;color:red"></span></p>
					<p><label for="new-password">新密码：</label><input id="new-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请输入新密码"><span class="newtip" style="padding-left: 20px;color:red"></span></p>
					<p><label for="conf-password">确认密码：</label><input id="conf-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请再次输入新密码"><span class="conftip" style="padding-left: 20px;color:red"></span></p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary btn-savepass">
					提交更改
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<!-- 模态框 更改手机号 -->
<div class="modal fade" id="phModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						更改手机号
					</h4>
				</div>
				<div class="modal-body">
					<div style="width: 460px;margin: 0 auto;">
						<p><label for="old-password">手机号：</label><input id="phonenum" class="form-control" style="width: 172px;display: inline-block;" type="text" placeholder="请输入手机号"><span class="phonetip" style="padding-left: 20px;color:red"></span></p>
						<p><label for="new-password">验证码：</label><input id="checkcode" class="form-control" style="width: 80px;display: inline-block;" type="text" placeholder="验证码">
							<span class="getcode" style="font-size: 14px;padding: 8px 8px;border: 1px solid #ccc;border-radius: 4px;color: #337ab7;cursor: pointer;">获取验证码</span><span class="codetip" style="padding-left: 20px;color:red"></span>
						</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭
					</button>
					<button type="button" class="btn btn-primary btn-savetel">
						提交更改
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
<script type="text/javascript">
$(function(){
/*换肤*/
$(".dropdown .changecolor li").click(function(){
	var style = $(this).attr("id");
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+style+"']").removeAttr("disabled"); 

	$.cookie('mystyle', style, { expires: 7 }); // 存储一个带7天期限的 cookie 
})
var cookie_style = $.cookie("mystyle"); 
if(cookie_style!=null){ 
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+cookie_style+"']").removeAttr("disabled"); 
} 
/*左侧导航栏显示隐藏功能*/
$(".subNav").hover(
	function(){
		$(this).find('.rdot').css('background','#008fbf');
	},
	function(){
		$(this).find('.rdot').css('background','#515660');
	}
)
$(".subNav").click(function(){	
	//$(this).find('.rdot').css('background','#008fbf');			
	// 修改数字控制速度， slideUp(500)控制卷起速度
	$(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(300);
	})
/*左侧导航栏缩进功能*/
$(".left-main .sidebar-fold").click(function(){
	if($(this).parent().attr('class')=="left-main left-full"){
		$(this).parent().removeClass("left-full");
		$(this).parent().addClass("left-off");
		$(this).parent().parent().find(".right-product").removeClass("right-full");
		$(this).parent().parent().find(".right-product").addClass("right-off");
		$('.rdot').hide();
	}else{
		$(this).parent().removeClass("left-off");
		$(this).parent().addClass("left-full");
		$(this).parent().parent().find(".right-product").removeClass("right-off");
		$(this).parent().parent().find(".right-product").addClass("right-full");
		$('.rdot').show();
	}
	if($('.navbar-brand').hasClass('brand-bef-bg')){
		$('.navbar-brand').removeClass('brand-bef-bg');
		$('.navbar-brand').addClass('brand-aft-bg');
	}else{
		$('.navbar-brand').removeClass('brand-aft-bg');
		$('.navbar-brand').addClass('brand-bef-bg');
	}
})	
 
/*左侧鼠标移入提示功能*/
$(".sBox ul li").mouseenter(function(){
	if($(this).find("span:last-child").css("display")=="none")
	{$(this).find("div").show();}
	}).mouseleave(function(){$(this).find("div").hide();})	
})
</script>
</body>
</html>
<script>
    function checkform(form){
        if($('.certified-item-com').css('display')!="none"){
            if(form.companyname.value==''){
                $('.companynamep').css('visibility','visible');
                return false;
            }else{
                $('.companynamep').css('visibility','hidden');
            }
            if($('.compic').find('img').attr('src')!=''){
                $('.comp').css('visibility','hidden');
            }else{
                $('.comp').css('visibility','visible');
                return false;
            }
        }
        if(form.username.value==''){
            $('.usernamep').css('visibility','visible');
            return false;
        }else{
            $('.usernamep').css('visibility','hidden');
        }
        if(form.linkmail.value==''){
            $('.linkmailp').css('visibility','visible');
            return false;
        }else{
            $('.linkmailp').css('visibility','hidden');
        }
        if(form.address.value==''){
            $('.addressp').css('visibility','visible');
            return false;
        }else{
            $('.addressp').css('visibility','hidden');
        }
        if(form.certtype.value==''){
            $('.certtypep').css('visibility','visible');
            return false;
        }else{
            $('.certtypep').css('visibility','hidden');
        }
        if(form.certnum.value==''||form.certnum.value.length!=18){
            $('.certnump').css('visibility','visible');
            return false;
        }else{
            $('.certnump').css('visibility','hidden');
        }
        if($('.cerpic').find('img').eq(0).attr('src')!=''&&$('.cerpic').find('img').eq(1).attr('src')!=''&&$('.cerpic').find('img').eq(2).attr('src')!=''){
            $('.certpicp').css('visibility','hidden');
        }else{
            $('.certpicp').css('visibility','visible');
            return false;
        }
    }
</script>
<script>
    function preview1(file) {
        var img = new Image(), url = img.src = URL.createObjectURL(file);
        var $img = $(img);
        img.onload = function() {
            URL.revokeObjectURL(url);
            $('#preview').empty().append($img);
            
        }
    }
    function preview2(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var $img = $('<img>').attr("src", e.target.result);
            $('#preview').empty().append($img);
            
        }
        reader.readAsDataURL(file);        
    }

    function preview11(file) {
        var img = new Image(), url = img.src = URL.createObjectURL(file);
        var $img = $(img);
        img.onload = function() {
            URL.revokeObjectURL(url);
            $('#preview1').empty().append($img);
            
        }
    }
    function preview22(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var $img = $('<img>').attr("src", e.target.result);
            $('#preview1').empty().append($img);
            
        }
        reader.readAsDataURL(file);   
    }

    function preview111(file) {
        var img = new Image(), url = img.src = URL.createObjectURL(file);
        var $img = $(img);
        img.onload = function() {
            URL.revokeObjectURL(url);
            $('#preview2').empty().append($img);
            
        }
    }
    function preview222(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var $img = $('<img>').attr("src", e.target.result);
            $('#preview2').empty().append($img);
            
        }
        reader.readAsDataURL(file);   
    }
    function preview1111(file) {
        var img = new Image(), url = img.src = URL.createObjectURL(file);
        var $img = $(img);
        img.onload = function() {
            URL.revokeObjectURL(url);
            $('#preview3').empty().append($img);
            
        }
    }
    function preview2222(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var $img = $('<img>').attr("src", e.target.result);
            $('#preview3').empty().append($img);
            
        }
        reader.readAsDataURL(file);   
    }
    
    $(function() {
        $('#f1').change(function(e) {
            var file = e.target.files[0];
            preview1(file);
            document.getElementsByTagName("img").width=120;
            $("input[name='img']").val('');
        })
        $('#f2').change(function(e) {
            var file = e.target.files[0];
            preview11(file);
            document.getElementsByTagName("img").width=120;
            $("input[name='img1']").val('');
        })
        $('#f3').change(function(e) {
            var file = e.target.files[0];
            preview111(file);
            document.getElementsByTagName("img").width=120;
            $("input[name='img2']").val('');
        })
        $('#f4').change(function(e) {
            var file = e.target.files[0];
            preview1111(file);
            document.getElementsByTagName("img").width=120;
            $("input[name='img3']").val('');
        })
    })
</script>