<?php
//添加收藏功能的实现
require_once('tpl/head.php');
require_once('system/myFunc.php');

  //连接数据库		
$link=connect();
$vid=$_GET["vid"];
if(!isset($_SESSION["user"])){
?>
  <h3 ><a href="#" data-toggle="modal" data-target="#login"  onclick="func(<?php
    echo $row['vid']
    ?>)">登录</a>后可以收藏</h3>
<?php 
	
	exit;
}
//根据user的session值取得uid
$uname=$_SESSION["user"];
$sql1="select uid from users where uname='$uname'";
//echo $sql1;
$rs1=mysqli_query($link,$sql1)or die('查询1失败！'.mysqli_error($link));   
$row1=mysqli_fetch_assoc($rs1);
$uid=$row1["uid"];
//echo $uid;
//如果该用户收藏过，则不允许重复收藏。
$sql2="select * from collect where uid=$uid and vid=$vid";
$rs2=mysqli_query($link,$sql2)or die('查询2失败！'.mysqli_error($link));
$rownum=mysqli_num_rows($rs2);
if($rownum>0){
			echo "<script language=\"javascript\">";
echo "document.location=\"show.php?vid=$vid&flag=3\"";
echo "</script>";
}else{
//编写sql将数据插入数据表
$sql="insert into collect values(null,$uid,$vid)";
$num=mysqli_query($link,$sql);
if($num>0){
	echo "<script language=\"javascript\">";
	echo "document.location=\"show.php?vid=$vid&flag=4\"";
	echo "</script>";
}
else{
	echo "<script language=\"javascript\">";
	echo "document.location=\"show.php?vid=$vid\"";
	echo "</script>";
}
}
?>

 </body>
</html>
