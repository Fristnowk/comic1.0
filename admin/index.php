<?php
if(isset($_COOKIE["name"])){
session_start();
$_SESSION["admin"]=$_COOKIE["name"];
header("location:welcome.php");exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>管理员登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
  <div class="main">
    <div class="login">
      <h1>动漫电影信息网</h1>
      <div class="inset">
        <!--start-main-->
        <form method="post" action="doAdminLogin.php">
               <div>
                <h2>管理员登录</h2>
            <span><label>用户名</label></span>
            <span><input type="text" class="textbox" name="adminname" ></span>
           </div>
           <div>
            <span><label>密码</label></span>
              <span><input type="password" class="password" name="password"></span>
           </div>
          <div class="sign">
                        <input type="submit" value="登录" class="submit" />
          </div>
          </form>
        </div>
      </div>
    <!--//end-main-->
    </div>


</body>
</html>
