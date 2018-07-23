<?php
namespace app\manager\controller;

use \think\Controller;

class Uploadcenter extends ManagerBase
{
    private $bannerPath = "uploadcenter/banner";

    public function index()
    {
    	return $this->fetch("index");
    }

    public function banner()
    {
    	// 轮播图管理页面
        $bannerFiles = scanBannerFile();
        $this->assign('bannerFiles', $bannerFiles);
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
                $info = $file->rule($mUR)->move($this->bannerPath);
            }

        }

    	return $this->fetch('banner_add');
    }

    public function uploadcenter_handle()
    {
        // 各种提交请求处理
        if(input("post.types") == "delBanner"){
            $datas = input();
            unset($datas['types']);
            $files = explode(",", $datas['files']);

            foreach ($files as $value) {
                if(strlen($value) > 0){
                    if(!unlink($this->bannerPath . DS . $value)){
                        exception('删除Banner错误');
                        // throw new Exception("删除Banner错误");
                    }
                }
            }

            return true;
        }
    }

}
