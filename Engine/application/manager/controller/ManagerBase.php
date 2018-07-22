<?php
namespace app\manager\controller;
use think\Controller;
use think\Db;
use think\Validate;
use think\Loader;

class ManagerBase extends Controller
{
	// 跳转回首页的设置
    protected $rehome = "<script>window.location.replace('/manager');</script>";

    public function _initialize()
    {
        // 基础初始化
    	// 基础初始化的东西开始

        // 创建上传中心目录
        mkdirs("uploadcenter");
        mkdirs("uploadcenter/banner");

    	return;
    }

	public function _empty()
	{
        // 404页面
		return "系统出了问题，请联系管理员";
	}

}
