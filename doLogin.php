<html>
 <head>
  <meta charset="UTF-8">
  
  <title>处理表单</title>
 </head>
 <body>
 <?php
 //处理用户登录功能的实现
  require_once('./system/dbConn.php');
 //连接数据库    
  $link=connect();
  //如果是首页登录
if($_POST["vid"]==0){
$u=$_POST["username"];
$p=$_POST["pswd"];
 
$sql="select * from users where uname='$u' and password=md5('$p')"; 

//执行sql
$rs=mysqli_query($link,$sql);
$num=mysqli_num_rows($rs);
if($num>0)
{
   session_start();
   $_SESSION["user"]=$u;
   header("location:index.php");
}
else
    header("location:index.php?re=1&msg=登录失败，请重新登录");
   }else{
     //如果是内容页登录
  $vid=$_POST["vid"];
  $u=$_POST["username"];
  $p=$_POST["pswd"];
  $sql="select * from users where uname='$u' and password=md5('$p')"; 

//执行sql
$rs=mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));
$num=mysqli_num_rows($rs);
//如果登录信息正确 
if($num>0)
{ session_start();
   $_SESSION["user"]=$u;
     header("location:show.php?vid=$vid");
}
//如果登录失败 
else{
  header("location:show.php?re=1&msg=登录失败，请重新登录&vid=$vid"); 
   }
}
?>

  
 </body>
</html>
