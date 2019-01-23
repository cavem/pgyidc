<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($title); ?></title>
<link href="/Application/Home/View/Public/css/animate.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/bootstrap.min.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/bootstrap.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/jquery.range.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/style.css" rel="stylesheet">
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">
<link rel="icon" href="/Application/Home/View/Public/images/pgyicon.png" />
<script src="/Application/Home/View/Public/js/jquery.min.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/ZeroClipboard.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/wow.min.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/prototype.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/slide.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/ImageSlide.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/jquery.range.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/md5.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/base64.js" type="text/javascript"></script>
<?php if($current == 'cloudbuy'): ?><script src="/Application/Home/View/Public/js/cloudbuy.js"></script><?php endif; ?>
<?php if($current == 'jdcloudbuy'): ?><script src="/Application/Home/View/Public/js/jdcloudbuy.js"></script><?php endif; ?>
<style>
.navigation-up .navigation-v3 li h2 {line-height: 60px;font-weight: normal;padding: 0;margin: 0;font-size: 15px;}
.navigation-up .navigation-v3 li h2 a{padding: 0 14px;color: #fff;display: inline-block;height: 60px;font-family: "microsoft yahei";}
.nav-up-selected{background: rgba(52, 65, 87, 0.9);}
.navigation-down .nav-down-menu{background: rgba(52, 65, 87, 0.9);}
.top{line-height: 60px;}
.login{margin-top:0;height: 60px;}
.smlogin{display: none;}
@media screen and (max-width: 1200px){
.login{display: none;}
.smlogin{display: block !important;}
}
</style>
<script>
$(function(){
    $('.askbtn').click(function(){
        $('.float-panel-middle').slideDown();
    })
    $('.closetan').click(function(){
        $('.float-panel-middle').slideUp();
    });
})
</script>
<script>
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
        new WOW().init();
    };
</script>
<?php if($current == 'index'): ?><script>
// layer.open({
//     type: 1
//     ,title: false
//     ,closeBtn: false
//     ,area: '300px;'
//     ,shade: 0.5
//     ,id: 'LAY_layuipro'
//     ,btn: ['火速围观', '残忍拒绝']
//     ,btnAlign: 'c'
//     ,moveType: 1
//     ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">这是一个公告^_^</div>'
//     ,success: function(layero){
//         var btn = layero.find('.layui-layer-btn');
//         btn.find('.layui-layer-btn0').attr({
//         href: 'http://pgy.com/'
//         ,target: ''
//         });
//     }
// });
</script><?php endif; ?>
<script>
    $(function(){
        $('.right-float').mouseenter(function(){
            $('.float-panel-right').fadeIn();
            $('#rfloat').css('width','400px');
        });
        $('#rfloat').mouseleave(function(){
            $('.float-panel-right').fadeOut();
            $('#rfloat').css('width','64px');
        });
        $('.left-float').mouseenter(function(){
            $('.float-panel-left').fadeIn();
            $('#rfloat').css('width','470px');
        });
        $('#lfloat').mouseleave(function(){
            $('.float-panel-left').fadeOut();
            $('#rfloat').css('width','64px');
        });
    })
</script>
<script>
  $(function(){
    $(window).scroll(function(){
      var scrtop=$(window).scrollTop();
      if(scrtop>50){
        $('.home').fadeIn();
      }else{
        $('.home').fadeOut();
      }
    });
    $('.home').click(function(){
      $('body,html').animate({scrollTop:0},300);
    })
  });
</script>
<script>
  $(function(){  
      var qcloud={};
      $('[_t_nav]').hover(function(){
          var _nav = $(this).attr('_t_nav');
          clearTimeout( qcloud[ _nav + '_timer' ] );
          qcloud[ _nav + '_timer' ] = setTimeout(function(){
          $('[_t_nav]').each(function(){
          $(this)[ _nav == $(this).attr('_t_nav') ? 'addClass':'removeClass' ]('nav-up-selected');
          });
          $('#'+_nav).stop(true,true).slideDown(200);
          }, 150);
      },function(){
          var _nav = $(this).attr('_t_nav');
          clearTimeout( qcloud[ _nav + '_timer' ] );
          qcloud[ _nav + '_timer' ] = setTimeout(function(){
          $('[_t_nav]').removeClass('nav-up-selected');
          $('#'+_nav).stop(true,true).slideUp(200);
          }, 150);
      });
  });    
