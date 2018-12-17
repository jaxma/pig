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

        // //上传图片
        // $img_info = M('goods')->where('goods_id = 12')->find();
        // $img_info = $img_info['goods_img'];
        // $img_path = $_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$img_info;
        // $size = filesize($img_path);
        // $file_info = array(
        //   'filename' => $img_path,
        //   'content-type' => 'image/jpg', //文件类型
        //   'filelength' => $size
        // );
        // $upload_img_result = $this->wechat_obj->upload_meterial($file_info);

        // $media_id = $upload_img_result['media_id'];

        // //获取图片
        // $images = $this->wechat_obj->getForeverList('image',0,20);
        // // p($images);die;
        // $media_id = $images['item'][0]['media_id'];

        // //上传素材
        // $upload_article_data = array(
        //   'title' => '测试标题',
        //   'thumb_media_id' => $media_id,
        //   'author' => '测试作者',
        //   'digest' => '测试简介',
        //   'show_cover_pic' => 1,
        //   'content' => '测试内容',
        //   'content_source_url' => 'www.yangsi.tk'
        // );

        // $articles[] = $upload_article_data;
        // $data = array(
        //   'articles' => $articles
        // );
        // $result= $this->wechat_obj->uploadForeverArticles($data);

        //7idfvHjR9O9A62yMDav65C2BZ_sMlqtfJ9HCfkUlL50

        // //获取素材
        // $result = $this->wechat_obj->getForeverMedia('7idfvHjR9O9A62yMDav65C2BZ_sMlqtfJ9HCfkUlL50');

        $Event = $this->wechat_obj->getRev()->getRevEvent();

        if($Event['event'] == 'CLICK' && $Event['key'] == 'TEST_V2_1'){
            // $data = array(
            //   "0"=>array(
            //      'Title'=>'曾经的大猪',
            //      'Description'=>'曾经...',
            //      'PicUrl'=>'http://www.yangsi.tk/Public/Admin/kindeditor/attached/image/20181103/20181103063738_69669.jpg',
            //       'Url'=>'http://www.yangsi.tk/'
            //  ),
            // );

            $result = $this->wechat_obj->getForeverMedia('7idfvHjR9O9A62yMDav65C2BZ_sMlqtfJ9HCfkUlL50');
            $data = $result['news_item'][0];
            $this->wechat_obj->news($data)->reply();
            // $this->wechat_obj->text('faker')->reply();
            exit;
        }else{
          // setlog('getRevEvent_return:'.$Event['event']);
          // setlog('getRevEvent_return:'.$Event['key']);
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