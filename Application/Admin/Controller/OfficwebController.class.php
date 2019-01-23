<?php
namespace Admin\Controller;
use Think\Controller;
class OfficwebController extends BaseController {
    //官网导航栏类别
    public function navlistAction(){
        parent::nosession();
    	//先查询一级类别
    	$navModel=D('navigation');
    	$first = $navModel->where('NavFatherID =%d',0)->order('NavType DESC,NavID ASC')->select();
    	foreach ($first as $k => $f) {
            //获取二级类别
            if (!empty($first)) {
                $sec = $navModel->where('NavFatherID =%d',$f['navid'])->select();
                $first[$k]['sec']=$sec;
                foreach ($first[$k]['sec'] as $ke => $s) {
                    if (!empty($sec)) {
                        //获取三级类别
                        $thr = $navModel->where('NavFatherID =%d',$s['navid'])->select();
                        $first[$k]['sec'][$ke]['thr']=$thr;
                    }
                }
            }
        }
        $this->assign('datatype',$first);
    	$this->assign('guanwang',1);
    	$this->assign('daohang',1);
    	$this->display();
    }

    //导航详情页面
    public function navinfoAction()
    {
        parent::nosession();
    	$navModel=D('navigation');
    	$id=I('id/d');
    	if (!empty($id)) {
    		//编辑
    		$info = $navModel->where('NavID =%d',$id)->find();
    		$this->assign('info',$info);
    		$this->assign('navid',$id);
    	}
    	//获取类别
    	$first = $navModel->where('NavFatherID =%d',0)->select();   	
    	foreach ($first as $k => $f) {
    		//获取二级类别
    		if (!empty($first)) {
	    		$sec = $navModel->where('NavFatherID =%d',$f['navid'])->select();
	    		$first[$k]['sec']=$sec;
	    		foreach ($first[$k]['sec'] as $ke => $s) {
	    			if (!empty($sec)) {
		    			//获取三级类别
		    			$thr = $navModel->where('NavFatherID =%d',$s['navid'])->select();
		    			$first[$k]['sec'][$ke]['thr']=$thr;
	    			}
	    		}
	    	}
    	}
    	$this->assign('datatype',$first);
    	$this->assign('guanwang',1);
    	$this->assign('daohang',1);
    	$this->display();
    }

    //导航添加/修改
    public function navaddAction()
    {
        parent::nosession();
    	$navModel=D('navigation');
    	$navid=I('navid/d');
    	$navname=I('navname/s');
    	$navurl=I('navurl/s');
    	$navfatherid=I('fatherid/d');
    	$data=array(
    		"NavName"=>$navname,
    		"NavUrl"=>$navurl,
    		"NavFatherID"=>$navfatherid=="-1"?0:$navfatherid,
            "NavType"=>$navfatherid=="-1"?1:0
    	);
    	if (empty($navid)) {
    		$navModel->add($data);
    	}
    	else
    	{
    		$navModel->where('NavID= %d',$navid)->save($data);
    	}
    	$this->success('保存成功', U('officweb/navlist'));
    }

    public function newslistAction(){
        parent::nosession();
        //获取文章列表
        $navModel=D('navigation');
        $newslist=D('newslist');
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $map['Title']=array('like','%'.$key.'%');
        $count = $newslist->where($map)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $Page->parameter['keyword'] =  $key;
        $show = $Page->show();// 分页显示输出
        $res=$newslist->limit($Page->firstRow.','.$Page->listRows)->where($map)->order('ID DESC')->select();
        foreach ($res as $k => $r) {
            //获取类别名称
            $navname = $navModel->field('NavName')->where('NavID =%d',$r['datatype'])->find();
            $res[$k]['navname']=$navname['navname'];
        }
        $this->assign('model', $res);
        $this->assign('page',$show);
        $this->assign('keyword',$key);

    	$this->assign('guanwang',1);
    	$this->assign('mokuai',1);
    	$this->display();
    }


    //文章详情页面
    public function newsinfoAction()
    {
        parent::nosession();
        $newslist=D('newslist');
        $id=I('id/d');
        if (!empty($id)) {
            //编辑
            $info = $newslist->where('ID =%d',$id)->find();
            $this->assign('info',$info);
            $this->assign('newsid',$id);
        }
        $navModel=D('navigation');
        $navlist = $navModel->where('NavType =%d',1)->select(); 
        $this->assign('navlist',$navlist);
        $this->assign('guanwang',1);
        $this->assign('mokuai',1);
        $this->display();
    }