</script>
<?php if($current == 'index'): ?><script>
    $(function(){
        $('#myCarousel').carousel({
            interval:5000
        });
        // new ImageSlide({
        //     project:"#focusImage",
        //     content:".contents li",
        //     tigger:".triggers a",
        //     dot:".icon-dot a",
        //     watch:".link-watch",
        //     auto:!0,
        //     hide:!0
        // })
        $('#wrap li').mouseenter(function(){
            $(this).find('.divA').stop().animate({bottom:'-66px'});
            $(this).find('.a2').css({left:'0'})
            $(this).children('.a2').find('.p4').css({left:'0'})
            $(this).children('.a2').find('.p5').css({left:'0'})
            $(this).children('.a2').find('.p6').css({transform:'scale(1)'})
            $(this).children('.a2').find('.p7').css({bottom:'25px'})
        })
        $('#wrap li').mouseleave(function(){
            $(this).find('.divA').stop().animate({bottom:'0px'});
            $(this).find('.a2').css({left:-$(this).width()})
            $(this).children('.a2').find('.p4').css({left:-$(this).width()})
            $(this).children('.a2').find('.p5').css({left:-$(this).width()})
            $(this).children('.a2').find('.p6').css({transform:'scale(1.3)'})
            $(this).children('.a2').find('.p7').css({bottom:'-50px'})
        })
        
    });
</script><?php endif; ?>

<!-- 关于 -->
<?php if($current == 'about'): ?><script>
    $(function(){
        var scrollToLocation=function(elemnet) {
            var mainContainer = $(elemnet);
            $('body,html').animate({
                scrollTop: mainContainer.offset().top-80
            }, 500);
        }
        
        var addcurrent=function(element){
            $('.ul-smbancon li').removeClass('currenton');
            element.addClass('currenton');
        }
        var scrollcheck=function(){
            var knowustop=$('#knowus').offset().top;
            var joinustop=$('#joinus').offset().top;
            var connectustop=$('#connectus').offset().top;
            var scrotop=$(window).scrollTop();
            if(scrotop>0&&scrotop<joinustop-90){
                addcurrent($('.know'));
            }else if(scrotop>joinustop-90&&scrotop<connectustop-90){
                addcurrent($('.join'));
            }else if(scrotop>connectustop-90){
                addcurrent($('.connect'));
            }
        }
        $('.know').click(function(){
            scrollToLocation('#knowus');
            addcurrent($('.know'));
        })
        $('.join').click(function(){
            scrollToLocation('#joinus');
            addcurrent($('.join'));
        })
        $('.connect').click(function(){
            scrollToLocation('#connectus');
            addcurrent($('.connect'));
        })
        $(window).scroll(function(){
            var scrtop=$(window).scrollTop();
            var sbtop=$('.small-banner').offset().top;
            if(scrtop>sbtop){
                $('.small-fixbanner').css('display','block');
            }else{
                $('.small-fixbanner').css('display','none');
            }
            scrollcheck();
        });
    })
</script><?php endif; ?>
<!-- 文档 -->
<?php if(($current == 'document')): ?><script>
    $(function() {
        $('.accordioncontain-item').mouseenter(function(){
            $(this).css('background','#60aff6');
            $(this).find('i').css('color','#fff');
            $(this).find('.title').css('color','#fff');
        });
        $('.accordioncontain-item').mouseleave(function(){
            $(this).css('background','#fff');
            $(this).find('i').css('color','#60aff6');
            $(this).find('.title').css('color','#424242');
        });
    });
</script><?php endif; ?>
<!-- 下载 -->
<?php if(($current == 'download') OR ($current == 'paytype') OR ($current == 'document')): ?><script>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;
            var links = this.el.find('.link');
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }
    
        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
                $this = $(this),
                $next = $this.next();
    
            $next.slideToggle();
            $this.parent().toggleClass('open');
    
            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }	
    
        var accordion = new Accordion($('#accordion'), false);
    });
