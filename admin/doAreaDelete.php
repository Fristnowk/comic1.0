<?php
//删除地区功能模块的实现
  require_once('tpl/header.php');
?>
<?php
//连接到数据库  
  $link=connect();
//获取areaList.php页面删除超链接传递过来的aid参数
  $aid = $_GET['aid'];    
//查询待删除地区中是否存在动漫电影
$sql0="select * from videos where aid=$aid";
$rs0=mysqli_query($link,$sql0);
$num0=mysqli_num_rows($rs0);
if($num0>0)
{
	redirect('areaList.php','该地区中还有动漫电影视频，不能删除');
	exit;
}
//如果该地区中没有电影信息，则删除该地区
$sql="delete  from area where aid=$aid";
$num=mysqli_query($link,$sql);
if($num)
{
	redirect('areaList.php','地区删除成功！');
}
else{
  	redirect('areaList.php','删除地区失败');
}
  ?>        



<?php
  require_once('tpl/footer.php');
?>