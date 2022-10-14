<?php
//前台动漫电影详情页功能模块的实现
 require_once('tpl/head.php');
 require_once('./system/dbConn.php');
  //连接数据库   
  $link=connect();
 //类型id是通过GET方法提交的   
   //根据类型vid从数据库中查询某个特定视频信息
   $vid = $_GET['vid'];
   $sql="select * from videos where vid=$vid";
   //echo $sql;
   $result = mysqli_query($link,$sql) or die('查询1失败！'.mysqli_error($link));   
   $row = mysqli_fetch_assoc($result);
  //取得留言分页记录
   //获取指定的页码
   //判断是否指定第几页，如果没有指定，则显示第1页。
  if(!isset($_GET["page"]))
  $page=1;
  else{
    $page=$_GET["page"];
  }
  //获取总行数，用于计算分几页显示
  $sql0="select * from comments where vid=$vid";
  $result0 = mysqli_query($link,$sql0);
  $totalrows = mysqli_num_rows($result0);

  //定义每页显示的行数
  $rowsperpage =5;
  //计算从表中第几行开始输出
  $start = ($page-1) * $rowsperpage;

  //查询用户，从第$start行开始，共查询$rowsperpage行。
  $sql0.= " limit {$start}, {$rowsperpage}";
 // echo $sql0.'<br/>';
  //执行sql语句
  $result0= mysqli_query($link,$sql0) or die('查询2失败！'.mysqli_error($link));  
  
//更新点击量
$sql2="update videos set clicks=clicks+1 where vid=$vid";
 mysqli_query($link,$sql2) or die('查询3失败！'.mysqli_error($link)); 
?>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-12">
          <div class="row box">
            <div class="col-md-4 text-center">
              <img src="posters/<?php echo $row["pic"];?>" width="270" height="320" >
<!-- 点击标题显示新窗口中的视频-->
            <div class="theme-buy">
                   <a class="theme-login" href="javascript:;">
                  <h3 class="brand-name" title="点击这里可在线播放~"><?php
                    echo $row["videoname"];
                    ?><img src="assets/images/play.png" width="30px" height="30px">
                    </h3></a>
            </div>

            <div class="theme-popover">
              <div class="theme-poptit">
                 <a  href="javascript:;" title="关闭" class="close">×</a>
                   <h4><?php echo $row["videoname"];?> </h4>
              </div>
            <div>
              <video id="myVideo" src=<?php echo $row["link"];?> controls  width="100%" height="100%">
              </video>
            </div>
      </div>
      <div class="theme-popover-mask"></div>
<!-- 点击标题显示新窗口中的视频-->
   </div>
     <div class="col-md-4 text-center">
        <table class="table">
        <tr>
          <td>地区</td>
          <td><?php
          $aid=$row["aid"];
          $sqlt="select * from area where aid=$aid";
          $result=mysqli_query($link,$sqlt) or die('查询5失败！'.mysqli_error($link));
          $vname=mysqli_fetch_assoc($result);
          echo $vname["areaname"];
          ?>
          </td>
        </tr>
        <tr>
          <td>更新时间</td>
          <td><?php echo $row["updatetime"];?></td>
        </tr>
        <tr>
          <td>点击次数</td>
          <td><?php echo $row["clicks"];;?></td>
        </tr>
        <tr>
          <td>下载次数</td>
          <td> <?php echo $row["downloads"];?></td>
        </tr>
        <tr>
          <td>有事找站长</td>
          <td><a href="mailto:support@zhonghui.vip">意见箱</a></td>
        </tr>
        <tr>
          <td>下载地址</td>
          <td> <a href="down.php?vid=<?php echo $row["vid"];?>" >点击这里下载</a></td>
        </tr>
        <tr>
          <td>评分</td>
          <td>
