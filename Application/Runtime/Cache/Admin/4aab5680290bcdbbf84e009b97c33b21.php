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
            <div class="showtitle" style="width:100px;"><img src="" />云主机管理</div>
            <a href="<?php echo U('Cloud/cloudmanage');?>"><span class="sublist-icon glyphicon glyphicon-cloud"></span><span class="sub-title">云主机管理</span></a></li>
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
<link href="/Application/Admin/View/Public/css/product.css" rel="stylesheet" title="" type="text/css" />
</script>

  <div class="right-product right-full">
        <div class="center-back right-back">
        <div class="container-fluid">
          <div class="info-center">
                    <div class="page-header">
                      <div class="pull-left">
						<h4>云服务器</h4>      
					</div>
            <div class="pull-right">
                <button type="button" class="btn btn-mystyle btn-sm">搜索</button>
                <button type="button" onclick="window.history.go(-1);" class="btn btn-mystyle btn-sm">返回</button>
            </div>
            </div>
            
            <div class="table-tab" id="userBizTables">
              <ul>
                <li class="table-tab--current" data-tab_id="t1">基本设置</li>
                <li data-tab_id="t2">产品价格</li>
              </ul>
            </div>
            <form action="<?php echo U('Officweb/cloudadd');?>" method="post">
              <input name="id" type="hidden" value="<?php echo ($cid); ?>"/>
              <input name="fid" type="hidden" value="<?php echo ($fid); ?>"/>
              <div class="" id="t1">
                <div class="content-block">
                  <div class="content-block-title">
                    基础资料
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>所属分组：</th>
                      <td>
                        <select name="navdata" class="input" style="width: 180px;" <?=!empty($fid)?"disabled='disabled'":''?>>
                          <?php if(is_array($clst)): foreach($clst as $key=>$c): ?><option value="<?php echo ($c["id"]); ?>" <?=$c['id']==$fid?"selected":''?>><?php echo ($c["title"]); ?></option><?php endforeach; endif; ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th>线路名称：</th>
                      <td><input type="text" name="name" class="input" value="<?php echo ($info["title"]); ?>"/>
                      </td>
                    </tr>
                    <!-- <tr>
                      <th>显示状态：</th>
                      <td>
                        <label class="first-label" for="visible_1">
                          <input type="radio" name="status" id="visible_1" value="1" checked />
                          显示
                        </label>
                        <label for="visible_0">
                          <input type="radio" name="status" id="visible_0" value="0" />
                          隐藏
                        </label>
                      </td>
                    </tr> -->
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    带宽
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>

                    <tr>
                      <th>带宽最小：</th>
                      <td><input type="text" name="bandwidthmin" onkeypress="return event.keyCode>=48&&event.keyCode<=57" class="input input-short" value="<?php echo ($info["bwmin"]); ?>"/> M
                      </td>
                    </tr>

                    <tr>
                      <th>带宽最大：</th>
                      <td><input type="text" name="bandwidthmax" onkeypress="return event.keyCode>=48&&event.keyCode<=57" class="input input-short" value="<?php echo ($info["bwmax"]); ?>"/> M
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>

                <div class="content-block">
                  <div class="content-block-title">
                    存储
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>存储类型：</th>
                      <td>
                        <label class="checkbox-inline">
                            <input type="checkbox"  name="storage1" value="30G" <?=empty($info['mu1'])?'':'checked'?> style="margin-top: .9em"> 30G
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox"  name="storage2" value="50G" <?=empty($info['mu2'])?'':'checked'?> style="margin-top: .9em"> 50G
                        </label>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>

                <div class="content-block">
                  <div class="content-block-title">
                    IP
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>地址个数：</th>
                      <td>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="ip1" value="1个" <?=empty($info['ip1'])?'':'checked'?> style="margin-top: .9em"> 1个
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox2" name="ip2" value="2个" <?=empty($info['ip2'])?'':'checked'?> style="margin-top: .9em"> 2个
                        </label>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-relate" id="t2">
                <div class="content-block">
                  <div class="content-block-title">
                    基础价格
                  </div>
                  <table class="inner-table edit-table">
                    <tr>
                      <th width="100px">价格：</th>
                      <td><input type="text" name="lineprice" class="input input-short" value="<?php echo ($info["line"]); ?>"/> 元/月
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    核心价格
                    <span class="row-title">(直接填入数字，单位 元/月)</span>
                  </div>
                  <table id="server_list_table" width="100%" border="0" cellspacing="0" cellpadding="0"
                         class="main-table main-table-stripe">
                    <thead>
                    <tr>
                      <th></th>
                      <th>1G</th>
                      <th>2G</th>
                      <th>4G</th>
                      <th>8G</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>2核</td>
                      <td><input type="text" name="corePrice_2_1" class="input input-short"
                                 value="<?php echo ($info["core21"]); ?>"/></td>
                      <td><input type="text" name="corePrice_2_2" class="input input-short"
                                 value="<?php echo ($info["core22"]); ?>"/></td>
                      <td><input type="text" name="corePrice_2_4" class="input input-short"
                                 value="<?php echo ($info["core24"]); ?>"/></td>
                      <td><input type="text" name="corePrice_2_8" class="input input-short"
                                 value="<?php echo ($info["core28"]); ?>"/></td>
                    </tr>
                    <tr>
                      <td>4核</td>
                      <td><input type="text" name="corePrice_4_1" class="input input-short"
                                 value="<?php echo ($info["core41"]); ?>"/></td>
                      <td><input type="text" name="corePrice_4_2" class="input input-short"
                                 value="<?php echo ($info["core42"]); ?>"/></td>
                      <td><input type="text" name="corePrice_4_4" class="input input-short"
                                 value="<?php echo ($info["core44"]); ?>"/></td>
                      <td><input type="text" name="corePrice_4_8" class="input input-short"
                                 value="<?php echo ($info["core48"]); ?>"/></td>
                    </tr>
                    <tr>
                      <td>8核</td>
                      <td><input type="text" name="corePrice_8_1" class="input input-short"
                                 value="<?php echo ($info["core81"]); ?>"/></td>
                      <td><input type="text" name="corePrice_8_2" class="input input-short"
                                 value="<?php echo ($info["core82"]); ?>"/></td>
                      <td><input type="text" name="corePrice_8_4" class="input input-short"
                                 value="<?php echo ($info["core84"]); ?>"/></td>
                      <td><input type="text" name="corePrice_8_8" class="input input-short"
                                 value="<?php echo ($info["core88"]); ?>"/></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    端口价格
                  </div>
                  <table class="inner-table edit-table">
                    <tr>
                      <th width="100px">价格：</th>
                      <td><input type="text" name="portprice" class="input input-short" value="<?php echo ($info["port"]); ?>"/> 元/月/M
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    硬盘价格
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>价格：</th>
                      <td>
                        <input type="text" name="ssdprice" class="input input-short" value="<?php echo ($info["ssd"]); ?>"/> 元/月/G
                      </td>
                      <td>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    IP价格
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>价格：</th>
                      <td>
                        <input type="text" name="ipprice" class="input input-short" value="<?php echo ($info["ip"]); ?>"/> 元/月/个
                      </td>
                      <td>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    备份集价格
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>快照备份价格：</th>
                      <td>
                        <input type="text" name="snapshotprice" class="input input-short" value="<?php echo ($info["snapshot"]); ?>"/> 元/月/G
                      </td>
                      <td>
                      </td>
                    </tr>
                    <tr>
                      <th>完整备份价格：</th>
                      <td>
                        <input type="text" name="fullprice" class="input input-short" value="<?php echo ($info["full"]); ?>"/> 元/月/G
                      </td>
                      <td>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    销售折扣
                    <table class="inner-table edit-table">
                      <tbody>
                      <tr>
                        <th>销售折扣：</th>
                        <td><input type="text" name="discount" class="input input-short"
                                   value="<?php echo ($info["discount"]); ?>"/>
                          <span class="row-title">注：销售折扣，如0.2则是原价乘于0.2销售。1表示不打折，0则0元销售</span>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div id="bt" style="border-top:1px solid #e6e6e6;margin-bottom:2em;">
                <!-- <div class="content-block-title">后台操作保护</div> -->
                <table class="inner-table edit-table">
                  <tbody>
                  <!-- <tr>
                    <th>管理员密码：</th>
                    <td><input type="password" name="password" class="password input"
                               tabindex="2"/>
                    </td>
                  </tr> -->
                  <tr>
                    <th></th>
                    <td>
                      <input type="submit" value="确定修改" class="btn btn-primary submit ajax-submit"/>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>

            </form>
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
  $(function () {
    $('#userBizTables ul li').click(function(e) {
        var tabid=$(this).attr('data-tab_id');
        $("#"+tabid).removeClass("tab-relate");
        $("#"+tabid).siblings().addClass("tab-relate");
        $(this).addClass("table-tab--current");
        $(this).siblings().removeClass("table-tab--current");
        $("#bt").removeClass("tab-relate");
    })
    // NY.component.initTableTab("#userBizTables");
    // $('.tabs .tab').tabs();

    // $(".radioItem").change(function () {
    //   var $_selectedValue = $("input[name='type']:checked").val();
    //   $(".tab-item").hide();
    //   $("#" + $_selectedValue).show();
    // });

  });
  // 三个密码框“同步”密码
  $(function () {
    $('.password').change(function () {
      $('.password').val($(this).val());
    })
  })
</script>