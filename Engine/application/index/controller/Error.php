<?php
namespace app\index\controller;

use \think\Controller;

class Error
{
    public function index()
    {
    	abort(404, "丢了丢了！");
    }

}
