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
.mr20{margin-right: 20px}
.ml20{margin-left: 20px}
.main{text-align: center;padding: 25px 30px;}
.alert{height: 52px;padding: 6px;}
.pswgroup{margin: 10px 0;text-align: left;}
.pswgroup a{color: #60aff6;cursor: pointer;}
.pswlabel{display: inline-block;width: 90px;text-align: right;}
.form-control{display: inline-block;border-radius: 0;width: 380px;}
.bottom{position: absolute;bottom: 0;right: 0;width: 100%;height: 50px;line-height: 50px;background: #f8f8f8;text-align: right;padding: 0 30px;}
.newtip,.conftip{color: red;width: 380px;margin-left: 95px;text-align: left;font-size:12px;}
.onthis{background-color: #60aff6 !important;color: #fff;}
.imagetypeul{display: inline-block;}
.imagetypeul li{float: left;position: relative;margin-left: -1px;min-width: 46px;height: 30px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 30px;font-size: 13px;padding: 0 12px;}
.imagetypeul li:hover{background: #60aff6;color: #fff;}
.btn-primary{background: #60aff6;border: 1px solid #60aff6;}
.btn-primary:hover{background: #2e86d3;border: 1px solid #2e86d3;}
</style>
<script>
    $(function(){
        var href=window.location.href;
        var paramarr=href.split('?')[1];
        var paramarr=paramarr.split('&');
        var regionid=paramarr[0].split('=')[1];
        var instanceid=paramarr[1].split('=')[1];
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
				$.post("reos",$('.mform').serialize()+"&instanceid="+instanceid+"&regionid="+regionid+"&imagename="+$('.imagetext').text(),function(data,status){
					layer.closeAll(); 
                    if(data=="0"){
						layer.msg('修改成功', {icon: 1});
					}else if(data=="1"){
						layer.msg('修改失败,请联系管理员处理', {icon: 2});
                    }else{
						layer.msg(data, {icon: 2});
                    }
				});
			}
		});
        var onthis=function(cthis){
            cthis.closest('.imagetypeul').find('li').removeClass('onthis');
            cthis.addClass('onthis');
        }
        //获取镜像版本
        var getimagelist=function(){
            var imagesource=$('.imagetypeul').find('.onthis').data('val');
            var platform=$('.sel-os').children("option:selected").val();
            $.post("/Admin/Jdcloud/getimage",{"regionid":regionid,"imagesource":imagesource,"platform":platform},function(data,status){
                data=JSON.parse(data);
                var images=data['msg']['result']['images'];
                if(images!=null){
                    var options="<option value=''>请选择镜像版本</option>";
                    for(var i=0;i<images.length;i++){
                        options+="<option value="+images[i]['imageId']+">"+images[i]['name']+"</option>";
                    }
                    $('.sel-images').html(options);
                    $('.spandding').hide();
                }else{
                    $('.sel-images').html('<option value="">暂无镜像</option>');
                    $('.spandding').hide();
                }
            });
        }
        getimagelist();
        $('.imagetypeul li').click(function(){
            onthis($(this));
            if($(this).index()==3){
                $('.sel-os').hide();
            }else{
                $('.sel-os').show();
            }
            getimagelist();
        });
        //选择系统
        $(".sel-os").change(function(){  
            getimagelist();        
        });
        //更换镜像
        $('.replaceimg').click(function(){
            if($(this).text()=="更换镜像"){
                $(this).text("使用原镜像");
            }else{
                $(this).text("更换镜像");
                $('.imagetext').text($('.rootimgname').val());
                $('.imageid').val($('.rootimgid').val());
            }
            $('.imgtypegp,.imggp').toggle();
        })
        //选择镜像
        $(".sel-images").change(function(){
            $('.imagetext').text($(this).children('option:selected').text());
            $('.imageid').val($(this).children('option:selected').val());
        })
    })
</script>
</head>
<body>

<div class="main">
    <div class="alert alert-danger">注意：重置系统只针对系统盘做初始化/更换操作系统，该操作会清空云主机系统盘内数据，请您做好备份，若由于未备份造成的数据丢失，蒲公英概不负责。重置系统需重新加载已挂载的数据盘。</div>
    <form class="mform">
    <div class="pswgroup">
        <span class="pswlabel">当前镜像：</span>
        <input type="hidden" class="rootimgid" value="<?php echo ($cloudlist["imageId"]); ?>">
        <input type="hidden" class="rootimgname" value="<?php echo ($imagename); ?>">
        <input type="hidden" class="imageid" name="imageid" value="<?php echo ($cloudlist["imageId"]); ?>">
        <span class="imagetext"><?php echo ($imagename); ?></span>
        <a class="ml20 replaceimg">更换镜像</a>
    </div>
    <div class="pswgroup imgtypegp" style="display: none;">
        <span class="pswlabel" style="position: relative;top: -10px;">镜像类型：</span>
        <ul class="imagetypeul">
            <li class="onthis" data-val="public">官方</li>
            <li data-val="private">私有</li>
            <li data-val="shared">共享</li>
            <li data-val="thirdparty">镜像市场</li>
        </ul>
    </div>
    <div class="pswgroup imggp" style="display: none;">
        <span class="pswlabel">镜像：</span>
        <select class="form-control sel-os" style="width: 150px;">
            <option value="">请选择镜像类型</option>
            <option value="CentOS">CentOS</option>
            <option value="Ubuntu">Ubuntu</option>
            <option value="Windows Server">Window Server</option>
        </select>
        <select class="form-control sel-images" style="width: 350px;">
                                    
        </select>
    </div>
    <div class="pswgroup">
        <span class="pswlabel">系统盘：</span>
        <span>本地盘（40GB）</span>
    </div>
    <div class="pswgroup">
        <span class="pswlabel">用户名：</span>
        <span>root</span>
    </div>
    <div class="pswgroup">
        <span class="pswlabel">密码：</span>
        <input class="form-control newpsw" name="password" type="password">
        <p class="newtip"></p>
    </div>
    <div class="pswgroup">
        <span class="pswlabel">确认密码：</span>
        <input class="form-control confpsw" type="password">
        <p class="conftip"></p>
    </div>
    </form>
</div>
<div class="bottom">
    <button class="btn btn-default mr20 closethis">取消</button>
    <button class="btn btn-primary config">确定</button>
</div>
</body>
</html>