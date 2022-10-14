<?php
//后台管理员修改密码功能的实现
  require_once('tpl/header.php');
?>

<?php
  //连接到数据库  
$link=connect();

$u=$_SESSION["admin"];
$oldpswd=$_POST["old"];
$newpswd1=$_POST["new1"];
$newpswd2=$_POST["new2"];

$sql0="select * from admins where adminname='$u'";
$result0=mysqli_query($link,$sql0);
$row=mysqli_fetch_assoc($result0);
if(strcmp($row["password"],md5($oldpswd))!=0){
  redirect('welcome.php', '原密码不正确！');
  exit;
}
if(strcmp($newpswd1,$newpswd2)!=0){
  redirect('welcome.php', '新密码和确认密码不一致！');
  exit;
}

$sql="update admins set password=md5('$newpswd1') where adminname='$u'";
 //执行SQL语句
  //echo $sql;
  $result = mysqli_query($link,$sql) or die("密码修改失败！<br/>".mysqli_error($link));
  //判断是否更新成功
  if(!$result){
    echo "密码修改失败！<br/>";
    echo "<a href='welcome.php'>返回</a>";    
  }else{    
    redirect('welcome.php', '密码修改成功！');
  }
  
?>                             
<?php
  require_once('tpl/footer.php');
?>