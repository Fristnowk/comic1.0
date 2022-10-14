<?php
//查询地区功能模块的实现
  require_once('tpl/header.php');
?>


<table class="table table-hover">
	<tr>
	<th>序号</th>
	<th>地区名称</th>
	<th>操作</th>
 	</tr>

<?php
//连接数据库 
 $link=connect();
 //编写sql语句
$sql="select * from area";
 //执行sql语句
$result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));  
$i=1;
while($row=mysqli_fetch_assoc($result))
{
?>
<tr>
<td><?php
echo $i++;
?>
</td>
<td><?php
echo $row["areaname"];
?>
</td>
<td>
<a href="areaEdit.php?aid=<?php
echo $row["aid"];
?>" title="">修改</a>|
<a href="doAreaDelete.php?aid=<?php
echo $row["aid"];
?>" title="" onclick="return confirm('你确定删除吗？')">删除</a>
</td>
</tr>

<?php
}
?>
</table>



<?php
  require_once('tpl/footer.php');
?>