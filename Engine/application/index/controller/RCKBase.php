<?php
namespace app\index\controller;

class RCKBase extends Allbase
{
	// 跳转回首页的设置
    protected $rehome = "<script>window.location.replace('/');</script>";

    public function _initialize()
    {
        // 基础初始化
    	// 基础初始化的东西开始

        parent::_initialize();
        $topShowCol = db("column")->where("pid is null")->select();
        $topShowColAll = db("column")->where("pid is not null")->select();
        $this->assign("topShowCol", $topShowCol);
        $this->assign("topShowColAll", $topShowColAll);
    }

	public function _empty()
	{
        // 404页面
		abort(404, "丢了丢了！");
        return;
	}

}