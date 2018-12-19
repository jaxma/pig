<?php
header("Content-Type: text/html; charset=utf-8");
/**
 *  微斯咖经销商管理系统
 */

/**
 *  微信自定义菜单栏
 *  @author  ys<1105190775@qq.com>
 *  1、自定义菜单栏
 *  	1.1 获取在公众平台编辑好的，或者自己使用接口上传的菜单栏数据，自由修改，使用生成菜单栏的接口上传
 *  2、上传永久素材
 *  	2.1 上传成功后，返回专门的微信页面链接，实际操作中，点击菜单栏，生成包括一张封面图和详情的推送，再次点击，跳转到微信页面
 * 		2.2 上传永久素材，需要封面media_id，详情，文章名称，文章内容，作者名称，‘阅读原文’跳转链等
 *  	2.3 先上传推送封面，获取封面media_id，再上传图文内容
 *  	2.4 需将文章中的本地图片转化为微信图片，否则在微信页面不会显示图片
 *  	2.5 在数据库中，将菜单栏的key值与上传到微信服务器的图文素材返回的media_id对应起来
 *  3、信息推送
 *  	3.1 获取推送事件内容，如果是点击事件，根据key值，在数据库中找到对应的media_id,获取到标题，详情，
 *		内容链接和原文跳转链接，使用news接口组合该推送内容
 *		3.2 如果没有永久素材，直接推送内容，只能选择推送一张图片，或者纯文字，推送图文只能用素材
 *  4、其他
 *		4.1 永久素材上限为5000！删除接口请查sdk！
 *		4.2 接口详情请参考文档 https://mp.weixin.qq.com/wiki
 *		4.2 暂时不支持音乐，视频素材的上传！
 */

class MenuAction extends Action {

    public function index() {
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $this->wechat_obj = new Wechat($options);

        // $this->display();
        // die;

        $self_menu = $this->wechat_obj->getSelfmenu();

        foreach ($self_menu as $k => $v) {
            if($k == 'selfmenu_info'){
                $list = $self_menu[$k]['button'];
            }
        }

        foreach ($list as $k => $v) {
            $type = $v['type'];
            if($type == 'click'){
                $data = array(
                    'type' => $v['type'], 
                    'name' => $v['name'], 
                    'mkey' => $v['key'], 
                    'pid' => 0, 
                );
                $res = M('wechat_menu')->where($data)->find();
                if($res){
                    M('wechat_menu')->where('id='.$res['id'])->save($data);
                    $id = $res['id'];
                }else{
                    $id = M('wechat_menu')->add($data);
                }
                $list[$k]['id'] = $id;
            }elseif($type == 'view'){
                $data = array(
                    'type' => $v['type'], 
                    'name' => $v['name'], 
                    'url' => $v['url'], 
                    'pid' => 0, 
                );
                $res = M('wechat_menu')->where($data)->find();
                if($res){
                    M('wechat_menu')->where('id='.$res['id'])->save($data);
                    $id = $res['id'];
                }else{
                    $id = M('wechat_menu')->add($data);
                }
                $list[$k]['id'] = $id;
            }else{
                $res = M('wechat_menu')->where('name = "'.$v['name'].'" and type = "" ')->find();
                if(!$res){
                    $data = array(
                        'name' => $v['name'], 
                        'pid' => 0, 
                    );
                    $pid = M('wechat_menu')->add($data);
                }else{
                    $pid = $res['id'];
                }
                $list[$k]['id'] = $pid;
                if(!empty($v['sub_button']['list'])){
                    foreach ($v['sub_button']['list'] as $kk => $vv) {
                        $type = $vv['type'];
                        if($type == 'click'){
                            $data = array(
                                'type' => $vv['type'], 
                                'name' => $vv['name'], 
                                'mkey' => $vv['key'], 
                                'pid' => $pid, 
                            );
                            $res = M('wechat_menu')->where($data)->find();
                            if($res){
                                $id = M('wechat_menu')->where('id='.$res['id'])->save($data);
                                $id = $res['id'];
                            }else{
                                $id = M('wechat_menu')->add($data);
                            }
                        }elseif($type == 'view'){
                            $data = array(
                                'type' => $vv['type'], 
                                'name' => $vv['name'], 
                                'url' => $vv['url'], 
                                'pid' => $pid, 
                            );
                            $res = M('wechat_menu')->where($data)->find();
                            if($res){
                                $id = M('wechat_menu')->where('id='.$res['id'])->save($data);
                                $id = $res['id'];
                            }else{
                                $id = M('wechat_menu')->add($data);
                            }
                        }
                        $list[$k]['sub_button']['list'][$kk]['id'] = $id;
                    }
                }
            }
        }

        $this->assign('list',$list);

        $this->display();
    }

