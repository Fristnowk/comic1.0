<?php
//处理评分功能的实现
require_once('tpl/head.php');
  //连接数据库		
$link=connect();
$vid=$_GET["vid"];
$level=$_GET["level"];
//根据user的session值取得uid
$uname=$_SESSION["user"];
$sql1="select uid from users where uname='$uname'";
//echo $sql1;
$rs1=mysqli_query($link,$sql1)or die('查询1失败！'.mysqli_error($link));   
$row1=mysqli_fetch_assoc($rs1);
$uid=$row1["uid"];
//echo $uid;
//如果该用户对此视频评过分了，则不允许重复评分。
$sql2="select * from levels where uid=$uid and vid=$vid";
//echo $sql2;
$rs2=mysqli_query($link,$sql2)or die('查询2失败！'.mysqli_error($link));
$rownum=mysqli_num_rows($rs2);
if($rownum>0){
		//echo '<h2 style="color:white;">您已评分了该视频，不允许重复评分！</h2>';
		//header("refresh:3;url='show.php?vid=$vid'");  
		//echo '<script>alert("您已评分了该视频，不允许重复评分！");</script>';
		//header("location:show.php?vid=$vid&flag=1");

	echo "<script language=\"javascript\">";
echo "document.location=\"show.php?vid=$vid&flag=1\"";
echo "</script>";
}else{
//编写sql将数据插入数据表
$sql="insert into levels values(null,$vid,$uid,$level)";

$num=mysqli_query($link,$sql);
if($num>0){

//echo "评分成功！3秒后回到上一页面！";
//header("location:show.php?vid=$vid&flag=2");
echo "<script language=\"javascript\">";
echo "document.location=\"show.php?vid=$vid&flag=2\"";
echo "</script>";
}
else{
	//echo"评分失败！3秒后回到上一页面！";
	//header("location:show.php?vid=$vid");
	echo "<script language=\"javascript\">";
echo "document.location=\"show.php?vid=$vid\"";
echo "</script>";
}
}
?>

 </body>
</html>
