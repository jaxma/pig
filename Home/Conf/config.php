<?php

$config_arr1 = include_once WEB_ROOT . 'Common/config.php';
$config_arr2 = array(
	'SHOW_PAGE_TRACE'=>false,
	'TMPL_PARSE_STRING'=>array(
		'__IMG__'=>__ROOT__.'/Public/Home/Img',
		'__JS__'=>__ROOT__.'/Public/Home/Js',
		'__CSS__'=>__ROOT__.'/Public/Home/Css',
	),
    //'OUTPUT_ENCODE'=>true,
    //'URL_HTML_SUFFIX'=>'html|xml|shtml',
    //'URL_PATHINFO_DEPR'=>'-',
    //'URL_MODEL' => 2,
);
return array_merge($config_arr1, $config_arr2);
?>