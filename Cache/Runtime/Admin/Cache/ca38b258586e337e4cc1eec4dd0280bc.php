<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>管理员管理=>权限管理</title>
    <link href="__PUBLIC__/Admin/Css/Style.css" rel="stylesheet" />
    <link href="__PUBLIC__/Admin/lhgdialog/skins/default.css" rel="stylesheet" />
    <script src="__PUBLIC__/Admin/Js/jquery-1.7.2.min.js"></script>
    <script src="__PUBLIC__/Admin/Js/jquery.treeview.js"></script>
    <script src="__PUBLIC__/Admin/lhgdialog/lhgdialog.min.js"></script>
    <script src="__PUBLIC__/Admin/Js/jQueryPlugin.js"></script>
    <script src="__PUBLIC__/Admin/Js/JavaScript.js"></script>
	<script src="__PUBLIC__/Admin/kindeditor/kindeditor.js"></script>
    <!--[if lte IE 6]>    <script src="__PUBLIC__/Admin/Js/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script><script type="text/javascript">DD_belatedPNG.fix('*');</script><![endif]-->
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
			<li class="current"><a href="javascript:">招聘属性</a></li>
		</ul>
	</div>
	<div class="column_Box mainAutoHeight wrapBox">
        <div class="body">
				<table border="0" cellpadding="0" cellspacing="0">
					<tbody>							
						<tr>
							<td style="text-align:right;">姓名：</td>
							<td style="text-align:left;"><?php echo ($info['name']); ?></td>
						</tr>
						<tr>
							<td style="text-align:right;">联系电话：</td>
							<td style="text-align:left;"><?php echo ($info['phone']); ?></td>
						</tr>
						<tr>
							<td style="text-align:right;">电子邮箱：</td>
							<td style="text-align:left;"><?php echo ($info['email']); ?></td>
						</tr>
						<tr>
							<td style="text-align:right;">留言时间：</td>
							<td style="text-align:left;"><?php echo ($info['add_time']); ?></td>
						</tr>
						<tr>
							<td style="text-align:right;">内容：</td>
							<td style="text-align:left;"><?php echo ($info['content']); ?></td>
						</tr>				
					</tbody>
				</table>
        </div>
    </div>
</div>
</body>
</html>