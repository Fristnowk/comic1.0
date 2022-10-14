<?php
//前台首页功能模块的实现
require_once('tpl/head.php');
require_once('./system/dbConn.php');
  //连接数据库		
  $link=connect();
  //查询首页中国大陆地区的六个视频
    $sql1="select * from area where areaname='中国大陆'";
	$result1 = mysqli_query($link,$sql1) or die('查询失败！'.mysql_error($link));  
	$row1=mysqli_fetch_assoc($result1);
	$aid1=$row1["aid"];
	//根据查的的地区id查询中国大陆地区的六条记录
	$sql11="select * from videos where aid='$aid1' limit 6";
	$result11 = mysqli_query($link,$sql11) or die('查询失败！'.mysqli_error($link));  

	 //查询首页美国地区的六个视频
    $sql3="select * from area where areaname='美国'";
	$result3 = mysqli_query($link,$sql3) or die('查询失败！'.mysqli_error($link));  
	$row3=mysqli_fetch_assoc($result3);
	$aid3=$row3["aid"];
	//根据查的的地区id查询美国地区的六条记录
	$sql33="select * from videos where aid='$aid3' limit 6";
	$result33 = mysqli_query($link,$sql33) or die('查询失败！'.mysqli_error($link));  


	//查询首页日本地区的六个视频
    $sql4="select * from area where areaname='日本'";
	$result4 = mysqli_query($link,$sql4) or die('查询失败！'.mysqli_error($link));  
	$row4=mysqli_fetch_assoc($result4);
	$aid4=$row4["aid"];
	//根据查到的地区id查询日本的六条记录
	$sql44="select * from videos where aid='$aid4' limit 6";
	$result44 = mysqli_query($link,$sql44) or die('查询失败！'.mysqli_error($link));  

//查询首页显示的点击排行4个视频和下载排行的4个视频
    $sql5="select * from videos  order by clicks desc  limit 4";
	$sql6="select * from videos  order by downloads desc  limit 4";
	$result5 = mysqli_query($link,$sql5) or die('查询失败！'.mysqli_error($link));  
	$result6 = mysqli_query($link,$sql6) or die('查询失败！'.mysqli_error($link));  
	?>
<div class="container">
<!--幻灯片开始-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="assets/images/image1.jpg" class="img-responsive" alt="image 1">

            <div class="carousel-caption">
              
            </div>
        </div>
        <div class="item">
            <img src="assets/images/image2.jpg" class="img-responsive" alt="image 2">

            <div class="carousel-caption">
               

            </div>
        </div>
        <div class="item">
            <img src="assets/images/image3.jpg" class="img-responsive" alt="image 3">

            <div class="carousel-caption">
               
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<!--幻灯片结束-->



    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-md-9">


            <div class="row text-center">
                <div class="col-xs-12 col-md-12 mlist">
                    <h2>中国大陆</h2>
                    <ul class="list-inline row text-center">
                        <?php
                        while($row1=mysqli_fetch_assoc($result11))
                        {
						?>
                        <li class="col-xs-4 col-sm-3 col-lg-2">
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
                     <p><a class="btn btn-default" href="list.php?aid=<?php
                    echo $aid1;
                    ?>" role="button">更多 &raquo;</a></p>
                </div>
                <!--/.col-xs-6.col-md-4-->

            </div>
            <!--/row-->

           

			            <div class="row text-center">
                <div class="col-xs-12 col-lg-12 mlist">
                    <h2>美国</h2>
                    <ul class="list-inline row text-center">
                        <?php
                        while($row3=mysqli_fetch_assoc($result33))
                        {
						?>
                        <li class="col-xs-4 col-sm-3 col-lg-2">
                            <img src="posters/<?php
                            echo $row3["pic"];
                            ?>" class="responsive img-thumbnail"/>

                            <p><a href="show.php?vid=<?php
                            echo $row3["vid"];
                            ?>"><?php
                            echo $row3["videoname"];
                            ?></a>
                            </p>
                        </li>
                    <?php
                    }
                    ?>
                    </ul>
                     <p><a class="btn btn-default" href="list.php?aid=<?php
                    echo $aid3;
                    ?>" role="button">更多 &raquo;</a></p>
                </div>
                <!--/.col-xs-6.col-lg-4-->

            </div>
            <!--/row-->

<div class="row text-center">
                <div class="col-xs-12 col-md-12 mlist">
                    <h2>日本</h2>
                    <ul class="list-inline row text-center">
                        <?php
                        while($row4=mysqli_fetch_assoc($result44))
                        {
						?>
                        <li class="col-xs-4 col-sm-3 col-lg-2">
                            <img src="posters/<?php
                            echo $row4["pic"];
                            ?>" class="responsive img-thumbnail"/>

                            <p><a href="show.php?vid=<?php
                            echo $row4["vid"];
                            ?>"><?php
                            echo $row4["videoname"];
                            ?></a>
                            </p>
                        </li>
                    <?php
                    }
                    ?>
                    </ul>
                    <p><a class="btn btn-default" href="list.php?aid=<?php
                    echo $aid4;
                    ?>" role="button">更多 &raquo;</a></p>
                </div>
                <!--/.col-xs-6.col-lg-4-->

            </div>
            <!--/row-->


        </div>
        <!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-12 col-md-3 sidebar-offcanvas">
            <div class="list-group text-center" id="sidebar">
                <h2 style="color:white;" >点击排行</h2>
                <ul class="list-inline row text-center">
				<?php
				while($row5=mysqli_fetch_assoc($result5))
				{
				?>
				
                    <li class="col-xs-12 col-lg-6">
                        <img src="posters/<?php
                        echo $row5["pic"];
                        ?>" class="responsive img-thumbnail" />

                        <p><a href="show.php?vid=<?php
                            echo $row5["vid"];
                            ?>"><?php
						//显示视频名称中的前5个字符
                        echo mb_substr($row5["videoname"],0,6,'utf-8');
                        ?></a>
                        </p>
                    </li>
                 <?php
				}
                 ?>
               </ul>
            </div>

            <div class="list-group text-center"  id="sidebar">
                <h2 style="color:white;" >下载排行</h2>
                <ul class="list-inline row text-center">
                   	<?php
				while($row6=mysqli_fetch_assoc($result6))
				{
				?>			
                    <li class="col-xs-12 col-lg-6">
                        <img src="posters/<?php
                        echo $row6["pic"];
                        ?>" class="responsive img-thumbnail"/>

                        <p><a href="show.php?vid=<?php
                            echo $row6["vid"];
                            ?>"><?php
                     	//显示视频名称中的前5个字符
                        echo mb_substr($row6["videoname"],0,6,'utf-8');
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