    public function get_menu_content(){
        if (!IS_AJAX) { }
        $id = I('id');
        $res = M('wechat_menu')->where('id='.$id)->find();
        $res['name'] = trim($res['name']);
        if($res){
            $data = array(
                'code'=>1,
                'list'=>$res,
                'con'=>htmlspecialchars_decode($res['content']),
                'msg'=>'获取成功'
            );
        }else{
            $data = array(
                'code'=>2,
                'msg'=>'获取失败'
            );
        }
        $this->ajaxReturn($data);
    }

    public function delete_menu(){
        if (!IS_AJAX) { }
        $id = I('id');
        $last_child = I('last_child');
        $r = M('wechat_menu')->where('id='.$id)->field('pid')->find();

        //如果是一级菜单，删除其二级菜单
        M('wechat_menu')->where('pid='.$id)->delete();

        $res = M('wechat_menu')->where('id='.$id)->delete();

        if($last_child != 1){

        }else{
            //没有二级菜单则给一级菜单添加点击事件
            $_key = date('Ymd',time()).'_'.rand(0,100000);
            $key = "MENU_".$_key;
            $data = array(
                'type'=>'click',
                'mkey'=>$key
            );
            M('wechat_menu')->where('id='.$r['pid'])->save($data);
            //删除所有冗余的子栏目
            M('wechat_menu')->where('pid='.$r['pid'])->delete();
        }

        if($res){
            $data = array(
                'code'=>1,
                'last_child'=>$last_child,
                'msg'=>'删除成功'
            );
        }else{
            // $data = array(
            //     'code'=>2,
            //     'msg'=>'删除失败'
            // );
        }
        $this->ajaxReturn($data);
    }

