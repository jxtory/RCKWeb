<?php
namespace app\manager\controller;

use \think\Controller;

class Content extends ManagerBase
{
    // 内容编辑页
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

    // 机构内容编辑页
    public function introduce()
    {
        // 机构内容编辑页

        return $this->fetch("introduce");
    }


    // 子页
    public function subpage()
    {
        if(request()->isGet()){
            $datas = input();

            // 渲染
            $this->assign("pageTitle", $datas['page']);
            $this->assign("pageTitleName", $this->subPageName[$datas['page']]);

            // 查询内容
            $res = db("subpages")->where("title", $datas['page'])->find();

            if(!is_null($res['title'])){
                $this->assign("pageContent", $res['content']);
            } else {
                $this->assign("pageContent", "");
            }

            return $this->fetch("subpage");

        }

        if(request()->isPost()){
            if(input("post.type") == "addSubPage"){
                $datas = input();
                unset($datas['type']);

                $data = [
                    'title'     =>  $datas['conTitle'],
                    'content'   =>  $datas['contentAll']
                ];

                $res = db("subpages")->insert($data, true);

                if($res){
                    return "1";
                } else {
                    return "2";
                }

            }
        }

        return exception('出错了');
    }

    // 添加内容
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
                'title'         =>  $datas['conTitle'],
                'cid'           =>  $cid,
                'purl'          =>  $datas['conThumbnailUrl'],
                'content'       =>  $datas['contentAll'],
                'createtime'    =>  date("Y-m-d h:i:s", time())
            ];

            $res = db("contents")->insert($data, true);

            if($res){
                return "1";
            } else {
                return "2";
            }
        }

        // 创建机构介绍新内容
        if(input("post.type") == "addIntroduceContent"){
            $datas = input();
            // 卸载请求头
            unset($datas['type']);

            $data = [
                'title'         =>  $datas['conTitle'],
                'cid'           =>  -1,
                'purl'          =>  "",
                'content'       =>  $datas['contentAll'],
                'createtime'    =>  date("Y-m-d h:i:s", time())
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

    // 编辑内容
    public function editContent_handle()
    {
        // 创建新内容
        if(input("post.type") == "editContent"){
            $datas = input();
            // 卸载请求头
            unset($datas['type']);


            $columnname = $datas['column'];
            $cid = db("column")->where("columnname", $columnname)->find()['id'];
            $nowPurl = db("contents")->where("id", $datas['conid'])->find()['purl'];

            if($nowPurl != $datas['conThumbnailUrl'] && file_exists($nowPurl)){
                unlink($nowPurl);
            }

            $data = [
                'title'         =>  $datas['conTitle'],
                'cid'           =>  $cid,
                'purl'          =>  $datas['conThumbnailUrl'],
                'content'       =>  $datas['contentAll'],
                'createtime'    =>  date("Y-m-d h:i:s", time())
            ];

            $res = db("contents")->where("id", $datas['conid'])->update($data);

            if($res){
                return "1";
            } else {
                return "2";
            }
        }
    	// 机构介绍新内容
    	if(input("post.type") == "editIntroduceContent"){
    		$datas = input();
    		// 卸载请求头
    		unset($datas['type']);

    		$data = [
    			'title'			=>	$datas['conTitle'],
    			'cid'			=>	-1,
    			'purl'			=>	"",
    			'content'		=>	$datas['contentAll'],
    			'createtime'	=>	date("Y-m-d h:i:s", time())
    		];

    		$res = db("contents")->where("id", $datas['conid'])->update($data);

    		if($res){
    			return "1";
    		} else {
    			return "2";
    		}
    	}

    	return;
    }

    // 内容列表
    public function contentList()
    {
        if(request()->isGet()){
            $colId = input("colid");
            $search = input("search");

            // 获取栏目列表
            $colList = db("column")->field("id, columnname")->where("pid is null")->select();
            
            for ($i=0; $i < count($colList); $i++) { 
                # code...
                $colList[$i][] = db("column")->field("id, columnname")->where("pid", $colList[$i]['id'])->select();
            }

            // 推送栏目列表
            $this->assign("colList", $colList);

            // 内容列表页面
            if(isset($search) || mb_strlen($search) > 0 || !is_null($search)){
                $datas = db("contents a")
                    ->field("a.id, a.title, a.cid, a.createtime, b.columnname, b.pid")
                    ->join("cnpse_column b", "cid = b.id")
                    ->where("a.cid", $colId)
                    ->where("title|content", "like", "%" . $search ."%")
                    ->order("id desc")
                    ->paginate(15);
                
            } else {
                $datas = db("contents a")
                    ->field("a.id, a.title, a.cid, a.createtime, b.columnname, b.pid")
                    ->join("cnpse_column b", "cid = b.id")
                    ->where("a.cid", $colId)
                    ->order("id desc")
                    ->paginate(15);

            }

            $this->assign("setColId", $colId);

            // 所有栏目时候
            if(!isset($colId) || $colId == "0" || is_null($colId)){
                if(isset($search) || mb_strlen($search) > 0 || !is_null($search)){
                    $this->assign("setColId", "0");
                    $colId = "0";
                    // 内容列表页面
                    $datas = db("contents a")
                        ->field("a.id, a.title, a.cid, a.createtime, b.columnname, b.pid")
                        ->join("cnpse_column b", "cid = b.id")
                        ->where("title|content","like", "%" . $search ."%")
                        ->order("id desc")
                        ->paginate(15);

                } else {
                    $this->assign("setColId", "0");
                    $colId = "0";
                    // 内容列表页面
                    $datas = db("contents a")
                        ->field("a.id, a.title, a.cid, a.createtime, b.columnname, b.pid")
                        ->join("cnpse_column b", "cid = b.id")
                        ->order("id desc")
                        ->paginate(15);
                    
                }

            }

            $this->assign('contents', $datas);

            return $this->fetch("contentList");
        }
        return;
    }

    // 内容列表
    public function contentIntroducelist()
    {
        if(request()->isGet()){
            $colId = -1;
            $search = input("search");

            // 内容列表页面
            if(isset($search) || mb_strlen($search) > 0 || !is_null($search)){
                $datas = db("contents")
                  ->where("cid", $colId)
                    ->where("title|content", "like", "%" . $search ."%")
                    ->order("id desc")
                    ->paginate(15);
                
            } else {
                $datas = db("contents")
                    ->where("cid", $colId)
                    ->order("id desc")
                    ->paginate(15);

            }

            $this->assign('contents', $datas);

            return $this->fetch("contentIntroducelist");
        }
        return;
    }


    // 编辑内容
    public function editContent()
    {
        if(request()->isGet() && !is_null(input("get.cid"))){

            // 获取内容ID
            $contentId = input("cid");

            // 获取内容并推送
            $content = db("contents")->where("id", $contentId)->find();
            // $content['content'] = json_encode($content['content']);
            // dump($content['content']);die;
            $this->assign("content", $content);

            // 获取栏目列表
            $colList = db("column")->field("id, columnname")->where("pid is null")->select();
            
            for ($i=0; $i < count($colList); $i++) { 
                # code...
                $colList[$i][] = db("column")->field("columnname")->where("pid", $colList[$i]['id'])->select();
            }

            // 推送栏目列表
            $this->assign("colList", $colList);

            return $this->fetch("editContent");
        }
        return;
    }

    // 编辑机构介绍内容
    public function editIntroduceContent()
    {
        if(request()->isGet() && !is_null(input("get.cid"))){

            // 获取内容ID
            $contentId = input("cid");

            // 获取内容并推送
            $content = db("contents")->where("id", $contentId)->find();
            // $content['content'] = json_encode($content['content']);
            // dump($content['content']);die;
            $this->assign("content", $content);

            return $this->fetch("editIntroduceContent");
        }
        return;
    }

    // 删除内容
    public function deleteContent()
    {
        if(input("type") == "deleteContent"){
            $datas = input();
            unset($datas['type']);

            $purl = db("contents")->where("id", $datas['conid'])->find()['purl'];
            if(!is_null($purl) && file_exists($purl)){
                unlink($purl);
            }

            $res = db("contents")->where("id", $datas['conid'])->delete();

            if($res){
                return "1";
            } else {
                return "2";
            }
        }

        if(input("type") == "deleteIntroduceContent"){
            $datas = input();
            unset($datas['type']);

            $purl = db("contents")->where("id", $datas['conid'])->find()['purl'];
            if(!is_null($purl) && file_exists($purl)){
                unlink($purl);
            }

            $res = db("contents")->where("id", $datas['conid'])->delete();

            if($res){
                return "1";
            } else {
                return "2";
            }
        }

        return "error";
    }

    // 查看栏目
    public function lookcolumn()
    {
        // 查看栏目
        $cols = db("column")->select();
        $this->assign("columns", $cols);

        return $this->fetch("lookcolumn");
    }

    // 查看置顶
    public function looktop()
    {
        // 查看栏目
        $datas = db("contenttop")
            ->field("b.*, c.*,b.id as bid, c.id as cid, c.cid as colid")
            ->join("cnpse_column b", "b.id = cid")
            ->join("cnpse_contents c", "c.id = tid")
            ->select();

        $this->assign("datas", $datas);
        // dump($datas);die;
        return $this->fetch("looktop");
    }

    // 获取栏目名称
    public function getColumnName()
    {
        if(input("type") == "getColumnName"){
            $datas = input("post.");
            unset($datas['type']);
            $res = db("column")->where("id", $datas['cid'])->find();
            $res2 = db("contenttop")->where("cid", $datas['cid'])->find();
            $res3 = db("contents")->where("id", $res2['tid'])->find();
            $data['cname'] = $res['columnname'];
            $data['curtitle'] = $res3['title'];
            $data['cururl'] = url("index/contentlist/contentPage", ['listType' => $res3['cid'], 'cid' => $res3['id']]);

            return $data;
        }
        return "error";
    }

    // 设置内容置顶
    public function setContentTop()
    {
        if(input("type") == "setContentTop"){
            $datas = input("post.");
            unset($datas['type']);
            $res = db("contenttop")->insert([
                    "cid"   =>  $datas['cid'],
                    "tid"   =>  $datas['tid']

                ], true);

            if($res){return "ok";}
        }
        return "error";
    }

    // 查看内容标题
    public function lookTitle()
    {
        if(input("type") == "lookTitle"){
            $datas = input("post.");
            unset($datas['type']);

            $res = db("contents")->where("id", $datas['conid'])
                ->field("title")
                ->find();
                
            return $res['title'];
        }
        return "error";
    }

}
