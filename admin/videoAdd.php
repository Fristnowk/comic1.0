<?php
//添加动漫电影信息功能模块的实现：显示添加动漫电影信息的表单页
  require_once('tpl/header.php');
?>

<?php
$link=connect();
$sql="select * from area";
$rs=mysqli_query($link,$sql);
?>
 <h3>请填写动漫电影信息</h3>
<form class="form-horizontal" method="POST" action="doVideoAdd.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="videoname" class="col-md-2 col-xs-2 control-label">动漫电影名称</label>
    <div class="col-md-10 col-xs-10">
      <input type="text" class="form-control" id="videoname" placeholder="videoname" name="videoname" required>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">所属地区</label>
    <div class="col-md-10 col-xs-10">
    <select class="form-control" name="aid">
  <?php
  while($row=mysqli_fetch_assoc($rs))
  {
  ?>
  
  <option value=<?php
  echo $row["aid"];
  ?>
  ><?php
  echo $row["areaname"];
  ?>
  </option>
  <?php
  }
  ?>
  
</select> 
    </div>
</div>
  
<div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">动漫电影海报</label>
    <div class="col-md-10 col-xs-10">
        <input type="file" id="exampleInputFile" name="pic" required>
      </div>
  </div>


<div class="form-group">
<label  class="col-md-2 col-xs-2 control-label">动漫电影简介</label>
    <div class="col-md-10 col-xs-10">
       <textarea class="form-control" rows="3" name="videointro" required></textarea>
      </div>
</div>

 <div class="form-group">
    <label for="address" class="col-md-2 col-xs-2 control-label">下载地址</label>
    <div class="col-md-10 col-xs-10">
      <input type="text" class="form-control" id="address" placeholder="address" name="address" required>
    </div>
  </div>
    
  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
      <input type="submit" class="btn btn-default" value="添加">
     <input type="reset" class="btn btn-default" value="重置">
  </div>
  </div>
</form>      




<?php
  require_once('tpl/footer.php');
?>