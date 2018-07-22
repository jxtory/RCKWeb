<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


// 创建目录
function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || mkdir($dir, $mode)) return true;
    if (!mkdirs(dirname($dir), $mode)) return false;
 
    return @mkdir($dir, $mode);
}

function myUploadRule()
{
	return date('Ymd') . md5(microtime(true));
}