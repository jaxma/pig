<?php
class WechatAction extends CommonAction {
	public function __construct() {
		parent::__construct();

	}

	public function index(){
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            // 'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $obj = $this->wechat_obj = new Wechat($options);
        $postStr = file_get_contents("php://input");
        $Event = $obj->getRev()->getRevEvent();
        // setlog($Event);
        if($Event['event'] == 'CLICK' && $Event['key'] == 'TEST_V2_1'){
            setlog('inhere');
            $this->wechat_obj->text('faker')->reply();
            exit;
        }else{
          setlog($Event['event']);
          setlog($Event['key']);
        }

        // $list = $this->wechat_obj->getMenu();
          // $button = array (
          //     'button' => array (
          //       0 => array (
          //         'type' => 'click',
          //         'name' => '测试1',
          //         'key' => 'TEST_V1_1',
          //       ),
          //       1 => array (
          //         'name' => '测试2',
          //         'sub_button' => array (
          //             0 => array (
          //               'type' => 'click',
          //               'name' => '测试2',
          //               'key' => 'TEST_V2_1',
          //             ),
          //             1 => array (
          //               'type' => 'view',
          //               'name' => '测试3',
          //               'url' => 'http://baidu.com',
          //             ),
          //         ),
          //       ),
          //     ),
          // );

        // $list = $this->wechat_obj->createMenu($button);
        // p($list);
        // echo 'test';
        // die;
	}
	
}
?>