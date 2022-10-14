<?php
//修改动漫电影信息功能模块的实现：处理修改动漫电影信息功能页
  require_once('tpl/header.php');
?>
<?php
//连接数据库 
$link=connect();
//使用$_POST数组获取表单中输入的数据
$vid=$_POST["vid"];
$videoname=$_POST["videoname"];
$aid=$_POST["aid"];
$videointro=$_POST["videointro"];
$address=$_POST["address"];
//上传文件错误的判定
  if($_FILES["pic"]["error"]>0)
  {
    switch($_FILES["pic"]["error"])
    {
      case 1: echo "文件尺寸超过了配置文件的最大值"; exit;
      case 3: echo "部分文件上传";  exit;
      case 4: echo "没有选择海报文件!"; 
        //如果没选择图片，则直接更新其他数据
        $sql="update videos set videoname='$videoname',aid=$aid,updatetime=now(),intro='$videointro',link='$address' where vid=$vid";   
        break;
      default: echo "未知错误"; exit; 
    }     
  }else {   //上传文件，删除原来的海报，更新数据库
    //获取文件扩展名
    $suffix = strrchr($_FILES["pic"]["name"], '.'); //获取.在文件名中最后一次出现
    //判断文件类型是否图片
    $allowtype=array("jpg","jpeg","png","gif","Bmp","flv"); 
    if(!in_array(ltrim($suffix, '.'),$allowtype))
    {       
      echo "文件类型为$suffix！<br/>";
      echo "文件类型不正确！只能选择扩展名为jpg,jpeg,png,gif,Bmp,flv类型的文件！";
      exit;
    }  
  
    //指定在服务器上的文件存放路径和文件名
    $filepath="../posters/";
    $randname=date("YmdHis").rand(100,999).$suffix;
   //上传文件，如果上传成功，则将视频信息修改到数据库，否则提示“上传失败”
    if (move_uploaded_file($_FILES["pic"]["tmp_name"],$filepath.$randname)) {
    echo "海报图片上传成功！";
    }  
   //获取海报文件的文件名
      $sql="select * from videos where vid={$vid}";
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_assoc($result);
      $filename=$filepath.$row["pic"];
      //删除原来的海报文件
      if(file_exists($filename))   
         unlink($filename);

   //编写SQL语句
      $sql="update videos set videoname='$videoname',pic='$randname',aid=$aid,updatetime=now(),intro='$videointro',link='$address' where vid=$vid";
  } 
  //执行SQL语句
  $result = mysqli_query($link,$sql) or die("更新失败！<br/>".mysqli_error($link));
  //判断是否更新成功
   if(!$result){
    echo "更新失败！<br/>";
    echo "<a href='videoList.php'>返回</a>";    
  }else{    
    redirect('videoList.php', '更新成功！');
  } 
 ?>
<?php
  require_once('tpl/footer.php');
?>