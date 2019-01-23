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
layer.open({
    type: 1
    ,title: false
    ,closeBtn: false
    ,area: '300px;'
    ,shade: 0.5
    ,id: 'LAY_layuipro'
    ,btn: ['火速围观', '残忍拒绝']
    ,btnAlign: 'c'
    ,moveType: 1
    ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">这是一个公告^_^</div>'
    ,success: function(layero){
        var btn = layero.find('.layui-layer-btn');
        btn.find('.layui-layer-btn0').attr({
        href: 'http://pgy.com/'
        ,target: ''
        });
    }
});
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
        new ImageSlide({
            project:"#focusImage",
            content:".contents li",
            tigger:".triggers a",
            dot:".icon-dot a",
            watch:".link-watch",
            auto:!0,
            hide:!0
        })
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
<?php if(($current == 'download')): ?><script>
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
        <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Application/Home/View/Public/images/logo.png" height="60px" width="200px"></a></div>
        <div class="head-v3">
            <div class="navigation-up">
              <div class="navigation-inner">
                <div class="navigation-v3">
                  <ul>
                    <li  _t_nav="home"><h2><a href="<?php echo U('Index/index');?>">首页</a></h2></li>
                    <li  _t_nav="product"><h2><a href="#">云产品</a></h2></li>
                    <li  _t_nav="server"><h2><a href="#">服务器托管与租用</a></h2></li>
                    <li  _t_nav="solution"><h2><a href="#">行业解决方案</a></h2></li>
                    <li  _t_nav="cooperate"><h2><a href="<?php echo U('Index/cooperate');?>">合作伙伴</a></h2></li>
                    <li _t_nav="support" class=""><h2><a href="#">公司</a></h2></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="navigation-down">
              <div id="product" class="nav-down-menu menu-1" style="display: none;" _t_nav="product">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>云服务器</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/cloud');?>">云服务器</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/jdcloud');?>">京 东 云</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="http://yun.pgyidc.com/server/buy.html" target="blank">香港机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/serverbuy');?>">昊锐信息</a></dd>
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
                    <dt>最新产品</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/newserver');?>">最新产品</a></dd>
                  </dl>
                  <dl>
                    <dt>自营机房</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/sqidc');?>">宿迁机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/jdidc');?>">京东机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/wzidc');?>">温州机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/gzidc');?>">广州机房</a></dd>
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
                    <dt>关于我们</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about');?>">了解我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about/#joinus');?>">加入我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about/#connectus');?>">联系我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/news');?>">新闻动态</a></dd>
                  </dl>
                  <dl>
                    <dt>文档中心</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/document');?>">帮助文档</a></dd>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/download');?>">下载中心</a></dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
          <div class="login">
              <?php if($_SESSION['loginuser']== ''): ?><a href="<?php echo U('Admin/login');?>">登录</a><span>|</span><a href="<?php echo U('Admin/register');?>">注册</a>
                <?php else: ?><a href="">Hi! <?php echo ($_SESSION['loginuser']['username']); ?></a><span>|</span><a href="<?php echo U('Admin/Index/index');?>">控制台</a><?php endif; ?>
          </div>
    </div>
