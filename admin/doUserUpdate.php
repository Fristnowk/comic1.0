<?php
//修改用户信息功能模块的实现：处理修改用户信息的功能页
  require_once('tpl/header.php');
  //连接数据库 
  $link=connect();
  //使用$_POST数组获取表单中输入的修改后的数据
  $uid = $_POST['uid'];
  $uname = trim($_POST['uname']);  
  $tel = $_POST['tel'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];

  //上传文件错误的判定
  if($_FILES["pic"]["error"]>0)
  {
    switch($_FILES["pic"]["error"])
    {
      case 1: echo "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值"; exit;
      case 3: echo "部分文件上传";  exit;
      case 4: echo "没有选择头像文件!"; 
        //如果没选择图片，则直接更新其他数据
        $sql = "update users set uname='{$uname}', tel='{$tel}', gender={$gender}, email='{$email}' where uid={$uid}";  
        break;
      default: echo "未知错误"; exit; 
    }     
  }else {   //上传文件，删除原来的头像，更新数据库

    //获取文件扩展名
    $arr=explode(".", $_FILES["pic"]["name"]);
    $suffix=$arr[count($arr)-1];
    //判断文件类型是否图片
    $allowtype=array("jpg","jpeg","png","gif","Bmp","flv","JPG"); 
    if(!in_array($suffix,$allowtype))
    {       
      echo "文件类型为$suffix！<br/>";
      echo "文件类型不正确！只能选择扩展名为jpg,jpeg,png,gif,Bmp,flv,JPG类型的文件！";
      exit;
    }  
  
    //指定在服务器上的文件存放路径和文件名
    $filepath=UserPhotoPath;
    $newname=date("YmdHis").rand(100,999).".".$suffix;
    //上传文件，如果上传成功，则将用户信息修改到数据库，否则提示“上传失败”
    if (!move_uploaded_file($_FILES["pic"]["tmp_name"],$filepath.$newname)) {
      die('图片上传失败');
    }else {
      //获取头像文件的文件名
      $sql="select * from users where uid={$uid}";
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_assoc($result);
      $filename=$filepath.$row["photo"];
      //删除原来的头像文件
      if(file_exists($filename))    
        unlink($filename);

      //编写SQL语句
      $sql = "update users set uname='{$uname}', tel='{$tel}', gender={$gender}, email='{$email}', photo='{$newname}' where uid={$uid}";      
    }
  } 
  //执行SQL语句
  //echo $sql;

   $result = mysqli_query($link,$sql) or die("sql={$sql}, 更新失败！<br/>".mysqli_error($link));
  
  if ($result) {
    redirect('userList_page.php', '更新成功！');
  }else{
    echo "更新失败！<br/>";
    echo "<a href='userList_page.php'>返回</a>";  
  }

 ?>



<?php
  require_once('tpl/footer.php');
?>