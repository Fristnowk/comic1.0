<?php
//添加动漫电影信息功能模块的实现：处理添加动漫电影信息功能页
  require_once('tpl/header.php');
?>


<?php
//连接数据库   
  $link=connect();
//使用$_POST数组获取表单中其他输入的数据
$videoname=trim($_POST["videoname"]);
$aid=$_POST["aid"];
$videointro=$_POST["videointro"];
$address=$_POST["address"];

//处理文件上传
  if($_FILES["pic"]["error"]>0)
  {
  switch($_FILES["pic"]["error"]){
    case 1: echo "文件尺寸超过了配置文件的最大值"; break;
    case 3: echo "部分文件上传";  break;
    case 4: echo "没有选择头像文件！"; break;
    default: echo "未知错误"; break;    
  } 
  exit;
  }

  //获取文件扩展名
  $suffix = strrchr($_FILES["pic"]["name"], '.'); //获取.在文件名中最后一次出现
  //echo $suffix;
  //判断文件类型是否图片
  $allowtype=array("jpg","jpeg","png","gif","Bmp","flv","JPG","JPEG"); 
  if(!in_array(ltrim($suffix, '.'),$allowtype))
  { 
    echo "文件类型为$suffix！<br/>";
    echo "文件类型不正确！只能选择扩展名为jpg,jpeg,png,gif,Bmp,flv类型的文件！";
    exit;
  }  
  
  //指定在服务器上的文件存放路径和文件名
  $filepath=PosterPicturePath;
  $randname=date("YmdHis").rand(100,999).$suffix;
  
  //上传文件
  if (move_uploaded_file($_FILES["pic"]["tmp_name"],$filepath.$randname)) {
    echo "海报图片上传成功！";
  }
 //如果上传成功，则将电影信息添加到数据库，否则提示“上传失败”
 $sql="insert into videos values(null,'$videoname',$aid,'$randname','$videointro',now(),now(),0,0,'$address')";
 //echo $sql;
 $rs=mysqli_query($link,$sql);
 if($rs)
 { 
  redirect('videoAdd.php','动漫电影添加成功，3秒后返回，可继续添加。');
  }else{
  echo "动漫电影添加失败!";
 }
?>

<?php
  require_once('tpl/footer.php');
?>