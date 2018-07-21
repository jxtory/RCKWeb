<?php
namespace app\index\controller;

class Index extends RCKBase
{
    public function index()
    {
    	// 渲染首页
        $indexTitle = "首页";
        $this->assign("indexTitle", $indexTitle);

        $url_Manager = url("manager/index/index");

        // S开发中首页开放入口
        $frontcode = "<!-- S乱入代码 -->\n\t";
        $frontcode .= "<div style=\"text-align: center;font-size: 16px;\"><a href=\"{$url_Manager}\" target=\"_blank\">后台入口</a> |-<i>仅开发中可见</i></div>";
        $frontcode .= "<div style=\"text-align: center;font-size: 16px;\">我们的<i><b>前端</b>设计师</i>一直处于失踪的状态！首页还没出完就无影无踪了</div>";
        $frontcode .= "\n\t<!-- E乱入代码 -->";
        if(APD){
	        $this->assign('port_Manager', $frontcode);
        } else {
        	$this->assign('port_Manager', '');
        }
        // E开发中首页开放入口

    	return $this->fetch("index");
    }

}
