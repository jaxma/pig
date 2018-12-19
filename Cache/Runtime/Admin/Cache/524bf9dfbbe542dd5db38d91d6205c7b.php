<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type='text/javascript' src='http://code.jquery.com/jquery-1.8.0.min.js'></script>
    <link href="__PUBLIC__/Admin/layui/css/layui.css" rel="stylesheet" />
    <script src="__PUBLIC__/Admin/layui/layui.js"></script>
    <link href="__PUBLIC__/Admin/Css/wechat_menu.css" rel="stylesheet" />

    <title></title>
    <style>
        #obstruct{
            height: 0px;
            z-index: 1000;
        }
    </style>
    <script>
        var get_menu_content = '<?php echo U(GROUP_NAME . "/Menu/get_menu_content");?>/';
        var delete_menu = '<?php echo U(GROUP_NAME . "/Menu/delete_menu");?>/';
        var save_menu_url = '<?php echo U(GROUP_NAME . "/Menu/save_menu");?>/';
        /**
         * 使用图片上传接口需满足以下条件
         * 1.容器选择器id=upload
         * 2.设置name=image的input标签隐藏域
         * 3.指定上传目录名称
         */
        //上传目录
        var upload_dir_name = 'menu';
    </script>
</head>

<body>
<script src="__PUBLIC__/Admin/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K) {
    K.create('#content', {
        allowFileManager : false,
        pasteType : 2,
        newlineTag : 'p',
        urlType : 'absolute'
    });
});
</script>
    <div class="container-fluid edit-wrapper layui-container">
        <header>
            <blockquote class="layui-elem-quote">
                <span class="title">微信自定义菜单</span>
            </blockquote>
        </header>
        <div class="wechat-wrapper">
            <div class="wechat-show">
                <div class="phone-wrapper">
                    <div class="phone-content">
                        <div class="menu-wrapper" id="obstruct">
                        </div>
                        <div class="menu-wrapper">
                            <div class="icon-wrapper">
                                <img src="__PUBLIC__/Admin/images/wechat/icon.png" alt="">
                            </div>
                            <ul class="menu" id="menu">  
                                <li>
                                    <span class="menu-title">+</span>
                                    <ul class="menu-list">
                                        <li class="add-item">+</li>
                                    </ul>
                                </li>
                                <?php if(is_array($list)): foreach($list as $key=>$i): ?><li>
                                        <span class="menu-title2" data-type="<?php echo ($i["type"]); ?>" data-id="<?php echo ($i["id"]); ?>" <?php if($i["type"] == 'click' ): ?>data-key="<?php echo ($i["key"]); ?>"<?php elseif($i["type"] == 'view'): ?>data-url="<?php echo ($i["url"]); ?>"<?php endif; ?> ><?php if(empty($$i["name"])): echo ($i["name"]); else: ?>名称为空<?php endif; ?></span>
                                        <ul class="menu-list">
                                            <li class="add-item">+</li>
                                            <?php if(is_array($i["sub_button"]["list"])): foreach($i["sub_button"]["list"] as $key=>$ii): ?><li class="child-menu" data-type="<?php echo ($ii["type"]); ?>" data-id="<?php echo ($ii["id"]); ?>" <?php if($ii["type"] == 'click' ): ?>data-key="<?php echo ($ii["key"]); ?>"<?php elseif($ii["type"] == 'view'): ?>data-url="<?php echo ($ii["url"]); ?>"<?php endif; ?>>
                                                    <span><?php if(empty($$ii["name"])): echo ($ii["name"]); else: ?>名称为空<?php endif; ?></span>
                                                </li><?php endforeach; endif; ?>
                                        </ul>
                                    </li><?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wechat-set">
                <header>
                    <span id="m_name">菜单一</span>
                    <span id="clear-con" onclick = 'clear_con("alert");'>一键清空</span>
                    <span id="del" class="del" onclick = 'del_menu();'>删除菜单</span>
                </header>
                <div class="layui-form">
                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单名称：</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" required lay-verify="required" placeholder="请输入菜单名称" autocomplete="off" class="layui-input">
                        </div>
                        <p class="text-tip" style="text-indent: 20px;">字数不超过4个汉字或8个字母</p>
                    </div>
                    <div class="layui-form-item menu-content">
                        <label class="layui-form-label">菜单内容：</label>
                        <div class="layui-input-block">
                            <input type="radio" lay-filter="type" name="type" value="click" title="发送消息" id="type1" checked>
                            <input type="radio" lay-filter="type" name="type" value="view" title="跳转网页" id="type2">
                        </div>
                        <div class="layui-content editor-wrapper">
                            <div class="layui-form-item">
                                <label class="layui-form-label">作者：</label>
                                <div class="layui-input-block">
                                    <input type="text" name="author" placeholder="请输入作者" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">简述：</label>
                                <div class="layui-input-block">
                                    <input type="text" name="digest" placeholder="请输入简述" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">跳转链接：</label>
                                <div class="layui-input-block">
                                    <input type="text" name="content_source_url" placeholder="请输入跳转链接" autocomplete="off" class="layui-input">
                                </div>
                                <p class="text-tip" style="text-indent: 20px;">点击微信文章“阅读原文"时会跳转的页面</p>
                            </div>
                            <div class="layui-form">
                                <div class="layui-form-item items">
                                <label class="form-text">封面图片：</label>
                                    <i class="fa fa-question-circle-o question" data-tips-text="如果只上传封面图片，将默认直接推送一张图片，请勿填写作者，简述，跳转链接，编辑框"></i>
                                    <div class="form-right">
                                        <!--引入图片页面-->
                                        <script src="__PUBLIC__/Admin/Js/img_upload.js"></script>
                                        <div class="wrapper">
                                          <input class="input-inf2" type="text" name="" autocomplete="off" placeholder="请选择上传图片" class="layui-input">
                                          <button type="button" class="layui-btn orange layui-btn-danger upload-btn"><i class="layui-icon">&#xe67c;</i>上传图片</button>
                                          <div class="layui-upload layui-inline">
                                            <div class="layui-upload-list" data-show="0" data-url="">
                                              <img class="layui-upload-img">
                                              <p class="demoText"><i class="layui-icon delete" style="font-size: 26px;color: white;line-height: 27px;">&#xe640;</i></p>
                                            </div>
                                            <input type="hidden" class="image-name" name="image" value="" />
                                          </div>
                                        </div>
                                        <!-- <small class="orange-text">(请上传正方型的图片 图片大小为：80*80-150*150 最合适80*80)</small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body">
