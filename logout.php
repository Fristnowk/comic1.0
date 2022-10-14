<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  
  <title>Document</title>
 </head>
 <body>
<?php
//前台用户注销功能的实现
session_start();
session_destroy();
//header("location:login.php");
header("location:index.php?re6=1");
?>

 </body>
</html>
