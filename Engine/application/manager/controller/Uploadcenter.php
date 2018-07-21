<?php
namespace app\manager\controller;

use \think\Controller;

class Uploadcenter extends ManagerBase
{
    public function index()
    {
    	return $this->fetch("index");
    }

    public function banner()
    {
        return "Contents";
    }

}
