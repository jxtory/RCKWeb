<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Validate;
use think\Loader;

class RCKBase extends Controller
{
	// 跳转回首页的设置
    protected $rehome = "<script>window.location.replace('/');</script>";

    public function _initialize()
    {
        // 基础初始化
    	// 基础初始化的东西开始
    	return;
    }

	public function _empty()
	{
        // 404页面
		abort(404, "丢了丢了！");
        return;
	}

}