</div>
<style>
    .show-more{border:1px solid #fff;color:#fff;}
    ul{margin-bottom: 0;}
    .layui-layer-btn{text-align: center;}
    .onthis{background-color: #60aff6 !important;color: #fff;}
    .haveborder{border-right: 1px solid #ddd;background: #f4f4f4;}
    .main{margin: 25px auto;}
    .main tr td{position: relative;}
    .title{position: absolute;width: 30px;height:100%;left: 0;top: 0;background-color:#ddd;}
    .title span{position: absolute;left:50%;top:50%;margin-top:-12px;margin-left:-5px;width:1em;line-height: 1;color: #888;}
    .panelcon .list{position: relative;margin:10px auto;}
    .panelcon .list ul{margin-left:130px;height:30px;line-height:30px;display:inline-block;cursor: pointer;}
    .panelcon .list ul li{float: left;position: relative;margin-left: -1px;min-width: 46px;height: 30px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 30px;font-size: 13px;padding: 0 12px;}
    .panelcon .list ul li:hover{background: #60aff6;color: #fff;}
    .panelcon .list ul li input{position: absolute;width: 100%;height: 100%;left: 0;opacity: 0;cursor: pointer;}
    .panelcon .list .list-sp{position: absolute;margin-left: 30px;font-size: 12px;left: 0;top: 50%;margin-top:-10px;width: 90px;text-align: right;color:#999;}
    .nav-tabs>li{width: 180px;height: 50px;text-align: center;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #60aff6;}
    .nav>li>a{padding: 14px 15px;}
    .nav-tabs>li>a{font-size: 14px;}
    .form-control{height: 32px;font-size: 12px;border-radius:0px;width: 125px;display: inline-block;}
    .btn-primary{background-color: #60aff6;border: 0px;}
    .btn-primary:hover{background-color: #2680d0;}
    .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{border-bottom-width: 0px;}
    .ml130{margin-left: 130px;}
    input[type=checkbox], input[type=radio]{margin: 0;}
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    input[type="number"]{
        -moz-appearance: textfield;
    }
    .updown{display: inline-block;width: 20px;position: relative;top: 11px;text-align: center;background: #eee;}
    .updown span{display: block;font-size: 16px;}
    .updown span:hover{background: #bbb;}
    .dsb{color: #ccc;cursor: not-allowed;}
    .p-config span{color: #999;}
</style>
<script>
$(function(){
    $('.haveborder').mouseenter(function(){
        $(this).find('.title').css('background-color','#60aff6');
        $(this).find('.title span').css('color','#fff');
    });
    $('.haveborder').mouseleave(function(){
        $(this).find('.title').css('background-color','#ddd');
        $(this).find('.title span').css('color','#888');
    });
    $(window).scroll(function(){
        var docheight=$(window).height();
        var trpircetop=$("#tr-pirce").offset().top-$(window).scrollTop();
        
        if(trpircetop+90<docheight){
            $('.price-fix').hide();
        }else{
            $('.price-fix').show();
        }
    });
    var onthis=function(cthis){
        cthis.closest('.list').find('li').removeClass('onthis');
        cthis.addClass('onthis');
    }
    //获取镜像版本
    var getimagelist=function(){
        var imagesource=$('.imagetypeul').find('.onthis').data('val');
        var platform=$('.sel-os').children("option:selected").val();
        $('.spandding').show();
        $.post('getimage',{"imagesource":imagesource,"platform":platform},function(data,status){
            data=JSON.parse(data);
            var images=data['msg']['result']['images'];
            if(images!=null){
                var options="";
                for(var i=0;i<images.length;i++){
                    options+="<option value="+images[i]['imageId']+">"+images[i]['name']+"</option>";
                }
                $('.sel-images').html(options);
                getstandard();
                $('.spandding').hide();
            }else{
                $('.sel-images').html('<option value="">暂无镜像</option>');
                getstandard();
                $('.spandding').hide();
            }
            
        });
    }
    //获取规格
    var getstandard=function(){
        var keyword="";
        var regionidid=$('.localul').find('.onthis').data('val');
        $('.currency').html('<tr><td colspan="4" style="height: 140px;vertical-align: middle;text-align: center;"><img src="/Application/Home/View/Public/images/loading.gif" height="25px;"></td></tr>');
        //$('.spadding-td').show();
        $.post('getstandard',{"keyword":keyword,"regionidid":regionidid},function(data,status){
            data=JSON.parse(data);
            var standards=data['msg']['result']['instanceTypes'];
            if(standards!=null){
                var currency_tr="",calculate_tr="",memory_tr="";
                var pubobj={"g.n":"通用 标准型","g.s":"通用 共享型"};
                for(var i=0;i<standards.length;i++){
                    if(standards[i]['family']=="g.n"){
                        currency_tr+='<tr class=""><td class=""><label><input type="radio" name="instancetype" value="'+standards[i]['instanceType']+'">'+' '+pubobj[standards[i]['family']]+'</label></td><td class="">'+standards[i]['instanceType']+'</td> <td class="">'+standards[i]['cpu']+'核</td> <td class="">'+standards[i]['memoryMB']/1024+'GB</td></tr>'
                    }else if(standards[i]['family']=="c.n"){
                        calculate_tr+='<tr class=""><td class=""><label><input type="radio" name="instancetype" value="'+standards[i]['instanceType']+'"> 计算优化 标准型</label></td><td class="">'+standards[i]['instanceType']+'</td> <td class="">'+standards[i]['cpu']+'核</td> <td class="">'+standards[i]['memoryMB']/1024+'GB</td></tr>'
                    }else if(standards[i]['family']=="m.n"){
                        memory_tr+='<tr class=""><td class=""><label><input type="radio" name="instancetype" value="'+standards[i]['instanceType']+'"> 内存优化 标准型</label></td><td class="">'+standards[i]['instanceType']+'</td> <td class="">'+standards[i]['cpu']+'核</td> <td class="">'+standards[i]['memoryMB']/1024+'GB</td></tr>'
                    }
                }
            }
            $('.currency').html(currency_tr);
            $('.calculate').html(calculate_tr);
            $('.memory').html(memory_tr);
            $('.spadding-td').hide();
            $('.currency').children('tr').find('td').eq(0).find('input').attr("checked",true);
            var stardtype=$('.currency').children('tr').eq(0).children('td').eq(0).text();
            var standard=$('.currency').children('tr').eq(0).children('td').eq(1).text();
            var cpunum=$('.currency').children('tr').eq(0).children('td').eq(2).text();
            var ram=$('.currency').children('tr').eq(0).children('td').eq(3).text();
            $('.standardp').html("当前当前选择实例：<span style='color: #ff9600;'>"+standard+"("+cpunum+ram+","+stardtype+")</span>");
            getconflist(0);
            $("input[name='instancetype']").click(function(){
                var stardtype=$(this).closest('tr').children('td').eq(0).text();
                var standard=$(this).closest('tr').children('td').eq(1).text();
                var cpunum=$(this).closest('tr').children('td').eq(2).text();
                var ram=$(this).closest('tr').children('td').eq(3).text();
                var html="当前当前选择实例：<span style='color: #ff9600;'>"+standard+"("+cpunum+ram+","+stardtype+")</span>";
                $('.standardp').html(html);
                getconflist(0);
            })
        })
    }
    //获取配置列表
    var totalprice;
    var getconflist=function(isbuy){
        //获取配置
        var local=$('.localul').find('.onthis').text();//地域
        var area=$('.areaul').find('.onthis').text();//可用区
        var image=$('.sel-images').children("option:selected").text();//镜像
        var standard=$('.standardp').find('span').text();//规格
        var systemdisk=$('.sel-systemdisk').children("option:selected").text();//系统盘
        var datadisk="";//数据盘
            var gxpan=0;var ssdpan=0;
            var gxpannum="";var ssdpannum="";
            var gxpanpn="";var ssdpanpn="";
            $('.addssd').each(function(){
                var val=$(this).find('.sel-cloudpan').children("option:selected").val();
                if(val=="0"){
                    gxpan+=1;
                    gxpannum+=$(this).find('.pannum').val()+'GB、';
                    gxpanpn+=$(this).find('.pannum').val()+',';
                    
                }else{
                    ssdpan+=1;
                    ssdpannum+=$(this).find('.pannum').val()+'GB、';
                    ssdpanpn+=$(this).find('.pannum').val()+',';
                    
                }
            })
            gxpannum=gxpannum.substring(0,gxpannum.length-1);
            gxpanpn=gxpanpn.substring(0,gxpanpn.length-1);
            ssdpannum=ssdpannum.substring(0,ssdpannum.length-1);
            ssdpanpn=ssdpanpn.substring(0,ssdpanpn.length-1);
            if(gxpan!=0){
                datadisk+=gxpan+"个高效云盘("+gxpannum+")";
            }else{
                datadisk+="";
            }
            if(ssdpan!=0){
                datadisk+=ssdpan+"个SSD云盘("+ssdpannum+")";
            }else{
                datadisk+="";
            }
        var privatenet=$('.sel-privatenet').children("option:selected").val();//私有网络
        var subnet=$('.sel-subnet').children("option:selected").val();//子网
        var publicnetip="";//公网IP
            var provider=$('.bgpul').find('.onthis').text();
            var bdval=$('.port').val();
            if($('.bybd').hasClass('onthis')){
                publicnetip+=provider+"按带宽"+bdval+"Mbps";
            }else{
                publicnetip+=provider+"按流量"+bdval+"Mbps";
            }
        var duration=$('.durul').find('.onthis').text();//购买时长
        var buynum=$('.buynum').val();//购买数量
        $('.p-config').html("<span>地域：</span>"+local+" <span>可用区：</span>"+area+" <span>镜像:</span>"+image+" <span>规格：</span>"+standard+" <span>系统盘：</span>"+systemdisk+" <span>数据盘：</span>"+datadisk+" <span>私有网络：</span>"+privatenet+" <span>子网：</span>"+subnet+" <span>公网IP：</span>"+publicnetip+" <span>购买时长：</span>"+duration+" <span>购买数量：</span>"+buynum);
        //获取价格
        var formdata=$('.mform').serialize()+"&instancetype="+$("input[name='instancetype']:checked").val()+"&highpan="+gxpanpn+"&ssdpan="+ssdpanpn;
        if(isbuy==0){
            $('.totalprice').text('价格计算中...');
            $.post('getprice',formdata,function(data,status){
                if(status="success"){
                    $('.totalprice').text(data);
                    totalprice=data;
                }else{
                    $('.totalprice').text('价格获取失败！');
                }
            });
        }else{
            formdata+="&totalprice="+totalprice;
            if($('.sel-images').children("option:selected").val()==""){
                layer.msg('请选择镜像',{time:1000});
            }else if($('.servername').val().length>32||$('.servername').val().length==''){
                layer.msg('名称不能为空且不能超过32个字符！');
                $('.servername').css('border-color','red');
            }else if($("input[name='issetpsw']:checked").val()=='1'){
                if($('.setpsw').val().length<8||$('.setpsw').val().length>30){
                    layer.msg('请输入8至30位字符密码！',{time:1000});
                    $('.setpsw').css('border-color','red');
                }else if($('.setpsw').val()!=$('.pswconfig').val()){
                    layer.msg('两次输入密码不一致！',{time:1000});
                    $('.pswconfig').css('border-color','red');
                }else{
                    $('.servername .setpsw .setpsw').css('border-color','');
                    $.post('buynow',formdata,function(data,status){
                        console.log(data);
                    })
                }
            }else{
                $.post('buynow',formdata,function(data,status){
                    console.log(data);
                })
            }
        }
    }
    
    //初始化
    var init=function(){
        $('.list').find('ul:eq(0)').find('li:eq(0)').addClass('onthis');
        getimagelist();
    }
    init();

    //按钮点击事件
    $('.list ul li').click(function(){
        onthis($(this));
    });
    //其它按钮点击事件
    $('.otherul li').click(function(){
        getconflist(0);
    })
    //地域
    $('.localul').children('li').click(function(){
        $('.areaul').find('.onthis').removeClass('onthis');
        $('.areaul').children('li').eq(0).addClass('onthis');
        if($(this).index()==0||$(this).index()==3){
            $('.areaul').children('li').eq(1).show();
        }else{
            $('.areaul').children('li').eq(1).hide();
        }
        if($(this).index()!=1){
            $('.bgpul').children('li').eq(1).hide();
        }else{
            $('.bgpul').children('li').eq(1).show();
        }
        getstandard();
    })
    
    //带宽拖动事件
    $('.single-slider').jRange({
        from: 0,
        to: 200,
        step: 1,
        scale: [0,50,100,150,200],
        format: '%s',
        width: 500,
        showLabels: true,
        showScale: true
    });
    $('.demo').mouseup(function(){
        setTimeout(function(){
            var port=$('.port').val();
            var minport=$('.port').data('minval');
            if(port<minport){
                window.location.reload();
            }
            getconflist(0);
        },500)
    });
    //包年包月|按配置
    $("#mainTab li").click(function(){
        $("#mainTab").children('li').removeClass('active');
        $(this).addClass('active');
        getconflist(0);
    })
    //镜像类型
    $('.imagetypeul li').click(function(){
        if($(this).index()==3){
            $('.sel-os').hide();
            $('.sel-images').addClass('ml130');
        }else{
            $('.sel-os').show();
            $('.sel-images').removeClass('ml130');
        }
        getimagelist();
    })
    //选择系统
    $(".sel-os").change(function(){  
        getimagelist();        
    });
    //选择系统版本
    $('.sel-images').change(function(){
        getconflist(0);
    })
    
    //恢复镜像默认设置
    $('.resetimg').click(function(){
        $('.addssd').remove();
        $('.addpan').css({"cursor":"","color":""});
        getconflist(0);
    })
    //内网ip
    $('.sel-netip').change(function(){
        var val = $(this).children('option:selected').val();
        switch(val){
            case 'auto':$('.autoip,.autop').show();$('.customip,.customp').hide();break;
            case 'custom':$('.autoip,.autop').hide();$('.customip,.customp').show();break;
        }
    })
    //是否设置密码
    $("input[name='issetpsw']").click(function(){
        var val=$(this).val();
        switch(val){
            case "1":$('.inp-psd,.inp-repsd').show();break;
            case "0":$('.inp-psd,.inp-repsd').hide();break;
        }
    })
    //存储添加硬盘
    $('.addpan').click(function(){
        var ssdnum=0;
        $('.addssd').each(function(){
            ssdnum+=1;
        })
        if(ssdnum<4){
            $('.panlist').append('<div class="addssd ml130"><select class="form-control sel-cloudpan"><option value="0">高效云盘</option><option value="1">SSD云盘</option></select><input type="text" value="20" class="form-control pannum changessd" style="position: relative;bottom: 2px;" placeholder="20-3000"> GB <span class="ml20" title="数据盘设备名范围：/dev/vdb--/dev/vdh。">自动分配设备名</span><a href="javascript:void(0)" class="ml20">使用快照创建</a><a href="javascript:void(0)" class="ml20 delpan" style="font-size: 16px;"><i class="fa fa-trash-o"></i></a></div>');
        }else{
            $('.addpan').css({"cursor":"not-allowed","color":"#ccc"});
        }
        //删除云盘
        $('.delpan').click(function(){
            $('.addpan').css({"cursor":"","color":""});
            $(this).closest('.addssd').remove();
            getconflist(0);
        })
        //磁盘大小
        $('.changessd').change(function(){
            if($(this).val()%10!=0){
                $(this).val((parseInt($(this).val()/10)+1)*10);
            }
            getconflist(0);
        })
        $('.sel-cloudpan').change(function(){
            getconflist(0);
        })
        getconflist(0);
    })
    //名称
    $('.servername').blur(function(){
        if($(this).val().length>32||$(this).val().length==''){
            layer.msg('名称不能为空且不能超过32个字符！');
            $(this).css('border-color','red');
        }else{
            $(this).css('border-color','');
        }
    })
    //密码 
    $('.setpsw').blur(function(){
        var val=$(this).val();
        if(val.length<8||val.length>30){
            layer.msg('请输入8至30位字符密码！');
            $(this).css('border-color','red');
        }else{
            $(this).css('border-color','');
        }
    })
    $('.pswconfig').blur(function(){
        var setpswval=$('.setpsw').val();
        var configval=$(this).val();
        if(configval!=setpswval){
            layer.msg('两次输入的密码不一致！');
            $(this).css('border-color','red');
        }else{
            $(this).css('border-color','');
        }
    })
    //购买量
    var incandred=function(obj,type,num,max){
        var thisval=obj.closest('.contain').find('input').val();
        var min=obj.closest('.contain').find('input').data('min');
        thisval=parseInt(thisval);
        if(type==1){
            if(thisval<max){
                thisval=thisval+num;
                obj.closest('.contain').find('input').val(thisval);
                obj.closest('.lanwrap').find('.bval').text(thisval);
                obj.closest('.contain').find('span').removeClass('dsb');
            }else{
                obj.addClass('dsb');
            }
        }
        else{
            if(thisval>min){
                thisval=thisval-num;
                obj.closest('.contain').find('input').val(thisval);
                obj.closest('.lanwrap').find('.bval').text(thisval);
                obj.closest('.contain').find('span').removeClass('dsb');
            }else{
                obj.addClass('dsb');
            }
        }
    }
    //增加
    $('.updown .increase').click(function(){
        incandred($(this),1,1,10);
        getconflist(0);
    })
    //减少
    $('.updown .reduce').click(function(){
        incandred($(this),0,1,10);
        getconflist(0);
    })
    //手动输入
    $('.contain input').blur(function(){
        var val=$(this).val();
        if(val>10){
            $(this).val('10');
        }else if(val<1){
            $(this).val('1');
        }
        getconflist(0);        
    })
    //购买
    $('.buybtn').click(function(){
        getconflist(1);
    })
    
});

//规格选择
function chstandard(param){
    switch(param){
        case 0:$('.currency').show();$('.calculate,.memory').hide();break;
        case 1:$('.calculate').show();$('.currency,.memory').hide();break;
        case 2:$('.memory').show();$('.currency,.calculate').hide();break;
    }
}

//带宽
function bdcost(param){
    switch(param){
        case 0:$('.bdcostp').hide();break;
        case 1:$('.bdcostp').show();break;
    }
}

</script>
<div style="height:72px;line-height:72px;background-color:#fff;box-shadow: 1px 1px 3px rgba(58, 58, 58, 0.2);">
    <div class="w1200" style="margin:0 auto;text-align:left;">
        <span class="text-primary buy-top-title" style="padding-left:5px;">
            创建云主机
        </span>
    </div>
</div>

<div class="main w1200 tl">
    <ul id="mainTab" class="nav nav-tabs mb20">
        <li class="active">
            <a>包年包月<i class="fa fa-caret-left" style="color: red;margin-right: -1px;"></i><span style="color: #fff;background: red;padding: 2px 5px;border-radius: 5px;font-size: 12px;">优惠</span></a>
        </li>
        <li><a>按配置</a></li>
    </ul>
    <div id="mainTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="bytime">
            <table class="table">
                <tbody>
                    <form class="mform">
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span style="margin-top: -35px;">地域与可用区</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">地域：</span>
                                    <ul class="localul">
                                        <li data-val="cn-north-1"><input type="radio" name="regionid" value="cn-north-1" checked>华北-北京</li>
                                        <li data-val="cn-south-1"><input type="radio" name="regionid" value="cn-south-1">华南-广州</li>
                                        <li data-val="cn-east-1"><input type="radio" name="regionid" value="cn-east-1">华东-宿迁</li>
                                        <li data-val="cn-east-2"><input type="radio" name="regionid" value="cn-east-2">华东-上海</li>
                                    </ul>
                                    <i class="fa fa-question-circle-o" title="不同地域资源内网不互通，创建后不可更改。" style="font-size: 16px;color: #60aff6;"></i>
                                </div>
                                <div class="list">
                                    <span class="list-sp">可用区：</span>
                                    <ul class="otherul areaul">
                                        <li><input type="radio" name="area" value="a" checked>可用区A</li>
                                        <li><input type="radio" name="area" value="b">可用区B</li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>镜像</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">镜像类型：</span>
                                    <ul class="otherul imagetypeul">
                                        <li data-val="public">官方</li>
                                        <li data-val="private">私有</li>
                                        <li data-val="shared">共享</li>
                                        <li data-val="thirdparty">镜像市场</li>
                                    </ul>
                                </div>
                                <div class="list spelist">
                                    <div class="spandding" style="position: absolute;width: 480px;height: 32px;top: 0;left: 130px;background-color: rgba(255, 255, 255, 0.5);text-align: center;line-height: 32px;display: none;"><img src="/Application/Home/View/Public/images/loading.gif" height="25px;"></div>
                                    <span class="list-sp">镜像版本：</span>
                                    <select class="form-control ml130 sel-os" style="width: 130px;">
                                        <option value="CentOS">CentOS</option>
                                        <option value="Ubuntu">Ubuntu</option>
                                        <option value="Windows Server">Window Server</option>
                                    </select>
                                    <select class="form-control sel-images" style="width: 350px;" name="imageid">
                                        
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>规格</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">分类：</span>
                                    <ul>
                                        <li class="choose-currency" onclick="chstandard(0)">通用</li>
                                        <li class="choose-calculate" onclick="chstandard(1)">计算优化</li>
                                        <li class="choose-memory" onclick="chstandard(2)">内存优化</li>
                                    </ul>
                                </div>
                                <!-- <div class="standard ml130" style="border: 1px solid #dae2e9;border-bottom: 0;background: #eee;padding: 5px 10px;">
                                    <span>规格类型:</span>
                                    <select class="form-control">
                                        <option>全部</option>
                                        <option>共享型</option>
                                        <option>标准型</option>
                                    </select>
                                    <span>vCPU:</span>
                                    <select class="form-control">
                                        <option>全部</option>
                                        <option>1核</option>
                                        <option>2核</option>
                                        <option>4核</option>
                                        <option>8核</option>
                                        <option>16核</option>
                                        <option>32核</option>
                                        <option>64核</option>
                                        <option>72核</option>
                                    </select>
                                    <span>内存:</span>
                                    <select class="form-control">
                                        <option>全部</option>
                                        <option>16G</option>
                                    </select>
                                    <span>实例规格:</span>
                                    <input type="text" class="form-control" placeholder="例如g.s1.micro">
                                    <button class="btn btn-primary">查询</button>
                                </div> -->
                                <div class="scrollDIV  ml130" style="height: 200px;overflow-y:scroll;">
                                    <table class="table table-bordered tb-standard">
                                        <colgroup><col width="20%"> <col width="20%"> <col width="20%"> <col width="20%"></colgroup>
                                        <thead>
                                            <tr style="background-color: #f7f7f7;">
                                                <th>规格类型</th>
                                                <th>规格</th>
                                                <th>vCPU</th>
                                                <th>内存</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody class="currency">
                                            
                                        </tbody>
                                        <tbody class="calculate" style="display: none;">
                                            
                                        </tbody>
                                        <tbody class="memory" style="display: none;">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <p class="ml130 standardp" style="margin-top: 10px;"></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>存储</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">系统盘：</span>
                                    <select class="form-control ml130 sel-systemdisk">
                                        <option>本地盘</option>
                                    </select> /dev/vda
                                    <i class="fa fa-question-circle-o" title="本地盘赠送40GB。" style="font-size: 16px;color: #60aff6;"></i>
                                </div>
                                <div class="list panlist" style="margin-top: 30px;">
                                    <span class="list-sp">数据盘：</span>
                                </div>
                                <div class="addwrap ml130" style="margin-top: -10px;">
                                    <a class="addpan" href="javascript:void(0)" style="font-size:16px;"><i class="fa fa-plus-circle"></i></a> <span>添加一块云硬盘，一共可增加4块</span>
                                    <i class="fa fa-question-circle-o" title="云硬盘挂载到云主机后，需要进入&#10;云主机操作系统加载该云硬盘。" style="font-size: 16px;color: #60aff6;"></i>
                                    <a class="resetimg" href="javascript:void(0)" class="ml20">恢复镜像默认配置</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>网络</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">私有网络：</span>
                                    <div class="private-net ml130">
                                        <select class="form-control sel-privatenet" style="width: 200px;">
                                            <option>--默认私有网络--</option>
                                        </select>
                                        <select class="form-control sel-subnet" style="width: 200px;">
                                            <option>--默认子网--</option>
                                        </select>
                                        <!-- <a href="javascript:void(0)" class="ml20">新建子网</a> -->
                                    </div>
                                </div>
                                <p class="ml130" style="color: #aaa;">将为您创建一个默认私有网络192.168.0.0/16，并创建一个对应的默认子网192.168.0.0/20。</p>
                                <div class="list">
                                    <span class="list-sp">内网IP：</span>
                                    <div class="private-net ml130">
                                        <select class="form-control sel-netip">
                                            <option value="auto">自动分配</option>
                                            <!-- <option value="custom">自定义</option> -->
                                        </select>
                                        <input class="form-control autoip" type="text" placeholder="系统将自动分配" disabled style="position: relative;bottom: 2px;">
                                        <input class="form-control customip" type="text" placeholder="请输入IP地址" style="position: relative;bottom: 2px;display: none;">
                                    </div>
                                </div>
                                <p class="ml130 autop" style="color: #aaa;">将在<span style="color: #ff9600;">192.168.0.0/20</span>区间内自动分配内网IP</p>
                                <p class="ml130 customp" style="color: #aaa;display: none;">若选择自定义，请在<span style="color: #ff9600;">192.168.0.0/20</span>区间内指定内网IP，若选择自定义内网IP，暂不支持批量创建云主机</p>
                                <div class="list">
                                    <span class="list-sp">安全组：</span>
                                    <div class="private-net ml130">
                                        <select class="form-control" style="width: 400px;">
                                            <option>默认安全组开放全部端口</option>
                                        </select>
                                        <!-- <a href="javascript:void(0)" class="ml20">新建安全组</a> -->
                                    </div>
                                </div>
                                <p class="ml130" style="color: #aaa;">安全组是一种分布式、有状态的虚拟防火墙，用于实现云主机/容器的网络访问控制</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>带宽</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">带宽计费：</span>
                                    <ul class="otherul">
                                        <li class="bybd" onclick="bdcost(0)">按固定带宽</li>
                                        <!-- <li class="byll" onclick="bdcost(1)">按使用流量</li> -->
                                    </ul>
                                </div>
                                <p class="bdcostp ml130" style="display: none;">公网IP费用：<span style="color: #ff9600;">￥0.48/天/个</span>，流量费用：<span style="color: #ff9600;">￥0.80/GB</span>。选择使用流量类型公网IP，使用后付费，以天为单位结算，创建时无需支付费用。与右侧主机计费类型独立。
                                    <i class="fa fa-question-circle-o" title="购买固定带宽类型公网IP根据用户&#10;所选公网出带宽上限计费，单位为Mbps，&#10;适用于网络情况较稳定的业务场景。&#10;购买使用流量类型公网IP则根据用户&#10;实际使用出流量计费，单位为GB，&#10;适用于网络情况波动较大的业务场景。" style="font-size: 16px;color: #60aff6;"></i>
                                </p>
                                
                                <div class="list">
                                    <span class="list-sp">线路：</span>
                                    <ul class="otherul bgpul">
                                        <li><input type="radio" name="provider" value="BGP" checked>BGP</li>
                                        <li style="display: none;"><input type="radio" name="provider" value="nonBGP">非BGP</li>
                                    </ul>
                                </div>
                                <div class="list">
                                    <span class="list-sp">带宽上限：</span>
                                    <div class="demo" style="margin: 20px auto 20px 130px;">
                                        <input type="hidden" id="port" name="bandwidth" class="single-slider port" data-minval="10" value="10" style="display: none;">
                                    </div>
                                </div>
                                <!-- <p class="ml130" style="color: #aaa">支持暂不购买公网IP，可云主机创建完成后另行购买再绑定</p> -->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>基本信息</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp"><span style="color: red;">*</span> 名称:</span>
                                    <input type="text" name="servername" class="form-control ml130 servername" style="width: 400px;">
                                </div>
                                <p class="ml130" style="color: #aaa">不为空且只允许中文、数字、大小写字母、英文下划线“_”及中划线“-”，不超过32字符</p>
                                <div class="list">
                                    <span class="list-sp">描述:</span>
                                    <textarea name="description" class="form-control ml130 description" rows="4" style="width: 400px;"></textarea>
                                </div>
                                <p class="ml130" style="color: #aaa">描述只允许中文、数字、大小写字母、英文下划线“_”及中划线“-”且长度不能超过256字符</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span style="top: 35%;">登录信息</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp" style="top: 65%;">设置密码：</span>
                                    <div class="ml130">
                                    <label class="radio-inline">
                                        <input type="radio" name="issetpsw" value="1" checked style="margin-top: 2px;"> 立即设置
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="issetpsw" value="0" style="margin-top: 2px;"> 暂不设置
                                    </label>
                                    <i class="fa fa-question-circle-o" title="若不设置密码，系统将以短信及邮件方式发送默认密码。" style="font-size: 16px;color: #60aff6;"></i>
                                    </div>
                                </div>
                                <div class="list inp-psd">
                                    <span class="list-sp"><span style="color: red;">*</span> 密码：</span>
                                    <input type="password" class="form-control ml130 setpsw" style="width: 400px;" placeholder="请输入8至30位字符的密码">
                                </div>
                                <div class="list  inp-repsd">
                                    <span class="list-sp" ><span style="color: red;">*</span> 确认密码：</span>
                                    <input type="password" name="password" class="form-control ml130 pswconfig" style="width: 400px;" placeholder="请再次输入密码">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="haveborder">
                            <div class="title"><span>购买量</span></div>
                            <div class="panelcon">
                                <div class="list durlist">
                                    <span class="list-sp">购买时长：</span>
                                    <ul class="otherul durul">
                                        <li data-val="1"><input type="radio" name="duration" value="1" checked>1个月</li>
                                        <li data-val="2"><input type="radio" name="duration" value="2">2个月</li>
                                        <li data-val="3"><input type="radio" name="duration" value="3">3个月</li>
                                        <li data-val="4"><input type="radio" name="duration" value="4">4个月</li>
                                        <li data-val="5"><input type="radio" name="duration" value="5">5个月</li>
                                        <li data-val="6"><input type="radio" name="duration" value="6">6个月</li>
                                        <li data-val="7"><input type="radio" name="duration" value="7">7个月</li>
                                        <li data-val="8"><input type="radio" name="duration" value="8">8个月</li>
                                        <li data-val="9"><input type="radio" name="duration" value="9">9个月</li>
                                        <li data-val="12" title="购买一年云主机享7折优惠"><input type="radio" name="duration" value="12"><i class="fa fa-gift" style="color: red;"></i> 1年</li>
                                        <li data-val="24" title="购买一年云主机享6折优惠"><input type="radio" name="duration" value="24"><i class="fa fa-gift" style="color: red;"></i> 2年</li>
                                        <li data-val="36" title="购买一年云主机享5折优惠"><input type="radio" name="duration" value="36"><i class="fa fa-gift" style="color: red;"></i> 3年</li>
                                    </ul>
                                </div>
                                <div class="list">
                                    <span class="list-sp">数量：</span>
                                    <div class="contain ml130">
                                        <input name="number" type="number" class="form-control buynum" data-min="1" value="1" max="10" min="1" style="width: 60px;"> 
                                        <div class="updown"><span class="fa fa-caret-up increase"></span><span class="fa fa-caret-down reduce"></span></div> 台
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </form>
                    <tr>
                        <td></td>
                    </tr>
                    <tr id="tr-pirce">
                        <td class="haveborder">
                            <div class="title"><span>价格</span></div>
                            <div class="panelcon">
                                <div class="list">
                                    <span class="list-sp">配置价格：</span>
                                    <div style="height:80px;margin-left:130px;position:relative;">
                                        <span style="position:absolute;width:10px;font-size:24px;font-weight:700;color:red;margin-left:0;left:0;">￥</span>
                                        <span class="totalprice" style="position:absolute;font-size:24px;font-weight:700;color:red;margin-left:0;left:20px;">价格计算中...</span>
                                        <p class="p-config" style="position:absolute;top:50px;font-size:14px;"></p>
                                    </div>
                                    <button class="btn buybtn" style="position:absolute;right:10px;top:5%;background-color:red;color:#fff;font-size:20px;font-weight:bold;">立即购买</button>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="price-fix w1200" style="position:fixed;display:block;padding:8px;bottom:0;background-color:#fff;box-shadow: 0px -2px 16px rgba(0, 0, 0, .12);z-index:3;">
                <div class="title"><span>价格</span></div>
                <div class="panelcon">
                    <div class="list">
                        <span class="list-sp">配置价格：</span>
                        <div style="height:80px;margin-left:130px;position:relative;">
                            <span style="position:absolute;width:10px;font-size:24px;font-weight:700;color:red;margin-left:0;left:0;">￥</span>
                            <span class="totalprice" style="position:absolute;font-size:24px;font-weight:700;color:red;margin-left:0;left:20px;">价格计算中...</span>
                            <p class="p-config" style="position:absolute;top:50px;font-size:14px;"></p>
                        </div>
                        <button class="btn buybtn" style="position:absolute;right:10px;top:5%;background-color:red;color:#fff;font-size:20px;font-weight:bold;">立即购买</button>
                    </div>
                    
                </div>
            </div>
        </div>
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
                                    <span style="color: #ffe605;">0527-84224055转800</span>
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
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3004962426&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售小永</span></a>
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
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3004962426&site=qq&menu=yes" target="blank"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售小永</span></a>
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