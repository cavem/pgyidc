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
        $('.float-panel-middle').fadeIn();
    })
    $('.closetan').click(function(){
        $('.float-panel-middle').fadeOut();
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
                    <li _t_nav="product"><h2><a href="#">云服务器</a></h2></li>
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
                      <dl style="margin-left: 35%;">
                        <dt>支付平台</dt>
                        <dd><a hotrep="hp.header.product.compute1" href="http://pay.17b.net/" target="blank">传奇支付平台</a></dd>
                        <dd><a hotrep="hp.header.product.storage1" href="http://pay.pgyidc.com/" target="blank">发卡支付平台</a></dd>
                     </dl>
                      <dl>
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

    .about{padding:20px 0;background: #f2f2f2;};
    .small-banner{background:#dedfe4;}
    .small-fixbanner{background-color:#dedfe4;display: none;position: fixed;top: 0;left: 0;width: 100%;z-index:999;}
    .ul-smbancon{height: 60px;line-height: 60px;}
    .ul-smbancon li{display: inline-block;font-size: 16px;margin:0 50px 0 50px;cursor: pointer;}
    .currenton{color: #60aff6}
    .joinuscontain p,.knowuscontain p{text-align: left;line-height: 2em;font-size: 14px;color:#4b556a}
    .connectcontain{height: 250px;margin-top: 20px;}
    .connectcontain-item{width:24%;height: 250px;padding: 25px;margin-left:9px;float: left;}
    /* .connectcontain-item:hover{border:1px solid #60aff6;box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(96,175,246,.5);} */
    .connectcontain-item img{margin-top: 30px;}
    .connectcontain-item .title{color: #60aff6;font-size: 16px;margin-top:30px;}
    .connectcontain-item .contain{color: #999;font-size: 12px;line-height: 2em;}
</style>

<div class="banner">
    <div class="banner-contain w1200 pr">
        <div class="bc-left"><span class="circle1"></span><span class="circle2"></span><img src="/Application/Home/View/Public/images/about.png"></div>
        <div class="bc-right tl pa" style="left:200px;top:20px;">
            <h2 class="m0 wow fadeInUp">关于我们</h2>
            <p class="mt20 wow fadeInUp">宿迁蒲公英网络有限公司（http://www.pgyidc.com)是座落于中国经济最前沿—江苏宿迁的一家公司，由一批有多年网络行业丰富工作经验的人员于2005年10月参与创办，注册资本1000万元。公司于2006年获得江苏省通信管理局ICP经营许可，以国际化、高标准的工作流程为超过10万家企、事业单位及个人用户提供服务器托管及网站接入服务。宿迁蒲公英网络直营数据中心的服务器保有量超过5000台，网站接入数量超过10万个，是国内最大的互联网接入商之一。 核心资源覆盖在上海、江苏宿迁、扬州、镇江并在扬州镇江等地拥有直营子公司，在超过5个核心城市拥有直营数据中心及服务团队。 宿迁蒲公英网络是江苏互联网协会和中国互联网协会会员</p>
        </div>
    </div>
</div>
<div class="small-banner" style="background: #dedfe4">
    <div class="smban-contain w1200" style="height:60px;">
        <ul class="ul-smbancon">
            <li class="currenton know">了解我们</li>
            <li class="join">加入我们</li>
            <li class="connect">联系我们</li>
        </ul>
    </div>
</div>
<div class="small-fixbanner">
    <div class="smban-contain w1200" style="height:60px;">
        <ul class="ul-smbancon">
            <li class="currenton know">了解我们</li>
            <li class="join">加入我们</li>
            <li class="connect">联系我们</li>
        </ul>
    </div>
</div>
<div class="about">
    <div class="w1200" id="knowus">
        <h3>了解我们</h3>
        <div class="knowuscontain">
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">核心价值</b>&nbsp;&nbsp;宿迁蒲公英网络致力于为用户提供更好的解决方案，并始终领跑互联网服务的革新。对于宿迁蒲公英网络来说，优质的网络服务是不计回报的投入、极尽严格的品质规范和对“用户第一“的充分理解与贯彻，对销售和售后服务模式的大胆创新与挑战。宿迁蒲公英网络尊重和把握每一个客户的想法与建议，并视之为机遇，也正是这种始终与用户保持高度统一的价值观使宿迁蒲公英网络不断欣荣并高速、健康发展至今。这也是宿迁蒲公英网络品牌的核心所在：一个力求至臻完善的服务标准。</p>
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">公司理念</b>&nbsp;&nbsp;宿迁蒲公英网络在公司规模不断壮大的情况下大力加强企业文化建设，努力探索企业文化的内涵，公司和员工都认可“付出”与“回报”的正相关是实现企业发展和个人价值的的共赢选择。我们珍惜员工的每一份付出，珍惜用户的每一次选择，珍惜公司的每一步成长，这将激励我们努力提供一个更广阔的平台以实现“与员工双赢”、“与客户双赢”、“与社会双赢”、“与合作伙伴双赢”、“与竞争对手双赢”，进而成为一家优秀的互联网企业。</p>
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">业务覆盖</b>&nbsp;&nbsp;宿迁蒲公英网络专业从事服务器托管、服务器租用、数据中心维护、专线接入等服务 ，拥有最丰富的互联网资源，经营和管理着超过3个电信 、联通及双线数据中心。目前我们拥有电信总出口带宽超过120G，联通总出口带宽超过20G，截止2010年2月份投入使用的机柜数量超过400个。宿迁蒲公英网络积极拓展全球市场，不仅在华东、华北、华南地区实现了资源及服务的全覆盖，更是在香港、美国等海外市场拥有了直营或自建的数据中心。宿迁蒲公英网络同时拥有最顶尖的网络技术力量，在网络保障、信息安全等领域都领先业界;凭借大规模的投入和领先的技术支撑，宿迁蒲公英网络以更快的速度实现网络资源覆盖，满足我们的用户对差别网络资源的需求。</p>
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">服务团队</b>&nbsp;&nbsp;宿迁蒲公英网络目前服务团队超过60人，技术精湛、吃苦耐劳、敬业爱岗以及高度负责的工作态度体现在为用户服务的每一个环节;凭借一流的服务团队，我们为用户提供最优质的网络服务。宿迁蒲公英网络为每个机房配备三到八名工程师，提供24小时驻机房现场维护，为租用和托管用户提供实时上架、免费备机和备件 、带宽及硬件扩充服务。宿迁蒲公英网络每个直营机房均提供24小时技术支持电话，同时配备指定的客户经理24小时服务，保证畅通的服务渠道。在上海地区配备客户服务专车，免费接送客户的网络设备进出机房。公司同时采取“错时上班”机制，实时在线的业务受理一直延伸到晚上23:30，而驻机房的维护人员和信息安全人员则是24小时轮流值班，公司同时开放40部直线电话及50多部客户经理及服务投诉的手机，确保优质服务不留任何死角。</p>
        </div>
    </div>
    <div style="background: #fff;padding: 20px 0;">
        <div class="w1200" id="joinus">
            <h3>加入我们</h3>
            <div class="joinuscontain">
                <p>蒲公英自成立到现在，我们的事业取得了迅猛发展，如果你有志于IDC机房事业，希望亲手创造中国互联网下一个奇迹，那么非常欢迎加入我们，共创未来！我们希望我们的团队成员拥有充沛的创业激情，说到做到的执行力，以及永不放弃的精神！亲手创造中国互联网下一个奇迹，共创未来，您将和我们一起深度参与公司及团队的成长过程！</p>
                <p><i class="fa fa-circle"></i> <b style="color:#000;font-size: 16px;">客服</b></br>职位描述:</br>主要负责公司客户服务，互联网备案。工作时间8小时，每周单休。要求计算机专业毕业，对计算机知识有一定的认知，普通话标准。有1年以上的工作经验。薪资待遇：底薪 + 奖金，具体面议！</p>
                <p><i class="fa fa-circle"></i> <b style="color:#000;font-size: 16px;">技术工程师</b></br>岗位职责:</br>1、负责维护公司内部服务器，为相关部门提供技术支持。</br>2、回复和处理客户提交的问题。</br>3、为客户提供我公司服务范围内的客户指导。</br>4、根据相关部门的要求协同各部门进行售后服务。
                <p>任职要求:</br>1、大专或本科学历，计算机相关专业，2年以上相关工作经验，能熟练组装电脑硬件，会排查判断电脑硬件故障。</br>2、精通web,email,sql服务架构,具有独立维护能力，能熟练安装windows 2003操作系统及liunx操作系统，有责任心，负责日常电信机房维护工作！</br>3、精通windows 操作系统（服务器版）和 linux (RH or centos or freebsd and so on.)系统，熟悉服务器等硬件设备的设置以及管理。</br>4、精通mysql、mssql的基本操作和基本维护，电脑公司技术员或者网吧技术员优先考虑。</br>5、具有团队合作精神、且又能独立的学习能力。</p>
                <p>工作时间:周一到周五，八小时工作时间。</p>
                <p>薪资待遇:底薪 + 奖金，具体面议！</p>
                <p>联系人:何颖</p>
                <p>联系方式:15751554577</p>
                <p>工作地点：江苏省宿迁市宿豫区金融财富广场C座4楼</p>
            </div>
        </div>
    </div>
    <div id="connectus" style="padding: 20px 0;">
        <h3>联系我们</h3>
        <div class="w1200 connectcontain">
            <div class="connectcontain-item">
                <i class="fa fa-envelope-o" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">公司邮箱</p>
                <p class="contain">pgyidc@hotmail.com</p>
            </div>
            <div class="connectcontain-item">
                <i class="fa fa-qq" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">售后客服</p>
                <p class="contain">QQ:800002004</p>
            </div>
            <div class="connectcontain-item">
                <i class="fa fa-phone" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">技术支持</p>
                <p class="contain">0527-84224055转800/801</p>
            </div>
            <div class="connectcontain-item">
                <i class="fa fa-map-marker" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">公司地址</p>
                <p class="contain">江苏省宿迁市宿豫区金融财富广场C座4楼</p>
            </div>
        </div>
        <section class="section map">
            <div style="width: auto; height: 400px; font-size: 12px; margin-top: 30px; overflow: hidden; position: relative; z-index: 0; background-color: rgb(243, 241, 236); color: rgb(0, 0, 0); text-align: left;" id="map"></div>
        </section>
    </div>
</div>
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
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391894&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售阿东</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391907&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售硕硕</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391890&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售宁宁</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002738725&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售吉祥</span></a>
                </li>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002725400&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售依一</span></a>
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
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391894&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售阿东</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391907&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售硕硕</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391890&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售宁宁</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002738725&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售吉祥</span></a>
                </li>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002725400&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售依一</span></a>
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