<?php
header("Content-type: text/html; charset=utf-8"); 
$host='127.0.0.1';
$user='root';
$password='root';
$dbName='test';
$link=new mysqli($host,$user,$password,$dbName);	
if ($link->connect_error){
die("连接失败：".$link->connect_error);
}else{
	echo '连接成功!';
};
$doperson = $_POST['doperson'];
//echo $doperson;
//die;
$content = $_POST['content'];
$createtime = $_POST['createtime'];
$sql="INSERT daydayday (doperson,content,createtime) VALUES ('$doperson','$content','$createtime')";
mysqli_query($link, "set names utf8");
$res=$link->query($sql);
echo $res;
if($res){
	echo "添加成功";
}else{
	echo "添加失败";
}
?>