<!--                                     <textarea id="editor" class="ueditors" name="content"></textarea>
                                    <!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>文本编辑器</title>
    <script type="text/javascript" charset="UTF-8">
      window.UEDITOR_HOME_URL = "__PUBLIC__/Admin/ueditor/"; //编辑器项目路径
    </script>
  </head>

  <body>
    <script type="text/javascript">
      require(['ZeroClipboard','ueditor.config', 'ueditor.all', 'zh-cn'], function(ZeroClipboard) {
        window['ZeroClipboard'] = ZeroClipboard;
        $('.ueditors').each(function(key,value){
          UE.delEditor($(value).attr("id"));
          var ue = UE.getEditor($(value).attr("id"),{initialFrameWidth:'100%',initialFrameHeight:350});
        })
      })
    </script>
  </body>


</html> -->
                                    <textarea style="width:100%;height:400px;" name="content" id="content" ></textarea>
                                    <i class="fa fa-question-circle-o question" data-tips-text="如果只填写编辑框，将默认直接推送编辑框内的文字内容"></i>
                                </div>
                            </div>
                        </div>
                        <div class="redirect">
                            <p class="text-tip">订阅者点击该子菜单会跳转到以下连接</p>
                            <div class="layui-form-item">
                                <label class="layui-form-label">页面链接</label>
                                <div class="layui-input-block">
                                    <input type="text" name="url" placeholder="请输入" autocomplete="off" class="layui-input" id="menu_url">
                                </div>
                                <p class="msg-select">请填写能够访问的正确链接（需要http://或者https://）</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="form-text"></label>
                        <div class="submit-wrapper">
                            <input type="hidden" name="pid" value=""/>
                            <input type="hidden" name="id" value=""/>
                            <input type="hidden" name="key" value=""/>
                            <input type="hidden" name="new_type" value=""/>
                            <button class="layui-btn menu-btn" lay-submit="" onclick="save_menu()" >保存为模板</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span id='daily_content' style="display: none;"></span>  
    <script src="__PUBLIC__/Admin/Js/wechat_menu.js"></script>
    <script>

    //清空
    function clear_con(alert){
        if(alert == 'alert'){
            if( !confirm('是否清空当前页编辑内容？') ){
                return false;
            }
        }
        //默认点击页面
        $('.menu-content').show();
        $('.layui-form-radio').eq(0).click();
        // UE.getEditor('editor').setContent('');
        $('#content').text('');
        $("input[name='name']").val('');
        $("input[name='url']").val('');
        $(".layui-upload-list").css('display','none');
        $(".layui-upload-img").attr('src','');
        $("input[name='image']").val('');
        $("input[name='author']").val('');
        $("input[name='digest']").val('');
        $("input[name='content_source_url']").val('');
    }
    //删除
    function del_menu(){
        if( !confirm('您确认删除菜单栏？删除一级菜单栏将会删除其二级菜单栏') ){
            return false;
        }
        id = $("input[name='id']").val();
        var last_child = '';
        $('#menu li').each(function(){
            if($(this).data('id') == id){
                var pc = $(this).prev().hasClass('child-menu');
                var nc = $(this).next().hasClass('child-menu');
                if(objIsEmpty(pc) &&　objIsEmpty(nc)){
                    //最后一个菜单栏
                    last_child = 1;
                }
                $(this).remove();
            }
            if($(this).find('span').data('id') == id){
                $(this).find('span').parent().remove();
            }
        })
        $.ajax({
          async: false,
          type: "POST",
          data: {
            id:id,
            last_child:last_child,
          },
          dataType: "json",
          url: delete_menu,
          success: function(res) {
            // console.log(res);
            if(res.code == 1) {
                layer.load();
                save_menu(1);
            }else{
                layer.msg(res.msg);
                layer.closeAll('loading');
            }
          },
          error: function(res){
            layer.closeAll('loading');
            layer.msg(res.msg);
          }
        });
    }

    function save_menu(del){
        layer.load();
        layer.msg('保存中');
        $li_parent_active = $('#menu li').hasClass('active');
        $span_children_active = $('#menu li span').hasClass('active');
        if(objIsEmpty($li_parent_active) && objIsEmpty($span_children_active)){
            layer.msg('请选择要保存的菜单栏！');
            return false;
        }
        var del = arguments[0] ? arguments[0] : '';
        var id = $("input[name='id']").val();
        var m_name = $("input[name='name']").val();
        var m_type = $("input[name='new_type']").val();
        var m_url = $("input[name='url']").val();
        // var m_content = UE.getEditor('editor').getContent();
        var m_content =  $("#content").text();
        var m_key = $("input[name='key']").val();
        var m_pid = $("input[name='pid']").val();
        var m_image = $("input[name='image']").val();
        var m_author = $("input[name='author']").val();
        var m_digest = $("input[name='digest']").val();
        var m_content_source_url = $("input[name='content_source_url']").val();
        //拥有二级结构的菜单id数组
        var ids = new Array();
        //用来删除后台除了这些id外的冗余数据
        var id_map = new Array();
        $('#menu li').each(function(e){
            ids[e] = {};
            var ids_2 = new Array();
            var $this = $(this).find('span');
            $id = $this.data('id');
            if(!objIsEmpty($id)){
                ids[e][0] = $id;
                id_map.push($id);
            }
            var $this2 = $this.next().find('li');
            $this2.each(function(f){
                $id_2 = $(this).data('id');
                if(!objIsEmpty($id_2)){
                    ids_2.push($id_2);
                    id_map.push($id_2);
                }
            })
            if(!objIsEmpty(ids_2)){
                ids[e][1] = ids_2;
            }
        })

        var ids = JSON.stringify(ids);
        ids = $.trim(ids);
        var id_map = JSON.stringify(id_map);
        id_map = $.trim(id_map);
        $.ajax({
          async: false,
          type: "POST",
          data: {
            id : id,
            name : m_name,
            type : m_type,
            content : m_content,
            url : m_url,
            key : m_key,
            pid : m_pid,
            image : m_image,
            author : m_author,
            digest : m_digest,
            content_source_url : m_content_source_url,
            ids : ids,
            id_map : id_map,
            del : del
          },
          dataType: "json",
          tradtional: true,
          url: save_menu_url,
          success: function(res) {
            // console.log(res);
            if(res.code == 1) {
                //新增菜单栏加id
                $('#menu li').each(function(){
                    //一级
                    if($(this).find('span').hasClass('active')){
                        $(this).find('span').attr('data-id',res.id);
                    }
                    //二级
                    if($(this).hasClass('active')){
                        $(this).attr('data-id',res.id);
                    }
                })
                layer.msg(res.msg);
                layer.closeAll('loading');
                setTimeout(function(){
                    window.location.reload();
                },2000);
            }else{
                layer.msg(res.msg);
                layer.closeAll('loading');
            }
          },
          error: function(res){
            layer.closeAll('loading');
            layer.msg(res.msg);
          }
        });
    }

    function getMenuContent(m_id){
        layer.load();
         $.ajax({
          async: false,
          type: "POST",
          data: {
            id:m_id
          },
          dataType: "json",
          url: get_menu_content,
          success: function(data) {
            layer.closeAll('loading');
            if(data.code == 1){
                var new_type = data.list.type;
                //以new_type为准
                $("input[name='new_type']").val(new_type);
                //切换
                if(new_type == 'click'){
                    $('.layui-form-radio').eq(0).click();
                }else if(new_type == 'view'){
                    $('.layui-form-radio').eq(1).click();
                }
                if(new_type == "click") {
                    // UE.getEditor('editor').setContent(data.con);
                    $("#content").text(data.con);
                    $("input[name='name']").val(data.list.name);
                    if(data.list.image)$(".layui-upload-list").css('display','block');
                    $(".layui-upload-img").attr('src','__ROOT__'+data.list.image);
                    $("input[name='image']").val(data.list.image);
                    $("input[name='author']").val(data.list.author);
                    $("input[name='digest']").val(data.list.digest);
                    $("input[name='content_source_url']").val(data.list.content_source_url);
                }else if(new_type == "view"){
                    $("input[name='url']").val(data.list.url);
                }
            }
          },
          error: function(data){
            layer.closeAll('loading');
            layer.msg(data.msg);
          }
        });
    }
    function objIsEmpty(obj) {
        if(!obj && obj !== 0 && obj !== '' || (Array.prototype.isPrototypeOf(obj) && obj.length === 0) || (Object.prototype.isPrototypeOf(obj) && Object.keys(obj).length === 0) || typeof(obj) == "undefined" || typeof(obj) === "undefined"){　　　　　　　　
            return true;
        }
        return false;
    }
    </script>
</body>

</html>