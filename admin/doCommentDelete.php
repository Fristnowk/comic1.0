<?php
//删除留言功能的实现
  require_once('tpl/header.php');
?>


<?php
  //连接到数据库  
  $link=connect();
  //评论id是通过GET方法提交的   
  $cid = $_GET['cid'];
  //删除数据库相应信息
  $sql = "delete from comments where cid={$cid}";
  $result = mysqli_query($link,$sql) or die('删除评论失败！'.mysqli_error($link));
  if(!mysqli_error($link)){
    redirect('commentList.php', '删除成功！');
  } 
?>


<?php
  require_once('tpl/footer.php');
?>