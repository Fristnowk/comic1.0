<?php
//添加地区功能模块的实现：处理添加地区功能页
  require_once('tpl/header.php');
?>


<?php
//连接数据库   
$link=connect();
$areaname=$_POST["areaname"];
$sql0="select * from area where areaname='$areaname'";
$rs0=mysqli_query($link,$sql0);
$num=mysqli_num_rows($rs0);
if($num!=0)
{
redirect('areaAdd.php','该地区名称已存在，请重新添加，3秒后返回');
exit;
}
$sql="insert into area values(null,'$areaname')";
$rs=mysqli_query($link,$sql);
if($rs==1)
{
  redirect('areaAdd.php','地区添加成功，3秒后返回，可继续添加。');
	
}else{
  echo "地区添加失败";
}
?>

<?php
  require_once('tpl/footer.php');
?>