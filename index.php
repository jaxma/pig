<?php
//1. 将timestamp , nonce , token 按照字典排序  
$timestamp = $_GET['timestamp'];  
$nonce = $_GET['nonce'];  
$token = "yancy";  
$signature = $_GET['signature'];  
$array = array($timestamp,$nonce,$token);  
sort($array);  
  
//2.将排序后的三个参数拼接后用sha1加密  
$tmpstr = implode('',$array);  
$tmpstr = sha1($tmpstr);  
  
//3. 将加密后的字符串与 signature 进行对比, 判断该请求是否来自微信  
if($tmpstr == $signature)  
{  
    echo $_GET['echostr'];  
    exit;  
}  

ini_set('date.timezone', 'Asia/Shanghai');
define('THINK_PATH', './ThinkPHP/');
define('APP_NAME', 'Home');
define('APP_PATH', './Home/');
define("WEB_ROOT", str_replace("\\",'/',dirname(__FILE__)) . "/");
define('WEB_CACHE_PATH', WEB_ROOT."Cache/");//网站当前路径
define("RUNTIME_PATH", WEB_ROOT . "Cache/Runtime/Home/");
define("QQ_NEWS", 'linkto');
define('APP_DEBUG', true);//开启之后注意模块名大写
define('WEB_URL', $_SERVER['SERVER_NAME']);
if (!file_exists(WEB_ROOT.'Common/systemConfig.php')) {
    exit;
}
//默认排序方式
define('SO','is_recommend desc,sort_order asc,add_time desc');
define('CSO','is_recommend desc,sort_order asc,cat_id desc');
define('FSO','is_best desc,is_top desc,is_recommend desc,is_hot desc,id desc');
define('COLS','article_id,title,original_img,short,cat_id');

require(THINK_PATH . "ThinkPHP.php");
?>