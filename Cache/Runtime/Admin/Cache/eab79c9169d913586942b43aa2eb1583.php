<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>内容管理=>博客管理</title>
    <link href="__PUBLIC__/Admin/Css/Style.css" rel="stylesheet" />
    <link href="__PUBLIC__/Admin/lhgdialog/skins/default.css" rel="stylesheet" />
    <script src="__PUBLIC__/Admin/Js/jquery-1.7.2.min.js"></script>
    <script src="__PUBLIC__/Admin/Js/jquery.treeview.js"></script>
    <script src="__PUBLIC__/Admin/lhgdialog/lhgdialog.min.js"></script>
    <script src="__PUBLIC__/Admin/Js/jQueryPlugin.js"></script>
    <script src="__PUBLIC__/Admin/Js/JavaScript.js"></script>
	<script src="__PUBLIC__/Admin/kindeditor/kindeditor.js"></script>
    <!--[if lte IE 6]>    <script src="__PUBLIC__/Admin/Js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script><script type="text/javascript">DD_belatedPNG.fix('*');</script><![endif]-->

	<style type="text/css">textarea{font-size: 12px; line-height: 20px;}</style>
</head>
<body>
<script type="text/javascript">
$(function(){
	autoHeight(jQuery('.autoHeight'));
	jQuery(".column_Box").each(function () {
		var t = jQuery(this);
		if (t.length < 1) return;
		Tab_click(t.find('.tab ul li'), t.find(".wrapBox .body"));
	});
});
</script>



<div class="column_Box mainAutoHeight">
	<div class="tab">
		<ul>
			<li class="current"><a href="javascript:">博客属性</a></li>
		</ul>
	</div>
	<div class="column_Box mainAutoHeight wrapBox">
        <div class="body">
			<form method="post" action="<?php echo U('Goods/insert');?>" id="submitForm" name="submitForm" enctype="multipart/form-data">
				<table border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td style="text-align:right;">博客名称：</td>
							<td style="text-align:left;"><input type="text" class="txt" name="title" value=""  size="50"/><em>*</em></td>
						</tr>
						<tr>
							<td style="text-align:right;">排序：</td>
							<td style="text-align:left;"><input type="text" class="txt" value="" name="sort_order" /></td>
						</tr>
						<tr>
							<td style="text-align:right;">是否显示：</td>
							<td style="text-align:left;">
						      <input type="radio" name="is_open" value="1" checked/>是&nbsp;&nbsp;
						      <input type="radio" name="is_open" value="0" />否
							</td>
						</tr>
						<tr>
							<td style="text-align:right;">图片：</td>
							<td style="text-align:left;"><input type="file" name="goods_img" size="35" /><em>*</em></td>
						</tr>
						<tr>
							<td style="text-align:right;"><em>*</em>&nbsp;&nbsp;博客内容</td>
							<td style="text-align:left;">
								<textarea class="s_content" name="content" style="width:700px;height:300px;"></textarea>
							</td>
						</tr>
						
						<tr>
							<td style="text-align:right;">关键字：</td>
							<td style="text-align:left;"><input type="text" class="txt" value="" name="keywords"  /> 	关键字为选填项，其目的在于方便外部搜索引擎搜索</td>
						</tr>
						<tr>
							<td style="text-align:right;">描述：</td>
							<td style="text-align:left;"><textarea style="width:400px;height:100px;" name="description" ></textarea></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td align='left'>
								<input type='hidden' name='goods_id' value=''/>
								<input type="submit" value="提交"/>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
        </div>
    </div>
</div>

<script src="__PUBLIC__/Admin/kindeditor/kindeditor.js"></script>
<script type="text/javascript">var editor;
KindEditor.ready(function(K) {
	editor = K.create('.s_content', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : true,
		items : [
			'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link']
	});
});
</script>
</body>
</html>