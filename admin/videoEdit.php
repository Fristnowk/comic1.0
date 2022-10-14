<?php
//修改动漫电影信息功能模块的实现：显示待修改动漫电影信息的表单页
  require_once('tpl/header.php');
?>

<?php
   //连接数据库   
   $link=connect();
   //视频id是通过GET方法提交的   
   //根据视频id从数据库中查询视频的所有信息
   $vid = $_GET['vid'];  
   $sql = "select * from videos where vid={$vid}";   
   $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));   
   $row = mysqli_fetch_assoc($result);
 ?>
<h3>请修改视频信息</h3>
<form class="form-horizontal" method=post action="doVideoUpdate.php" enctype="multipart/form-data">
<input type="hidden" name="vid" value="<?php
echo $row["vid"];
?>">

<div class="form-group">
    <label for="videoname" class="col-md-2 col-xs-2 control-label">动漫电影名称</label>
    <div class="col-md-10 col-xs-10">
   <input type="text" class="form-control" id="videoname" name="videoname" value="<?php
   echo $row["videoname"];
   ?>">
   </div>
</div>

<div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">所属地区</label>
    <div class="col-md-10 col-xs-10">
<select class="form-control" name="aid">
  <?php
$sql0="select * from area";
$rs0=mysqli_query($link,$sql0);
while($row0=mysqli_fetch_assoc($rs0))
  {
  ?>
  <option value=<?php  echo $row0["aid"];  ?> 
  <?php
    if($row["aid"]==$row0["aid"])
    echo "selected";
    ?>><?php
  echo $row0["areaname"];
  ?>
  </option>
  <?php
  }
  ?>
</select> 
    </div>
  </div>

  <div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">海报图片</label>
    <div class="col-md-10 col-xs-10">
        <input type="file" name="pic"><br>
原海报：<img src="../posters/<?php
echo $row["pic"];
?>" width="80px" height="80px" class="img-circle">
      </div>
  </div>

<div class="form-group">
<label  class="col-md-2 col-xs-2 control-label">动漫电影简介</label>
    <div class="col-md-10 col-xs-10">
      <textarea name="videointro" class="form-control" rows="5"><?php
echo $row["intro"];
?>
</textarea>
      </div>
</div>

<div class="form-group">
    <label for="address" class="col-md-2 col-xs-2 control-label">下载地址</label>
    <div class="col-md-10 col-xs-10">
     <input type="text" class="form-control" name="address" value=<?php
echo $row["link"];
?>>
    </div>
  </div>
   
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 col-xs-10">
    <input type="submit"  class="btn btn-default" value="更新">

  </div>
  </div>

</form>



<?php
  require_once('tpl/footer.php');
?>