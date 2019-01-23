<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>余额充值</title>
	<link rel="stylesheet" href="/Public/layui/css/layui.css" media="all" />
</head>
<body class="admin-main">
	<form id="form">
		<div class="user_left" style="margin-top: 2em">
			<div class="llayui-inline">
			    <label class="layui-form-label">操作类型</label>
				<div class="layui-input-inline">
					<select id="datatype" name="datatype" style="height:38px;line-height:1.3;width: 190px;border-color: #d5d5d5">
						<option value="0">充值</option>
	    				<option value="1">消费</option>
					</select>
				</div>
				<div style="clear: both;margin-bottom:1em;"></div>
				<label class="layui-form-label">输入金额</label>
			    <div class="layui-input-inline">
			    	<input type="text" id="money" name="money" value="" class="layui-input" style="width: 190px;" onkeyup="value=value.replace(/[^\d]/g,'');">
			    	<p>金额需输入10的倍数</p>
			    </div>
			</div>
		</div>
		<div class="layui-form-item" style="margin-top: 1em">
		    <div class="layui-input-block">
		    	<button class="layui-btn" id="tj">提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				<input type="hidden" name="userid" value="<?php echo ($userid); ?>"/>
		    </div>
		</div>
	</form>
	<script src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script>
	$(function () {
        $('#tj').click(function () {
            var money=$("#money").val();
            if(money=="")
            {
                alert('请输入金额');              
                $("#money").focus();
                return false;
            }
            $("#form").attr("action", "/Admin/Officweb/recharge");
            $("#form").submit();
			$(this).attr('disabled',true);
        });
    });
	</script>
</body>
</html>