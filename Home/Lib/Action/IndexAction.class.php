<?php
class IndexAction extends CommonAction {
	public function __construct() {
		parent::__construct();
        /*****start   网站标题 关键字 描述   start*********/
        $this->site_title = $this->site_info['title'];
        $this->site_keywords = $this->site_info['keyword'];
        $this->site_description = $this->site_info['description'];
        /*****end    网站标题 关键字 描述    end**********/
		$list = file_get_contents('http://news.qq.com');
		$list=mb_convert_encoding($list, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
	    // preg_match_all('#<li.*>.*<a.*class="cate".*href="(.*)".*target="_blank".*>(.*)</a>.*</li>#sU',$list,$arr);
	    preg_match_all('#<em.*>.*<a.*target="_blank".*class="'.QQ_NEWS.'".*href="(.*)".*>(.*)</a>.*</em>#sU',$list,$arr);
	    $new_url = $arr[1];
	    $new_title = $arr[2];
	    $news = array();
	    foreach ($new_url as $k => $v) {
	    	if($k <= 4)$news[]['url'] = $v;
	    }
	    foreach ($new_title as $k => $v) {
	    	if($k <= 4)$news[$k]['title'] = $v;
	    }
		$this->assign('news',$news);
	}

	public function index(){
        import("ORG.Wechat.Wechat");
        $options = array(
            'token' => C('APP_TOKEN'), //填写您设定的key
            'encodingaeskey' => C('APP_AESK'), //填写加密用的EncodingAESKey，如接口为明文模式可忽略
            'appid' => C('APP_ID'), //填写高级调用功能的app id
            'appsecret' => C('APP_SECRET'), //填写高级调用功能的密钥
        );
        $list = $this->wechat_obj = new Wechat($options);
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
        p($list);
        echo 'test';
        die;
        
		$goods_id = $_REQUEST['goods_id'];
		$detail = M('goods')->where('goods_id = '.$goods_id)->find();
		if(!$detail  || !$goods_id){
			$detail = M('goods')->where('is_open = 1')->order('sort_order asc')->find();
		}
		$goods = M('goods')->where('is_open = 1')->order('sort_order desc')->limit(15)->select();
		$this->assign('detail',$detail);
		$this->assign('goods',$goods);
		$this->display();
	}
	
    public function index2(){
		$search = $_REQUEST['search'];
		$where = ' (cat_id = 1 or cat_id = 6) ';
    	if($search)$where .= " and ((title like '%$search%') or (description like '%$search%'))";
        $limit      = $this->limit? $this->limit : 16;
        import('ORG.Util.Page2');// 导入分页类
        $count      = M('ads')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);
        $this->assign('page',$Page);
        $this->ads = M('ads')->where($where)->order('sort_order asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        // echo M('ads')->_sql();
        $this->assign('totalPage',ceil($count/$limit));

		$where2 = ' is_open = 1 ';
    	if($search)$where2 .= " and ((title like '%$search%') or (description like '%$search%'))";
        import('ORG.Util.Page2');// 导入分页类
        $count      = M('goods')->where($where2)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);
        $this->assign('page',$Page);
        $this->goods = M('goods')->where($where2)->order('sort_order asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('totalPage',ceil($count/$limit));

        //精彩评论
        $this->c1 = M('guestbook')->where('guestbook_id = 3')->find();
        $this->c2 = M('guestbook')->where('guestbook_id = 4')->find();
        $this->c3 = M('guestbook')->where('guestbook_id = 5')->find();
        $this->c4 = M('guestbook')->where('guestbook_id = 6')->find();
        $this->c5 = M('guestbook')->where('guestbook_id = 7')->find();
        $this->c6 = M('guestbook')->where('guestbook_id = 8')->find();

		$this->display();
    }
	public function freeback(){
        $guestbook = M('guestbook')->where('1')->order('guestbook_id desc')->select();
		$this->assign('guestbook',$guestbook);
		$this->display();
	}
	public function freeback2(){
		$guestbook_id = $_REQUEST['guestbook_id'];
		$guestbook = M('guestbook')->where('guestbook_id = '.$guestbook_id)->find();
		if(!$guestbook  || !$guestbook_id){
			$guestbook = M('guestbook')->where('1')->order('guestbook_id desc')->find();
		}
		$comments = M('comment')->where('pid = 0 and gid = '.$guestbook_id)->order('add_time desc')->limit(15)->select();
		$guestbook2 = M('guestbook')->where('1')->order('guestbook_id desc')->limit(15)->select();
		$this->assign('detail',$guestbook);
		$this->assign('goods',$guestbook2);
		$this->assign('comments',$comments);
		$this->display();
	}
	
    //添加留言
    public function addMessage(){
        $data = M('guestbook')->create();

        if (!$data['name']) $this->error('标题不能为空！');

        if (!$data['content']) $this->error('内容不能为空！');

        $data['add_time'] = time();

        if(M('guestbook')->add($data)){
            $this->success('您的留言已经提交，感谢您的反馈！');
        }else{
            $this->error('网络错误！');
        }
    }
    //添加评论
    public function addComment(){
        $data = M('Comment')->create();

        if (!$data['content']) $this->error('内容不能为空！');

        $data['add_time'] = time();
        $data['gid'] = $_REQUEST['gid'];
        $data['img'] = $_REQUEST['img'];
        $data['name'] = makeNickname();

        if(M('Comment')->add($data)){
            $this->success('您的评论已经提交，感谢您的反馈！');
        }else{
            $this->error('网络错误！');
        }
    }
    //添加评论
    public function addReback(){
        $data = M('Comment')->create();

        if (!$_REQUEST['con']) {
        	$res = array(
        		'code'=>3,
        		'msg'=>'内容不能为空',
        	);
            $this->ajaxReturn($res);
        }

        if (!$_REQUEST['gid']) {
        	$res = array(
        		'code'=>4,
        		'msg'=>'gid不能为空',
        	);
            $this->ajaxReturn($res);
        }

        if (!$_REQUEST['pid']) {
        	$res = array(
        		'code'=>5,
        		'msg'=>'pid不能为空',
        	);
            $this->ajaxReturn($res);
        }

        $data['add_time'] = time();
        $data['gid'] = $_REQUEST['gid'];
        $data['pid'] = $_REQUEST['pid'];
        $data['img'] = $_REQUEST['img'];
        $data['content'] = $_REQUEST['con'];
        $data['name'] = makeNickname();

        $id = M('Comment')->add($data);

        if($id){
        	$list = M('Comment')->find($id);
        	$pname = M('Comment')->where('id='.$_REQUEST['pid'])->field('name')->find();
        	$list['pname'] = $pname['name'];
        	$res = array(
        		'code'=>1,
        		'list'=>$list,
        		'msg'=>'评论成功',
        	);
            $this->ajaxReturn($res);
        }else{
        	$res = array(
        		'code'=>2,
        		'msg'=>'评论失败',
        	);
            $this->ajaxReturn($res);
        }
    }
    public function getMoreReback(){
        if (!$_REQUEST['pid']) {
        	$res = array(
        		'code'=>5,
        		'msg'=>'pid不能为空',
        	);
            $this->ajaxReturn($res);
        }
        $pid = $_REQUEST['pid'];
        $list = M('Comment')->where('pid='.$pid)->order('add_time desc')->select();
        foreach ($list as $k => $v) {
        	$pname = M('Comment')->where('id='.$pid)->field('name')->find();
        	$list[$k]['pname'] = $pname['name'];
        }
        if($list){
        	$res = array(
        		'code'=>1,
        		'list'=>$list,
        		'msg'=>'获取成功',
        	);
        }else{
        	$res = array(
        		'code'=>2,
        		'msg'=>'没有评论',
        	);
        }
         $this->ajaxReturn($res);
    }
	public function save_message(){
		if(IS_POST){
			if($_SESSION['verify'] != md5($_POST['verify'])) {
				redirect(U('Home/Liuyan/liuyan'), 3, '验证失败，页面跳转中...');
			}
			//$this->redirect('http://www.baidu.com', null, 5, '页面跳转中...');
			$Message = D("Message");
			if (!$Message->create()){ // 创建数据对象
				$this->error($Message->getError()); //失败，输出错误信息
			}else{
				$result =  $Message->add(); //成功添加数据
				$this->success('成功！',U('Home/Liuyan/liuyan')); //跳转
				//die;
			}

			//$post=$this->_post();
			//$mess = M('message');
			//dump($post);
		}
	}
	Public function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
		$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
		$info =  $upload->getUploadFileInfo();
		//print_r($info);die;
		}
		 
		// 保存表单数据 包括附件数据
		$User = M("files"); // 实例化User对象
		$User->create(); // 创建数据对象
		$User->photo = $info[0]['savename']; // 保存上传的照片根据需要自行组装
		//print_r($info[0]['savename']);die;
		$data['img'] = 'http://localhost/ThinkPHP/Public/Uploads/'.$info[0]['savename'];
		$User->add($data); // 写入用户数据到数据库
		$this->success('数据保存成功！');
}
    public function test(){
        $result = send_mail('1058514799@qq.com','tujia','测试','邮件测试!');
        pre($result);
    }
}
?>