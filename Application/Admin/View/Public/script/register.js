/**
 * Created by hefei on 2016/12/16.
 */
//防止被嵌套
if (top.location !== self.location) {
    top.location.href = self.location.href;
}

function check() {  
      //alert("check1");  return;
      var cusTypeSbmData = $("#cusTypeSbmData").val();  
      if (cusTypeSbmData == "Firm") {  
          var cusname=$("#cusName").val();
          if (cusname=="") {
            $("#formtips").html('请输入企业名称'); return false;  
          }
      }
      var email=$("#email").val();
      if (email=="") {
        $("#formtips").html('请输入邮箱'); return false;  
      } 
      var password=$("#password").val();
      if (password=="") {
        $("#formtips").html('请输入密码'); return false;  
      }
      if(password.length<8){
        $("#formtips").html('密码长度必须大于八位'); return false;
      }
      var password_confirmation=$("#password_confirmation").val();
      if (password_confirmation=="") {
        $("#formtips").html('请重复输入密码'); return false;  
      }
      if (password_confirmation!=password) {
        $("#formtips").html('两次密码输入不一致'); return false;  
      }
      var verifyCode=$("#verifyCode").val();
      if (verifyCode=="") {
        $("#formtips").html('请输入短信验证码'); return false;  
      }
      document.mform.action="/Admin/User/reging";
      document.mform.target="";
      document.mform.submit(); 
}

function yzcode()
{
  var mobile=$("#mobile").val();
  var email=$("#email").val();
  if(mobile=="")
  {
    $("#formtips").html('请输入手机号'); return false;  
  }
  $.ajax({
       type: "POST",
       url: "/Admin/User/yzcode",
       data:"mobile="+mobile+"&email="+email,
       success: function(msg){
           if(msg==1)
           { 
             layer.msg('系统出错', {icon: 2}); 
             return;
           }
           else if(msg==2)
           { 
             layer.msg('未匹配到相关用户', {icon: 5});
             return;
           }
           else
           {
              $("#crmid").val(msg);
              $("#J_getCode").css('pointer-events','none');
              $("#J_getCode").css('background','#FFF');
              timedCount(); 
              layer.msg('验证码已发送至手机', {icon: 6}); 
              return;
           }
       }
  });
}

var c=60;
function timedCount()
{
   var sec=c+"秒"; 
   $("#J_getCode").html(sec);
   c=c-1;
   t=setTimeout("timedCount()",1000);
   if(c==-1)
   {
     clearTimeout(t);
     $("#J_getCode").css('pointer-events','auto');
     $("#J_getCode").css('background','#FFF');
     $("#J_getCode").html("获取验证码");
     c=60;
   }
}

$(document).ready(function () {
    $(".tabs-item ul li").click(function () {
        $(this).addClass("active").siblings("li").removeClass("active");
        $(".from-wrapper").eq($('.tabs-item ul li').index(this)).show().siblings(".from-wrapper").hide();
        $(".check-error-tips").html('');
    });
    /**
     * 注册用户类型切换
     */
    $(".tab-switch-component .tab-switch").click(function () {
        $(this).addClass("active").siblings(".tab-switch").removeClass("active");
        var active_id = $(this).attr("id");
        $(".check-error-tips").html('');
        if (active_id == "Firm") {
            $("#contactName").show();
        } else if (active_id == "self") {
            $("#contactName").hide();
        }
        $("#cusTypeSbmData").val(active_id);
    });

    

    // $("#register").on('click', function() { 
    //  alert("check2");  return;
    //     var excel_file = $("#excel_file").val();  
    //     if (excel_file == "" || excel_file.length == 0) {  
    //         alert("请选择文件路径！");  
    //         return false;  
    //     } else {  
    //         return true;  
    //     }  
    // });

    // $(".tab-yz .tab-s").click(function () {
    //     $(this).addClass("active").siblings(".tab-s").removeClass("active");
    //     var active_id = $(this).attr("id");
    //     $(".check-error-tips").html('');
    //     if (active_id == "emailyz") {
    //         $("#contactName").show();
    //     } else if (active_id == "phoneyz") {
    //         $("#contactName").hide();
    //     }
    // });
});