</script><?php endif; ?>
</head>
<body>
<div class="nav_big">
    <div class="top w1200">
        <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Application/Home/View/Public/images/logo.png" width="160px"></a></div>
        <div class="head-v3">
            <div class="navigation-up">
              <div class="navigation-inner">
                <div class="navigation-v3">
                  <ul>
                    <li _t_nav="home"><h2><a href="<?php echo U('Index/index');?>">网站首页</a></h2></li>
                    <li _t_nav="newactive"><h2><a href="<?php echo U('Index/newactive');?>">最新活动</a></h2></li>
                    <li _t_nav="server"><h2><a href="<?php echo U('Index/newserver');?>">主机服务</a></h2></li>
                    <li _t_nav="product"><h2><a href="http://www.17b.net/cloud/home/buy.html">云服务器</a></h2></li>
                    <li _t_nav="pay"><h2><a href="#">增值服务</a></h2></li>
                    <li _t_nav="news"><h2><a href="<?php echo U('Index/news');?>">新闻资讯</a></h2></li>
                    <li _t_nav="support" class=""><h2><a href="#">帮助中心</a></h2></li>
                    <li _t_nav="company" class=""><h2><a href="#">关于我们</a></h2></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="navigation-down">
              <div id="product" class="nav-down-menu menu-1" style="display: none;" _t_nav="product">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>云服务器</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/cloud');?>">云主机线路1</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Hdcloud/jdcloud');?>">云主机线路2</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="http://yun.pgyidc.com/server/buy.html" target="blank">香港云主机</a></dd>
                  </dl>
                  <dl>
                    <dt>云虚拟主机</dt>
                    <dd>
                      <a hotrep="hp.header.product.storage1" href="<?php echo U('Index/vhost');?>">云虚拟主机</a></dd>
                  </dl>
                </div>
              </div>
              <div id="server" class="nav-down-menu menu-1" style="display: none;" _t_nav="server">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>服务器租用</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/serverbuy');?>">服务器租用</a></dd>
                  </dl>
                  <dl>
                    <dt>服务器托管</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/servertrust');?>">服务器托管</a></dd>
                  </dl>
                </div>
              </div>
              <div id="pay" class="nav-down-menu menu-1" style="display: none;" _t_nav="pay">
                    <div class="navigation-down-inner w1200">
                      <!-- <dl style="margin-left: 35%;">
                        <dt>支付平台</dt>
                        <dd><a hotrep="hp.header.product.compute1" href="http://pay.17b.net/" target="blank">传奇支付平台</a></dd>
                        <dd><a hotrep="hp.header.product.storage1" href="http://pay.pgyidc.com/" target="blank">发卡支付平台</a></dd>
                     </dl> -->
                      <dl style="margin-left: 35%;">
                        <dt>网站方案</dt>
                        <dd><a hotrep="hp.header.product.compute1" href="">网站方案</a></dd>
                      </dl>
                      <dl>
                        <dt>游戏方案</dt>
                        <dd><a hotrep="hp.header.product.compute1" href="">游戏方案</a></dd>
                      </dl>
                    </div>
                  </div>
              <div id="solution" class="nav-down-menu menu-1" style="display: none;" _t_nav="solution">
                <div class="navigation-down-inner w1200">
                    <dl style="margin-left: 35%;">
                      <dt>自助防御</dt>
                      <dd><a hotrep="hp.header.product.compute1" href="http://user.pgyidc.com" target="blank">自动防御系统</a></dd>
                    </dl>
                    <dl>
                      <dt>自动化管理</dt>
                      <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/sqidc');?>">自动化管理系统</a></dd>
                    </dl>
                </div>
              </div>
              <div id="support" class="nav-down-menu menu-1" style="display: none;" _t_nav="support">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>付款方式</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/paytype');?>">付款方式</a></dd>
                  </dl>
                  <dl>
                    <dt>帮助文档</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/document');?>">帮助文档</a></dd>
                  </dl>
                  <dl>
                    <dt>下载中心</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/download');?>">下载中心</a></dd>
                    </dl>
                </div>
              </div>
              <div id="company" class="nav-down-menu menu-1" style="display: none;" _t_nav="company">
                <div class="navigation-down-inner w1200">
                    <dl style="margin-left: 35%;">
                    <dt>公司资质</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/honer');?>">公司资质</a></dd>
                    </dl>
                    <dl>
                    <dt>关于我们</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about');?>">了解我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about/#connectus');?>">联系我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about/#joinus');?>">加入我们</a></dd>
                    </dl>
                </div>
              </div>
            </div>
          </div>
          <div class="login">
              <?php if($_SESSION['loginuser']== ''): ?><a href="<?php echo U('Admin/login');?>">登录</a><span>|</span><a href="<?php echo U('Admin/register');?>">注册</a>
                <?php else: ?><a href="">Hi! <?php echo ($_SESSION['loginuser']['username']); ?></a><span>|</span><a href="<?php echo U('Admin/Index/index');?>">控制台</a><?php endif; ?>
          </div>
          <div class="smlogin" style="float: right;color: #fff;"><a href="<?php echo U('Admin/Index/index');?>" style="font-size:14px;color: #fff;">控制台</a></div>
    </div>
