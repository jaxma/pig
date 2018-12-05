<?php 
define("TOKEN", "yancy"); 
$wechatObj = new wechatCallbackapiTest(); 
if (!isset($_GET['echostr'])) { 
$wechatObj->responseMsg(); //调用responseMsg()接收消息 
}else{ 
$wechatObj->valid(); //其实已经不再调用 
} 
class wechatCallbackapiTest
{ 
private $access_token; 
public function __construct(){ 
//构造函数 
} 
public function valid(){ //略，本系列第一篇中有代码 
} 
private function checkSignature(){ 
//略，本系列第一篇中有代码 
} 
public function responseMsg(){ 
$postArr = file_get_contents("php://input"); //php7.0只能用这种方式获取数据，之前的$GLOBALS['HTTP_RAW_POST_DATA']7.0版本不可用 
$postObj = simplexml_load_string($postArr); //读取xml格式文件,记得安装php7.0-xml //接收关注事件推送：用户关注微信号后，将会受到一条“欢迎光临”的消息 
if(strtolower($postObj->MsgType) == 'event'){ 
  if(strtolower($postObj->Event) == 'subscribe'){ 
    $toUser = $postObj->FromUserName; 
    $fromUser = $postObj->ToUserName; 
    $time = time(); 
    $msgType = 'text'; 
    $content = '欢迎光临！'; 
    $template = "<xml>
                               <ToUserName><![CDATA[%s]]></ToUserName>
                               <FromUserName><![CDATA[%s]]></FromUserName>
                               <CreateTime>%s</CreateTime>
                               <MsgType><![CDATA[%s]]></MsgType>
                               <Content><![CDATA[%s]]></Content>
                                </xml>"; 
                                $info= sprintf($template,$toUser,$fromUser,$time,$msgType,$content); 
                                echo $info; 
                                } 
                                } //接收普通文本消息：用户发送“tuwen”后,将收到4条图文消息 
                                if(strtolower($postObj->MsgType)=='text' && trim($postObj->Content)=='tuwen') { 
                                $toUser =$postObj->FromUserName; 
                                $fromUser =$postObj->ToUserName; 
                                $arr=array ( 
                                array( 'title'=>'百度', 'description'=>"百度很棒!", //单图文会显示，多图文不显示description 
                                'picUrl'=>'http://www.peng.com/baidu.jpg', 'url'=>'http://www.baidu.com', //这里的网页也可以是自己写的html,php等网页
                                 ), 
                                array( 'title'=>'中国亚马逊', 'description'=>"中国亚马逊很棒！", 'picUrl'=>'http://www.peng.com/amazon_cn.png', 'url'=>'https://www.amazon.cn/', ), array( 'title'=>'Amazon in UK', 'description'=>"Amanon is very good!", 'picUrl'=>'http://www.peng.com/amazon_co_uk.png', 'url'=>'https://www.amazon.co.uk/', ), array( 'title'=>'Amazon en France', 'description'=>"Amazon est très bon!", 'picUrl'=>'http://www.peng.com/amazon_fr.png', 'url'=>'https://www.amazon.fr/',
                                 ) 
                                ); 
                                $template="<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <ArticleCount>".count($arr)."</ArticleCount>
                        <Articles>"; 
                        foreach($arr as $k=>$v) { 
                          $template .="<item>
                            <Title><![CDATA[".$v['title']."]]></Title>
                            <Description><![CDATA[".$v['description']."]]></Description>
                            <PicUrl><![CDATA[".$v['picUrl']."]]></PicUrl>
                            <Url><![CDATA[".$v['url']."]]></Url>
                            </item>"; 
                            } 
                            $template .="</Articles>
                        </xml> "; 
                        echo sprintf($template,$toUser,$fromUser,time(),'news'); 
                      } 
                    } 
                  } 
                  ?>