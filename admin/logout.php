<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  
  <title>Document</title>
 </head>
 <body>
<?php
//管理员注销功能的实现
session_start();
session_destroy();
header("location:index.php");
?>

 </body>
</html>
