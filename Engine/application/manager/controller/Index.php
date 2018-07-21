<?php
namespace app\manager\controller;

use \think\Controller;

class Index extends ManagerBase
{
    public function index()
    {
    	return $this->fetch("index");
    }

    public function welcome()
    {
    	//欢迎页面
    	return $this->fetch("welcome");
    }

    public function aboutme()
    {
    	//关于后台
    	return $this->fetch("aboutme");
    }

    public function update_description()
    {
        //更新说明页面
        return $this->fetch("update_description");
    }

}
