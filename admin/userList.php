<?php
//查询用户信息功能模块的实现
  require_once('tpl/header.php');
?>
<?php             //连接数据库 
  $link=connect();
  //编写sql语句
  $sql = "select * from users";
 
 //关键字可能是用户点击搜索按钮得到的
 if(isset($_GET['key']))  {    
    $key = trim($_GET['key']);
    $sql = $sql." where uname like '%{$key}%' ";    
  }

  $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link)); 
  $num=mysqli_num_rows($result);
 ?>

<form  action="">
    请输入用户名：
  <input type="text" name="key">
  <input type="submit" value="搜索">  
 </form> 


 <table class="table table-hover"> 
 <caption>共有 <?php echo $num; ?> 名用户</caption>
 <tr>
   <th>用户编号</th>
   <th>用户名</th>   
   <th>性别</th>
   <th>电话</th>
   <th width='80'>头像</th>
   <th>电子邮件</th>
   <th>操作</th>
 </tr>

 <?php
 
 $i=1;
  while($row = mysqli_fetch_assoc($result))
  {
  ?>
<tr>
  <td><?php echo $i++; ?></td>
  <td><a href="userDetail.php?uid=<?php echo $row["uid"]; ?>"><?php echo $row["uname"]; ?></a></td>
  <td><?php if($row["gender"]==0) echo "男"; else echo "女";?></td>
  <td><?php echo $row["tel"]; ?></td>
  <td><img class="img-circle" src="<?php echo UserPhotoPath.$row["photo"]; ?>" width=60 height=60  alt=""></td>
  <td><?php echo $row["email"]; ?></td>
  <td><a href="userEdit.php?uid=<?php echo $row["uid"];?>">修改</a> | <a href="doUserDelete.php?uid=<?php echo $row["uid"];?>" onclick="return confirm('真的要删除吗？')">删除</a></td>
</tr>
   
   <?php 
   }
    ?> 
 
</table>           

<?php
  require_once('tpl/footer.php');
?>