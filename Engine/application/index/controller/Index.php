<?php
namespace app\index\controller;

use \think\Controller;

class Index extends Controller
{
    public function index()
    {
    	// 渲染首页
        $indexTitle = "首页";
        $this->assign("indexTitle", $indexTitle);
    	return $this->fetch("index");
    }

}
