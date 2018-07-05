<?php
	//前端调试时
	echo "<script>self.location.href='http://localhost/index.html';</script>";
	// 程序位置
	define('APP_PATH', __DIR__ . '/Room/application/');
	// 网站根目录
	define('MySite', __DIR__);
	// 扩展目录
	// define('EXTEND_PATH', 'RoomClassForPHP');
	// 引擎文件引入
	require __DIR__ . './Room/thinkphp/start.php';
?>