<?php 
//登录后的用户才可以评分
    if(isset($_SESSION["user"]))
  {
?>  
  <form name="f1" method="get" action="doLevel.php" onsubmit="check()" class="form-horizontal">
  <input type="hidden" name="vid" value="<?php
echo $row["vid"];
?>">
  <select  name="level" required>
  <option selected value="">评价影片</option>
  <option value="5">力推★★★★★</option>
  <option value="4">推荐★★★★</option>
  <option value="3">还行★★★</option>
  <option value="2">较差★★</option>
  <option value="1">很差★</option>
</select>
  <input type="submit" value=" 评价">
  </form>
<?php
  }else{
    ?>             
  <a href="#" data-toggle="modal" data-target="#login"  onclick="func(<?php
    echo $row['vid']
    ?>)">登录</a>后可以评分
    <?php
  }
?>
          </td>
      </tr>
     </table>
   </div>
<!-- 影评分开始 -->
 <div class="col-md-4 text-center">
    <table class="table table-bordered">
          <tr>
          <td>评分
 <?php
    $sqls="select avg(score) from levels where vid=$vid";
    $query=mysqli_query($link,$sqls) or die('查询4失败！'.mysqli_error($link));  
    $row1=mysqli_fetch_array($query);
    $number= $row1['0']; 
   if($number==0){
    echo "<h2>暂无评分</h2>";
   }else{//如果有评分
    echo "<h2>".substr($number,0,3)."</h2>";
  //计算各等级占比 
$sqltal="select count(*) as tal from levels where vid=$vid";
$sqlcur5="select count(*) as cur5 from levels where vid=$vid and score=5";
$sqlcur4="select count(*) as cur4 from levels where vid=$vid and score=4";
$sqlcur3="select count(*) as cur3 from levels where vid=$vid and score=3";
$sqlcur2="select count(*) as cur2 from levels where vid=$vid and score=2";
$sqlcur1="select count(*) as cur1 from levels where vid=$vid and score=1";
$rstal=mysqli_query($link,$sqltal);
$rowtal=mysqli_fetch_assoc($rstal);
$tal=$rowtal["tal"];
$rscur5=mysqli_query($link,$sqlcur5);
$rowcur5=mysqli_fetch_assoc($rscur5);
$cur5=$rowcur5["cur5"];

$rscur4=mysqli_query($link,$sqlcur4);
$rowcur4=mysqli_fetch_assoc($rscur4);
$cur4=$rowcur4["cur4"];

$rscur3=mysqli_query($link,$sqlcur3);
$rowcur3=mysqli_fetch_assoc($rscur3);
$cur3=$rowcur3["cur3"];

$rscur2=mysqli_query($link,$sqlcur2);
$rowcur2=mysqli_fetch_assoc($rscur2);
$cur2=$rowcur2["cur2"];

$rscur1=mysqli_query($link,$sqlcur1);
$rowcur1=mysqli_fetch_assoc($rscur1);
$cur1=$rowcur1["cur1"];
?>
5星 -> <?php echo round(($cur5/$tal)*100); echo "%";?><br>
4星 -> <?php echo round(($cur4/$tal)*100); echo "%";?><br>
3星 -> <?php echo round(($cur3/$tal)*100); echo "%";?><br>
2星 -> <?php echo round(($cur2/$tal)*100); echo "%";?><br>
1星 -> <?php echo round(($cur1/$tal)*100); echo "%";?><br>
<?php
}//end of else     
?>
          </td>
          </tr>
          <tr>
          <td><a href="doCollect.php?vid=<?php echo $row["vid"] ?>">点击收藏</a></td>
          </tr>
      </table>
     </div>

            </div>
            <!--/row-->
            <div class="row box">

                <div class="col-lg-12">
                    <h3 class="intro-text text-center">内容简介</h3>
          <?php
                    echo $row["intro"];
                    ?>


                </div>
            </div>
}


