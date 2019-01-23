$(function(){
    $('.upclose').click(function(){
        window.parent.location.reload();
    })
    $("input[type='radio']").click(function(){
        var tval=$(this).val();
        $('.renprice').text(tval+".00");
    })
    $(".confirm").click(function(){
        var chval=$("input[type='radio']:checked").val();
        var datatype=$("input[type='radio']:checked").attr('data_type');
        var vpsid=$('#vpsid').val();
        $.ajax({
           type: "POST",
           url: "/admin/cloud/renew",
           data:"chval="+encodeURIComponent(chval)+"&datatype="+encodeURIComponent(datatype)+"&vpsid="+encodeURIComponent(vpsid),
           success: function(msg){
               if(msg==1)
               { 
                 layer.msg('系统出错', {icon: 2}); 
                 return;
               }
               else if(msg==2)
               { 
                 layer.msg('余额不足，请充值', {icon: 5});
                 return;
               }
               else
               {
                  layer.msg('操作成功', {icon: 1});
                  window.parent.location.reload();
                  return;
               }
           }
      });
    })
});
