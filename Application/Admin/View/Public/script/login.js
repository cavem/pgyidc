document.onkeydown=function(e){e=e||window.event;if(e.keyCode==13){$("#loginin").click()}};$(function(){$("#loginin").click(function(){var name=$("#uid").val();var pwd=$("#pwd").val();if(name==""||pwd==""){layer.msg("用户名或密码不能为空",{icon:5});return false}layer.msg("登录中...",{icon:16,shade:0.01});$.ajax({type:"POST",url:"User/loginin",data:$("#mform").serialize(),success:function(msg){if(msg==0){window.location.href="index/index";return false}else{if(msg==2){layer.msg("密码输入有误",{icon:2});return false}else{if(msg==1){layer.msg("登录失败，如有必要可联系管理员",{icon:2});return false}else{if(msg==3){layer.msg("非法访问",{icon:2});return false}else{if(msg==4){layer.msg("验证码错误",{icon:2});return false}}}}}}})})});