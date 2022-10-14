<?php
//后台管理员欢迎页
  require_once('tpl/header.php');
?>

<div class="jumbotron">
  <h2>欢迎管理员: <?php
             
                 echo $_SESSION["admin"];
                 ?>
                 访问"动漫电影信息网站"</h2>
  <br>
  <br>
    
  
</div>




<?php
  require_once('tpl/footer.php');
?>