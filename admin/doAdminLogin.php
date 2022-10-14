<!-- doAdminLogin.php 用于判断用户是否合法。 -->
<?php
//处理管理员登录功能的实现
  require_once('../system/myFunc.php');   
  require_once('../system/dbConn.php');  
  //获取用户输入的信息
  $adminname = $_POST["adminname"];
  $password = $_POST["password"];

  //连接数据库  
  $link=connect();
  //编写sql语句
  $sql = "select * from admins where adminname='".$adminname."' and password=md5('".$password."')"; 
  //echo $sql."<br/>";
  $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));
  
  //判断是否合法用户，如果是合法用户，则转向用户列表页面，否则转向登录页面
  $num = mysqli_num_rows($result);
  if($num>0){	 
	  //3秒后转向用户列表页面
	  session_start();
	   $_SESSION["admin"]=$adminname;

 if(isset($_POST["rm"])){
  setcookie("name",$adminname,time()+3600*24);
 }

	 header("location:welcome.php");	
  }else{
	 header("location:index.php?msg= '用户名或密码错误！请重新登录'");	  
  } 
?>