<?php
	//前端调试时
	// echo "<script>self.location.href='http://localhost/index.html';</script>";

	// 常用常量
	define('APP_PATH', __DIR__ . '/Engine/application/');			//程序位置
	define('MySite', __DIR__);										//网站根目录
	define('APD', true);											//开发状态

	// 扩展目录
	// define('EXTEND_PATH', 'Jahs_VexyPHP');
	// 引擎文件引入
	require __DIR__ . './Engine/thinkphp/start.php';
?>
