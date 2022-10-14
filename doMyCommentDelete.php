<?php
//用户删除自己发表的留言信息
require_once('tpl/head.php');
require_once('./system/dbConn.php');
 //连接数据库  
$link=connect();
	//用户id是通过GET方法提交的   
	$page=$_GET['page'];
	$cid = $_GET['cid'];
	//删除数据库相应信息
	$sql = "delete from comments where cid={$cid}";
	$result = mysqli_query($link,$sql) or die('删除我的评论失败！'.mysqli_error($link));
	 if(!mysqli_error($link)){
			//echo '<h2 style="color:white;">我的评论删除成功！3秒后返回评论列表页</h2>';
		 //header("refresh:3;url='myCommentList.php'"); 
		 header("location:myCommentList.php?page=$page&flag=2");
		 }
?>
              
   <?php
require_once('tpl/foot.php');
?>