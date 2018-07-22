<?php
namespace app\manager\controller;

use \think\Controller;

class Uploadcenter extends ManagerBase
{
    public function index()
    {
    	return $this->fetch("index");
    }

    public function banner()
    {
    	// 轮播图管理页面
    	return $this->fetch('banner');
    }

    public function banner_add()
    {
        // 轮播图上传
        if(request()->isPost()){
            // 文件上传处理
            $files = request()->file();

            foreach ($files as $file) {
                // 文件取名规则 —— function myUploadRule 定义在 Common.php
                $mUR = 'myUploadRule';
                $info = $file->rule($mUR)->move('uploadcenter/banner');
            }

        }

    	return $this->fetch('banner_add');
    }

}
