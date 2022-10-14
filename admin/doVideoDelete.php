<?php
//删除动漫电影信息功能模块的实现
  require_once('tpl/header.php');
?>


<?php
  //连接到数据库  
  $link=connect();
  //vid是通过GET方法提交的   
  $vid = $_GET['vid'];

  $sql="select * from videos where vid={$vid}";
  $result=mysqli_query($link,$sql);
  $row=mysqli_fetch_assoc($result);
  $filename=PosterPicturePath.$row["pic"];
  //删除数据库相应信息，如果删除成功，删除该用户的头像文件
  $sql = "delete from videos where vid={$vid}";
  $result = mysqli_query($link,$sql) or die('删除失败！'.mysqli_error($link));
  if(!mysqli_error($link)){
    //如果有头像，则删除头像文件
    if(file_exists($filename))    unlink($filename);
    redirect('videoList.php', '删除成功！');
  } 
?>


<?php
  require_once('tpl/footer.php');
?>