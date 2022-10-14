<?php
//修改地区功能模块的实现：显示待修改地区的表单页
  require_once('tpl/header.php');
?>
<?php
 //连接数据库   
   $link=connect();
 //接收areaList.php页面通过超链接传递过来的aid参数
   $aid = $_GET['aid'];  
 //写sql语句
   $sql="select * from area where aid=$aid";
 //执行sql语句得到结果集
   $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));
 //取出结果集中的记录   
   $row = mysqli_fetch_assoc($result);
?>
<form class="form-horizontal" method="POST" action="doAreaUpdate.php">
<input type="hidden" name="aid" value="<?php
echo $row["aid"];
?>">
<div class="form-group">
    <label for="typename" class="col-md-2 control-label">地区名称</label>
    <div class="col-md-10">
      <input type="text" class="form-control" name="areaname" value="<?php  echo $row["areaname"];?>">
    </div>
</div>
      
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value="修改">
   </div>
</div>
</form>  

<?php
  require_once('tpl/footer.php');
?>