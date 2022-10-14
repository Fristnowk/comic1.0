<?php
require_once('tpl/head.php');
require_once('./system/dbConn.php');
 //连接数据库  
$link=connect();

//根据user的session值取得uid
$uname=$_SESSION["user"];
$sql1="select uid from users where uname='$uname'";
//echo $sql1;
$rs1=mysqli_query($link,$sql1)or die('查询1失败！'.mysqli_error($link));   
$row1=mysqli_fetch_assoc($rs1);
$uid=$row1["uid"];

//获取指定的页码
   //判断是否指定第几页，如果没有指定，则显示第1页。
	if(!isset($_GET["page"]))
	$page=1;
	else{
		$page=$_GET["page"];
	}
	 //编写sql语句
  $sql = "select * from comments join videos on comments.vid=videos.vid where uid=$uid";
  $result = mysqli_query($link,$sql) or die('查询2失败！'.mysqli_error($link));    
  //获取总行数，用于计算分几页显示
  $totalrows = mysqli_num_rows($result);
  //定义每页显示的行数
  $rowsperpage =10;
  //计算从表中第几行开始输出
  $start = ($page-1) * $rowsperpage;

  //查询用户，从第$start行开始，共查询$rowsperpage行。
  $sql.= " limit {$start}, {$rowsperpage}";
  //执行sql语句
  $result= mysqli_query($link,$sql) or die('查询3失败！'.mysqli_error($link));  
  if($totalrows>0)
	  {		
?>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-12">

            <div class="row">
                <div class="col-xs-12 col-lg-12 mlist">
                    <h2 style="text-align:center;">留言列表 </h2>
             <table class="table table-hover"> 
			<tr>
			<th>序号</th>
			<th>电影名称</th>
			<th>留言内容</th>
			<th>发表留言的时间</th>
			<th>操作</th>
			</tr>

<?php
	$i=1;
	while($row=mysqli_fetch_assoc($result))
	{
 ?>								
									<tr>
									<td width="10%"><?php
									echo $i++;	
									?>
							    	<td width="20%"><?php		
									echo $row["videoname"];
									?></td>
									<td width="40%"><?php
								echo $row["content"];
									?></td>
									<td width="20%"><?php
									echo $row["cdate"];
									?></td>
								<td width="10%">
					<a href="myCommentEdit.php?page=<?php
							echo $page;
						?>&cid=<?php
							echo $row["cid"];
						?>" title="">修改</a> |
					<a href="doMyCommentDelete.php?page=<?php
							echo $page;
						?>&cid=<?php
							echo $row["cid"];
						?>" title="" onclick="return confirm('确认删除吗？')">删除</a>
										</td>
									</tr>
									<?php
									}
									?>			     
                   </table>         
                    <nav class="text-center">
<?php
//计算总页数。如果每页显示的行数>总行数，则只有1页，否则，页数=总行数/每页行数，上取整
  if($rowsperpage >= $totalrows)
      $totalpages = 1;
  else{	  
	  $totalpages = ceil($totalrows / $rowsperpage);
  }
  //如果不是第1页，则显示第一页和上一页的超链接，否则只显示文字
  if($page>1){
	  $first = "<a href=?page=1>首页</a>";
	  $pre = "<a href=?page=".($page-1).">上一页</a>";
  }else{
	  $first = '首页';
	  $pre = '上一页';
  }
  //如果不是最后一页，则显示下一页和最后一页的超链接，否则只显示文字
  if($page<$totalpages){
	  $last = "<a href=?page=$totalpages>尾页</a>";
	  $next = "<a href=?page=".($page+1).">下一页</a>";
  }else{
	  $last = '尾页';
	  $next = '下一页';
  }
  //输出分页
  echo "共{$totalrows}条记录&nbsp;&nbsp;";
  echo "$first"."&nbsp;&nbsp;";
  echo "$pre"."&nbsp;&nbsp;";
  for($i=1;$i<=$totalpages;$i++) 
		echo "<a href=?page=$i>第{$i}页</a>&nbsp;&nbsp;";
  echo "$next"."&nbsp;&nbsp;";
  echo "$last";
  ?>
  
  </nav>


                </div>
                <!--/.col-xs-6.col-lg-4-->

            </div>
            <!--/row-->
        </div>
        <!--/.col-xs-12.col-sm-12-->
<?php
	}
else{
	 
	echo '<h2 style="color:white;">您尚未评价任何影片，找不到您的评论记录</h2>';
	
}
?>   
    </div>
    <!--/row-->
</div>
   <?php
require_once('tpl/foot.php');
?>

<?php
//判定删除和更新页传过来的值 flag=1 显示修改成功，flag=2 显示删除成功。
if(isset($_GET["flag"]))
	if($_GET["flag"]==1){
	echo '<script>alert("评价更新成功！");</script>';
	}
	else{
		echo '<script>alert("评价删除成功！");</script>';
	}
?>