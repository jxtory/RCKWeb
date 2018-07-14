<?php
namespace app\index\controller;

use \think\Controller;

class Index extends RCKBase
{
    public function index()
    {
    	// 渲染首页
        $indexTitle = "首页";
        $this->assign("indexTitle", $indexTitle);

        $url_Manager = url("manager/index/index");

        // 开发中首页开放入口
        if(APD){
	        $this->assign('port_Manager', "<div style=\"text-align: center;font-size: 16px;\"><a href=\"{$url_Manager}\" target=\"_blank\">后台入口</a> |-<i>仅开发中可见</i></div>");
        } else {
        	$this->assign('port_Manager', '');
        }

    	return $this->fetch("index");
    }

}
