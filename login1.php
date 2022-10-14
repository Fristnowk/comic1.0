<?php
//前台用户登录表单页
 require_once('tpl/head.php');
 include_once('./system/dbConn.php');
 $vid=$_GET["vid"];
?>
	
<body>
<div class="container">
<form  method="post" action="doLogin1.php"  class="form-horizontal">
<input type="hidden" name="vid" value=<?php
echo $vid;
?>>
<h2>普通用户登录</h2>
<div class="form-group">
  <label for="exampleInputUserName1" class="col-md-2 control-label">用户名</label>
 <div class="col-md-4">
<input type="text" name="uname" class="form-control" id="exampleInputUserName1" placeholder="姓名" required>
</div>
<div class="col-md-6">
</div>
</div>

	<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">密码</label>
    <div class="col-md-4">
	<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码" required>
	</div>
	 <div class="col-md-6">
	
	</div>
  </div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value="提交">
	  <input type="reset" class="btn btn-default" value="重置">
    </div>
  </div>
	

<?php
if(isset($_GET["msg"])){
echo $_GET["msg"];
}
?>


  </form>


     
    </div>
    <!--/row-->
   <?php
require_once('tpl/foot.php');
?>
