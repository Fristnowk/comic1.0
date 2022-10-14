<?php
//分页功能的实现
  require_once('tpl/header.php');
?>


<?php             //连接数据库 
  $link=connect();
  //编写sql语句
  $sql = "select * from users";
  //获取指定的页码
   //判断是否指定第几页，如果没有指定，则显示第1页。
  if(!isset($_GET["page"]))
  $page=1;
  else{
    $page=$_GET["page"];
  }
  $key="";//下面分页中用到$key,先给个空值，要不然没有搜索项时分页中的$key报错
 //关键字可能是用户点击搜索按钮得到的，也可能是点击”下一页“超链接得到的
 if(isset($_GET['key']))  {    
    $key = trim($_GET['key']);
    $sql = $sql." where uname like '%{$key}%' ";    
  }
  //获取总行数，用于计算分几页显示
  $result = mysqli_query($link,$sql);
  $totalrows = mysqli_num_rows($result);

  //定义每页显示的行数
  $rowsperpage =5;
  //计算从表中第几行开始输出
  $start = ($page-1) * $rowsperpage;

  //查询用户，从第$start行开始，共查询$rowsperpage行。
  $sql .= " limit {$start}, {$rowsperpage}";
  //echo $sql.'<br/>';
  //执行sql语句
  $result = mysqli_query($link,$sql) or die('查询失败！'.mysqli_error($link));  
 ?>

<form  action="">
    请输入用户名：
  <input type="text" name="key">
  <input type="submit" value="搜索">  
 </form> 


 <table class="table table-hover"> 
 <tr>
   <th>用户编号</th>
   <th>用户名</th>   
   <th>性别</th>
   <th>手机号码</th>
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
  <td><img class="img-circle" src="<?php echo UserPhotoPath.$row["photo"]; ?>" width=60 height=60 alt=""></td>
  <td><?php echo $row["email"]; ?></td>
  <td><a href="userEdit.php?uid=<?php echo $row["uid"];?>">修改</a> | <a href="doUserDelete.php?uid=<?php echo $row["uid"];?>" onclick="return confirm('真的要删除吗？')">删除</a></td>
</tr>
   
   <?php 
   }
    ?> 
 
</table>
  <?php
  //计算总页数。如果每页显示的行数>总行数，则只有1页，否则，页数=总行数/每页行数，上取整。
  //echo $rowsperpage.', '.$totalrows;
  if($rowsperpage >= $totalrows)
      $totalpages = 1;
  else{   
    $totalpages = ceil($totalrows / $rowsperpage);
  }

  //如果不是第1页，则显示第一页和上一页的超链接，否则只显示文字
  if($page>1){
    $first = "<a href=?key={$key}&page=1>首页</a>";
    $pre = "<a href=?key={$key}&page=".($page-1).">上一页</a>";
  }else{
    $first = '首页';
    $pre = '上一页';
  }
  //如果不是最后一页，则显示下一页和最后一页的超链接，否则只显示文字
  if($page<$totalpages){
    $last = "<a href=?key={$key}&page=$totalpages>尾页</a>";
    $next = "<a href=?key={$key}&page=".($page+1).">下一页</a>";
  }else{
    $last = '尾页';
    $next = '下一页';
  }
  echo "<table align='center'><tr>";
   echo "<td>共{$totalrows}条记录&nbsp;&nbsp;</td>";
  echo "<td>$first"."&nbsp;&nbsp;"."$pre"."&nbsp;&nbsp;";
  for($i=1;$i<=$totalpages;$i++) {
    echo "<a href='?key={$key}&page=$i'>第{$i}页</a>&nbsp;&nbsp;";
  }
  echo "$next"."&nbsp;&nbsp;"."$last &nbsp;";
  //输出第几页/共几页
  echo "<font color=red>";
  echo "&nbsp;&nbsp;第".$page."页/共".$totalpages."页&nbsp;&nbsp;";
  echo "</font></td>";
  //输出转到几页的表单
  ?>

<td>
  <form  action="">
  <input type="hidden" name="key" value=<?php
  if(isset($_GET["key"]))
      echo $_GET["key"];
  ?>>
  <input type="text" name="page" placeholder="页码" size="2"  required>
  <input type="submit" value="转到">  
  </form>
</td>
 </tr></table>                 

<?php
  require_once('tpl/footer.php');
?>