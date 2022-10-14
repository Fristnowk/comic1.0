<?php
//修改地区功能模块的实现：处理修改地区功能页
  require_once('tpl/header.php');
?>
 <?php
//连接数据库 
  $link=connect();
//使用$_POST数组获取表单中输入的数据
  $aid=$_POST["aid"];
  $areaname=$_POST["areaname"];
//编写SQL语句
  $sql="update area set areaname='$areaname' where aid=$aid";
//执行SQL语句
  $rs=mysqli_query($link,$sql);
  if($rs==1)
    redirect('areaList.php','地区信息更新成功');
  else
    redirect('areaList.php','地区信息更新失败');
?>

<?php
  require_once('tpl/footer.php');
?>