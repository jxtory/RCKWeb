<?php
namespace app\index\controller;

use \think\Controller;

class Index extends Controller
{
    public function index()
    {
    	// 渲染首页
    	return $this->fetch("index");
    }
}
