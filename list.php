<?php
//前台列表页功能模块的实现
 require_once('tpl/head.php');
 require_once('./system/dbConn.php');
//连接数据库		
  $link=connect();
//地区id是通过GET方法提交的   
   $aid = $_GET['aid'];
   $sql0="select * from area where aid=$aid";
   $result0 = mysqli_query($link,$sql0) or die('查询失败！'.mysql_error());   
   $row0 = mysqli_fetch_assoc($result0);

   $sql = "select * from videos where aid={$aid}";   
   $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));   
  //获取指定的页码
   //判断是否指定第几页，如果没有指定，则显示第1页。
	if(!isset($_GET["page"]))
	$page=1;
	else{
		$page=$_GET["page"];
	}

  //获取总行数，用于计算分几页显示
  $result = mysqli_query($link,$sql);
  $totalrows = mysqli_num_rows($result);

  //定义每页显示的行数
  $rowsperpage =8;
  //计算从表中第几行开始输出
  $start = ($page-1) * $rowsperpage;

  //从第$start行开始，共查询$rowsperpage行。
  $sql .= " limit {$start}, {$rowsperpage}";
  //echo $sql.'<br/>';
  //执行sql语句
  $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));  

   //查询该地区下的下载排行信息
   $sql1 = "select * from videos where aid={$aid} order by downloads desc  limit 4";   
   $result1 = mysqli_query($link,$sql1) or die('查询失败！'.mysqli_error($link));   
?>


<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">


            <div class="row">


                <div class="col-xs-12 col-lg-12 mlist">
                    <h2><?php
                    echo $row0["areaname"];
                    ?></h2>
                    <ul class="list-inline row text-center">
                      <?php
                      while($row=mysqli_fetch_assoc($result))
					  {
                      ?>
                        <li class="col-xs-6 col-lg-3">
                            <img src="posters/<?php
                            echo $row["pic"];
                            ?>" class="responsive img-thumbnail"/>

                            <p><a href="show.php?vid=<?php
                            echo $row["vid"];
                            ?>"><?php
                            echo $row["videoname"];
                            ?></a>
                            </p>
                        </li>
					<?php
					  }
					?>
					</ul>
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
	  $first = "<a href=?page=1&aid=$aid>首页</a>";
	  $pre = "<a href=?aid=$aid&page=".($page-1).">上一页</a>";
  }else{
	  $first = '首页';
	  $pre = '上一页';
  }
  //如果不是最后一页，则显示下一页和最后一页的超链接，否则只显示文字
  if($page<$totalpages){
	  $last = "<a href=?aid=$aid&page=$totalpages>尾页</a>";
	  $next = "<a href=?aid=$aid&page=".($page+1).">下一页</a>";
  }else{
	  $last = '尾页';
	  $next = '下一页';
  }
  //输出分页
  echo "共{$totalrows}条记录&nbsp;&nbsp;";
  echo "$first"."&nbsp;&nbsp;";
  echo "$pre"."&nbsp;&nbsp;";
  for($i=1;$i<=$totalpages;$i++) 
		echo "<a href=?aid=$aid&page=$i>第{$i}页</a>&nbsp;&nbsp;";
  echo "$next"."&nbsp;&nbsp;";
  echo "$last";
  ?>
  
  </nav>


                </div>
                <!--/.col-xs-6.col-lg-4-->

            </div>
            <!--/row-->
        </div>
        <!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas">
            <div class="list-group text-center"  id="sidebar">
                <h2 style="color:white;">下载排行</h2>
                <ul class="list-inline row text-center">
					<?php
                      while($row1=mysqli_fetch_assoc($result1))
					  {
                      ?>
                    <li class="col-xs-12 col-lg-6">
                       <img src="posters/<?php
                            echo $row1["pic"];
                            ?>" class="responsive img-thumbnail"/>

                            <p><a href="show.php?vid=<?php
                            echo $row1["vid"];
                            ?>"><?php
                            echo $row1["videoname"];
                            ?></a>
                            </p>
                    
                    </li>
                   <?php
					  }
					?>

                </ul>
            </div>

        </div>
        <!--/.sidebar-offcanvas-->
    </div>
    <!--/row-->

    

</div>
<!--/.container-->
<?php

require_once('tpl/foot.php');
?>