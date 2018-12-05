<?php
/**
  * wechat php test
  */
 
//define your token
define("TOKEN", "yancycs");
$wechatObj = new wechatCallbackapiTest();
// $wechatObj->valid();
$wechatObj->responseMsg();//调用回复消息的函数
 
class wechatCallbackapiTest
{
  public function valid()
    {
        $echoStr = $_GET["echostr"];
 
 
        //valid signature , option
        if($this->checkSignature()){
          echo $echoStr;
          exit;
        }
    }


   public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
                libxml_disable_entity_loader(true);
                  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";        
                if(!empty( $keyword ))
                        {
                          $msgType = "text";
                          $contentStr = "你好！！";
                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                          echo $resultStr;
                        }else{
                          echo "Input something...";
                        }
         
                }     
                if($postObj->MsgType=='event'){
                  if($postObj->Event == 'CLICK'){
                    if($postObj->EventKey == 'TEST_V2_1'){

                 $contentStr = "微信连,www.phpos.net";
                 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                 echo $resultStr;
                   }
                  }
                }

    }else {
        echo "success";
        exit;
    }
}

  private function checkSignature()
  {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];  
            
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }
}
 
?>