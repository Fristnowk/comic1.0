<html>
 <head>
  <meta charset="UTF-8">
  
  <title>处理表单</title>
 </head>
 <body>
<?php
//前台用户修改个人密码的功能实现
require_once('./system/dbConn.php');
 //连接数据
$link=connect();
session_start();
$u=$_SESSION["user"];
$oldpswd=$_POST["old"];
$newpswd1=$_POST["new1"];
$newpswd2=$_POST["new2"];

$sql0="select * from users where uname='$u'";
$rs=mysqli_query($link,$sql0);
$row=mysqli_fetch_assoc($rs);
require_once('./system/dbConn.php');
 //连接数据
$link=connect();
  //使用$_POST数组获取表单中输入的数据
  $uid=$_POST["uid"];
  $uname =$_POST["uname"]; 
  $tel = $_POST['tel'];
  $gender = $_POST['gender'];
  $email=$_POST["email"];
  
  //上传文件错误的判定
  if($_FILES["pic"]["error"]>0)
  {
		switch($_FILES["pic"]["error"])
		{
			case 1: echo "文件尺寸超过了配置文件的最大值";	exit;
			case 3: echo "部分文件上传";	exit;
			case 4: echo "没有选择头像文件!";	
				//如果没选择图片，则直接更新其他数据
				$sql = "update users set uname='{$uname}',tel='{$tel}', gender={$gender},updatetime=now(),email='{$email}' where uid={$uid}";	
				break;
			default: echo "未知错误";	exit;	
		}			
  }else {		//上传文件，删除原来的头像，更新数据库

		//获取文件扩展名
		$suffix = strrchr($_FILES["pic"]["name"], '.');	//获取.在文件名中最后一次出现
		//echo $suffix;
		
	   
		//指定在服务器上的文件存放路径和文件名
		$filepath="images/";
		$randname=date("YmdHis").rand(100,999).$suffix;
		//echo $filepath.$newname.'<br/>';

		//上传文件，如果上传成功，则将用户信息修改到数据库，否则提示“上传失败”
		if (move_uploaded_file($_FILES["pic"]["tmp_name"],$filepath.$randname)) {
			echo "图片上传成功<br>";
		}
			//获取头像文件的文件名
			$sql="select * from users where uid={$uid}";
			$result=mysqli_query($link,$sql);
			$row=mysqli_fetch_assoc($result);
			$filename=$filepath.$row["photo"];
			//删除原来的头像文件
			if(file_exists($filename))		
				unlink($filename);

			//编写SQL语句
			$sql = "update users set uname='{$uname}', tel='{$tel}', gender={$gender}, updatetime=now(),email='{$email}', photo='{$randname}' where uid=$uid";			
		}
 
  //执行SQL语句
  $result = mysqli_query($link,$sql) or die("更新失败<br/>".mysqli_error($link));
  //判断是否更新成功
  if($result){
	header("location:index.php?re8=1&msg8=修改成功，请点击关闭按钮返回首页");
  }	
  
 ?>