<?php
namespace app\manager\controller;

use \think\Controller;

class Content extends ManagerBase
{
    public function index()
    {
    	return $this->fetch("index");
    }

}
