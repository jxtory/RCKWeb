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
    	return;
    }

	public function _empty()
	{
        // 404页面
		// abort(404, "丢了丢了！");
		return "页面错误……";
	}

}
