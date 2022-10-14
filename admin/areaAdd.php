<?php
//添加地区功能模块的实现：显示添加地区的表单页
  require_once('tpl/header.php');
?>



 <h3>请填写地区信息</h3>
<form class="form-horizontal" method="POST" action="doAreaAdd.php" enctype="multipart/form-data">

  <div class="form-group">
    <label for="areaname" class="col-md-2 control-label">地区名称</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="areaname" placeholder="areaname" name="areaname">
    </div>
  </div>

      
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value="添加">
  </div>
  </div>
</form>      




<?php
  require_once('tpl/footer.php');
?>