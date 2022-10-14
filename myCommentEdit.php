<?php
require_once('tpl/head.php');
require_once('./system/dbConn.php');
 //连接数据库  
 $link=connect();
 $cid = $_GET['cid'];  
 $page=$_GET['page'];
   $sql = "select * from comments join videos on videos.vid=comments.vid where cid={$cid}";   
   $result = mysqli_query($link,$sql) or die('查询1失败！'.mysqli_error($link));   
   $row = mysqli_fetch_assoc($result);
 ?>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-12">

            <div class="row">
                <div class="col-xs-12 col-lg-12 mlist">
                  <h3>请修改您对该视频的评价信息</h3>
<form class="form-horizontal" method=post action="doMyCommentUpdate.php" enctype="multipart/form-data">
<input type="hidden" name="cid" value="<?php
echo $row["cid"];
?>">
<input type="hidden" name="page" value="<?php
echo $page;
?>">
<div class="form-group">
    <label for="videoname" class="col-md-2 control-label">电影名称</label>
    <div class="col-md-10">
   <input type="text" class="form-control" id="videoname" readonly="readonly" name="videoname" value="<?php
   echo $row["videoname"];
   ?>">
   </div>
</div>


<div class="form-group">
<label  class="col-md-2 control-label">留言内容</label>
    <div class="col-md-10">
      <textarea name="content" class="form-control" rows="5"><?php
echo $row["content"];
?>
</textarea>
      </div>
</div>

 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="submit"  class="btn btn-default" value="更新">

	</div>
  </div>

</form>

                </div>
                <!--/.col-xs-6.col-lg-4-->

            </div>
            <!--/row-->
        </div>
        <!--/.col-xs-12.col-sm-12-->
      
    </div>
    <!--/row-->
</div>
   <?php
require_once('tpl/foot.php');
?>