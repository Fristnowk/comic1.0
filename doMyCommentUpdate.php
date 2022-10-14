<?php
//用户更新自己的留言信息
require_once('tpl/head.php');
require_once('./system/dbConn.php');
 //连接数据库  
  $link=connect();
	$cid = $_POST['cid'];
	$page = $_POST['page'];
	$content = $_POST['content'];
	//更新数据库相应信息
//编写SQL语句
    $sql = "update comments set content='{$content}',cdate=now() where cid={$cid}";			

  //执行SQL语句
   $result = mysqli_query($link,$sql) or die("sql={$sql}, 更新失败！<br/>".mysqli_error($link));
  //判断是否更新成功
  if(!$result){
		echo "更新失败！<br/>";
		echo "<a href='myCommentList.php'>返回</a>";	  
  }else{		
		//echo '<h2 style="color:white;">我的留言更新成功！3秒后返回留言列表页</h2>';
		// header("refresh:3;url='myCommentList.php'"); 
		 header("location:myCommentList.php?page=$page&flag=1");
  }	
?>
              
   <?php
require_once('tpl/foot.php');
?>