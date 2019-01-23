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
<script>
    $(function(){
        $('.closethis').click(function(){
            window.parent.layer.closeAll();
        });
        var regex = new RegExp('^(?![a-zA-Z]+$)(?![A-Z0-9]+$)(?![A-Z\W_!@#$%^&*`~()-+=]+$)(?![a-z0-9]+$)(?![a-z\W_!@#$%^&*`~()-+=]+$)(?![0-9\W_!@#$%^&*`~()-+=]+$)[a-zA-Z0-9\W_!@#$%^&*`~()-+=]{8,30}$');
        //newpsw光标离开事件
		$(".newpsw").blur(function(){
			var newpwd=$(this).val();
			if(newpwd.length<8||newpwd.length>30){
				$(".newtip").text('请输入8至30位字符密码');
                $(this).css("border-color","red");
			}else if(!regex.test(newpwd)){
                $(".newtip").text('密码必须包含大写字母、小写字母、数字以及特殊符号其中三类！');
                $(this).css("border-color","red");
            }else{
				$(".newtip").text('');
                $(this).css("border-color","");
			}
		});
		//confpsw光标离开事件
		$(".confpsw").blur(function(){
			var confpwd=$(this).val();
			var newpwd=$(".newpsw").val();
			if(confpwd!=newpwd){
				$(".conftip").text('两次输入的密码不一致');
                $(this).css("border-color","red");
			}else{
				$(".conftip").text('');
                $(this).css("border-color","");
			}
		});
		//确定
		$(".config").click(function(){
			var newpwd=$(".newpsw").val();
			var confpwd=$(".confpsw").val();
			var vid=$("input[name=vid]").val();
			if(newpwd.length<8||newpwd.length>30){
				$(".newtip").text('请输入8至30位字符密码');
                $(".newtip").css("border-color","red");
                return;
			}else if(!regex.test(newpwd)){
                $(".newtip").text('密码必须包含大写字母、小写字母、数字以及特殊符号其中三类！');
                $(".newtip").css("border-color","red");
                return;
            }else if(confpwd!=newpwd){
				$(".conftip").text('两次输入的密码不一致');
                $(".conftip").css("border-color","red");
                return;
			}else{
                $(".newtip,.conftip").text('');
                $(".newtip,.conftip").css("border-color","");
                layer.msg('请稍等', {icon: 16,shade: 0.01});
				$.post("pwchange",{'newpwd':newpwd,'vid':vid},function(data,status){
					if(data!=""){
						layer.closeAll(); 
						layer.msg('重置密码成功', {icon: 1});
						setTimeout(function(){
							window.location.reload();
						},1000);
					}
				});
			}
		});
    })
</script>
</head>
<body>
<style>
.mr20{margin-right: 20px}
.main{text-align: center;padding: 25px 30px;}
.alert{height: 34px;padding: 6px;}
.pswgroup{margin: 10px 0;}
.pswlabel{display: inline-block;width: 90px;text-align: right;}
.form-control{display: inline-block;border-radius: 0;width: 380px;}
.bottom{position: absolute;bottom: 0;right: 0;width: 100%;height: 50px;line-height: 50px;background: #f8f8f8;text-align: right;padding: 0 30px;}
.newtip,.conftip{color: red;width: 380px;margin-left: 125px;text-align: left;font-size:12px;}
.btn-primary{background: #60aff6;border: 1px solid #60aff6;}
.btn-primary:hover{background: #2e86d3;border: 1px solid #2e86d3;}
</style>
<div class="main">
    <div class="alert alert-danger">请注意：云主机密码重置完成后，需在控制台重启云主机才能生效</div>
    <div class="pswgroup">
        <span class="pswlabel">新密码：</span>
        <input class="form-control newpsw" type="password">
        <p class="newtip"></p>
    </div>
    <div class="pswgroup">
        <span class="pswlabel">确认密码：</span>
        <input class="form-control confpsw" type="password">
        <p class="conftip"></p>
    </div>
</div>
<div class="bottom">
    <button class="btn btn-default mr20 closethis">取消</button>
    <button class="btn btn-primary config">确定</button>
    <input type="hidden" name="vid" value="<?php echo ($vid); ?>">
</div>
</body>
</html>