    public function save_menu(){
        if (!IS_AJAX) { }
        //删除后保存要排除参数的影响
        $del = I('post.del');
        if(!$del){
            $name = trim(I('post.name'));
            $type = I('post.type');
            $url = I('url');
            $pid = I('pid');
            $id = I('id');
            $content = I('post.content');
            //封面图
            $thumb_img = I('post.image');
            //作者
            $author = I('post.author');
            //简述
            $digest = I('post.digest');
            //点击微信阅读原文可跳转到所填的链接
            $content_source_url = I('post.content_source_url');

            if($thumb_img && $content && $name && $author && $digest && $content_source_url){
            	$upload_data = $this->uploadForeverThing($thumb_img,$content,$name,$author,$digest,$content_source_url);
            }elseif($thumb_img && !$content && !$author && !$digest && !$content_source_url){
                //只推送封面图
                $upload_data['thumb_media_id'] = $this->uploadThumbImg();
            }else{
        		$content = html_entity_decode($content);
            	$upload_data['content'] = $content;
            }

            if($upload_data['code'] == 2){
                $res = array(
                    'code'=>2,
                    'msg'=>$upload_data['msg'],
                );
                $this->ajaxReturn($res);
            }

            if(empty($name)){
                $res = array(
                    'code'=>2,
                    'msg'=>'名称不能为空',
                );
                $this->ajaxReturn($res);
            }
            if($pid == '')$pid = 0;
            //如果有二级菜单插入，修改对应的一级菜单
            if($pid != 0){
                $data = array(
                    'type' => '',
                    'mkey' => '',
                    'url' => '',
                    'image' => '',
                    'author' => '',
                    'digest' => '',
                    'content_source_url' => '',
                    'content' => '',
                    'thumb_media_id' => '',
                    'media_id' => '',
                );
                $res = M('wechat_menu')->where('id='.$pid)->save($data);
            }
            if($type == 'click'){
                $key = I('key');
                if(!$key){
                    $_key = date('Ymd',time()).'_'.rand(0,100000);
                    $key = "MENU_".$_key;
                }
                $data = array(
                    'name' => $name,
                    'type' => $type,
                    'mkey' => $key,
                    'pid' => $pid,
                    'url' => '',
                    'image' => $thumb_img,
                    'author' => $author,
                    'digest' => $digest,
                    'content_source_url' => $content_source_url,
                    'content' => $upload_data['content'],
                    'thumb_media_id' => $upload_data['thumb_media_id'],
                    'media_id' => $upload_data['media_id'],
                );
            }elseif($type == 'view'){
                $data = array(
                    'name' => $name,
                    'type' => $type,
                    'url' => $url,
                    'pid' => $pid,
                    'content' => '',
                    'mkey' => '',
                );
            }else{
                $data = array(
                    'name' => $name,
                    'pid' => $pid,
                );
            }
            if($id){
                $res = M('wechat_menu')->where('id='.$id)->save($data);
                $list = M('wechat_menu')->where('id='.$id)->find();
            }else{
                $add_id = M('wechat_menu')->add($data);
                $list = M('wechat_menu')->where('id='.$add_id)->find();
            }
        }

        //保存到微信
        $ids = I('ids');
        $ids = html_entity_decode($ids);
        $ids = json_decode($ids,ture);
        $ids = array_filter($ids);

        $id_map = I('id_map');
        $id_map = html_entity_decode($id_map);
        $id_map = json_decode($id_map,ture);
        $id_map = implode(',', $id_map);
        $id_map = $id_map.','.$add_id;

        //新增的一级菜单或者二级菜单内容，要加到菜单数组里
        //新增的一级菜单
        if($pid == 0 && $add_id && !$del){
            $res = M('wechat_menu')->where('id='.$add_id)->find();
            if($res['type'] == 'click' && $res['pid'] == 0){
                $temp['type'] = $res['type'];
                $temp['name'] = trim($res['name']);
                $temp['key'] = $res['mkey'];
            }elseif($res['type'] == 'view' && $res['pid'] == 0){
                $temp['type'] = $res['type'];
                $temp['name'] = trim($res['name']);
                $temp['url'] = $res['url'];
            }
            $arr['button'][] = $temp;
        }

        foreach ($ids as $k => $v) {
            $res = M('wechat_menu')->where('id='.$v[0])->find();
            if($res['type'] == 'click' && $res['pid'] == 0){
                $temp['type'] = $res['type'];
                $temp['name'] = trim($res['name']);
                $temp['key'] = $res['mkey'];
            }elseif($res['type'] == 'view' && $res['pid'] == 0){
                $temp['type'] = $res['type'];
                $temp['name'] = trim($res['name']);
                $temp['url'] = $res['url'];
            }else{
                $temp['name'] = $res['name'];
                $ids2 = $v[1];
                foreach ($ids2 as $kk => $vv) {
                    $r = M('wechat_menu')->where('id='.$vv)->find();
                    if($r['type'] == 'click'){
                        $t['type'] = $r['type'];
                        $t['name'] = trim($r['name']);
                        $t['key'] = $r['mkey'];
                    }elseif($r['type'] == 'view'){
                        $t['type'] = $r['type'];
                        $t['name'] = trim($r['name']);
                        $t['url'] = $r['url'];
                    }
                    $temp['sub_button'][] = $t;
                    unset($t);
                }
            }
            //新增的子菜单
            if($pid != 0 && empty($id) && !$del){
                if($res['id'] == $pid){
                    $r = M('wechat_menu')->where('id='.$add_id)->find();
                    if($r['type'] == 'click'){
                        $tt['type'] = $r['type'];
                        $tt['name'] = trim($r['name']);
                        $tt['key'] = $r['mkey'];
                    }elseif($r['type'] == 'view'){
                        $tt['type'] = $r['type'];
                        $tt['name'] = trim($r['name']);
                        $tt['url'] = $r['url'];
                    }
                    $temp['sub_button'][] = $tt;
                }
            }
            $arr['button'][] = $temp;
            unset($temp);
        }

        // p($arr);
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $this->wechat_obj = new Wechat($options);
        $res = $this->wechat_obj->createMenu($arr);

        if($res){
        	//删除冗余数据
        	M('wechat_menu')->where('id not in ('.$id_map.')')->delete();
            if($del){
                $msg = '删除成功';
            }else{
                $msg = '保存成功';
            }
            $data = array(
                'code'=>1,
                'msg'=>$msg,
                'id'=>$id,
                'list'=>$list
            );
        }else{
            $data = array(
                'code'=>2,
                'msg'=>'保存失败'
            );
        }
        $this->ajaxReturn($data);
    }

