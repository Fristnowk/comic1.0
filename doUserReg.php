<?php
//处理用户注册信息功能的实现
 require_once('./system/dbConn.php');
  //连接数据库   
 $link=connect();
  //使用$_POST数组获取表单中输入的数据
$username=$_POST["username"];
$password=$_POST["password"];
$gender=$_POST["gender"];
$tel=$_POST["tel"];
$email=$_POST["email"];
//判定注册用户不能重名
$sql0="select * from users where uname='$username'";
//echo $sql0;
$rs0=mysqli_query($link,$sql0);//结果集（多条记录组成的变量）
$num=mysqli_num_rows($rs0);//查询结果集中记录的条数
if ($num>0) {
  header("location:index.php?re1=1&msg1=该用户名已被注册，请重新注册");
  exit;
}

//处理文件上传
if($_FILES["pic"]["error"]>0){//文件上传出错的判定
  switch ($_FILES["pic"]["error"]) {
    case 1:
      echo "文件尺寸超过了配置文件中的最大值";
      break;
    case 3:
      echo "部分文件上传";
      break;
    case 4:
      echo "没有文件上传";
      break;
    
    default:
      echo "未知错误";
      break;
  }
exit;
}

//获取文件扩展名
$arr=explode(".", $_FILES["pic"]["name"]);
$suffix=$arr[count($arr)-1];//取扩展名
//判断文件类型是否图片
$a=array("jpg","jpeg","png","bmp","gif","JPG","PNG","JPEG");
if(!in_array($suffix, $a)){
  echo "您上传的文件类型不是图片类型，请重新上传！";
  exit;//结束程序
}
//指定在服务器上的文件存放路径和文件名
$filepath="./images/";
$randname=date("YmdHis").rand(100,999).".".$suffix;
if(move_uploaded_file($_FILES["pic"]["tmp_name"], $filepath.$randname)){
  echo "图片上传成功！";
}
 //编写SQL语句
$sql="insert into users values(null,'$username',md5('$password'),$gender,'$tel','$randname','$email',now(),now())";
//执行sql语句
$rs=mysqli_query($link,$sql) or die("添加数据失败".mysqli_error($link));
 if($rs){
     header("location:index.php?re2=1&msg2=注册成功,请点击关闭按钮返回首页登录");   

  }else{    
    echo "注册失败！<br/>";
    echo "<a href='userReg.html'>返回</a>";   
  }    

?>

