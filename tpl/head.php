<?php 
session_start();
require_once('system/dbConn.php');  
$link=connect();
$sql="select * from area";
$rs=mysqli_query($link,$sql)or die('查询1失败！'.mysqli_error($link));
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>动漫电影信息网站</title>
	 <!-- Bootstrap core CSS js -->

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/play.css" rel="stylesheet">
	<link href="assets/css/offcanvas.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
	
	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
<!-- 从show页登录成功后取得vid 并跳转到登录模态框--> 
 <script>
 function func(vid){
	document.getElementById("videoid").value=vid;
   document.getElementById("login").modal();
	}
 </script>
 <!-- 从show页登录成功后取得vid 并跳转到登录模态框--> 

<!-- 弹窗显示视频的资源 css和jQ-->
<script>
jQuery(document).ready(function($) {
	$('.theme-login').click(function(){
		$('.theme-popover-mask').fadeIn(100);
		$('.theme-popover').slideDown(200);
	})
	$('.theme-poptit .close').click(function(){
var myVideo=$('#myVideo')[0];
			myVideo.pause();
		$('.theme-popover-mask').fadeOut(100);
		$('.theme-popover').slideUp(200);
				
	})

})
</script>
<!-- 弹窗显示视频的资源 css和jQ end-->
</head>

<body>
<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" style="font-weight:bold">
        <li><a href="index.php">首页</a></li>
<?php
					while($row=mysqli_fetch_assoc($rs))
					{
?>

                <li><a href="list.php?aid=<?php  echo $row["aid"]; ?>">
                  <?php
                echo $row["areaname"];
                ?>
                </a></li>
<?php
}
?>
          
          </ul>
        </li>
      </ul>
      <form   action="search.php"class="navbar-form navbar-left" role="search" >
        <div class="form-group">
          <input type="text" class="form-control"  name="videoname" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>
       <ul class="nav navbar-nav navbar-right">
<?php 
if(!isset($_SESSION["user"])){
?>
          <li><a href="#" data-toggle="modal" data-target="#login">登录</a></li>
          <li><a href="#" data-toggle="modal" data-target="#reg">注册</a></li>
<?php        
}else{
?>
<li><a href="#">欢迎【<?php echo $_SESSION["user"];?>】<img src="./images/<?php 
      $username=$_SESSION["user"];
      $sqluser="select photo from users where uname='$username'";
      $result=mysqli_query($link,$sqluser);
      $rowuser=mysqli_fetch_assoc($result);
      echo $rowuser["photo"];
       ?>" alt="" width="30px" height="30px" class="img-circle"></a></li>
      <li><a href="logout.php">注销</a></li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">个人中心 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#" data-toggle="modal" data-target="#changePassword">修改个人密码</a></li>
            <li><a href="#" data-toggle="modal" data-target="#changeInfor">修改个人信息</a></li>
            <li><a href="myCommentList.php" >我的留言</a></li>
            <li><a href="myCollectList.php" >我的收藏</a></li>
          </ul>
</li>
<?php 
}
 ?>
</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- /注册模态框 -->
 <div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">请填写用户注册信息</h4>
      </div>
      <div class="modal-body">
 <form method=post action="doUserReg.php" enctype="multipart/form-data"  class="form-horizontal">
  <div class="form-group">
  <label for="exampleInputUserName" class="col-md-2 control-label">用户</label>
 <div class="col-md-10">
<input type="text" name="username" class="form-control" id="exampleInputUserName" placeholder="姓名" required>
</div>
</div>
 <div class="form-group">
  <label for="exampleInputPassword" class="col-md-2 control-label">密码</label>
 <div class="col-md-10">
<input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="密码" required>
</div>
</div>
  <div class="form-group">
  <label class="col-md-2 control-label">性别</label>
    <div class="col-md-10">
    <label class="radio-inline">
  <input type="radio" name="gender"  value=0 checked> 男
</label>
<label class="radio-inline">
  <input type="radio" name="gender" value=1> 女
</label>
   </div>
  </div>
<div class="form-group">
  <label for="exampleInputBirth" class="col-md-2 control-label">电话</label>
 <div class="col-md-10">
<input type="number" name="tel" class="form-control" id="exampleInputBirth" placeholder="电话" required>
</div>
</div>
 <div class="form-group">
    <label for="exampleInputFile" class="col-md-2 control-label">头像</label>
    <div class="col-md-10">
  <input type="file"  name="pic" id="exampleInputFile" required>
    </div>
  </div>
 <div class="form-group">
    <label for="exampleInputEmail" class="col-md-2 control-label">电子邮件</label>
    <div class="col-md-10">
  <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="常用邮箱" required>
  </div>
  </div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value="注册">
    <input type="reset" class="btn btn-default" value="重置">
    </div>
  </div>
</form>
<?php
if(isset($_GET["msg1"])){
echo'<h1 style="color:red;">'.$_GET["msg1"]."</h1>";
}
if(isset($_GET["msg2"])){
echo '<h1 style="color:red;">'.$_GET["msg2"]."</h1>";
}
?>
</div>
      <div class="modal-footer">
              <button type="button" class="btn btn-default" onclick="location.replace('index.php')" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>  
<!-- /注册模态框结束 -->
<!-- /登录模态框开始 -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">请填写普通用户登录信息</h4>
      </div>
      <div class="modal-body">

	  <form  name="fm" method="post" action="doLogin.php" onsubmit="return check()" class="form-horizontal">
<input type="hidden" name="vid" id="videoid" >
<div class="form-group">
  <label for="exampleInputUserName1" class="col-md-2 control-label">用户名</label>
 <div class="col-md-4">
