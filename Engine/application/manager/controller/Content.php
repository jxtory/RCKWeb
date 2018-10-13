<?php
namespace app\manager\controller;

use \think\Controller;

class Content extends ManagerBase
{
    public function index()
    {
    	// 添加内容页面
    	// 获取栏目列表
    	$collist = db("column")->field("columnname")->where("pid is not null")->select();
    	// 推送栏目列表
    	$this->assign("collist", $collist);

    	return $this->fetch("index");
    }

}