    //文章添加/修改
    public function newsaddAction()
    {
        parent::nosession();
        $newslist=D('newslist');
        $id=I('newsid/d');
        $datatype=I('datatype/d');
        $title=I('navname/s','','htmlspecialchars');
        $content=I('content/s','','');
        $newslist=M('newslist');
        $data=array(
            'Title'=>$title,
            'Content'=>$content,
            'DataType'=>$datatype,
            'data'=>time(),
        );
        if (!empty($id)) {
            //编辑
            if (!$newslist->create($data)) {
                $this->error($newslist->getError());
            }else{
                if ($newslist->where('ID = %d',$id)->save($data)) {
                    $this->success('提交成功',U('officweb/newslist'));
                } else {
                    $this->error('更新失败');
                }        
            }
        }
        else
        {
            if (!$newslist->create($data)) {
                $this->error($newslist->getError());
            }else{
                if ($newslist->add($data)) {
                    $this->success('提交成功',U('officweb/newslist'));
                } else {
                    $this->error('提交失败');
                }        
            }
        }
    }

    //文章删除
    public function newsdelAction()
    {
        parent::nosession();
        $id=I('id/d');
        $newslist=D('newslist');
        if ($newslist->delete($id)) {
            $this->success('删除成功',U('officweb/newslist'));
        } else {
            $this->error('删除失败');
        }
    }

    /*---------------------------------云主机报价---------------------------------------*/
    public function configlistAction(){
        parent::nosession();
        $configlistModel=D('configlist');
        $cpage=I('p/d',1);
        $fid=I('fid/d',0);//0BGP云主机 1单线云主机 2高防云主机
        $map['DataType']=array('eq',0);
        $res=$configlistModel->where($map)->order('Px ASC')->select();
        $this->assign('model', $res);//配置信息
        $this->assign('datatype',$datatype);
        $this->assign('product',1);
        $this->assign('quote',1);
        $this->assign('fid',$fid);
        $this->display();
    }

    //产品分组详情页面
    public function configinfoAction()
    {
        parent::nosession();
        $configlistModel=D('configlist');
        $id=I('id/d');
        if (!empty($id)) {
            //编辑
            $info = $configlistModel->where('ID =%d',$id)->find();
            $this->assign('info',$info);
            $this->assign('id',$id);
        }
        $this->assign('product',1);
        $this->assign('quote',1);
        $this->display();
    }

