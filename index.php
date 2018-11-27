<?php
// //装载模板文件
// include_once("wx_tpl.php");
 
// //获取微信发送数据
// $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
 
//   //返回回复数据
// if (!empty($postStr)){
          
//     	//解析数据
//           $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
//     	//发送消息方ID
//           $fromUsername = $postObj->FromUserName;
//     	//接收消息方ID
//           $toUsername = $postObj->ToUserName;
//    	 //消息类型
//           $form_MsgType = $postObj->MsgType;
          
//     	//事件消息
//           if($form_MsgType=="event")
//           {
//             //获取事件类型
//             $form_Event = $postObj->Event;
//             //订阅事件
//             if($form_Event=="subscribe")
//             {
//               //回复欢迎文字消息
//               $msgType = "text";
//               $contentStr = "感谢您关注我的微信！[愉快]";
//               $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
//               echo $resultStr;
//               exit;
//             }
          
//           }
          
//   }
//   else 
//   {
//           echo "";
//           exit;
//   }
 

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