<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<title>宠物家园</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="__CSS__/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="__CSS__/camera.css" rel="stylesheet" type="text/css" media="all" />
 <script type='text/javascript' src='__JS__/jquery.min.js'></script>
    <script type='text/javascript' src='__JS__/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='__JS__/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='__JS__/jquery.easing.1.3.js'></script> 
     <script>
	</script>
</head>
<body>
<div class="wrap">
<div class="header">
	<div class="logo">
		<a href="<?php echo U("Index/index");?>"><img src="https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/5824440e15d5db6b11fa3e25/1478771753186/HSBC+Chinese+Proverbs+-+Eyes+%28Twitter%29.gif?format=1000w" style = "width:340px;height:115px;" alt="" order = 0> </a>
	</div>
    <div class='ribbon'>
        <a class="active" href='<?php echo U("Index/index");?>' style="color:red;">博客</a>
        <a href='<?php echo U("Index/freeback");?>'>留言</a>
        <a href='<?php echo U("Index/index2");?>'>宠物图片</a>
    </div>
</div>
<div class="fluid_container">
          <div class="camera_wrap camera_azure_skin">
            <div data-thumb="__IMG__/slides/thumbs/slider1.jpg" data-src="__IMG__/slides/slider1.jpg">
                          </div>
            <div data-thumb="__IMG__/slides/thumbs/slider2.jpg" data-src="__IMG__/slides/slider2.jpg">
          </div>
     </div>
</div><div class="tlinks">Collect from <a href="http://www.yangsi.tk/" >宠物家园</a></div>
<div class="clear"></div>
<div class="content-bg">
<div class="grid-list-main">
	<div class="grid-list-btm">
		<h4><?php echo ($detail["title"]); ?></h4>
		<h2><?php echo (date('Y-m-d h:i',$detail["add_time"])); ?></h2>
		<p><?php echo ($detail["content"]); ?></p>
	</div>	
	</div>

		<div class="sidebar">
		<div class="text1">
			<h2>Other Blog</h2>
		</div>
		<div class="text1-nav">
		<ul>
        <?php if(is_array($goods)): foreach($goods as $key=>$i): ?><li><a href="<?php echo U('Index/index', array('goods_id'=>$i['goods_id']));?>"><?php echo (mb_substr($i["title"],0,15,'UTF-8')); ?></a></li><?php endforeach; endif; ?>
	    </ul>
	</div>
	</div>
	<div class="clear"></div>
</div>
<div class="footer">
  <div class="box1">
		<h4>最新资讯</h4>
        <?php if(is_array($news)): foreach($news as $key=>$i): ?><a href = '<?php echo ($i["url"]); ?>' target="_blank"><p><?php echo ($i["title"]); ?></p></a><?php endforeach; endif; ?>
  </div>
<div class="clear"></div>			
</div>
<div class="footer1">
	<p class="link"><span>Copyright &copy; 2018.Company name All rights reserved.More Templates <a href="http://www.yangsi.tk/" target="_blank" title="宠物家园">宠物家园</a> - Collect from <a href="http://www.yangsi.tk/" title="宠物家园" target="_blank">宠物家园</a></span></p>
</div>
</div>
    <script type='text/javascript' src='__JS__/jquery.mousewheel.min.js'></script> 