    public function configaddAction()
    {
        parent::nosession();
        $configlistModel=D('configlist');
        $id=I('id/d');
        $px=I('px/d',0);
        $title=I('title/s','','htmlspecialchars');
        $property=I('property/d',0);
        $data=array(
            'Title'=>$title,
            'Property'=>$property,
            'Px'=>$px,
        );
        if (!empty($id)) {
            //编辑
            if (!$configlistModel->create($data)) {
                $this->error($configlistModel->getError());
            }else{
                if ($configlistModel->where('ID = %d',$id)->save($data)) {
                    echo "<script>window.parent.window.stopupload(0); </script>";
                    exit();
                } else {
                    echo "<script>window.parent.window.stopupload(1); </script>";
                    exit();
                }        
            }
        }
        else
        {
            if (!$configlistModel->create($data)) {
                $this->error($configlistModel->getError());
            }else{
                if ($configlistModel->add($data)) {
                    echo "<script>window.parent.window.stopupload(0); </script>";
                    exit();
                } else {
                    echo "<script>window.parent.window.stopupload(1); </script>";
                    exit();
                }        
            }
        }
    }
    //云架构
    public function cloudlistAction(){
        parent::nosession();
        //获取文章列表
        $configModel=D('configinfo');
        $cpage=I('p/d',1);
        $configlistModel=D('configlist');
        $cl=$configlistModel->field('ID,Title')->where('Property=0')->order('Px ASC')->select();
        $this->assign('cl', $cl);//配置信息
        $fid=I('fid/d',$cl[0]['id']);
        $map['DataType']=array('eq',0);
        $map['NavData']=array('eq',$fid);
        $map['DataName']=array('eq',0);
        $res=$configModel->field('CID,Title')->where($map)->order('CID ASC')->select();
        $this->assign('model', $res);//配置信息
        $this->assign('datatype',$datatype);
        $this->assign('product',1);
        $this->assign('quote',1);
        $this->assign('fid',$fid);
        $this->display();
    }
    //京东云架构
    public function jdcloudlistAction(){
        parent::nosession();
        //获取规格价格
        $standardmodel=M('jdcstandard');
        $standardlist=$standardmodel->select();
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $map['standardtype']=array('like','%'.$key.'%');
        $map['standard']=array('like','%'.$key.'%');
        $map['_logic'] = 'OR';
        $count = $standardmodel->where($map)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $Page->parameter['keyword'] =  $key;
        $show = $Page->show();// 分页显示输出
        $standardlist=$standardmodel->limit($Page->firstRow.','.$Page->listRows)->where($map)->order('id DESC')->select();
        //获取其它价格
        $jdcpricelist=M('jdcprice')->select();
        $this->assign('standardlist',$standardlist);
        $this->assign('jdcpricelist',$jdcpricelist[0]);
        $this->assign('page',$show);
        $this->assign('product',1);
        $this->assign('jdquote',1);
        $this->assign('fid',$fid);
        $this->display();
    }
    public function savesdAction(){
        $standardmodel=M('jdcstandard');
        $standard=I('post.standard');
        $data=array(
            "price" => (int)I('post.price'),
        );
        if($standardmodel->where("standard='%s'",$standard)->save($data)){
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn('error');
        }
    }
    public function addsdAction(){
        $standardmodel=M('jdcstandard');
        $data=array(
            "standardtype" => I('post.standardtype'),
            "standard" => I('post.standard'),
            "vcpu" => I('post.vcpu'),
            "ram" => I('post.ram'),
            "price" => I('post.price'),
        );
        if($standardmodel->add($data)){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
    }
    public function deletesdAction(){
        $standardmodel=M('jdcstandard');
        $standard=I('post.standard');
        if($standardmodel->where("standard='%s'",$standard)->delete()){
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn('error');
        }
    }
    public function ssdpriceAction(){
        $jdcprice=M('jdcprice');
        $data=array(
            "highpan" => I('post.highpan'),
            "ssdpan" => I('post.ssdpan'),
            "bgp" => I('post.bgp'),
            "notbgp" => I('post.notbgp'),
        );
        if($jdcprice->where("id=1")->save($data)){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
    //文章详情页面
    public function cloudinfoAction()
    {
        parent::nosession();
        $configModel=D('configinfo');
        $cid=I('cid/d');
        $fid=I('fid/d',1);
        if (!empty($cid)) {
            //编辑
            $info = $configModel->field('Title')->where('CID =%d',$cid)->find();
            $childinfo=$configModel->field('DataName,Title')->where('FatherID =%d and NavData=%d',array($cid,$fid))->select();
            foreach ($childinfo as $k => $v) {
                switch ($v['dataname']) {
                    case '1'://带宽
                        $bw=explode("/", $v['title']);
                        $info['bwmin']=$bw[0];
                        $info['bwmax']=$bw[1];
                        break;
                    case '2'://存储
                        $mu=explode("/", $v['title']);
                        $info['mu1']=$mu[0];
                        $info['mu2']=$mu[1];
                        break;
                    case '3'://IP
                        $ips=explode("/", $v['title']);
                        $info['ip1']=$ips[0];
                        $info['ip2']=$ips[1];
                        break;
                }
            }
            
            //核心价格
            $corepriceModel=D('coreprice');
            $coreinfo = $corepriceModel->where('CID =%d',$cid)->select();
            foreach ($coreinfo as $k => $c) {
                $core="core".$c['kernel'].$c['gigabyte'];
                $info[$core]=round($c['prix'],2);
            }

            //其他价格
            $priceModel=D('price');
            $priceinfo = $priceModel->field('DataName,Prix')->where('CID =%d',$cid)->select();
            foreach ($priceinfo as $k => $p) {
                switch ($p['dataname']) {
                    case '0'://端口价格
                        $info['port']=$p['prix'];
                        break;
                    case '1'://快照备份价格
                         $info['snapshot']=$p['prix'];
                        break;
                    case '2'://销售折扣
                        $info['discount']=$p['prix'];
                        break;
                    case '3'://线路价格
                        $info['line']=$p['prix'];
                        break;
                    case '4'://存储价格
                         $info['ssd']=$p['prix'];
                        break;
                    case '5'://IP价格
                        $info['ip']=$p['prix'];
                        break;
                    case '6'://完整备份价格
                        $info['full']=$p['prix'];
                        break;
                }
            }
            $this->assign('info',$info);
            $this->assign('cid',$cid);
            $this->assign('fid',$fid);
        }
        $configlistModel=D('configlist');
        $res=$configlistModel->field('ID,Title')->order('ID ASC')->select();
        $this->assign('clst',$res);
        $this->assign('product',1);
        $this->assign('quote',1);
        $this->display();
    }

    //添加/修改
    public function cloudaddAction()
    {
        parent::nosession();
        try {
        $configModel=D('configinfo');
        $id=I('id/d');
        $fid=I('fid/d');
        //基础设置版块
        $title=I('name/s','','htmlspecialchars');//线路名称
        $navdata=I('navdata/d','');
        $bandwidthmin=I('bandwidthmin/d');//最小带宽
        $bandwidthmax=I('bandwidthmax/d');//最大带宽
        $storage1=I('storage1');//存储30G
        $storage2=I('storage2');//存储50G
        $ip1=I('ip1');//一个ip
        $ip2=I('ip2');//两个ip

        $data=array(
            "NavData"=>$fid
        );
        if (!empty($title)) {//线路名称
            $data["Title"]=$title;
            if (!empty($navdata)) {
                $data["NavData"]=$navdata;
            }
            $data["DataName"]=0;
            $data["DataType"]=0;
            //先查询是否已经设置
            $res=$configModel->field('CID,Title')->where('DataName =%d and NavData =%d and DataType =%d and CID =%d',array(0,$fid,0,$id))->find();
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(0,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        if (!empty($bandwidthmin)||!empty($bandwidthmax)) {//带宽
            $data["Title"]=$bandwidthmin."/".$bandwidthmax;
            $data["DataName"]=1;
            $data["DataType"]=0;
            $data["FatherID"]=$id;
            //先查询是否已经设置
            $res=self::cfinfo(1,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(1,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        if (!empty($storage1)||!empty($storage2)) {//存储
            $data["Title"]=$storage1."/".$storage2;
            $data["DataName"]=2;
            $data["DataType"]=0;
            $data["FatherID"]=$id;
            //先查询是否已经设置
            $res=self::cfinfo(2,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(2,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        if (!empty($ip1)||!empty($ip2)) {//IP
            $data["Title"]=$ip1."/".$ip2;
            $data["DataName"]=3;
            $data["DataType"]=0;
            $data["FatherID"]=$id;
            //先查询是否已经设置
            $res=self::cfinfo(3,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(3,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        //产品价格版块
        $priceModel=D('price');
        $lineprice=I("lineprice/f");//线路价格
        $portprice=I("portprice/f");//端口价格
        $ssdprice=I("ssdprice/f");//存储价格
        $ipprice=I("ipprice/f");//ip个数价格
        $snapshotprice=I("snapshotprice/f");//快照备份价格
        $fullprice=I("fullprice/f");//完整备份价格
        $discount=I("discount/f");//销售折扣
        $pdata=array(
            "CID"=>$id,
            "DataType"=>0
        );

        if (!empty($lineprice)) {//线路价格
            $pdata["Prix"]=$lineprice;
            $pdata["DataName"]=3;
            //先查询是否已经设置
            $res=self::priceinfo(3,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(3,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($portprice)) {//端口价格
            $pdata["Prix"]=$portprice;
            $pdata["DataName"]=0;
            //先查询是否已经设置
            $res=self::priceinfo(0,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(0,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($ssdprice)) {//存储价格
            $pdata["Prix"]=$ssdprice;
            $pdata["DataName"]=4;
            //先查询是否已经设置
            $res=self::priceinfo(4,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(4,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($ipprice)) {//ip价格
            $pdata["Prix"]=$ipprice;
            $pdata["DataName"]=5;
            //先查询是否已经设置
            $res=self::priceinfo(5,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(5,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($snapshotprice)) {//快照备份价格
            $pdata["Prix"]=$snapshotprice;
            $pdata["DataName"]=1;
            //先查询是否已经设置
            $res=self::priceinfo(1,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(1,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($fullprice)) {//完整备份价格
            $pdata["Prix"]=$fullprice;
            $pdata["DataName"]=6;
            //先查询是否已经设置
            $res=self::priceinfo(6,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(6,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($discount)) {//销售折扣
            $pdata["Prix"]=$discount;
            $pdata["DataName"]=2;
            //先查询是否已经设置
            $res=self::priceinfo(2,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(2,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        //核心价格
        $corepriceModel=D('coreprice');
        $corePrice_2_1=I("corePrice_2_1/f");//2核1G
        $corePrice_2_2=I("corePrice_2_2/f");//2核2G
        $corePrice_2_4=I("corePrice_2_4/f");//2核4G
        $corePrice_2_8=I("corePrice_2_8/f");//2核8G

        $corePrice_4_1=I("corePrice_4_1/f");//4核1G
        $corePrice_4_2=I("corePrice_4_2/f");//4核2G
        $corePrice_4_4=I("corePrice_4_4/f");//4核4G
        $corePrice_4_8=I("corePrice_4_8/f");//4核8G

        $corePrice_8_1=I("corePrice_8_1/f");//8核1G
        $corePrice_8_2=I("corePrice_8_2/f");//8核2G
        $corePrice_8_4=I("corePrice_8_4/f");//8核4G
        $corePrice_8_8=I("corePrice_8_8/f");//8核8G

        $cdata=array(
            "CID"=>$id
        );

        if (!empty($corePrice_2_1)) {//2核1G
            $cdata["Prix"]=$corePrice_2_1;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=1;
            //先查询是否已经设置
            $res=self::coreinfo(2,1,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,1,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_2_2)) {//2核2G
            $cdata["Prix"]=$corePrice_2_2;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=2;
            //先查询是否已经设置
            $res=self::coreinfo(2,2,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,2,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_2_4)) {//2核4G
            $cdata["Prix"]=$corePrice_2_4;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=4;
            //先查询是否已经设置
            $res=self::coreinfo(2,4,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,4,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_2_8)) {//2核8G
            $cdata["Prix"]=$corePrice_2_8;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=8;
            //先查询是否已经设置
            $res=self::coreinfo(2,8,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,8,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_1)) {//4核1G
            $cdata["Prix"]=$corePrice_4_1;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=1;
            //先查询是否已经设置
            $res=self::coreinfo(4,1,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,1,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_2)) {//4核2G
            $cdata["Prix"]=$corePrice_4_2;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=2;
            //先查询是否已经设置
            $res=self::coreinfo(4,2,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,2,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_4)) {//4核4G
            $cdata["Prix"]=$corePrice_4_4;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=4;
            //先查询是否已经设置
            $res=self::coreinfo(4,4,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,4,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_8)) {//4核8G
            $cdata["Prix"]=$corePrice_4_8;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=8;
            //先查询是否已经设置
            $res=self::coreinfo(4,8,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,8,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_1)) {//8核1G
            $cdata["Prix"]=$corePrice_8_1;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=1;
            //先查询是否已经设置
            $res=self::coreinfo(8,1,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,1,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_2)) {//8核2G
            $cdata["Prix"]=$corePrice_8_2;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=2;
            //先查询是否已经设置
            $res=self::coreinfo(8,2,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,2,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_4)) {//8核4G
            $cdata["Prix"]=$corePrice_8_4;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=4;
            //先查询是否已经设置
            $res=self::coreinfo(8,4,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,4,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_8)) {//8核8G
            $cdata["Prix"]=$corePrice_8_8;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=8;
            //先查询是否已经设置
            $res=self::coreinfo(8,8,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,8,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        $this->success("提交成功",U('Officweb/cloudlist'));

        } catch (Exception $e) {
            $this->error("保存失败");
        }
        
    }

    //查询产品配置信息
    function cfinfo($dataname,$fid,$cid)
    {
        $configModel=D('configinfo');
        $res=$configModel->field('CID,Title')->where('DataName =%d and NavData =%d and DataType =%d and FatherID =%d',array($dataname,$fid,0,$cid))->find();
        return $res;
    }
    //查询价格信息
    function priceinfo($dataname,$cid)
    {
        $priceModel=D('price');
        $res=$priceModel->field('PID,Prix')->where('DataName =%d and CID =%d and DataType =%d',array($dataname,$cid,0))->find();
        return $res;
    }

    //查询核心价格信息
    function coreinfo($gigabyte,$kernel,$cid)
    {
        $corepriceModel=D('coreprice');
        $res=$corepriceModel->field('ID')->where('Kernel =%f and Gigabyte =%f and CID =%d',array($gigabyte,$kernel,$cid))->find();
        return $res;
    }

    /*---------------------------------物理架构报价---------------------------------------*/
    public function physicslistAction(){
        parent::nosession();
        //获取文章列表
        $configModel=D('configinfo');
        $cpage=I('p/d',1);
        $fid=I('fid/d',0);//0BGP云主机 1单线云主机 2高防云主机
        $map['DataType']=array('eq',1);
        $map['NavData']=array('eq',$fid);
        $map['DataName']=array('eq',0);
        $res=$configModel->field('CID,Title')->where($map)->order('CID ASC')->select();
        $this->assign('model', $res);//配置信息
        $this->assign('datatype',$datatype);
        $this->assign('product',1);
        $this->assign('physics',1);
        $this->assign('fid',$fid);
        $this->display();
    }

    //文章详情页面
    public function physicsinfoAction()
    {
        parent::nosession();
        $configModel=D('configinfo');
        $cid=I('cid/d');
        $fid=I('fid/d');
        if (!empty($cid)) {
            //编辑
            $info = $configModel->field('Title')->where('CID =%d',$cid)->find();
            $childinfo=$configModel->field('DataName,Title')->where('FatherID =%d',$cid)->select();
            foreach ($childinfo as $k => $v) {
                switch ($v['dataname']) {
                    case '1'://带宽
                        $bw=explode("/", $v['title']);
                        $info['bwmin']=$bw[0];
                        $info['bwmax']=$bw[1];
                        break;
                    case '2'://存储
                        $mu=explode("/", $v['title']);
                        $info['mu1']=$mu[0];
                        $info['mu2']=$mu[1];
                        break;
                    case '3'://IP
                        $ips=explode("/", $v['title']);
                        $info['ip1']=$ips[0];
                        $info['ip2']=$ips[1];
                        break;
                }
            }
            //核心价格
            $corepriceModel=D('coreprice');
            $coreinfo = $corepriceModel->where('CID =%d',$cid)->select();
            foreach ($coreinfo as $k => $c) {
                $core="core".$c['kernel'].$c['gigabyte'];
                $info[$core]=round($c['prix'],2);
            }

            //其他价格
            $priceModel=D('price');
            $priceinfo = $priceModel->field('DataName,Prix')->where('CID =%d',$cid)->select();
            foreach ($priceinfo as $k => $p) {
                switch ($p['dataname']) {
                    case '0'://端口价格
                        $info['port']=$p['prix'];
                        break;
                    case '1'://快照价格
                         $info['snapshot']=$p['prix'];
                        break;
                    case '2'://销售折扣
                        $info['discount']=$p['prix'];
                        break;
                    case '3'://线路价格
                        $info['line']=$p['prix'];
                        break;
                }
            }
            $this->assign('info',$info);
            $this->assign('cid',$cid);
            $this->assign('fid',$fid);
        }
        $this->assign('product',1);
        $this->assign('physics',1);
        $this->display();
    }

    //文章添加/修改
    public function physicsaddAction()
    {
        parent::nosession();
        try {
        $configModel=D('configinfo');
        $id=I('id/d');
        $fid=I('fid/d');
        //基础设置版块
        $title=I('name/s','','htmlspecialchars');//线路名称
        $bandwidthmin=I('bandwidthmin/d');//最小带宽
        $bandwidthmax=I('bandwidthmax/d');//最大带宽
        $storage1=I('storage1');//存储30G
        $storage2=I('storage2');//存储50G
        $ip1=I('ip1');//一个ip
        $ip2=I('ip2');//两个ip

        $data=array(
            "NavData"=>$fid
        );
        if (!empty($title)) {//线路名称
            $data["Title"]=$title;
            $data["DataName"]=0;
            $data["DataType"]=0;
            //先查询是否已经设置
            $res=self::cfinfo(0,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(0,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        if (!empty($bandwidthmin)||!empty($bandwidthmax)) {//带宽
            $data["Title"]=$bandwidthmin."/".$bandwidthmax;
            $data["DataName"]=1;
            $data["DataType"]=0;
            $data["FatherID"]=$id;
            //先查询是否已经设置
            $res=self::cfinfo(1,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(1,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        if (!empty($storage1)||!empty($storage2)) {//存储
            $data["Title"]=$storage1."/".$storage2;
            $data["DataName"]=2;
            $data["DataType"]=0;
            $data["FatherID"]=$id;
            //先查询是否已经设置
            $res=self::cfinfo(2,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(2,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        if (!empty($ip1)||!empty($ip2)) {//IP
            $data["Title"]=$ip1."/".$ip2;
            $data["DataName"]=3;
            $data["DataType"]=0;
            $data["FatherID"]=$id;
            //先查询是否已经设置
            $res=self::cfinfo(3,$fid,$id);
            if (empty($res)) 
            {
                $configModel->add($data);
            }
            else
            {
                $configModel->where('CID='.$res['cid'])->save($data);
            }
        }
        else
        {
            $res=self::cfinfo(3,$fid,$id);
            if (!empty($res)) {
                $configModel->where('CID='.$res['cid'])->delete();
            }
        }

        //产品价格版块
        $priceModel=D('price');
        $lineprice=I("lineprice/f");//线路价格
        $portprice=I("portprice/f");//端口价格
        $snapshotprice=I("snapshotprice/f");//快照价格
        $discount=I("discount/f");//销售折扣
        $pdata=array(
            "CID"=>$id,
            "DataType"=>0
        );

        if (!empty($lineprice)) {//线路价格
            $pdata["Prix"]=$lineprice;
            $pdata["DataName"]=3;
            //先查询是否已经设置
            $res=self::priceinfo(3,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(3,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($portprice)) {//端口价格
            $pdata["Prix"]=$portprice;
            $pdata["DataName"]=0;
            //先查询是否已经设置
            $res=self::priceinfo(0,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(0,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($snapshotprice)) {//快照价格
            $pdata["Prix"]=$snapshotprice;
            $pdata["DataName"]=1;
            //先查询是否已经设置
            $res=self::priceinfo(1,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(1,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        if (!empty($discount)) {//销售折扣
            $pdata["Prix"]=$discount;
            $pdata["DataName"]=2;
            //先查询是否已经设置
            $res=self::priceinfo(2,$id);
            if (empty($res)) 
            {
                $priceModel->add($pdata);
            }
            else
            {
                $priceModel->where('PID='.$res['pid'])->save($pdata);
            }
        }
        else
        {
            $res=self::priceinfo(2,$id);
            if (!empty($res)) {
                $priceModel->where('PID='.$res['pid'])->delete();
            }
        }

        //核心价格
        $corepriceModel=D('coreprice');
        $corePrice_2_1=I("corePrice_2_1/f");//2核1G
        $corePrice_2_2=I("corePrice_2_2/f");//2核2G
        $corePrice_2_4=I("corePrice_2_4/f");//2核4G
        $corePrice_2_8=I("corePrice_2_8/f");//2核8G

        $corePrice_4_1=I("corePrice_4_1/f");//4核1G
        $corePrice_4_2=I("corePrice_4_2/f");//4核2G
        $corePrice_4_4=I("corePrice_4_4/f");//4核4G
        $corePrice_4_8=I("corePrice_4_8/f");//4核8G

        $corePrice_8_1=I("corePrice_8_1/f");//8核1G
        $corePrice_8_2=I("corePrice_8_2/f");//8核2G
        $corePrice_8_4=I("corePrice_8_4/f");//8核4G
        $corePrice_8_8=I("corePrice_8_8/f");//8核8G

        $cdata=array(
            "CID"=>$id
        );

        if (!empty($corePrice_2_1)) {//2核1G
            $cdata["Prix"]=$corePrice_2_1;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=1;
            //先查询是否已经设置
            $res=self::coreinfo(2,1,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,1,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_2_2)) {//2核2G
            $cdata["Prix"]=$corePrice_2_2;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=2;
            //先查询是否已经设置
            $res=self::coreinfo(2,2,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,2,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_2_4)) {//2核4G
            $cdata["Prix"]=$corePrice_2_4;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=4;
            //先查询是否已经设置
            $res=self::coreinfo(2,4,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,4,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_2_8)) {//2核8G
            $cdata["Prix"]=$corePrice_2_8;
            $cdata["Kernel"]=2;
            $cdata["Gigabyte"]=8;
            //先查询是否已经设置
            $res=self::coreinfo(2,8,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(2,8,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_1)) {//4核1G
            $cdata["Prix"]=$corePrice_4_1;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=1;
            //先查询是否已经设置
            $res=self::coreinfo(4,1,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,1,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_2)) {//4核2G
            $cdata["Prix"]=$corePrice_4_2;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=2;
            //先查询是否已经设置
            $res=self::coreinfo(4,2,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,2,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_4)) {//4核4G
            $cdata["Prix"]=$corePrice_4_4;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=4;
            //先查询是否已经设置
            $res=self::coreinfo(4,4,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,4,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_4_8)) {//4核8G
            $cdata["Prix"]=$corePrice_4_8;
            $cdata["Kernel"]=4;
            $cdata["Gigabyte"]=8;
            //先查询是否已经设置
            $res=self::coreinfo(4,8,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(4,8,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_1)) {//8核1G
            $cdata["Prix"]=$corePrice_8_1;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=1;
            //先查询是否已经设置
            $res=self::coreinfo(8,1,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,1,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_2)) {//8核2G
            $cdata["Prix"]=$corePrice_8_2;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=2;
            //先查询是否已经设置
            $res=self::coreinfo(8,2,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,2,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_4)) {//8核4G
            $cdata["Prix"]=$corePrice_8_4;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=4;
            //先查询是否已经设置
            $res=self::coreinfo(8,4,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,4,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        if (!empty($corePrice_8_8)) {//8核8G
            $cdata["Prix"]=$corePrice_8_8;
            $cdata["Kernel"]=8;
            $cdata["Gigabyte"]=8;
            //先查询是否已经设置
            $res=self::coreinfo(8,8,$id);
            if (empty($res)) 
            {
                $corepriceModel->add($cdata);
            }
            else
            {
                $corepriceModel->where('ID='.$res['id'])->save($cdata);
            }
        }
        else
        {
            $res=self::coreinfo(8,8,$id);
            if (!empty($res)) {
                $corepriceModel->where('ID='.$res['id'])->delete();
            }
        }

        $this->success("提交成功",U('Officweb/physicslist'));

        } catch (Exception $e) {
            $this->error("保存失败");
        }
        
    }

    //物理服务器
    public function serverlistAction(){
        parent::nosession();
        //获取文章列表
        $quoteModel=D('quoteinfo');
        $cpage=I('p/d',1);
        $datatype=I('datatype/d',0);
        $fid=I('fid/d',0);//父类id 若存在则是下级列表
        $key=I('keyword/s');
        $map['Title']=array('like','%'.$key.'%');
        $map['FatherID']=array('eq',$fid);
        $count = $quoteModel->where($map)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $Page->parameter['keyword'] =  $key;
        $show = $Page->show();// 分页显示输出
        $res=$quoteModel->limit($Page->firstRow.','.$Page->listRows)->where($map)->order('QuotID ASC')->select();
        $this->assign('model', $res);
        $this->assign('page',$show);
        $this->assign('keyword',$key);
        $this->assign('datatype',$datatype);
        $this->assign('product',1);
        $this->assign('server',1);
        $this->assign('fid',$fid);
        $this->display();
    }

    //文章详情页面
    public function quoteinfoAction()
    {
        parent::nosession();
        $quoteModel=D('quoteinfo');
        $id=I('id/d');
        $fid=I('fid/d');
        if (!empty($id)) {
            //编辑
            $info = $quoteModel->where('QuotID =%d',$id)->find();
            $this->assign('info',$info);
            $this->assign('quotid',$id);
        }
        $this->assign('fid',$fid);
        $this->assign('product',1);
        $this->assign('quote',1);
        $this->display();
    }

    //文章添加/修改
    public function quoteaddAction()
    {
        parent::nosession();
        $quoteModel=D('quoteinfo');
        $id=I('quotid/d');
        $title=I('title/s','','htmlspecialchars');
        $datatype=I('datatype/d');
        $price=I('price');
        $fid=I('fid/d',0);
        $data=array(
            'Title'=>$title,
            'DataType'=>$datatype,
            'Price'=>$price,
            'FatherID'=>$fid
        );
        if (!empty($id)) {
            //编辑
            if (!$quoteModel->create($data)) {
                $this->error($quoteModel->getError());
            }else{
                if ($quoteModel->where('QuotID = %d',$id)->save($data)) {
                    echo "<script>window.parent.window.stopupload(0); </script>";
                    exit();
                } else {
                    echo "<script>window.parent.window.stopupload(1); </script>";
                    exit();
                }        
            }
        }
        else
        {
            if (!$quoteModel->create($data)) {
                $this->error($quoteModel->getError());
            }else{
                if ($quoteModel->add($data)) {
                    echo "<script>window.parent.window.stopupload(0); </script>";
                    exit();
                } else {
                    echo "<script>window.parent.window.stopupload(1); </script>";
                    exit();
                }        
            }
        }
    }

    //文章删除
    public function quotedelAction()
    {
        parent::nosession();
        $id=I('id/d');
        $quoteModel=D('quoteinfo');
        if ($quoteModel->delete($id)) {
            $this->success('删除成功',U('officweb/quotelist'));
        } else {
            $this->error('删除失败');
        }
    }

    /*---------------------------------会员信息管理---------------------------------------*/
    public function memberlistAction(){
        parent::nosession();
        //获取文章列表
        $userModel=D('users');
        $paylogModel=M('paylog');
        $cpage=I('p/d',1);
        $key=I('keyword/s');
        $userid=I('userid/d');
        $map['UserName']=array('like','%'.$key.'%');
        $map['LinkMail']=array('like','%'.$key.'%');
        $map['_logic'] = 'OR';
        $count = $userModel->where($map)->count();
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(15) 
        $Page->parameter['keyword'] =  $key;
        $show = $Page->show();// 分页显示输出
        if(!empty($userid)){
            $res=$userModel->limit($Page->firstRow.','.$Page->listRows)->where("UserID=%d",$userid)->order('UserID DESC')->select();
        }else{
            $res=$userModel->limit($Page->firstRow.','.$Page->listRows)->where($map)->order('UserID DESC')->select();
        }
        foreach ($res as $k => $val) {
            //查询余额
            //先获取当前用户的总充值金额
            $plus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($val['userid'],0))->select(); 
            $minus=$paylogModel->field('SUM(money) as my')->where("userid=%d and datatype=%d",array($val['userid'],1))->select();
            $balance=round($plus[0]['my'],2)-round($minus[0]['my'],2);
            $res[$k]['balance']=$balance;
        }
        $this->assign('model', $res);
        $this->assign('page',$show);
        $this->assign('keyword',$key);
        $this->assign('guanwang',1);
        $this->assign('member',1);
        $this->display();
    }

    public function payinfoAction(){
        parent::nosession();
        $userid=I('userid/d');
        $this->assign('userid',$userid);
        $this->display();
    }

    public function rechargeAction(){
        parent::nosession();
        $userid=I('userid/d');
        $datatype=I('datatype/d');
        $money=I('money');
        $paylogModel=M('paylog');
        $data=array(
            "ordernum"=>"pgy".date('YmdHis'),
            "money"=>$money,
            "userid"=>$userid,
            "addtime"=>time(),
            "typename"=>empty($datatype)?"管理员充值":"管理员扣费",
            "datatype"=>$datatype
        );
        $paylogModel->add($data);
        $this->success('提交成功',U('officweb/payinfo'));
    }

    //客户信息删除
    public function memberdelAction()
    {
        parent::nosession();
        $id=I('id/d');
        $userModel=D('users');
        if ($userModel->delete($id)) {
            $this->success('删除成功',U('officweb/memberlist'));
        } else {
            $this->error('删除失败');
        }
    }
}