</div>
<style>
    .show-more{border:1px solid #fff;color:#fff;display: inline-block;}
    th,td{text-align: center;font-size: 14px;color: #4b556a;}
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td{padding:12px 24px;vertical-align: middle;line-height: 2em;}
    .table>thead>tr>th{padding: 20px 0;font-size: 16px;}
    .small-banner{background-color:#dedfe4;}
    .ul-smbancon{height: 60px;line-height: 60px;}
    .ul-smbancon li{display: inline-block;font-size: 16px;margin:0 50px 0 50px;}
    .currenton{color: #60aff6}
    .bborder{border-bottom: 2px solid #dedfe4;}
    .main-h3,.main-p{color: #4b556a;}
    .main-p{font-size: 14px;line-height: 24px;}
    .main-ul{width: 100%;}
    .main-ul li{width: 13%;display: inline-block;}
    .main-ulscene{width: 380px;height: 110px;margin:0 auto;}
    .main-ulscene li{display: inline-block;width: 150px;height: 110px;background-color: #f5f6f7;text-align: center;cursor: pointer;}
    .active{border: 1px solid #ddd;background-color: #fff;box-shadow: 0 0 10px 0 #dedfe4;}
    .main-conscene{width: 870px;height: 350px;margin:20px auto;box-shadow: 0 0 10px 0 #dedfe4;overflow: hidden;}
    .main-ulscene img{margin-top: 20px;}
    .scene-span{display: block;padding: 10px 0;}
    .conscene-game,.conscene-web{width: 100%;height: 100%;}
    .commend-item {height: 270px;min-height: 270px;margin: 12px 5px;width: 347px;background-color: #f5f7fb;position: relative;display: inline-block;vertical-align: top;text-align: left;}
    .commend-item-intro {padding: 0 35px 50px;font-size: 12px;color: #657493;}
    .commend-item-title {text-align: left;padding: 20px 0;font-size: 14px;color: #000;line-height: 20px;}
    .commend-item-intro .info-line {margin: 5px 0;position: relative;}
    .commend-item-intro .introlabel, .commend-item-intro .text {width: auto;float: left;}
    .commend-item-intro .introlabel {text-align: right;}
    .commend-item-btn-wrap {height: 50px;line-height: 50px;width: 100%;position: absolute;bottom: 0;}
    .commend-item-btn-wrap .commend-item-btn {height: 100%;width: 50%;float: left;text-align: center;-webkit-transition: all .3s;transition: all .3s;}
    .commend-item-btn-wrap .commend-item-btn:hover {background-color: #e2e6ec;color: #657493;}
    .initial{width: 100%;border-top: 1px dotted #ddd;height: 150px;line-height:150px;margin-top: 30px;}
    .initial-title{color: #60aff6;font-size: 16px;display: inline-block;margin-right: 20px;}
    .initial-item{display: inline-block;padding:18px 24px;border: 1px solid #ddd;margin-left: 10px;}
    .initial-item span:first-child{display: block;line-height: 1em;font-size: 16px;color: #60aff6;}
    .initial-item span:last-child{display: block;line-height: 1em;margin-top: 5px;color: #888;}
    .initial .btn{display: inline-block;margin-left:80px;background: red;font-weight:bold;font-size:16px;color: #fff;}
    .panel-title{font-size: 20px;padding: 6px;}
    .mt25{margin-top:25px;}
    .pb-title h4{font-size: 16px;}
    .pb-title p{line-height: 1.5em;font-size: 14px;margin-left: 14px;}
    .pb-title i{font-size:12px;position: relative;bottom: 2px;color: #60aff6;}
    .active{background-color: #fff;box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(96,175,246,.5);}
</style>
<div class="banner">
    <div class="banner-contain w1200 pr">
        <div class="bc-left"><span class="circle1"></span><span class="circle2"></span><img src="/Application/Home/View/Public/images/cloud.png"></div>
        <div class="bc-right tl pa" style="left:200px;top:20px;">
            <h2 class="m0 wow fadeInUp">云主机线路2</h2>
            <p class="mt20 wow fadeInUp">云主机线路2是一种管理便捷、安全可靠的云计算服务单元。您无需为硬件的购买和维护投入精力，可随时创建和释放多台云主机，快速部署应用，并且可根据业务需要扩展计算能力，按需付费，节约成本，帮助您更高效稳定的开展业务。</p>
            <div class="show-more m0 mt30 wow fadeInUp askbtn">立即咨询</div>
            <a href="<?php echo U('Hdcloud/jdcloudbuy');?>"><div class="show-more m0 mt30 wow fadeInUp">立即购买</div></a>
        </div>
    </div>
</div>
<div class="main-contain">
    <div class="w1200 pt25 pb25 bborder">
        <h3 class="main-h3 pt20 pb20">产品优势</h3>
        <table class="table table-bordered">
            <thead>
                <tr style="background: #dedfe4;">
                    <th width="299px;">产品优势</th>
                    <th width="594px;">云主机</th>
                    <th width="306px;">传统主机 </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>稳定可靠</td>
                    <td class="tl">承诺99.9%的服务可用性和不低于99.99%的数据可靠性。网络架构稳定，云硬盘多副本容灾，同时提供镜像及数据盘的快照功能，支持整机备份，发生故障，百倍赔偿。</td>
                    <td class="tl">稳定性受硬件性能制约，不可控因素较多，数据需手动备份，故障修复困难。</td>
                </tr>
                <tr>
                    <td>灵活配置</td>
                    <td class="tl">按需配置云主机的操作系统、CPU、内存、硬盘及网络带宽，快速创建和释放，合理分配资源，并可根据需求进行横向和纵向的伸缩，避免资源浪费。</td>
                    <td class="tl">配置种类有限且固定，升级成本高、耗时长，影响业务扩展。</td>
                </tr>
                <tr>
                    <td>安全防护</td>
                    <td class="tl">用户间网络100%隔离，实时监控主机安全风险，精准防御黑客入侵行为，保障用户数据安全。提供完善的安全组及DDoS防护等服务，增强网络防御能力，为主机提供全面防护。</td>
                    <td class="tl">需额外购买各种安全服务，数据安全很难保障。</td>
                </tr>
                <tr>
                    <td>简单易用</td>
                    <td class="tl">提供简单易用的管理控制台和功能完备的API，支持秒级重启，缩短业务中断时长。支持使用镜像快速生成相同环境配置及应用部署的云主机，提升运维效率。</td>
                    <td class="tl">扩展困难，升级受限。</td>
                </tr>
                <tr>
                    <td>高性价比</td>
                    <td class="tl">云主机及相关计算资源均支持包年包月或按配置计费，按需购买，随时调整，无需投入硬件及运维成本。采用英特尔®至强®处理器 E5 v3,v4产品家族，支持前沿的处理技术，为运行于软件定义基础架构上的新一代数据中心带来性能和功能的飞跃，支持敏捷的云计算架构和对传统型工作负载的高效管理。</td>
                    <td class="tl">高架构费用，持续投入维护成本。</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="w1200 pt25 pb25 bborder">
        <h3 class="main-h3 pt20 pb20">产品功能</h3>
        <div class="panel panel-default">
            <div class="panel-heading tl">
                <h3 class="panel-title">
                    <i class="fa fa-calculator"></i> 弹性计算
                </h3>
            </div>
            <div class="panel-body tl">
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 第二代云主机</h4>
                    <p>京东云第二代云主机采用最新一代英特尔®至强®可扩展处理器，与上一代产品相比，该处理器综合性能显著提升，每个时钟周期的浮点计算性能提升至原来的2倍，显著提高了工作负载速度。最新云主机将提供更高的vCPU及内存规格配置，京东云在虚拟化、网络及调度等方面进行了深度优化，业务性能大幅提升，能更好地支持计算密集型场景，如科学建模、基因计算、数据挖掘与分析、高性能计算等。</p>
                </div>
                <div class="pb-title mt25">
                    <h4><i class="fa fa-circle"></i> 丰富的配置类型及规格</h4>
                    <p>京东云提供通用型、计算优化型、内存优化型及高频计算型四类规格类型，用户可根据不同应用量级选择云主机规格类型及对应规格，按需分配CPU、内存、存储以及公网IP。支持灵活调整CPU及内存，扩容存储以及不关机调整网络带宽，保障应用持续服务。</p>
                </div>
                <div class="pb-title mt25">
                    <h4><i class="fa fa-circle"></i> 超大内存实例</h4>
                    <p>京东云提供国内最大内存云主机，搭载英特尔® 至强® E5-2698 v4处理器 ，独享1464GB DDR4内存，满足数据交换速度和内存容量有极高要求的大型业务部署场景。</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading tl">
                <h3 class="panel-title">
                    <i class="fa fa-hdd-o"></i> 可靠存储
                </h3>
            </div>
            <div class="panel-body tl">
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 可扩展云硬盘</h4>
                    <p>云硬盘是京东云为用户提供的低时延、高可靠的块级存储。有高效云盘、SSD云盘及 超高性能云盘三类云硬盘供客户选择。支持按需设置云硬盘的容量并随时扩展以满足业务快速增长。此外，云硬盘提供制作快照功能，通过对云硬盘数据制作快照可进一步满足批量部署、快速恢复等需求场景。</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading tl">
                <h3 class="panel-title">
                    <i class="fa fa-globe"></i> 网络
                </h3>
            </div>
            <div class="panel-body tl">
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 网络隔离</h4>
                    <p>私有网络为用户划分一片隔离安全的私有空间，私有网络间独立隔离，将云主机部署在不同私有网络下即可实现网络隔离。用户完全掌控网络管理，支持自主划分子网、配备公网IP等。此外，可通过VPN或专线等服务将用户本地服务器与京东云主机连通，实现对现有网络部署的扩展。</p>
                </div>
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 弹性公网IP</h4>
                    <p>弹性公网IP与京东云账户关联，用户可以将其余同地域下的任意云主机关联，实现云主机的外网访问，同时可根据网络实际使用情况调整带宽带宽、更改绑定云主机。京东云为公网IP提供最高2Gbps的免费DDoS防护，无间断抵御网络攻击。</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading tl">
                <h3 class="panel-title">
                    <i class="fa fa-eye"></i> 安全及监控
                </h3>
            </div>
            <div class="panel-body tl">
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> SSH密钥</h4>
                    <p>京东云允许使用秘钥加密解密基于Linux系统的主机登录信息，为用户提供比密码登录更安全的秘钥登录方式，使您的主机权限管理在简单化的同时，享有更高等级的安全性。</p>
                </div>
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 安全组</h4>
                    <p>安全组是一种分布式、有状态的虚拟防火墙，具备检测和过滤云主机进出的数据包的功能。使用安全组可以完成单台或多台云主机的网络访问控制，包括云主机之间的东西向流量以及云主机与公网通信的南北向流量。通过使用安全组功能，可以实现云主机之间的网络安全隔离。</p>
                </div>
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 资源监控</h4>
                    <p>基于多维度监控云主机，方便用户实时掌握云主机资源使用情况、性能及运行状态。 支持针对不同监控指标自定义报警规则，通过短信、邮件等方式发送报警通知，满足不同用户场景下需求，保障应用程序的持续稳定运行。</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading tl">
                <h3 class="panel-title">
                    <i class="fa fa-bullseye"></i> 镜像
                </h3>
            </div>
            <div class="panel-body tl">
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 官方镜像</h4>
                    <p>京东云提供的公共基础镜像，包含Linux和Windows的多个发行版本。官方镜像包含初始系统环境或基本软件，用户可以根据实际需求自主配置应用环境和相关软件配置。</p>
                </div>
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 私有镜像</h4>
                    <p>基于自有云主机创建的自定义镜像，可用于快速批量部署环境一致的云主机。此外，还支持用户将自己的私有镜像共享给其他京东云用户使用。</p>
                </div>
                <div class="pb-title">
                    <h4><i class="fa fa-circle"></i> 镜像市场镜像</h4>
                    <p>由入驻京东云-云市场的服务商（包括京东云官方团队）所提供的镜像，集成了针对不同业务场景的运行环境或软件，方便用户快速部署业务。</p>
                </div>
            </div>
        </div>
    </div>
    <div class="w1200 pt25 pb25 bborder">
        <h3 class="main-h3 pt20 pb20">应用场景</h3>
        <ul class="main-ulscene">
            <li class="fl active"><img src="/Application/Home/View/Public/images/web.png"><span class="scene-span">进阶型</span></li>
            <li class="fr"><img src="/Application/Home/View/Public/images/tall.png"><span class="scene-span">专业型</span></li>
        </ul>
        <div class="main-conscene">
            <div class="conscene-initial p50">
                <p class="tl" style="font-size: 16px;">适用对象：地方与行业门户网站</p>
                <p class="tl" style="color: #888;line-height: 2em;">社区网站业务相对个人网站，有更多的用户访问，为保证性能，此时就需要对带宽、内存、CPU进行优化，以便提供更大的空间，提升访问速度。
                        <span style="color: #60aff6">适合流量适中的网站应用，或简单开发环境、代码存储库等。</span></p>
                <div class="tl initial">
                    <span class="initial-title">推荐配置:</span>
                    <span class="initial-item"><span>2核</span><span>cpu</span></span>
                    <span class="initial-item"><span>2G</span><span>内存</span></span>
                    <span class="initial-item"><span>20M</span><span>带宽</span></span>
                    <span class="initial-item"><span>30G</span><span>存储</span></span>
                    <a href="<?php echo U('Index/jdcloudbuy');?>"><button class="btn btn-default">立即购买</button></a>
                </div>
            </div>
            <div class="conscene-game p50" style="display:none;">
                <p class="tl" style="font-size: 16px;">适用对象：网上商城、团购网</p>
                <p class="tl" style="color: #888;line-height: 2em;">随着电子商务的不断发展，众多企业逐渐意识到电子商务的重要性。该配置适用于开发、测试、上线初期，后期可根据您的业务的实际增长进行增减，可灵活控制。
                        <span style="color: #60aff6">计算能力满足90%云计算使用者需求，适合企业运营活动、并行计算应用、普通数据处理服务等。</span></p>
                <div class="tl initial">
                    <span class="initial-title">推荐配置:</span>
                    <span class="initial-item"><span>4核</span><span>cpu</span></span>
                    <span class="initial-item"><span>4G</span><span>内存</span></span>
                    <span class="initial-item"><span>50M</span><span>带宽</span></span>
                    <span class="initial-item"><span>50G</span><span>存储</span></span>
                    <a href="<?php echo U('Index/jdcloudbuy');?>"><button class="btn btn-default">立即购买</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.main-ulscene li:eq(0)').click(function(){
            $('.active').removeClass('active');
            $(this).addClass('active');
            $('.conscene-game').fadeOut();
            $('.conscene-initial').fadeIn();
        });
        $('.main-ulscene li:eq(1)').click(function(){
            $('.active').removeClass('active');
            $(this).addClass('active');
            $('.conscene-game').fadeIn();
            $('.conscene-initial').fadeOut();
        });
    })
    
</script>
<!--左右悬浮-->
<style>
    .float{
        position: fixed;
        width: 64px;
        height: 158px;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,.15);
        background-color: #60aff6;
        text-align: center;
        top:0;
        bottom: 0;
        margin: auto;
    }
    .float img{
        width: 48px;
        margin: 8px 0 4px;
    }
    .float span{
        cursor: default;
        display: inline-block;
        width: 18px;
        font-size: 18px;
        color: #fff;
        line-height: 21px;
    }
    .float-panel{
        box-sizing: border-box;
        position: fixed;
        padding: 20px;
        background: #fff;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,.15);
        z-index: 4;
    }
    /*right*/
    .right-float{
        right: 20px;
    }
    .float-panel-right{
        right: 100px;
        width: 320px;
        height: 224px;
        top: 0;
        bottom: 66px;
        margin: auto;
    }
    .float-panel-right .panel-content{
        min-height: 24px;
        padding-left: 0;
    }
    
    .float-panel-right .panel-content li{
        list-style: none;
        margin-bottom: 20px;
        text-align: left;
    }
    .float-panel-right .panel-content li:hover{
        background: #ece9e9;
    }
    .float-panel-right .panel-content .content-icon{
        width: 24px;
        height: 24px;
        display: inline-block;
        vertical-align: middle;
    }
    .float-panel-right .panel-content .content-icon img{
        width: 100%;
    }
    .float-panel-right .panel-content .content-main{
        display: inline-block;
        vertical-align: middle;
        margin-left: 12px;
        text-align: left;
    }
    .float-panel-right .panel-content .content-main .content-title{
        line-height: 24px;
    }
    .float-panel-right .panel-content .content-main .content-desc{
        color: #9b9ea0;
        font-size: 12px;
        line-height: 24px;
    }
    .float-panel-right .panel-content .content-main a{
        text-decoration: none;
        color: #5f6367;
        font-size: 14px;
    }
    /*left*/
    .left-float{
        left: 20px;
    }
    .float-panel-left{
        left: 100px;
        width: 470px;
        height: 224px;
        top: 0;
        bottom: 66px;
        margin: auto;
    }
    
    .float-panel-left ul li{
        text-align: left;
        padding: 5px 5px;
    }
    .float-panel-left ul li span{
        border: 1px solid #c1c2c3;
        margin-left: 10px;
        font-size: 15px;
        padding: 2px;
        cursor: pointer;
        border: 1px solid #60aff6;
        color: #60aff6;
        border-radius: 5px;
    }
    .float-panel-left ul li span:hover{
        background: #60aff6;
        color: #fff;
    }
    .float-panel-left ul li img{
        width: 15px;
        margin-top: -5px;
    }
    /*middle*/
    .float-panel-middle{
        position: fixed;
        background: #eee;
        padding: 20px;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,.15);
        left: 0; top: 0; right: 0; bottom: 0;
        width: 470px;
        height: 240px;
        margin: auto;
        opacity: 0.9;
        z-index: 16;
    }
    
    .float-panel-middle ul li{
        text-align: left;
        padding: 5px 5px;
    }
    .float-panel-middle ul li span{
        border: 1px solid #c1c2c3;
        margin-left: 10px;
        font-size: 15px;
        padding: 2px;
        cursor: pointer;
        border: 1px solid #60aff6;
        color: #60aff6;
        border-radius: 5px;
    }
    .float-panel-middle ul li span:hover{
        background: #60aff6;
        color: #fff;
    }
    .float-panel-middle ul li img{
        width: 15px;
        margin-top: -5px;
    }
    /*弹窗*/
    .closetan{position: absolute;top: -15px;right: 0;font-size: 25px;}
    .closetan:hover{color: red;}
</style>
<div class="footer_above" style="width:100%;height:160px;background-image:url('/Application/Home/View/Public/images/footer-bg.jpg');">
    <p style="height:90px;line-height:100px;font-size:24px;color:#fff;">加入我们，立即开启您的互联网飞速之旅！</p>
    <a href="<?php echo U('Admin/register');?>" style="color:#60aff6;font-size:17px;" class="btn btn-default default-transition">免费注册</a>
</div>
<div class="footer_big">
	<div class="footer_content w1200">
        <div class="footer_left">
            <p>产品导航</p>
            <ul>
                <li><a href="<?php echo U('Index/cloud');?>">VPS云主机</a></li>
                <li><a href="<?php echo U('Index/vhost');?>">虚拟主机</a></li>
                <li><a href="<?php echo U('Index/newserver');?>">服务器租用</a></li>
                <li><a href="<?php echo U('Index/newserver');?>">服务器托管</a></li>
            </ul>
        </div>
        <div class="footer_left footer_service">
            <p>服务支持</p>
            <ul>
                <li class="qq">售后ＱＱ：800002004</li>
                <li class="phone">售后电话：0527-84224055转800</li>
                <li class="wechat">微信服务号: 扫描下方二维码</li>
                <li style="width:100px;height:100px;"><img src="/Application/Home/View/Public/images/ewm.jpg" width="100%"></li>
            </ul>
        </div>
        <div class="footer_left">
        	<p>服务承诺</p>
            <ul>
            	<li><a href="">用户政策</a></li>
                <li><a href="">服务条款</a></li>
                <li><a href="">隐私保护</a></li>
                <li><a href="">DMCA政策</a></li>
            </ul>
        </div>
        <div class="footer_left">
            <p>公司资质</p>
            <ul>
                <li>增值电信业务经营许可证</li>
                <li>电信与信息服务业务经营许可证</li>
                <li>电信业务审批[2008]字第888号</li>
                <li>ISO9001国际标准质量体系认证</li>
            </ul>
        </div>
        <div class="clear"></div>
        <p class="footer_bottom mt20" style="margin:0;padding:10px;border-top:1px solid #aaa;">
            <span style="color:#bbb;font-size:12px">Copyright ©2014 宿迁蒲公英网络 All Rights Reserved</br> ICP证：苏B2-20070043-1</span></br>
            <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=32130202080002" target="blank" style="color:#fff;font-size:13px"> <img src="/Application/Home/View/Public/images/20160331152326_4663.png">  备案号：苏公网安备 32130202080002号</a>
        </p>
    </div>

    <div id="rfloat" style="position:fixed;top:0;bottom:0;margin:auto;right:20px;width:84px;height:224px;z-index:999;">
        <div class="float right-float">
            <img class="button-background" src="/Application/Home/View/Public/images/service.png" alt="">
            <span>售后服务</span>
        </div>
        <div class="float-panel float-panel-right" style="display:none;">
            <ul class="panel-content">
                <li>
                    <div class="content-icon">
                        <img src="/Application/Home/View/Public/images/telephone.png" alt="">
                    </div>
                    <div class="content-main">
                        <a href="javascript:void(0);">
                            <div>
                                <div class="content-title">
                                    售后服务电话
                                </div>
                                <div class="content-desc">
                                    <span style="color: #ff9900;">0527-84224055转800</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
                <li data-spm-anchor-id="5176.8142029.762944.i3.e93976f4s5uTHh">
                    <div class="content-icon">
                        <img src="/Application/Home/View/Public/images/qq.png" alt="">
                    </div>
                    <div class="content-main">
                        <a target="_blank" href="http://crm2.qq.com/page/portalpage/wpa.php?uin=800002004&aty=0&a=0&curl=&ty=1">
                            <div>
                                <div class="content-title">
                                    售后QQ
                                </div>
                                <div class="content-desc">
                                    24小时在线解答
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="lfloat" style="position:fixed;top:0;bottom:0;margin:auto;left:20px;width:84px;height:224px;z-index:999;">
        <div class="float left-float">
            <img class="button-background" src="/Application/Home/View/Public/images/service-2.png" alt="">
            <span>售前咨询</span>
        </div>
        <div class="float-panel float-panel-left" style="display:none;">
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6">售前咨询</h2>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002725400&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售依一</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391907&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售硕硕</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391890&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售宁宁</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002738725&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售吉祥</span></a>
                </li>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391894&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售阿东</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391885&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售慧慧</span></a>
                </li>
            </ul>
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6;margin-top:20px;">投诉建议</h4>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002951580&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  投诉受理</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="float-panel-middle" style="display:none;">
        <div style="position: relative;">
            <div class="closetan"><i class="fa fa-times"></i></div>
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6">售前咨询</h2>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002725400&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售依一</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391907&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售硕硕</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391890&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售宁宁</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002738725&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售吉祥</span></a>
                </li>
                <li>
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391894&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售阿东</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391885&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售慧慧</span></a>
                </li>
            </ul>
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6;margin-top:20px;">投诉建议</h4>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002951580&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  投诉受理</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="home" style="display:none;"><a href="javascript:void(0);"><img src="/Application/Home/View/Public/images/home.png"></a></div>
</div>
<?php if($current == 'about'): ?><script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6"></script>
<script type="text/javascript" src="https://api.map.baidu.com/getscript?v=2.0&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;services=&amp;t=20180323171755"></script>
<script type="text/javascript" src="/Application/Home/View/Public/js/pgymap.js"></script><?php endif; ?>
</body>
</html>