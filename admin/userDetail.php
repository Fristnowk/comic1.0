<?php
  require_once('tpl/header.php');
  connect();
  $uid=$_GET["uid"];
  $sql="select * from users where uid=$uid";
  $result=mysql_query($sql);
  $row=mysql_fetch_assoc($result);
  $sqlc="select * from comments join videos on comments.vid=videos.vid where uid=$uid";
  $rs=mysql_query($sqlc);
  ?>
<div class="row">
<div class="col-md-4">
	<table class="table table-bordered">
	<caption>基本信息</caption>
<tr>
	<th>用户名</th>
	<td><?php echo $row["uname"] ?></td>
</tr>
<tr>
	<th>性别</th>
	<td><?php 
if ($row["gender"]==0) {
	echo "男";
}else{
	echo "女";
	}?>
	</td>

</tr>
<tr>
	<th>生日</th>
	<td><?php echo $row["birthdate"] ?></td>
</tr>
<tr>
	<th>电子邮件</th>
	<td><?php echo $row["email"] ?></td>
</tr>
<tr>
	<th>头像</th>
	<td><img class="img-circle" src="../images/<?php echo $row["pic"] ?>" width="100" height="100" alt=""></td>
</tr>
	
</table>
</div>

<div class="col-md-8">
	<table class="table table-bordered">
<caption style="align-content: center">发表的评论</caption>
<tr>
	<th>序号</th>
	<th>视频名称</th>
	<th>评论内容</th>
	<th>发表日期</th>
</tr>
<?php 
$i=0;
while ($rowc=mysql_fetch_assoc($rs)) {
	?>
<tr>
	<td><?php echo $i++; ?></td>
	<td><?php echo $rowc["videoname"] ?></td>
	<td><?php echo $rowc["content"] ?></td>
	<td><?php echo $rowc["cdate"] ?></td>
</tr>
	<?php
	
}
 ?>



</table>

</div>
	
</div>

   

<?php
  require_once('tpl/footer.php');
?>