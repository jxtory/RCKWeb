<?php
namespace app\index\controller;

class Index extends RCKBase
{
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
        foreach ($this->bannerConfig as $key => $value) {
            $i = $key + 1;
            if(!file_exists($value)){$this->bannerConfig[$key] = "__images__/banner0{$i}.jpg";}
        }
        $this->assign('banners', $this->bannerConfig);

        // 通知栏推送
        if(file_exists($this->noticeConfigPath)){
            $this->noticeConfig = json_decode(file_get_contents($this->noticeConfigPath));
        } else {
            $this->noticeConfig = json_decode(json_encode(['title'=>'通知栏', 'content' => '未设置']));
        }
        $this->assign('notice', $this->noticeConfig);

    	return $this->fetch("index");
    }

    public function contentlist()
    {
        // 渲染
        return $this->fetch("contentlist");
    }
}

