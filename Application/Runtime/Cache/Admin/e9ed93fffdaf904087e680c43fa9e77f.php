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
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">产品与服务<span class="caret"></span></a>
      
        <!----下拉框选项---->
         <div class="dropdown-menu topbar-nav-list">
             <div class="topbar-nav-col">
                <div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">云计算</p>
                  <ul>
                    <li><a href="<?php echo U('Cloud/cloudmanage');?>">
                        <span class="glyphicon glyphicon-cloud"></span> 
                        <span class="">云主机线路1管理</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Jdcloud/jdcloudmanage');?>">
                        <span class="glyphicon glyphicon-cloud"></span> 
                        <span class="">云主机线路2管理</span> 
                    </a>
                    </li>
                  </ul>
               </div> 
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
             </div>
             <div class="topbar-nav-col">
                <div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">物理机管理</p>
                  <ul>
                    <li><a href="<?php echo U('Physical/ordercontrol');?>">
                        <span class="fa fa-list-alt"></span> 
                        <span class="">我的订单</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Physical/servercontrol');?>">
                        <span class="fa fa-server"></span> 
                        <span class="">我的服务器</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Physical/workingsheet');?>">
                        <span class="fa fa-th-list"></span> 
                        <span class="">正在处理工单</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Physical/attacktow');?>">
                        <span class="fa fa-unlock"></span> 
                        <span class="">攻击解封</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Physical/attackrecord');?>">
                        <span class="fa fa-file-text-o"></span> 
                        <span class="">攻击记录</span> 
                    </a>
                    </li>
                  </ul>
               </div> 
              </div>
              <div class="topbar-nav-col">
                  <div class="topbar-nav-item">
                    <p class="topbar-nav-item-title">防火墙相关设置</p>
                    <ul>
                      <li><a href="<?php echo U('Firewall/goldenshield');?>">
                          <span class="fa fa-shield"></span> 
                          <span class="">金盾网页CC</span> 
                      </a>
                      </li>
                      <li><a href="<?php echo U('Firewall/blacklist');?>">
                          <span class="fa fa-fire-extinguisher"></span> 
                          <span class="">防火墙IP释放</span> 
                      </a>
                      </li>
                      <li><a href="<?php echo U('Firewall/whitelistadd');?>">
                          <span class="fa fa-file"></span> 
                          <span class="">域名白名单(宿迁)</span> 
                      </a>
                      </li>
                      <li><a href="<?php echo U('Firewall/whitelistaddyz');?>">
                          <span class="fa fa-file"></span> 
                          <span class="">域名白名单(扬州)</span> 
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
th{color: #FFF;font-weight: normal;}
td{color: #4b556a;}
.table-condensed>thead>tr>th,.table-condensed>tbody>tr>td{vertical-align: middle;padding: 10px;}
.table{margin-bottom: 0px;}
.page-body{width: 100%;background: #fff;padding: 20px;box-shadow: 0 0 5px 0 #dedfe4;border-radius: 4px;}
.form-control{display: inline-block;height: 34px;border-radius: 0;}
.onthis{background-color: #09c !important;color: #fff;}
.otherul li{float: left;text-align: center;position: relative;margin-left: -1px;min-width: 91px;height: 34px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 34px;font-size: 13px;padding: 0 12px;}
.otherul li:hover{background: #09c;color: #fff;}
.option a,.option span{color: #60aff6;cursor: pointer;}
.fold-drop{position: absolute;min-width: 100px;background: #fff;border: 1px solid #e7e7e7;display: none;z-index: 99;}
.fold-drop li a {display: block;padding: 0 5px;line-height: 30px;text-align: left;color: #404241;text-decoration-line: none;}
.fold-drop li a:hover{color: #fff;background: #60aff6;}
.disableda{color: #999 !important;cursor:not-allowed !important;}
.disableda:hover{color: #999 !important;cursor:not-allowed !important;background: #fff !important;}
.icon-status{display:inline-block;border-radius:5px;height:10px;width:10px;background: #c71585;animation:move ease-in-out .6s infinite alternate;}
@keyframes move{
    0%{
        -moz-transform:scale(1.2);
        -webkit-transform:scale(1.2);opacity:1
    }
    to{
        -moz-transform:scale(.7);
        -webkit-transform:scale(.7);
        opacity:.1
    }
}
</style>
<script>
$(function(){
    $('.moreoption').hover(
        function(){
            $(this).find('.fold-drop').show();
        },
        function(){
            $(this).find('.fold-drop').hide();
        }
    )
    var mulayer=function(title,url,width,height){
        layer.closeAll(); 
        layer.open({
            type: 2,
            title: title,
            shade: 0.6,
            shadeClose: true,
            maxmin: true, //开启最大化最小化按钮
            area: [width, height],
            content: url
        });
    }
    $('.otherul li').click(function(){
        $('tbody').html('<tr><td colspan="9" align="center" style="border: 0px;background: rgba(255, 255, 255,0.9);position:relative;width:100%;z-index: 999;"><img src="/Application/Admin/View/Public/img/loading.gif" height="22px;"> 加载中...</td></tr>');
    })
    $('.resetpsw').click(function(){
        var vid=$(this).attr("data");
        mulayer('重置密码',"/Admin/Jdcloud/resetpsw?vid="+vid,'600px','300px');
    })
    $('.resetos').click(function(){
        var instanceid=$(this).closest('tr').find('.instanceid').text();
        mulayer('重置系统','/Admin/Jdcloud/resetos?regionid=<?php echo ($regionid); ?>&instanceid='+instanceid,'700px','550px');
    })
    $('.restandard').click(function(){
        var instanceid=$(this).closest('tr').find('.instanceid').text();
        mulayer('调整配置','/Admin/Jdcloud/restandard?regionid=<?php echo ($regionid); ?>&instanceid='+instanceid,'800px','550px');
    })
    $('.renew').click(function(){
        var instanceid=$(this).closest('tr').find('.instanceid').text();
        mulayer('续费','/Admin/Jdcloud/renew?regionid=<?php echo ($regionid); ?>&instanceid='+instanceid,'1100px','550px');
    })
})

function start(obj){
    var a=$(obj);
    var cloudno=a.attr("data");
    a.parent('td').siblings("#status").html('<span class="icon-status"></span> <span style="color: #c71585;">启动中...</span>');
    $.ajax({
         type: "POST",
         url: "/Admin/Jdcloud/start",
         data:"cloudno="+cloudno,
         success: function(msg){
            if (msg!="") 
            {
                a.parent('td').siblings("#status").html("<span style='color: #3ec7ab;'>运行</span>");
                a.text("停止");
                a.removeAttr("onclick");
                a.attr("onclick","stop(this);");
                window.location.reload();
                return false;
            }
           
         }
    })
}
function stop(obj){
    var a=$(obj);
    var cloudno=a.attr("data");
    a.parent('td').siblings("#status").html('<span class="icon-status"></span> <span style="color: #c71585;">停止中...</span>');
    $.ajax({
         type: "POST",
         url: "/Admin/Jdcloud/stop",
         data:"cloudno="+cloudno,
         success: function(msg){
            if (msg!="") 
            {
                a.parent('td').siblings("#status").html("<span style='color: #dcbb44;'>停止</span>");
                a.text("启动");
                a.removeAttr("onclick");
                a.attr("onclick","start(this);");
                window.location.reload();
                return false;
            }
            
         }
    })
}
function restart(obj){
    var a=$(obj);
    var cloudno=a.attr("data");
    a.parent('td').siblings("#status").html('<span class="icon-status"></span> <span style="color: #c71585;">重启中...</span>');
    $.ajax({
         type: "POST",
         url: "/Admin/Jdcloud/restart",
         data:"cloudno="+cloudno,
         success: function(msg){
            if (msg!="") 
            {
                a.parent('td').siblings("#status").html("<span style='color: #3ec7ab;'>运行</span>");
                window.location.reload();
                return false;
            }
            
         }
    })
}
</script>
<div class="right-product right-full" style="background: #eef0f6;">
    <div class="center-back right-back">
        <div class="container-fluid">
            <div class="info-center">
                <div class="page-header">
                    <div class="pull-left">
                        <h4>云主机线路2</h4>      
                    </div>
                </div>
                
                <div class="page-body">
                    <ul class="otherul">
                        <!-- <a href="<?php echo U('Jdcloud/jdcloudmanage',array('regionid'=>'cn-north-1'));?>"><li <?php if($regionid == 'cn-north-1'): ?>class="onthis"<?php endif; ?>>华北-北京</li></a>
                        <a href="<?php echo U('Jdcloud/jdcloudmanage',array('regionid'=>'cn-south-1'));?>"><li <?php if($regionid == 'cn-south-1'): ?>class="onthis"<?php endif; ?>>华南-广州</li></a> -->
                        <a href="<?php echo U('Jdcloud/jdcloudmanage',array('regionid'=>'cn-east-1'));?>"><li <?php if($regionid == 'cn-east-1'): ?>class="onthis"<?php endif; ?>>华东-宿迁</li></a>
                        <!-- <a href="<?php echo U('Jdcloud/jdcloudmanage',array('regionid'=>'cn-east-2'));?>"><li <?php if($regionid == 'cn-east-2'): ?>class="onthis"<?php endif; ?>>华东-上海</li></a> -->
                    </ul>
                    <a href="<?php echo U('Home/Hdcloud/jdcloudbuy');?>" target="blank"><button type="button" class="btn btn-info" style="float:left;margin-left: 25px;">购买云主机</button></a>
                    <?php if($_SESSION['loginuser']['usertype']== 1): ?><a href="<?php echo U('Jdcloud/jdadmincdmg',array('regionid'=>$regionid));?>">
                            <button type="button" class="btn btn-default" style="float: left;margin-left: 10px;">进入后台管理</button>
                        </a><?php endif; ?>
                    <form action="<?php echo U('Cloud/cloudmanage');?>" method="post" style="float: right;">
                        <div>
                            <input type="text" name="keyword" value="<?php echo ($keyword); ?>" class="form-control" placeholder="请输入云主机编号" style="width: 150px;position: relative;top: 1px;">               
                            <input type="submit" name="" class="btn btn-default" style="width:70px" value="搜索">
                        </div>
                    </form>
                    
                    <table class="table table-condensed" style="margin-top: 50px;">
                        <thead>
                            <tr style="background: #09c;color: #fff;">
                                <th>ID/名称</th>
                                <th>可用区</th>
                                <th>IP地址</th>
                                <th>状态</th>
                                <th>规格类型</th>
                                <th>配置</th>
                                <th>计费信息</th>
                                <th>到期时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($cloudlist == ''): ?><tr><td colspan="9" align="center">暂无云主机数据</td></tr><?php endif; ?>
                            <?php if(is_array($cloudlist)): $i = 0; $__LIST__ = $cloudlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td class="id"><span class="instanceid"><?php echo ($vo["instanceId"]); ?></span></br><span style="color:#60aff6;"><?php echo ($vo["instanceName"]); ?></span></td>
                                <td>
                                    <?php switch($vo["az"]): case "cn-east-1a": case "cn-east-2a": case "cn-north-1a": case "cn-south-1a": ?>可用区A<?php break;?>
                                        <?php case "cn-east-1b": case "cn-east-2b": case "cn-north-1b": case "cn-south-1b": ?>可用区B<?php break; endswitch;?>
                                </td>
                                <td>
                                    <?php echo ($vo["elasticIpAddress"]); ?>
                                </td>
                                <td id="status">
                                    <?php switch($vo["status"]): case "running": ?><span style="color: #3ec7ab;">运行</span><?php break;?>
                                        <?php case "stopped": ?><span style="color: #dcbb44;">停止</span><?php break; endswitch;?>
                                </td>
                                <td><?php echo ($vo["instanceType"]); ?></td>
                                <td></td>
                                <td><?php echo ($vo["launchTime"]); ?>创建</td>
                                <td>20<?php echo (date("y-m-d",$vo["duetime"])); ?> 到期</td>
                                <td class="option">
                                    <?php switch($vo["status"]): case "running": ?><a onclick="stop(this)" data="<?php echo ($vo["instanceId"]); ?>">停止</a><?php break;?> 
                                        <?php case "stopped": ?><a onclick="start(this)" data="<?php echo ($vo["instanceId"]); ?>">启动</a><?php break; endswitch;?>
                                    <a onclick="restart(this)" data="<?php echo ($vo["instanceId"]); ?>">重启</a>
                                    <span class="moreoption" style="display: inline-block;">更多 <i class="fa fa-sort-desc" style="position: relative;top: -1px;"></i>
                                        <ul class="fold-drop">
                                            <li class="">
                                                <a href="javascript:;" <?php if($vo["status"] != 'running'): ?>class="resetos"<?php else: ?>class="disableda" title="仅停止状态云主机支持重置系统"<?php endif; ?>>重置系统</a>
                                            </li> 
                                            <li class="">
                                                <a href="javascript:;" class="resetpsw" data="<?php echo ($vo["instanceId"]); ?>">重置密码</a>
                                            </li> 
                                            <li class="">
                                                <a href="javascript:;" <?php if($vo["status"] != 'running'): ?>class="restandard"<?php else: ?>class="disableda" title="仅停止状态云主机支持调整配置"<?php endif; ?>>调整配置</a>
                                            </li> 
                                            <li class="">
                                                <a href="javascript:;" class="renew">续费</a>
                                            </li> 
                                        </ul>
                                    </span>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                              <td colspan="9">
                                <div class="pull-right">
                                    <?php echo ($page); ?>
                                </div>
                              </td>
                            </tr>
                        </tfoot>
                    </table>
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
$('.askbtn').click(function(){
	$('.float-panel-middle').slideDown();
})
$('.closetan').click(function(){
	$('.float-panel-middle').slideUp();
});
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