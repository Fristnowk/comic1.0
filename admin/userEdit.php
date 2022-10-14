<?php
//修改用户信息功能模块的实现：显示待修改用户信息的表单页
  require_once('tpl/header.php');
?>

<?php
   //连接数据库   
   $link=connect();
   //用户id是通过GET方法提交的   
   //根据用户id从数据库中查询用户的所有信息
   $uid = $_GET['uid'];  
   $sql = "select * from users where uid={$uid}";   
   $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));   
   $row = mysqli_fetch_assoc($result);
   //var_dump($row);   
   $uname = $row['uname'];
   $gender = $row['gender'];
   $tel = $row['tel'];
   $email = $row['email'];
   $pic = UserPhotoPath.$row['photo'];    
  //将查询结果显示在表单中
 ?>
<h3>请修改用户信息</h3>
<form method="post"  class="form-horizontal" action="doUserUpdate.php"  enctype="multipart/form-data">
  <input type="hidden" name="uid" value=<?php  echo $uid;  ?>>  

<div class="form-group">
    <label for="username" class="col-md-2 col-xs-2 control-label">用户名</label>
    <div class="col-md-10 col-xs-10">
   <input type="text" class="form-control" id="username" readonly="readonly" name="uname" value=<?php  echo $uname;  ?>>
   </div>
</div>

<div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">性别</label>
<div class="col-md-10 col-xs-10">
  <label class="radio-inline">
 <input type="radio"  name="gender" value="0" <?php  if(!$gender) echo 'checked';  ?>>男</label>
<label class="radio-inline">
 <input type="radio"  name="gender" value="1" <?php  if($gender) echo 'checked';  ?>>女</label>
 </div>
</div>

<div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">电话</label>
<div class="col-md-10 col-xs-10">
<input type="number" name="tel" class="form-control"  value=<?php  echo $tel;  ?>>
 </div>
</div>

<div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">头像</label>
<div class="col-md-10 col-xs-10">    
     <input type="file" name="pic">
原头像：<img src="<?php
echo $pic;
?>" width="80px" height="80px" class="img-circle">
</div>
</div>

<div class="form-group">
    <label  class="col-md-2 col-xs-2 control-label">电子邮件</label>
<div class="col-md-10 col-xs-10">    
   <input type="email" name="email" class="form-control"  value=<?php  echo $email;  ?>>
</div>
</div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 col-xs-10">
    <input type="submit"  class="btn btn-default" value="更新">
    </div>
  </div>

</form>




<?php
  require_once('tpl/footer.php');
?>