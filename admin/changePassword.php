<?php
//后台管理员修改密码功能的实现
  require_once('tpl/header.php');
?>

 <form  name="fm" method="post" action="doChangePassword.php" onsubmit="return check()" class="form-horizontal">
<h3>请修改您的密码</h3>

  <div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 col-xs-2 control-label">原密码</label>
    <div class="col-md-4 col-xs-4">
  <input type="password" name="old" class="form-control" id="exampleInputPassword1" placeholder="原密码" required>
  </div>
   <div class="col-md-4">
  
  </div>
  </div>


<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 col-xs-2 control-label">新密码</label>
    <div class="col-md-4 col-xs-4">
  <input type="password" name="new1" class="form-control" id="exampleInputPassword1" placeholder="新密码" required>
  </div>
   <div class="col-md-4">
  
  </div>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 col-xs-2 control-label">确认新密码</label>
    <div class="col-md-4 col-xs-4">
  <input type="password" name="new2" class="form-control" id="exampleInputPassword1" placeholder="确认新密码" required>
  </div>
   <div class="col-md-4">
  
  </div>
  </div>



<div class="form-group">
    <div class="col-md-offset-4 col-xs-4 col-md-8">
      <input type="submit" class="btn btn-default" value="修改">
    <input type="reset" class="btn btn-default" value="重置">
    </div>
  </div>

  </form>


<?php
  require_once('tpl/footer.php');
?>