<script>
     window.arr = [
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/5824440e15d5db6b11fa3e25/1478771753186/HSBC+Chinese+Proverbs+-+Eyes+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/5812147fe4fcb59d13a77264/1477579914197/HSBC-Chinese-Proverbs+-+Hens+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/5812147f15d5db78c826f51a/1477579922142/HSBC-Chinese-Proverbs+-+Trees+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/582443f8e4fcb5b384e0b9b4/1478771732873/HSBC+Chinese+Proverbs+-+River+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/5835808915d5db57b18e8ee2/1479901855479/HSBC+Chinese+Proverbs+-+Cart+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c598a20099e8a55051ccb/1493981606494/HSBC+Chinese+Proverbs+-+Family+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c598a46c3c4d418c5fbb6/1493981621969/HSBC+Chinese+Proverbs+-+Travelling+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c599ee4fcb50ff47e8cad/1493981659666/HSBC+Chinese+Proverbs+-+People+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c59d417bffc097baaf9ba/1493981693463/HSBC+Chinese+Proberbs+-+Tiger+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c59ade6f2e13e84051230/1493981701516/HSBC+Chinese+Proverbs+-+Journey+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c59d41e5b6cd813fa6482/1493981751699/HSBC+Chinese+Proverbs+-+Army+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c59fa1b631b401a75df99/1493981742391/HSBC+Chinese+Proverbs+-+Beginning+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c59d44402434f1dfef9e8/1493981751764/HSBC+Chinese+Proverbs+-+Leaves+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c59f76b8f5bfe3f3a2916/1493981745632/HSBC+Chinese+Proverbs+-+Two+Boats+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5a2686e6c071a64a3cd5/1493981811636/HSBC+Chinese+Proverbs+-+Book+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5a2c414fb51af8c53e1b/1493981809471/HSBC+Chinese+Proverbs+-+Snail+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5a30db29d6fb55d16ef6/1493981795072/HSBC+Chinese+Proverbs+-+Door+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5a6c59cc68e734581f3a/1493981879083/HSBC+Chinese+Proverbs+-+Cow+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5a5c03596e9021cc40fb/1493981872275/HSBC+Chinese+Proverbs+-+Cyclical+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5a67be659408c687c5aa/1493981875034/HSBC+Chinese+Proverbs+-+Forebearance+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5ab2ff7c502a07794597/1493981919538/HSBC+Chinese+Proverbs+-+Dog+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5aa529687fec92f85911/1493981937385/HSBC+Chinese+Proverbs+-+Melon+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5aa95016e1ca29e099db/1493981952412/HSBC+Chinese+Proverbs+-+Mountains+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5ad9bebafbc3108ab82d/1493982042252/HSBC+Chinese+Proverbs+-+Dumplings+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5afa15cf7d4452940930/1493981983205/HSBC+Chinese+Proverbs+-+Earth+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5aeab8a79b19e29c724c/1493982021112/HSBC+Chinese+Proverbs+-+Shore+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5af259cc68e734582317/1493982011584/HSBC+Chinese+Proverbs+-+Spring+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5b1ca5790a44386ce89d/1493982052089/HSBC+Chinese+Proverbs+-+Embroidery+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5b359f74560ebc7558cd/1493982061850/HSBC+Chinese+Proverbs+-+Treasure+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5b396b8f5bfe3f3a321a/1493982073988/HSBC+Chinese+Proverbs+-+Flowers+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5b8759cc68e734582779/1493982160797/HSBC+Chinese+Proverbs+-+Fingers+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5b936b8f5bfe3f3a351b/1493982165799/HSBC+Chinese+Proverbs+-+Fire+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5b9cbe659408c687d025/1493982167777/HSBC+Chinese+Proverbs+-+Sky+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5bcb86e6c071a64a4995/1493982265578/HSBC+Chinese+Proverbs+-+Fish+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5bd13e00bed27052ef00/1493982221852/HSBC+Chinese+Proverbs+-+Harvest+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5bda37c5813774b38fbd/1493982227375/HSBC+Chinese+Proverbs+-+Tigers+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5c0717bffc097bab0b41/1493982340189/HSBC+Chinese+Proverbs+-+Learning+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5c6b20099e8a5505340c/1493982368197/HSBC+Chinese+Proverbs+-+Trousers+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5c8629687fec92f86a42/1493982368295/HSBC+Chinese+Proverbs+-+Horse+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5c77c534a56b5dbc2545/1493982392962/HSBC+Chinese+Proverbs+-+Jade+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5c9de4fcb50ff47ea3c8/1493982408334/HSBC+Chinese+Proverbs+-+Inn+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5ce5bf629a2694de06c0/1493982534499/HSBC+Chinese+Proverbs+-+Ocean+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5e33d482e9f9e5d15522/1493982827799/HSBC+Chinese+Proverbs+-+Laugh+%28Twitter%29.gif?format=1000w',
          'https://static1.squarespace.com/static/535e680de4b0eea56c05a375/5812147f3e00be2c5f42fcad/590c5bd015cf7d4452941266/1493982237243/HSBC+Chinese+Proverbs+-+Flower+%28Twitter%29.gif?format=1000w'
    ]
	jQuery(function($) {

		logo_auto = setInterval(function(){ 
			order = $('.logo img').attr('order');
			order++
			order = parseInt(order);
			if(order>=43){
				order = 0;
			}
			$('.logo img').attr('src',arr[order]);
			$('.logo img').attr('order',order);
		}, 3000);

		$('.logo').bind('mousewheel', function(event, delta) {
		var dir = delta > 0 ? 'Up' : 'Down';
		if (dir == 'Up') {
			clearInterval(logo_auto);
			order = $('.logo img').attr('order');
			order--;
			order = parseInt(order);
			if(order<=0){
				order = 43;
			}
			$('.logo img').attr('src',arr[order]);
			$('.logo img').attr('order',order);
		}else if(dir == 'Down'){
			clearInterval(logo_auto);
			order = $('.logo img').attr('order');
			order++
			order = parseInt(order);
			if(order>=43){
				order = 0;
			}
			$('.logo img').attr('src',arr[order]);
			$('.logo img').attr('order',order);
		}
		return false;
		});
	})
</script>
</body>
</html>