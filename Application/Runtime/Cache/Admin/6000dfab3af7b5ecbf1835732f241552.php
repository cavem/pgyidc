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
<link href="/Application/Admin/View/Public/css/jquery.range.css" rel="stylesheet">
<script src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.cookie.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Public/layui/layui.all.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.range.js" type="text/javascript"></script>
<style>
.main{text-align: center;padding: 25px 30px;}
.pswgroup{margin: 10px 0;text-align: left;}
.pswlabel{display: inline-block;width: 90px;text-align: right;color:#888;}
.bottom{position: absolute;bottom: 0;right: 0;width: 100%;height: 50px;line-height: 50px;background: #f8f8f8;text-align: right;padding: 0 30px;border-top: 1px solid #eee;}
</style>
<script>
$(function(){
    $('.closethis').click(function(){
        window.parent.layer.closeAll();
    });
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
        },500)
    });
    //queidng
    $(".config").click(function(){
        
    })
})
</script>
</head>
<body>
    <div class="main">
        <div class="pswgroup">
            <span class="pswlabel" style="position: relative;bottom: 10px;">带宽上限：</span>
            <div class="demo" style="display: inline-block;">
                <input type="hidden" name="bandwidth" class="single-slider port" data-minval="1" value="1" style="display: none;">
            </div>
        </div>
        <div class="pswgroup" style="margin-top: 50px;">
            <span class="pswlabel">费用：</span>
            <span class="price" style="color: #ff9600;font-size: 24px;">￥00.00</span>/月
        </div>
    </div>
    <div class="bottom">
        <button class="btn btn-default mr20 closethis">取消</button>
        <button class="btn btn-primary config">确定</button>
    </div>
</body>
</html>