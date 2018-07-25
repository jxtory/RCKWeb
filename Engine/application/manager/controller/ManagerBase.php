<?php
namespace app\manager\controller;
use app\index\controller\Allbase as Allbase;

class ManagerBase extends Allbase
{
	// 跳转回首页的设置
    protected $rehome = "<script>window.location.replace('/manager');</script>";

    public function _initialize()
    {
        // 基础初始化
    	// 基础初始化的东西开始

        parent::_initialize();

    }

	public function _empty()
	{
        // 404页面
		return "系统出了问题，请联系管理员";
	}

}