<input type="text" name="username" class="form-control" id="exampleInputUserName1" placeholder="姓名" required>
</div>
<div class="col-md-6">
</div>
</div>

	<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2 control-label">密码</label>
    <div class="col-md-4">
	<input type="password" name="pswd" class="form-control" id="exampleInputPassword1" placeholder="密码" required>
	</div>
	 <div class="col-md-6">
	
	</div>
  </div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value="登录">
	  <input type="reset" class="btn btn-default" value="重置">
    </div>
  </div>
<?php
if(isset($_GET["msg"])){
echo'<h1 style="color:red;">'.$_GET["msg"]."</h1>";
}
if(isset($_GET["msg9"])){
echo'<h1 style="color:red;">'.$_GET["msg9"]."</h1>";
}
?>
</form>
      </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="location.replace('index.php')" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>  
<!-- /登录模态框结束 -->
<!-- /修改密码模态框开始 -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改个人密码</h4>
      </div>
      <div class="modal-body">
<form  name="fm" method="post" action="doChangePassword1.php" onsubmit="return check()" class="form-horizontal">


	<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-4 control-label">原密码</label>
    <div class="col-md-4">
	<input type="password" name="old" class="form-control" id="exampleInputPassword1" placeholder="原密码" required>
	</div>
	 <div class="col-md-4">
	
	</div>
  </div>


<div class="form-group">
    <label for="exampleInputPassword1" class="col-md-4 control-label">新密码</label>
    <div class="col-md-4">
	<input type="password" name="new1" class="form-control" id="exampleInputPassword1" placeholder="新密码" required>
	</div>
	 <div class="col-md-4">
	
	</div>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1" class="col-md-4 control-label">确认新密码</label>
    <div class="col-md-4">
	<input type="password" name="new2" class="form-control" id="exampleInputPassword1" placeholder="确认新密码" required>
	</div>
	 <div class="col-md-4">
	
	</div>
  </div>



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-default" value="修改">
	  <input type="reset" class="btn btn-default" value="重置">
    </div>
  </div>
	

<?php
if(isset($_GET["msg3"])){
echo'<h1 style="color:red;">'.$_GET["msg3"]."</h1>";
}
?>
<?php
if(isset($_GET["msg4"])){
echo'<h1 style="color:red;">'.$_GET["msg4"]."</h1>";
}
?>
<?php
if(isset($_GET["msg5"])){
echo'<h1 style="color:red;">'.$_GET["msg5"]."</h1>";
}
?>

  </form>
      </div>
      <div class="modal-footer">
<button type="button" class="btn btn-default" onclick="location.replace('index.php')" data-dismiss="modal">关闭</button>   
      </div>
    </div>
  </div>
</div>  
<!-- /修改密码模态框结束 -->
<!-- /修改个人信息模态框开始 -->
<?php
if (isset($_SESSION["user"])) {
 $uname=$_SESSION["user"];
$sql = "select * from users where uname='$uname'";   
$result = mysqli_query($link,$sql) or die('查询2失败！'.mysqli_error($link));   
$row = mysqli_fetch_assoc($result);
$uid=$row['uid'];
$gender = $row['gender'];
$tel = $row['tel'];
$email = $row['email'];
$pic = "../images/".$row['photo'];   
}
 
?>
 <div class="modal fade" id="changeInfor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">请修改您的注册信息</h4>
      </div>
      <div class="modal-body">

<form method="post"  class="form-horizontal" action="doChangeInfor.php"  enctype="multipart/form-data">
  <input type="hidden" name="uid" value=<?php  echo $uid;  ?>>  

<div class="form-group">
    <label for="username" class="col-md-2 control-label">用户名</label>
    <div class="col-md-10">
   <input type="text" class="form-control" id="username" readonly="readonly" name="uname" value=<?php  echo $uname;  ?> readonly>
   </div>
</div>

<div class="form-group">
    <label  class="col-md-2 control-label">性别</label>
<div class="col-md-10">
  <label class="radio-inline">
 <input type="radio"  name="gender" value="0" <?php  if(!$gender) echo 'checked';  ?>>男</label>
<label class="radio-inline">
 <input type="radio"  name="gender" value="1" <?php  if($gender) echo 'checked';  ?>>女</label>
 </div>
</div>

<div class="form-group">
    <label  class="col-md-2 control-label">电话</label>
<div class="col-md-10">
<input type="number" name="tel" class="form-control"  value=<?php  echo $tel;  ?>>
 </div>
</div>
<div class="form-group">
    <label  class="col-md-2 control-label">头像</label>
<div class="col-md-10">    
     <input type="file" name="pic">
原头像：<img src="images/<?php
echo $row["photo"];
?>" width="80px" height="80px" class="img-circle">
</div>
</div>

<div class="form-group">
    <label  class="col-md-2 control-label">电子邮件</label>
<div class="col-md-10">    
   <input type="email" name="email" class="form-control"  value="<?php  echo $email;  ?>">
</div>
</div>



  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="submit"  class="btn btn-default" value="更新">
    </div>
  </div>

</form>
<?php
if(isset($_GET["msg7"])){
echo'<h1 style="color:red;">'.$_GET["msg7"]."</h1>";
}
?>
<?php
if(isset($_GET["msg8"])){
echo '<h1 style="color:red;">'.$_GET["msg8"]."</h1>";
}
?> 
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="location.replace('index.php')" data-dismiss="modal">关闭</button>
        
      </div>
    </div>
  </div>
</div>  
<!-- /修改个人信息模态框结束 -->