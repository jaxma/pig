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

        // die;

        // //上传图片
        // $img_info = M('goods')->where('goods_id = 12')->find();
        // $img_info = $img_info['goods_img'];
        // $img_path = $_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$img_info;
        // $file_ext = pathinfo($img_path);
        // $file_ext = $file_ext['extension'];
        // $size = filesize($img_path);
        // $file_info = array(
        //   'filename' => $img_path,
        //   'content-type' => 'image/'.trim($file_ext), //文件类型
        //   'filelength' => $size
        // );
        // $upload_img_result = $this->wechat_obj->upload_meterial($file_info);

        // p($upload_img_result);die;

        // $file_info = array(
        //   'media' => '@{$img_path}',
        // );
        // $upload_img_result = $this->wechat_obj->uploadImg($file_info);
        // $url = $upload_img_result['url'];

        // $media_id = $upload_img_result['media_id'];
        //7idfvHjR9O9A62yMDav65EEw59dqi8D9l8_7EvlGIUY

        // //上传素材
        // $upload_article_data = array(
        //   'title' => '测试标题',
        //   'thumb_media_id' => $media_id,
        //   'author' => '测试作者',
        //   'digest' => '测试简介',
        //   'show_cover_pic' => 0,
        //   'content' => '测试用的<img src="http://mmbiz.qpic.cn/mmbiz_jpg/CgW0qVibL6YxABfsI3BjPSV3MSTibXibOcPj9f2Xvib3Mt87NwvicTyNiabJib8Hb3uOmchoSoRyhmArBkSfwcJX56CNQ/0?wx_fmt=jpeg" alt="" />测试用的',
        //   'content_source_url' => 'www.yangsi.tk'
        // );

        // $articles[] = $upload_article_data;
        // $data = array(
        //   'articles' => $articles
        // );
        // $result= $this->wechat_obj->uploadForeverArticles($data);

        // p($result);die;
        //7idfvHjR9O9A62yMDav65C2BZ_sMlqtfJ9HCfkUlL50
        //7idfvHjR9O9A62yMDav65FIxT8_i__q00E6hMCqlzg0
        //7idfvHjR9O9A62yMDav65LPcTYI0nJHIhWeq3_yJ5E0

        $Event = $this->wechat_obj->getRev()->getRevEvent();
        if($Event['event'] == 'CLICK'){
            $key = $Event['key'];
            $key = trim($key);
            $key = 'MENU_20181219_84519';
            $where = "key like '%$key%'";
            $res = M('wechat_menu')->where($where)->find();
            // $res = M('wechat_menu')->where('id = 874')->find();
            $sql = M('wechat_menu')->_sql();
            $media_id = $res['media_id'];
            $content = $res['content'];
            if($media_id){
                //获取素材
                $result = $this->wechat_obj->getForeverMedia($media_id);
                $media_data = $result['news_item'][0];
                $news_data = array(
                  "0"=>array(
                     'Title'=>$media_data['title'],
                     'Description'=>$media_data['digest'],
                     'PicUrl'=>$media_data['thumb_url'],
                      'Url'=>$media_data['url'],
                 ),
                );
                $this->wechat_obj->news($news_data)->reply();
            }elseif((!$media_id || $media_id == null) && $content && $content != null){
                $content = mb_strlen($content, 'utf-8') > 500 ? mb_substr($content, 0, 500, 'utf-8').'....' : $content;
                $content = strip_tags($content);
                $this->wechat_obj->text($content)->reply();
            }elseif((!$media_id || $media_id == null) && (!$content || $content == null) && $thumb_media_id){
                $this->wechat_obj->image($thumb_media_id)->reply();
            }else{
                $this->wechat_obj->text($sql.'内容'.$content.'id'.$res['id'])->reply();
                setlog('getRevEvent_return:'.$sql.'内容'.$content.'id'.$res);
            }
            exit;
        }else{
          // setlog('getRevEvent_return:'.$Event['event']);
          // setlog('getRevEvent_return:'.$Event['key']);
        }


        // if($Event['event'] == 'CLICK' && $Event['key'] == 'TEST_V2_1'){
            // $data = array(
            //   "0"=>array(
            //      'Title'=>'曾经的大猪',
            //      'Description'=>'曾经...',
            //      'PicUrl'=>'http://www.yangsi.tk/Public/Admin/kindeditor/attached/image/20181103/20181103063738_69669.jpg',
            //       'Url'=>'http://www.yangsi.tk/'
            //  ),
            // );

            // //获取素材
            // $result = $this->wechat_obj->getForeverMedia('7idfvHjR9O9A62yMDav65C2BZ_sMlqtfJ9HCfkUlL50');
            // $media_data = $result['news_item'][0];
            // $news_data = array(
            //   "0"=>array(
            //      'Title'=>$media_data['title'],
            //      'Description'=>$media_data['digest'],
            //      'PicUrl'=>$media_data['thumb_url'],
            //       'Url'=>$media_data['url'],
            //  ),
            // );
            // $this->wechat_obj->news($news_data)->reply();

            // $info = M('goods')->where('goods_id = 15')->find();
            // //550个汉字左右
            // $content = mb_strlen($info['content'], 'utf-8') > 500 ? mb_substr($info['content'], 0, 500, 'utf-8').'....' : $news['n_content'];
            // $content = strip_tags($content);
            // $this->wechat_obj->text($content)->reply();

            
        // }else{
          // setlog('getRevEvent_return:'.$Event['event']);
          // setlog('getRevEvent_return:'.$Event['key']);
        // }

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