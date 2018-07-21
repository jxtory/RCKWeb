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
    	return $this->fetch('banner_add');
    }

}
