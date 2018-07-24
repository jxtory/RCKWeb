<?php
namespace app\index\controller;

class Index extends RCKBase
{
    // 轮播图配置路径和文件
    private $bannerConfigPath = "uploadcenter/bannerConfig.json";
    private $bannerConfig = ['__images__/banner01.jpg', '__images__/banner02.jpg', '__images__/banner03.jpg', '__images__/banner04.jpg'];

    public function index()
    {
    	// 渲染首页
        $indexTitle = "首页";
        $this->assign("indexTitle", $indexTitle);

        $url_Manager = url("manager/index/index");

        // S开发中首页开放入口
        $frontcode = "<!-- S乱入代码 -->\n\t";
        $frontcode .= "<div style=\"text-align: center;font-size: 16px;\"><a href=\"{$url_Manager}\" target=\"_blank\">后台入口</a> |-<i>仅开发中可见</i></div>";
        $frontcode .= "\n\t<!-- E乱入代码 -->";
        if(APD){
	        $this->assign('port_Manager', $frontcode);
        } else {
        	$this->assign('port_Manager', '');
        }
        // E开发中首页开放入口


        // 轮播图推送
        if(file_exists($this->bannerConfigPath)){$this->bannerConfig = json_decode(file_get_contents($this->bannerConfigPath));}
        $this->assign('banners', $this->bannerConfig);

    	return $this->fetch("index");
    }

    public function contentlist()
    {
        // 渲染
        return $this->fetch("contentlist");
    }
}

