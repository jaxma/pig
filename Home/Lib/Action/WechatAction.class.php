<?php
class WechatAction extends CommonAction {
	public function __construct() {
		parent::__construct();

	}

	public function index(){
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $this->wechat_obj = new Wechat($options);
        // $postStr = file_get_contents("php://input");

        // $res = $this->wechat_obj->getSelfmenu();
        // $list = $this->wechat_obj->getMenu();

        // $button = array (
        //       'button' => array (
        //         0 => array (
        //           'type' => 'click',
        //           'name' => '测试1',
        //           'key' => 'TEST_V1_1',
        //         ),
        //         1 => array (
        //           'name' => '测试2',
        //           'sub_button' => array (
        //               0 => array (
        //                 'type' => 'click',
        //                 'name' => '测试2',
        //                 'key' => 'TEST_V2_1',
        //               ),
        //               1 => array (
        //                 'type' => 'view',
        //                 'name' => '测试3',
        //                 'url' => 'http://baidu.com',
        //               ),
        //           ),
        //         ),
        //       ),
        //   );

        // $list = $this->wechat_obj->createMenu($button);
        // p($list);

        $data = array(
          "0"=>array(
             'Title'=>'曾经的大猪',
             'Description'=>'曾经...',
             'PicUrl'=>'http://www.yangsi.tk/Public/Admin/kindeditor/attached/image/20181103/20181103063738_69669.jpg',
            'Url'=>'http://www.yangsi.tk/'
         ),
        )

        $Event = $this->wechat_obj->getRev()->getRevEvent();
        if($Event['event'] == 'CLICK' && $Event['key'] == 'TEST_V2_1'){
            // $this->wechat_obj->text('faker')->reply();
            $this->wechat_obj->news($data)->reply();
            exit;
        }else{
          setlog('getRevEvent_return:'.$Event['event']);
          setlog('getRevEvent_return:'.$Event['key']);
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