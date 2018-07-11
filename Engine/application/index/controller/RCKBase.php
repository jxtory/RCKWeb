<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Validate;
use think\Loader;

class RCKBase extends Controller
{
	public function _empty()
	{
		abort(404, "丢了丢了！");
	}

}