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
if(strcmp($row["password"],md5($oldpswd))!=0) {
echo "修改失败，原密码不正确，3秒后返回";
header("refresh:3;url='index.php'");
exit;
}
if(strcmp($newpswd1,$newpswd2)!=0){
echo "修改失败，新密码和确认密码不一致，3秒后返回";
header("refresh:3;url='index.php'");
exit;
}
$sql="update users set password=md5('$newpswd1') where uname='$u'";
$rs=mysqli_query($link,$sql);
if($rs==1){
echo "修改成功，3秒后返回首页";
header("refresh:3;url='index.php'");
}else{
echo "<h2>密码修改失败，3秒后返回网站首页<h2>";
header("refresh:3;url='index.php'");
}

?>

     </div>
    <!--/row-->

    <hr>

    

</div>
<!--/.container-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>

<script src="offcanvas.js"></script>
<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
</script>
</body>
</html>