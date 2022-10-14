 <?php  
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PWD', '');
  define('DB_CHARSET', 'UTF8');
  define('DB_DBNAME', 'comic');
  function connect(){ 
    //连接mysql
    $link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
    //设置字符集
    mysqli_set_charset($link,DB_CHARSET);
    return $link;
 }  
 ?>
