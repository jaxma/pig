$(document).ready(function () {

    first_touch = true;

    //所有
    $('#menu').on('click', 'span', function () {
        //添加按钮
        $(this).parent().siblings().find('.menu-list').fadeOut();
        $('.menu li span').each(function(){
            $(this).removeClass('active');
        })
        if ($(this).hasClass('active')) {
            $(this).removeClass('active').next().fadeOut();
        } else {
            $('#menu .menu-title').removeClass('active');
            $(this).addClass('active').next().fadeIn();    
        }
    })
    //父类添加
    $('.menu-title').on('click',function () {
        clear_con(2);
        var len = $('.menu > li').length;
        if(len == 3){
            html = '<li><span class="menu-title2">菜单名称</span><ul class="menu-list"><li class="add-item">+</li></ul></li>';
            $(this).parent().after(html);
            $(this).parent().remove();
        }else if(len>3){
            layer.msg('最多只能有三个一级菜单');
            $(this).parent().remove();
        }else{
            html = '<li><span class="menu-title2">菜单名称</span><ul class="menu-list"><li class="add-item">+</li></ul></li>';
            $(this).parent().after(html);
        }
    })
    //子类添加
    $("body").on("click",".add-item",function(){
        clear_con(2);
        //判断当前父类是否有id,没有则先保存
        var find_pid = $(this).parent().prev().data('id');
        if(objIsEmpty(find_pid)){
            layer.msg('请先保存一级菜单！');
            $('.menu-content').hide();
            return false;
        }
        var child_len = $(this).parent().find('li').length;
        if(child_len >= 5){
            $(this).parent().append('<li class="child-menu"><span>子菜单名称</span></li>');
            $(this).remove();
        }else{
            $(this).parent().append('<li class="child-menu"><span>子菜单名称</span></li>');
        }
    })
    //父类操作
    $('body').on('click','.menu-title2',function () {
        //第一次点击
        if(first_touch == true){
            $("input[name='id']").val($(this).data('id'));
        }else{
            var id = $("input[name='id']").val();
        }

        //去掉子菜单绿框
        $('.menu-list li').each(function(){
            $(this).removeClass('active');
        });

        //有子菜单的话隐藏编辑内容
        have_child = $(this).next().find('li').hasClass('child-menu');
        if(have_child){
            $('.menu-content').hide();
        }else{
            $('.menu-content').show();
        }

        var m_name = $(this).text();
        m_name = $.trim(m_name);
        $("input[name='name']").val(m_name);

        var m_key = $(this).data('key');
        $("input[name='key']").val(m_key);

        $("input[name='pid']").val(0);

        //获取数据
        id = $(this).data('id');
        if(id){
            getMenuContent(id);
        }

        //改变菜单名
        $this = $(this);
        $("input[name='name']").blur(function(){
            new_name = $(this).val();
            $this.text(new_name);
        })
        $("input[name='id']").val(id);

        first_touch = false;
    })

    //子类操作
    $('body').on('click', '.child-menu', function () {
        removeActive();
        $(this).addClass('active');

        //第一次点击
        if(first_touch == true){
            $("input[name='id']").val($(this).data('id'));
        }else{
            var id = $("input[name='id']").val();
        }

        var m_name = $(this).text();
        m_name = $.trim(m_name);
        $("input[name='name']").val(m_name);

        var m_key = $(this).data('key');
        $("input[name='key']").val(m_key);

        var m_pid = $(this).parent().prev().data('id');
        if(m_pid){
            $("input[name='pid']").val(m_pid);
        }else{
            layer.msg('请先保存一级菜单！');
        }

        //获取数据
        id = $(this).data('id');
        if(id){
            getMenuContent(id);
        }

        $this = $(this);
        $("input[name='name']").blur(function(){
            new_name = $(this).val();
            $this.text(new_name);
        })

        $("input[name='id']").val(id);

        first_touch = false;
    })

    //去掉所有绿框
    function removeActive(){
        //去掉子菜单的绿框
        $('#menu .menu-list li').removeClass('active');
        //去掉父菜单的绿框
        $('.menu li span').each(function(){
            $(this).removeClass('active');
        })
    }

    layui.use('form', function () {
        var form = layui.form;
        form.render();
        form.on('radio(type)', function (data) {
            if (data.value == 'click') {
                $('.menu-content').show();
                $('.editor-wrapper').show();
                $('.redirect').hide();
                $("input[name='new_type']").val('click');
            } else if (data.value == 'view') {
                $('.menu-content').show();
                $('.editor-wrapper').hide();
                $('.redirect').show();
                $("input[name='new_type']").val('view');
            }
        });
    })
})