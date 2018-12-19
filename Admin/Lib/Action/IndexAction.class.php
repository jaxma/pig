<?php

class IndexAction extends CommonAction {
	/**
      +----------------------------------------------------------
     * 后台首页
      +----------------------------------------------------------
     */
    public function index() {
		parent::logined();
		$this->display();
    }
	
	public function main(){
		$M_admin_user = M('admin_user');
		$info = $M_admin_user->where(array('user_id'=>$_SESSION['admin_id']))->find();

		switch(PHP_OS)
		{
			case "Linux":
				$sysReShow = (false !== ($sysInfo = sys_linux()))?"show":"none";
			break;
			
			case "FreeBSD":
				$sysReShow = (false !== ($sysInfo = sys_freebsd()))?"show":"none";
			break;
		/*	
			case "WINNT":
				$sysReShow = (false !== ($sysInfo = sys_windows()))?"show":"none";
			break;
		*/	
			default:
			break;
		}
		$session_start=isfun("session_start");
		
		$this->assign('info',$info);
		$this->assign('sysReShow',$sysReShow);
		$this->assign('sysInfo',$sysInfo);
		$this->assign('session_start',$session_start);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 头部导航菜单
      +----------------------------------------------------------
     */
	 public function topMenu() {
		parent::logined();
		$this->display();
    }
	
	/**
      +----------------------------------------------------------
     * 左边导航菜单
      +----------------------------------------------------------
     */
	 public function leftMenu() {
		parent::logined();
		$this->display();
    }
	
	
	/**
      +----------------------------------------------------------
     * 清除缓存目录
      +----------------------------------------------------------
     */
	function clearCache($type=0,$path=NULL) {
		parent::logined();
		D('Index')->deldir(dirname(RUNTIME_PATH));
		$this->success('更新缓存文件成功！');
    }

    public function upload()
    {
        $upload_dir_name = I('post.upload_dir_name');
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小 3M
        $upload->allowExts = array('jpg', 'png', 'jpeg', 'bmp', 'pic'); // 设置附件上传类型

        $upload->savePath = './Uploads/'.$upload_dir_name.'/';// 设置附件上传目录
        $upload->thumb = true; // 是否需要对图片文件进行缩略图处理，默认为false       
        $upload->thumbPath = './Uploads/'.$upload_dir_name.'/thumb/';  //缩略图的保存路径，留空的话取文件上传目录本身
        $upload->thumbMaxWidth="50";   //缩略图的最大宽度，多个使用逗号分隔
        $upload->thumbMaxHeight="50";   //缩略图的最大高度，多个使用逗号分隔
        $upload->thumbPrefix="thumb_";   //缩略图的文件前缀，默认为thumb_  （如果你设置了多个缩略图大小的话，请在此设置多个前缀）

        $upload->uploadReplace = false; //存在同名文件是否是覆盖
        $upload->thumbRemoveOrigin = false;//生成缩略图后是否删除原图
        $upload->autoSub = true;    //是否以子目录方式保存
        $upload->subType = 'date';  //可以设置为hash或date
        $upload->dateFormat = 'Ymd';
        if ($upload->upload()) {
            $info = $upload->getUploadFileInfo();
            $image = substr($info[0]['savepath'],1) . $info[0]['savename'];
            
            $this->ajaxReturn(['code' => 0, 'msg' => '上传成功', 'src' => $image], 'JSON');
        } else {
            $this->ajaxReturn(['code' => 1, 'msg' => '上传失败'], 'JSON');
        }
//        return $image;
    }
	

}