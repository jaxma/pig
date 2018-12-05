<?php
/**
 * wechat php test
 */
  
//define your token
//定义TOKEN秘钥
define("TOKEN", "yancy");
  
//实例化微信对象
$wechatObj = new wechatCallbackapiTest();
//验证成功后注释valid方法
$wechatObj->valid();
//开启自动回复功能
$wechatObj->responseMsg();
  
  
//定义类文件
class wechatCallbackapiTest
{
  //实现valid验证方法:实现对接微信公众平台
  public function valid()
  {
    //接受随机字符串
    $echoStr = $_GET["echostr"];
  
    //valid signature , option
    //进行用户数字签名验证
    if($this->checkSignature()){
      //如果成功,则返回接受到的随机字符串
      echo $echoStr;
      //退出
      exit;
    }
  }
  //定义自动回复功能
  public function responseMsg()
  {
    //get post data, May be due to the different environments
    //接受用户端发送过来的xml数据
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
  
    //extract post data
    //判断xml数据是否为空
    if (!empty($postStr)){
        /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
          the best way is to check the validity of xml by yourself */
        libxml_disable_entity_loader(true);
        //通过simplexml进行xml解析
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        //接受微信的手机端
        $fromUsername = $postObj->FromUserName;
        //微信公众平台
        $toUsername = $postObj->ToUserName;
        //接受用户发送的关键词
        $keyword = trim($postObj->Content);
        //1.接受用户消息类型
        $msgType = $postObj -> MsgType;
        //时间戳
        $time = time();
        //文本发送模板
        $textTpl = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[%s]]></MsgType>
              <Content><![CDATA[%s]]></Content>
              <FuncFlag>0</FuncFlag>
              </xml>"; 
        //////////////////////////////////////////////////////////////////////////////////
        //如果用户发送的是文本类型文件,执行以下
        if($msgType == 'text'){
          if(!empty( $keyword ))
          {
            /*这是一个实例
              //如果发送文本信息
              $msgType = "text";
              //回复内容
              if($keyword == "李楠"){
                $contentStr = "叫我干嘛";
              }else{
                $contentStr = "叫我干嘛";
              }
              //格式化xml模板,参数与上面的模板是一一对应的.fromUsername和头Username是相反的,只写带%s的
              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
  
              //将xml信息返回给客户端
              echo $resultStr;
            */
            if($keyword == "?" || $keyword == "？"){
              $msgType = "text";
              $contentStr = "1.特种服务号码\n2.通讯服务号码";
              $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
              echo $resultStr;
            }elseif($keyword == 1){
              $msgType = "text";
              $contentStr = "1.匪警:110\n2.火警:119\n3.急救:120";
              $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
              echo $resultStr;
            }elseif($keyword == 2){
              $msgType = "text";
              $contentStr = "1.中国移动:10086\n2.中国联通:10010";
              $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
              echo $resultStr;
            }
          }else{
            echo "不能不说话";
          }
        }
        ////////////////////////////////////////////////////////////////////////////////////
        //接受图片信息
        if($msgType == "image"){
            //如果发送文本信息
            $msgType = "text";
            //回复内容
            $contentStr = "你发送的是图片文件";
            //格式化字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //将xml信息返回给客户端
            echo $resultStr;
        }
        ////////////////////////////////////////////////////////////////////////////////////
        if($msgType == "voice"){
            //如果发送文本信息
            $msgType = "text";
            //回复内容
            $contentStr = "你发送的是语音文件";
            //格式化字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //将xml信息返回给客户端
            echo $resultStr;
        }
        ////////////////////////////////////////////////////////////////////////////////////
        if($msgType == "video"){
            //如果发送文本信息
            $msgType = "text";
            //回复内容
            $contentStr = "你发送的是视频文件";
            //格式化字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //将xml信息返回给客户端
            echo $resultStr;
        }
        ////////////////////////////////////////////////////////////////////////////////////
        if($msgType == "shortvideo"){
            //如果发送文本信息
            $msgType = "text";
            //回复内容
            $contentStr = "你发送的是小视频文件";
            //格式化字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //将xml信息返回给客户端
            echo $resultStr;
        }
        ////////////////////////////////////////////////////////////////////////////////////
        if($msgType == "location"){
            //如果发送文本信息
            $msgType = "text";
            //回复内容
            $contentStr = "你发送的是地理位置文件";
            //格式化字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //将xml信息返回给客户端
            echo $resultStr;
        }
        ////////////////////////////////////////////////////////////////////////////////////
        if($msgType == "link"){
            //如果发送文本信息
            $msgType = "text";
            //回复内容
            $contentStr = "你发送的是连接文件";
            //格式化字符串
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //将xml信息返回给客户端
            echo $resultStr;
        }
        ////////////////////////////////////////////////////////////////////////////////////
        /*
        //判断用户发送关键词是否为空      
          
        if(!empty( $keyword ))
        {
          //如果发送文本信息
          $msgType = "text";
          //回复内容
          $contentStr = "大家好,我是hero";
          //格式化字符串
          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
          //将xml信息返回给客户端
          echo $resultStr;
        }else{
          echo "Input something...";
        }
        */
    }else {
      echo "";
      exit;
    }
  }
      
  private function checkSignature()
  {
    // // you must define TOKEN by yourself
    // //判断是否定义了TOKEN,如果没有就抛出一个异常
    // if (!defined("TOKEN")) {
    //   throw new Exception('TOKEN is not defined!');
    // }
      
    // $signature = $_GET["signature"];//接受微信加密签名
    // $timestamp = $_GET["timestamp"];//接受时间戳
    // $nonce = $_GET["nonce"];//接受随机数
          
    // $token = TOKEN;//把TOKEN常量赋值给$token
    // //把相关参数组装成数组
    // $tmpArr = array($token, $timestamp, $nonce);
    // // use SORT_STRING rule
    // //排序
    // sort($tmpArr, SORT_STRING);
    // //把排序后的数组转换成字符串
    // $tmpStr = implode( $tmpArr );
    // //通过哈希算法加密
    // $tmpStr = sha1( $tmpStr );
    // //与加密签名进行对比
    // if( $tmpStr == $signature ){
    //   //相同返回true
    //   return true;
    // }else{
    //   //不同返回false
    //   return false;
    // }
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
        // echo $_GET['echostr'];  
        // exit; 
        return true; 
    }  

  }
}
  
?>