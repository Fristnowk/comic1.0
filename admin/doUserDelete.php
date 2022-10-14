<?php
//删除用户信息功能模块的实现
  require_once('tpl/header.php');
  //连接到数据库  
  $link=connect();
  //用户id是通过GET方法提交的   
  $uid = $_GET['uid'];
  $sql="select * from users where uid={$uid}";
  $result=mysqli_query($link,$sql);
  $row=mysqli_fetch_assoc($result);
  $filename=UserPhotoPath.$row["photo"];
  //如果有头像，则删除头像文件
    if(file_exists($filename)){
      unlink($filename);
    }    
  //删除数据库相应信息，如果删除成功，删除该用户的头像文件
  $sql = "delete from users where uid={$uid}";
  $result = mysqli_query($link,$sql) or die('删除失败！'.mysqli_error($link));
  $num=mysqli_query($link,$sql);
  if ($num==1) {     
    redirect('userList.php', '删除成功！');
  } 
?>


<?php
  require_once('tpl/footer.php');
?>