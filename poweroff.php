<?php	
$config['mysql_host']='127.0.0.1';
$config['mysql_user']='root';
$config['mysql_pass']='caicai525217';
$config['mysql_dbname']='pgyidc';
date_default_timezone_set("Asia/Shanghai");
$mysql=mysql_connect($config['mysql_host'],$config['mysql_user'],$config['mysql_pass']);
if (!$mysql) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($config['mysql_dbname'],$mysql);
mysql_query("SET character_set_connection='utf8', character_set_results='utf8', character_set_client=utf8",$mysql);
	



/*---------------------------------分成方法START----------------------------------*/
$userid=$_REQUEST['userid'];
$cpu=$_REQUEST['cpu'];
$ram_max=$_REQUEST['ram_max'];//最大内存
$ram_min=$_REQUEST['ram_min'];//最小内存
$disk=$_REQUEST['disk'];//硬盘
$bandwidth=$_REQUEST['bandwidth'];//流量大小 0为不限量
$port=$_REQUEST['port'];//端口
$osid=$_REQUEST['osid'];//系统id
$cloudtype=$_REQUEST['cloudtype'];//先测试着 2暂定扬州 别的都是宿迁

$post_data = array 
(
    "identity" => "system",
    "api_username" => "e08ce2094689f5fe129",
    "api_key" => "JFSDFIEWOIFU098fds008f",
    "Action" => "vm_create",
    "userid" => $userid,
    "cpu" => $cpu,
    "ram_max" => $ram_max,
    "ram_min" => $ram_min,
    "disk" => $disk,
    "bandwidth" => empty($bandwidth)?0:$bandwidth,
    "port" => $port,
    "vpsname"=>"MyServer",
    "osid" => $osid,
    "serverid"=>$cloudtype==1?8:($cloudtype==2?3:13)//暂定
);
print"<pre>";
print_r($post_data);
print"</pre>";

// $post_data = array 
// (
//     "identity" => "system",
//     "api_username" => "e08ce2094689f5fe129",
//     "api_key" => "JFSDFIEWOIFU098fds008f",
//     "Action" => "vm_create",
//     "userid" => 1,
//     "cpu" => 2,
//     "ram_max" => 2048,
//     "ram_min" => 1024,
//     "disk" => 30,
//     "bandwidth" => 0,
//     "port" => 10,
//     "vpsname"=>"MyServer",
//     "osid" => 17,
//     "serverid"=>22//宿迁双线双IP
// );
$outres=yungopost($post_data);
return $outres;
/*---------------------------------分成方法END----------------------------------*/

function yungopost($postdata)
{
    $url = "http://xen.pgyidc.com/process.aspx?c=api";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // post数据
    curl_setopt($ch, CURLOPT_POST, 1);
    // post的变量
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    $output = curl_exec($ch);
    curl_close($ch);
    $outres=explode("|", $output);
    return $outres;
}

?>