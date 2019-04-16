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
//	echo '连接成功!';
};
$num = 1;
$sql = 'SELECT * FROM daydayday ';
//$res=$link->query($sql);
mysqli_query($link, "set names utf8");
$res = mysqli_query($link, $sql);
//$data=$res->fetch_all();
////var_dump($data);
////print_r($data);
//echo json_encode($data,true);
$arr = mysqli_fetch_all($res,MYSQLI_ASSOC);
echo  json_encode($arr);
?>