	//上传微信永久素材
	private function uploadForeverThing($thumb_img,$content,$name,$author,$digest,$content_source_url){
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $this->wechat_obj = new Wechat($options);

        //替换文章所有图片 不能大于1M
        $content = html_entity_decode($content);

        preg_match_all('/<img(.*?)src=\"(.*?)\"(.*?)>/is', $content, $matches);

        foreach ($matches[2] as $k => $v) {
        	//已经替换过的图片不能再替换一次，否则就被微信吞了
        	$have_replace = strstr($v,'mmbiz.qpic.cn');
        	if(!$have_replace){
	            $img_path = $_SERVER['DOCUMENT_ROOT'].__ROOT__.$v;
	            $file_info = array(
	              'media' => "@{$img_path}",
	            );
	            $upload_img_result = $this->wechat_obj->uploadImg($file_info);
	            if(!$upload_img_result){
                    //可能是引号的问题
                    $file_info2 = array(
                      "media" => '@{$img_path}',
                    );
                    $upload_img_result = $this->wechat_obj->uploadImg($file_info2);
                    setlog('uploadImg:'.$img_path);
                }
                if(!$upload_img_result)$upload_img_result['url'] = '??';//可以填写默认图片
	            $v = $upload_img_result['url'];
        	}
            $u[] = $v;
        }

        $m = $matches[2];

        $content = str_replace($m,$u,$content);

        $thumb_media_id = $this->uploadThumbImg($thumb_img);

        if($thumb_media_id == 'error'){
            $res = array(
                'code'=>2,
                'msg'=>'封面图上传失败',
            );
            return $res;
        }

        //上传素材
        $upload_article_data = array(
          'title' => $name,
          'thumb_media_id' => $thumb_media_id,
          'author' => $author,
          'digest' => $digest,
           //是否在正文显示封面图
          'show_cover_pic' => 0,
          'content' => $content,
          'content_source_url' => $content_source_url
        );

        $articles[] = $upload_article_data;
        $data = array(
          'articles' => $articles
        );
        $result= $this->wechat_obj->uploadForeverArticles($data);
        $media_id = $result['media_id'];
        if(!$result){
            $res = array(
                'code'=>2,
                'msg'=>'内容上传微信失败',
            );
            return $res;
        }elseif($result == 'max api'){
            $res = array(
                'code'=>2,
                'msg'=>'微信今日调用接口次数用尽',
            );
            return $res;
        }
        $data = array(
        	'thumb_media_id' => $thumb_media_id,
        	'content' => $content,
        	'media_id' => $media_id
        );
        return $data;
	}



        //上传封面图
    public function uploadThumbImg($thumb_img){
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $this->wechat_obj = new Wechat($options);

        $img_path = $_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$thumb_img;
        $file_ext = pathinfo($img_path);
        $file_ext = $file_ext['extension'];
        $size = filesize($img_path);
        $file_info = array(
          'filename' => $img_path,
          'content-type' => 'image/'.trim($file_ext), //文件类型
          'filelength' => $size
        );
        $upload_img_result = $this->wechat_obj->upload_meterial($file_info);
        $thumb_media_id = $upload_img_result['media_id'];
        $thumb_url = $upload_img_result['url'];
        if(!$thumb_media_id || !$thumb_url){
            //如果上传失败，应该是api限制的原因
            //暂时先取以前上传过的图片来做封面
            //没必要存微信的图片url，肯定会报微信的禁止引用图片，要存就存thumb_media_id
            $res = $this->wechat_obj->getForeverList('image',0,1);
            $thumb_media_id = $res['item'][0]['media_id'];
        }
        if($thumb_media_id){
            return $thumb_media_id;
        }else{
            return 'error';
        }
    }

}

?>