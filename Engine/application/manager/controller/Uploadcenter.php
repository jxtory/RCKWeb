<?php
namespace app\manager\controller;

use \think\Controller;

class Uploadcenter extends ManagerBase
{
    // 上传中心目录
    private $uploadCenter = "uploadcenter";

    // 轮播图目录和配置文件
    private $bannerPath = "uploadcenter/banner";
    private $bannerConfigPath = "uploadcenter/bannerConfig.json";
    private $bannerConfig = ['__images__/banner01.jpg', '__images__/banner02.jpg', '__images__/banner03.jpg', '__images__/banner04.jpg'];

    public function index()
    {
    	return $this->fetch("index");
    }

    public function banner()
    {
    	// 轮播图管理页面
        // 查看轮播图库
        $bannerFiles = scanBannerFile();
        $this->assign('bannerFiles', $bannerFiles);

        // 查看放映中的轮播图
        if(file_exists($this->bannerConfigPath)){$this->bannerConfig = json_decode(file_get_contents($this->bannerConfigPath));}
        foreach ($this->bannerConfig as $key => $value) {
            $i = $key + 1;
            if(!file_exists($value)){$this->bannerConfig[$key] = "__images__/banner0{$i}.jpg";}
        }
        $this->assign('banners', $this->bannerConfig);

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
        // 删除Banner
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

        // 设置轮播图
        if(input("post.types") == "addBanner"){
            $datas = input();
            unset($datas['types']);

            if(!file_exists($this->bannerConfigPath)){
                // 配置文件不存在
                $this->bannerConfig[$datas['offset']] = $this->bannerPath . DS . $datas['filename'];
                if(file_put_contents($this->bannerConfigPath, json_encode($this->bannerConfig))){
                    return true;
                } else {
                    return false;
                }

            } else {
                // 配置文件存在
                $this->bannerConfig = json_decode(file_get_contents($this->bannerConfigPath));
                $this->bannerConfig[$datas['offset']] = $this->bannerPath . DS . $datas['filename'];

                if(file_put_contents($this->bannerConfigPath, json_encode($this->bannerConfig))){
                    return true;
                } else {
                    return false;
                }

            }

        }
    }

}
