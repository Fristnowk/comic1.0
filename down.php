<?php
//前台下载动漫电影功能的实现
require_once('./system/dbConn.php');
  //连接数据库		
$link=connect();
$vid=$_GET["vid"];
$sqld="select * from videos where vid=$vid";
$rsd=mysqli_query($link,$sqld) or die('查询1失败！'.mysqli_error($link));   
$rowd=mysqli_fetch_assoc($rsd);
//更新下载量
$sqld2="update videos set downloads=downloads+1 where vid=$vid";
mysqli_query($link,$sqld2) or die('查询2失败！'.mysqli_error($link));   
//为下载文件重命名
$arr=explode(".",$rowd["link"]);
$suffix=$arr[count($arr)-1];
$videoname=$rowd["videoname"].".".$suffix;

//下载文件
header("Content-Transfer-Encoding:binary");
header("Content-Disposition:attachment;filename=$videoname");
ob_clean();
flush();
readfile($rowd["link"]);
?>