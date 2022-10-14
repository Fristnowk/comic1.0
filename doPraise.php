<?php
require_once('tpl/head.php');
  //连接数据库		
$link=connect();
$vid=$_GET["vid"];
$status=$_GET["status"];
//根据user的session值取得uid
$uname=$_SESSION["user"];
$sql1="select uid from users where uname='$uname'";
//echo $sql1;
$rs1=mysqli_query($link,$sql1)or die('查询1失败！'.mysqli_error($link));   
$row1=mysqli_fetch_assoc($rs1);
$uid=$row1["uid"];

//将推荐信息写入数据库
$sql="insert into praise values(null,$uid,$vid,$status)";
$rs=mysqli_query($link,$sql);
if ($rs) {
echo "<script language=\"javascript\">";
echo "document.location=\"show.php?vid=$vid&flag=5\"";
echo "</script>";
}

?>

 </body>
</html>