<?php
//如果有留言显示留言列表   
$num=mysqli_num_rows($result0);
if($num>0)
    {
?>
 <div class="row box">

                <div class="col-md-12">


                    <h3 class="intro-text text-center">留言列表</h3>
  <table class="table" align="center">
  <tr>
  <th>序号</th>
  <th>内容</th>
    <th>评论人</th>
  <th>发表时间</th>
  </tr>
    <?php
    $i=1;
    while($row=mysqli_fetch_assoc($result0))
    {
    ?>
    <tr>
    <td width="10%"><?php
    echo $i++;
    ?>
    </td>
      <td width="50%"><?php
    echo $row["content"];
    ?>
    </td>
  <td width="20%"><?php
   $uid=$row["uid"];
          $userrs=mysqli_query($link,"select * from users where uid=$uid");
          $user=mysqli_fetch_assoc($userrs);
          echo $user["uname"];
    ?>
    </td>
  <td width="20%"><?php
    echo $row["cdate"];
    ?>
    </td>
    </tr>
    <?php
    }//end of while
    ?>
  
  </table>
  <div align="center">
<?php
//计算总页数。如果每页显示的行数>总行数，则只有1页，否则，页数=总行数/每页行数，上取整
  if($rowsperpage >= $totalrows)
      $totalpages = 1;
  else{   
    $totalpages = ceil($totalrows / $rowsperpage);
  }
  //如果不是第1页，则显示第一页和上一页的超链接，否则只显示文字
  if($page>1){
    $first = "<a href=show.php?page=1&vid=$vid>首页</a>";
    $pre = "<a href=show.php?vid=$vid&page=".($page-1).">上一页</a>";
  }else{
    $first = '首页';
    $pre = '上一页';
  }
  //如果不是最后一页，则显示下一页和最后一页的超链接，否则只显示文字
  if($page<$totalpages){
    $last = "<a href=show.php?vid=$vid&page=$totalpages>尾页</a>";
    $next = "<a href=show.php?vid=$vid&page=".($page+1).">下一页</a>";
  }else{
    $last = '尾页';
    $next = '下一页';
  }
  //输出分页
  echo "共{$totalrows}条记录&nbsp;&nbsp;";
  echo "$first"."&nbsp;&nbsp;";
  echo "$pre"."&nbsp;&nbsp;";
  for($i=1;$i<=$totalpages;$i++) 
    echo "<a href=show.php?vid=$vid&page=$i>第{$i}页</a>&nbsp;&nbsp;";
  echo "$next"."&nbsp;&nbsp;";
  echo "$last";
  ?>
</div>
 
             </div>
            </div>
<?php
    }//end of if
       else{
?>
<div class="row box">

                <div class="col-md-12">


                    <h3 class="intro-text text-center">暂无留言</h3>
          
          </div>
</div>
<?php

       }
 ?>
<?php 

    if(isset($_SESSION["user"]))
  {
?>  
         <div class="row box">

                <div class="col-md-12">
                    <h3 class="intro-text text-center">写留言</h3>
<form method="post" action="doComment.php" class="form-horizontal">
<input type="hidden" name="vid" value=<?php echo $vid ?>>
  <div class="form-group">
      <div class="col-md-12">
    <textarea class="form-control" cols="80" rows="5"  required name="content"></textarea>
  </div>
  </div>
   <div class="form-group">
    <div class="col-md-12 text-center">
      <input type="submit" class="btn btn-default" value="发表">
   </div>
  </div>
</form>

                  </div>
            </div>

<?php
  }else{
    ?>
   <div class="row box">

                <div class="col-lg-12" style="align:center;">
  <h3 ><a href="#" data-toggle="modal" data-target="#login"  onclick="func(<?php
    echo $row['vid']
    ?>)">登录</a>后可以发表留言</h3>
  </div>
  </div>

    <?php
  }
?>


        </div>
        <!--/.col-xs-12.col-sm-12-->

     
    </div>
    <!--/row-->
</div>
   <?php
require_once('tpl/foot.php');
?>

<?php
//判定dolevel传过来的值 flag=1 显示不能重复评分的alert，flag=2 显示评分成功。
if(isset($_GET["flag"]))
  switch ($_GET["flag"]) {
    case '1':
     echo '<script>alert("您已评分了该视频，不允许重复评分！");</script>';
      break;
   case '2':
     echo '<script>alert("评分成功！");</script>';
      break;
    case '3':
      echo '<script>alert("您已收藏过！");</script>';
      break;
   case '4':
     echo '<script>alert("收藏成功！");</script>';
      break;
  }


  
?>