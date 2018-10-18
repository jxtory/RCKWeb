<?php
namespace app\manager\controller;

use \think\Controller;

class Content extends ManagerBase
{
    public function index()
    {
    	// 添加内容页面
    	// 获取栏目列表
    	$colList = db("column")->field("id, columnname")->where("pid is null")->select();
        
        for ($i=0; $i < count($colList); $i++) { 
            # code...
            $colList[$i][] = db("column")->field("columnname")->where("pid", $colList[$i]['id'])->select();
        }

    	// 推送栏目列表
    	$this->assign("colList", $colList);

    	return $this->fetch("index");
    }

    public function addContent()
    {
    	// 创建新内容
    	if(input("post.type") == "addContent"){
    		$datas = input();
    		// 卸载请求头
    		unset($datas['type']);


    		$columnname = $datas['column'];
    		$cid = db("column")->where("columnname", $columnname)->find()['id'];

    		$data = [
    			'title'			=>	$datas['conTitle'],
    			'cid'			=>	$cid,
    			'purl'			=>	$datas['conThumbnailUrl'],
    			'content'		=>	$datas['contentAll'],
    			'createtime'	=>	date("Y-m-d h:i:s", time())
    		];

    		$res = db("contents")->insert($data, true);

    		if($res){
    			return "1";
    		} else {
    			return "2";
    		}
    	}

    	return;
    }

    public function contentList()
    {
        // 获取栏目列表
        $colList = db("column")->field("id, columnname")->where("pid is null")->select();
        
        for ($i=0; $i < count($colList); $i++) { 
            # code...
            $colList[$i][] = db("column")->field("id, columnname")->where("pid", $colList[$i]['id'])->select();
        }

        // 推送栏目列表
        $this->assign("colList", $colList);

        // 内容列表页面
        $datas = db("contents a")
            ->field("a.id, a.title, a.cid, a.createtime, b.columnname")
            ->join("cnpse_column b", "cid = b.id")
            ->paginate(15);

        $this->assign('contents', $datas);

        return $this->fetch("contentList");
    }

    public function lookcolumn()
    {
        // 查看栏目
        $cols = db("column")->select();
        $this->assign("columns", $cols);

        return $this->fetch("lookcolumn");
    }

}
