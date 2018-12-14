<?php

$config_arr1 = include_once WEB_ROOT . 'Common/config.php';
$config_arr2 = array(
	'SHOW_PAGE_TRACE'=>false,
	'TMPL_PARSE_STRING'=>array(
		'__IMG__'=>__ROOT__.'/Public/Home/Img',
		'__JS__'=>__ROOT__.'/Public/Home/Js',
		'__CSS__'=>__ROOT__.'/Public/Home/Css',
	),
	//测试号token yancycs 正式号 yancy
	// 'APP_TOKEN'=>'yancy',
	'APP_TOKEN'=>'yancycs',
	'APP_AESK'=>'',
	//公众号
	// 'APP_ID'=>'wx8e6bdfe8474ee2d9',
	// 'APP_SECRET'=>'416d5f7db7cbe77340c22ab5842c06cd',
	
	//测试号 公众号已关注
	'APP_ID'=>'wx51eab2f84345c794',
	'APP_SECRET'=>'c7105ee684882bf742b76cfa0d7744ed',

    //'OUTPUT_ENCODE'=>true,
    //'URL_HTML_SUFFIX'=>'html|xml|shtml',
    //'URL_PATHINFO_DEPR'=>'-',
    //'URL_MODEL' => 2,
    // 'LOG_RECORD' => true, // 开启日志记录 
);
return array_merge($config_arr1, $config_arr2);
?>