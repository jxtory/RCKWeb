<?php
namespace app\manager\controller;

use \think\Controller;

class Index extends ManagerBase
{
    public function index()
    {
    	return $this->fetch("index");
    }

    // 后台登陆
    public function login()
    {
        return $this->fetch('');

    }

    public function welcome()
    {
    	// 欢迎页面
    	return $this->fetch("welcome");
    }

    public function aboutme()
    {
    	// 关于后台
    	return $this->fetch("aboutme");
    }

    public function update_description()
    {
        // 更新说明页面
        return $this->fetch("update_description");
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

    public function notice()
    {
        // 通知栏设置
        if(input("post.types") == "setNotice"){
            $datas = input();
            unset($datas['types']);

            $this->noticeConfig['title'] = $datas['notice_title'];
            $this->noticeConfig['content']  = $datas['notice_content'];
            if(file_put_contents($this->noticeConfigPath, json_encode($this->noticeConfig))){
                return true;
            } else {
                return false;
            }

        }

        // 读取配置文件
        if(file_exists($this->noticeConfigPath)){
            $this->noticeConfig = json_decode(file_get_contents($this->noticeConfigPath));
        } else {
            $this->noticeConfig = json_decode(json_encode(['title'=>'通知栏', 'content' => '未设置']));
        }
        $this->assign('notice', $this->noticeConfig);

        return $this->fetch('notice');
    }

    public function showboard($offset = 0)
    {
        // 读取配置文件
        if(file_exists($this->showboardConfigPath)){
            $this->showboardConfig = json_decode(file_get_contents($this->showboardConfigPath), true);
        } else {
            $this->showboardConfig = json_decode(json_encode($this->showboardConfig), true);
        }

        // 展示板设置
        if(input("post.types") == "setShowboard"){
            $datas = input();
            unset($datas['types']);

            $i = $offset - 1;

            $this->showboardConfig[$i]['caption'] = $datas['caption'];
            $this->showboardConfig[$i]['value'] = $datas['value'];

            if(file_put_contents($this->showboardConfigPath, json_encode($this->showboardConfig))){
                return true;
            } else {
                return false;
            }

        }

        $this->assign('showboard', $this->showboardConfig);

        // 渲染
        return $this->fetch("showboard");
    }

}
