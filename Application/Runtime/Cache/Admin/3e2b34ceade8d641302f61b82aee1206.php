<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>[title]</title>
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
<style>
.main{padding: 15px;}
.table{margin-bottom: 0;}
.table-wrap{background: #fff;padding: 15px;}
.table>thead>tr>th{border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;background: #dee6eb;padding: 8px 15px;}
.table-condensed>tbody>tr>td{padding: 7px 15px;border: 0px;}
.childrenew .table>thead>tr>th{background: #fff !important;padding: 6px 15px !important;font-weight: 500;}
.childrenew .table-condensed>tbody>tr>td{border-top:1px dotted #ddd;padding: 6px 20px;color: #888;}
.onthis{background-color: #60aff6 !important;color: #fff;}
.panelcon .list{position: relative;margin:10px auto;}
.panelcon .list ul{height:30px;line-height:30px;display:inline-block;cursor: pointer;position: relative;top:10px;}
.panelcon .list ul li{float: left;position: relative;margin-left: -1px;min-width: 46px;height: 30px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 30px;font-size: 13px;padding: 0 12px;}
.panelcon .list ul li:hover{background: #60aff6;color: #fff;}
.btn-primary{background: #60aff6;border: 1px solid #60aff6;}
.btn-primary:hover{background: #2e86d3;border: 1px solid #2e86d3;}
.panelcon .list ul li input{position: absolute;width: 100%;height: 100%;left: 0;opacity: 0;cursor: pointer;}
.cuscheckbox{width: 16px;height: 16px;display: inline-block;border: 1px solid #ddd;border-radius: 2px;background: #fff url(/Application/Admin/View/Public/img/check_right.png) center;cursor: pointer;margin-right: 5px;position: relative;top: 2px;}
.cuschecked{background: #60aff6  url(/Application/Admin/View/Public/img/check_right.png) center !important;border: 1px solid #60aff6 !important;}
</style>
<script>
$(function(){
    var href=window.location.href;
    var paramarr=href.split('?')[1];
    var paramarr=paramarr.split('&');
    var regionid=paramarr[0].split('=')[1];
    var instanceid=paramarr[1].split('=')[1];
    var totalprice;
    var onthis=function(cthis,isbuy){
        cthis.closest('.otherul').find('li').removeClass('onthis');
        cthis.addClass('onthis');

        var duration=$('.durul').find('.onthis').attr('data-val');
        var formdata="duration="+duration;
        if(isbuy==0){
            $('.totalprice').text('价格计算中...');
            var price=<?php echo ($info["price"]); ?>;
            if (!isNaN(price)) 
            {
                $('.totalprice').text("订单金额￥"+parseInt(price*duration)+".00");
                $('.price').text(parseInt(price*duration)+".00");
                totalprice=parseInt(price*duration);
            }
            else
            {
                $('.totalprice').text('价格获取失败');
            }  
        }else{
            var cloudno='<?php echo ($info["cloudno"]); ?>';
            formdata+="&cloudno="+cloudno;
            $.post('renewnow',formdata,function(data,status){
                if(data==0){
                    layer.msg("续费成功",{"icon":1});
                }else{
                    layer.msg(data,{"icon":2});
                }
            })
        }
    }
    $('.otherul li').click(function(){
        onthis($(this),0);
    })
    $('.buy-btn').click(function(){
        onthis($(this),1);
    })
    $('.cuscheckbox').click(function(){
        if($(this).index()!=0){
            if($(this).hasClass('cuschecked')){
                for(var i=1;i<4;i++){
                    $(this).eq(i).removeClass('cuschecked');
                }
            }else{
                for(var i=1;i<4;i++){
                    $(this).eq(i).addClass('cuschecked');
                }
            }
        }else{
            if($(this).hasClass('cuschecked')){
                $(this).removeClass('cuschecked');
            }else{
                $(this).addClass('cuschecked');
            }
        }
        if($(this).hasClass('cuschecked')&&$(this).hasClass('specheck')){
            $('.specheck').removeClass('cuschecked');
        }else if(!$(this).hasClass('cuschecked')&&$(this).hasClass('specheck')){
            $('.specheck').addClass('cuschecked');
        }else if($(this).hasClass('cuschecked')&&!$(this).hasClass('specheck')){
            
        }
    })
})
</script>
</head>
<body style="background: #f4f4f4;">
    <div class="main">
        <div class="alert alert-success">按配置计费资源完成续费后，将变更资源的计费方式为包年包月。</div>
        <div class="table-wrap">
            <table class="table table-condensed maintable">
                <colgroup><col width="25%"> <col width="25%"> <col width="25%"> <col width="25%"></colgroup>
                <thead>
                    <tr>
                        <th>待续费项</th>
                        <th>当前计费类型</th>
                        <th>当前到期时间</th>
                        <th>续费后到期时间</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="cuscheckbox cuschecked"></span>云主机：<?php echo ($cloudlist["instanceName"]); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="padding: 5px 0;">
                            <div class="childrenew">
                                <table class="table table-condensed" style="border: 1px solid #ddd;">
                                    <colgroup><col width="25%"> <col width="25%"> <col width="25%"> <col width="25%"></colgroup>
                                    <thead>
                                        <tr>
                                            <th><span class="cuscheckbox specheck cuschecked"></span>云主机<?php echo ($cloudlist["instanceName"]); ?>绑定资源</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="cuscheckbox specheck cuschecked"></span>公网ip：<?php echo ($cloudlist["elasticIpAddress"]); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="panelcon" style="padding: 5px 30px;background: #fff;border-top: 1px solid #ccc;">
            <div class="list durlist">
                <p><span class="cuscheckbox specheck cuschecked"></span>将云主机绑定的其它资源一并续费</p>
                <span class="list-sp">购买时长：</span>
                <ul class="otherul durul">
                    <li data-val="1" class="onthis"><input type="radio" name="duration" value="1" checked>1个月</li>
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
        </div>
        <div class="bottom" style="height: 65px;line-height: 65px;background: #fff;margin-top: 30px;position: absolute;bottom: 0;left:0;width: 100%;padding: 10px 25px;box-shadow: 0 -2px 6px rgba(220,223,228,.5)">
            <button class="btn btn-primary buy-btn" style="float: right;">去支付</button>
            <p style="float: right;margin-right:15px;">
                <span>费用：</span><span class="price" style="color: #ff9600;font-size: 24px;">￥<?php echo ($info["price"]); ?>.00</span></br>
                <span style="color: #666;font-size: 12px;" class="totalprice">订单金额￥<?php echo ($info["price"]); ?>.00</span><span style="color: #60aff6;margin-left:15px;font-size: 12px;">省￥0.00</span>
            </p>
            
        </div>
    </div>
</body>
</html>