<?php
//添加留言功能的实现
require_once('tpl/head.php');
//连接数据库		
$link=connect();
$vid=$_POST["vid"];
//session_start();
//根据user的session值取得uid
if(isset($_SESSION["user"]))
{
$uname=$_SESSION["user"];
$sql1="select uid from users where uname='$uname'";
//echo $sql1;
$rs1=mysqli_query($link,$sql1)or die('查询1失败！'.mysqli_error($link));   
$row1=mysqli_fetch_assoc($rs1);
$uid=$row1["uid"];
//echo "uid=".$uid;
	}
$content=$_POST["content"];
$sql2="insert into comments values(null,'$content',now(),$uid,$vid)";
//echo $sql2;
$rs2=mysqli_query($link,$sql2)or die('查询2失败！'.mysqli_error($link));   
if($rs2>0){
	echo "<script> alert('留言成功') </script>";
//echo "<h2>"."本次留言成功"."</h2>";
//header("location:show.php?vid=$vid");
echo "<script language=\"javascript\">";

   	
echo "document.location=\"show.php?vid=$vid\"";
echo "</script>";
//header("refresh:3;url='show.php?vid=$vid'");
}
else{
	echo "本次留言失败";
}
?>