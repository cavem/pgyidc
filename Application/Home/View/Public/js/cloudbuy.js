$(function(){var domain=window.location.host;var totalprice;var onthis=function(cthis){cthis.closest(".list").find("li").removeClass("onthis");cthis.addClass("onthis")};function getN(s){return s.replace(/[^0-9]/ig,"")}var configblock=function(isbuy){var cloudtype=$(".cloudtype").find(".onthis").data("val");var config=$(".config").find(".onthis").data("val").toString();var cpu=$(".cpu").find(".onthis").data("val").toString();var mmr=$(".mmr").find(".onthis").data("val");var ssd=$(".ssd").find(".onthis").data("val");var port=$(".port").val()<10?"10":$(".port").val().toString();var ostype=$(".select-os").children("option:selected").val();switch(ostype){case"win":var os=$(".winselect").children("option:selected").text();var osid=$(".winselect").children("option:selected").val().toString();break;case"linux":var os=$(".linuxselect").children("option:selected").text();var osid=$(".linuxselect").children("option:selected").val().toString();break}var ip=$(".ip").find(".onthis").data("val");var dur=$(".dur").find(".onthis").data("val").toString();var cloudtypetxt=$(".cloudtype").find(".onthis").text();var configtxt=$(".config").find(".onthis").text();var durtxt=$(".dur").find(".onthis").text();$(".p-config").text(cloudtypetxt+" "+configtxt+" "+cpu+"核(cpu) "+mmr+"G(内存) "+ssd+"(硬盘) "+port+"M(端口) "+os+"(系统) "+ip+"(ip) "+durtxt+"(时长)");if(isbuy==0){$(".totalprice").text("价格计算中...");$.post("http://"+domain+"/Home/Index/cloudbuyreq/",{"cloudtype":cloudtype,"config":config,"cpu":cpu,"mmr":mmr,"ssd":ssd,"port":port,"os":os,"ip":ip,"dur":dur},function(data,status){if(status=="success"){$(".totalprice").text(data);totalprice=data}})}else{totalprice=totalprice.toString();var balance=$(".balance").val().toString();var userid=$(".userid").val();var yungoid=$(".yungoid").val();var ssdnum=getN(ssd).toString();var mmrm=(mmr*1024).toString();var ipnum=getN(ip).toString();var base=new Base64();if(userid==""){window.location.href="http://"+domain+"/Admin/login"}else{if(osid=="--"){layer.msg("请选择系统镜像！",{time:2000,})}else{if(parseInt(balance)<parseInt(totalprice)){layer.msg("余额不足！是否立即前往充值。",{time:20000,btn:["确定","关闭"],yes:function(){window.location.href="http://"+domain+"/Admin/Index/index"}})}else{$.post("http://"+domain+"/Home/Index/isbuyreq/",{"yungoid":base.encode(yungoid),"userid":base.encode(userid),"cid":base.encode(config),"cpu":base.encode(cpu),"ram_max":base.encode(mmrm),"ram_min":base.encode("1024"),"disk":base.encode(ssdnum),"bandwidth":base.encode("0"),"port":base.encode(port),"osid":base.encode(osid),"additionalips":base.encode(ipnum),"totalprice":base.encode(totalprice),"dur":base.encode(dur)},function(data,status){if(data=="success"){console.log(data);layer.msg("购买成功！请前往控制台查看",{time:2000,})}else{console.log(data);layer.msg("购买失败！",{time:2000,})}})}}}}};var init=function(){var cloudid=$(".cloudid").val();var configcid=$(".configcid").val();$(".cloudtype"+cloudid).addClass("onthis");$(".config"+configcid).addClass("onthis");$(".list").find(".otherul:eq(0)").find("li:eq(0)").addClass("onthis");switch(configcid){case"4":$(".dur:eq(1)").css("display","block");$(".dur:eq(0),.dur:eq(2)").css("display","none");$(".durlist").find("li").removeClass("onthis");$(".durlist").find(".otherul:eq(1)").find("li:eq(0)").addClass("onthis");break;case"6":$(".dur:eq(2)").css("display","block");$(".dur:eq(0),.dur:eq(1)").css("display","none");$(".durlist").find("li").removeClass("onthis");$(".durlist").find(".otherul:eq(2)").find("li:eq(0)").addClass("onthis");break}configblock(0)};init();$(".otherul li").click(function(){var cthis=$(this);onthis(cthis);configblock(0)});$(".cloudtype li").click(function(){var keyid=$(this).data("val");window.location.href="http://"+domain+"/Home/Index/cloudbuy/id/"+keyid});$(".config li").click(function(){var keycid=$(this).data("val");window.location.href="http://"+domain+"/Home/Index/cloudbuy/cid/"+keycid});$(".single-slider").jRange({from:10,to:100,step:1,scale:[10,25,50,75,100],format:"%s",width:500,showLabels:true,showScale:true});$(".demo").parent(".list").mouseup(function(){var port=$(".port").val();var minport=$(".port").data("minval");if(port<minport){window.location.reload()}configblock(0)});$(".select-os").change(function(){var val=$(this).children("option:selected").val();switch(val){case"win":$(".selewin").css("display","block");$(".selelinux").css("display","none");break;case"linux":$(".selelinux").css("display","block");$(".selewin").css("display","none");break}});$(".winselect,.linuxselect").change(function(){configblock(0)});$(".buybtn").click(function(){configblock(1)});$(".haveborder").mouseenter(function(){$(this).find(".title").css("background-color","#60aff6");$(this).find(".title span").css("color","#fff")});$(".haveborder").mouseleave(function(){$(this).find(".title").css("background-color","#ddd");$(this).find(".title span").css("color","#888")});$(window).scroll(function(){var docheight=$(window).height();var trpircetop=$("#tr-pirce").offset().top-$(window).scrollTop();if(trpircetop+90<docheight){$(".price-fix").css("display","none")
}else{$(".price-fix").css("display","block")}})});