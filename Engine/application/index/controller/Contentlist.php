<?php
namespace app\index\controller;

class Contentlist extends RCKBase
{
    public function contentPage()
    {
        // 渲染
        if(request()->isGet()){
            // 获取请求类型
            $listType = input("listType");
            $contentId = input("cid");
            // 获取栏目
            $cols = db("column")->where("id", $listType)->find();
            $this->assign("secTitle", $cols['columnname']);

            // 空页面判断
            if($listType == null || $cols == null){
                abort(404,'页面不存在');
            }

            // 渲染标题
            if($cols['pid'] == null){
                $title = $cols['columnname'];
                $this->assign("title", $title);
            } else {
                $pCols = db("column")->where("id", $cols['pid'])->find();
                $title = $pCols['columnname'];
                $this->assign("title", $title);
            }

            // 推送栏目
            $leftColumns = db("column")->where("pid is null")->select();
            $this->assign("leftColumns", $leftColumns);

            // 推送侧边内容
            $cs = db("column")->where("pid is null")->count();

            for ($i=0; $i < count($leftColumns); $i++) { 
                $cas[$leftColumns[$i]['id']] = db("contents a")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $leftColumns[$i]['id'])
                    ->order("createtime desc")
                    ->limit(4)
                    ->select();
            }

            $this->assign("cas", $cas);

            // 推送文章
            $content = db("contents")->where("id", $contentId)->find();
            $this->assign("page", $content);

            // 渲染页面
            return $this->fetch("contentPage");
        }

        return $this->redirect("/");
    }

    public function contentlist()
    {
        // 渲染
    	if(request()->isGet()){
    		// 获取请求类型
    		$listType = input("listType");
    		// 获取栏目
    		$cols = db("column")->where("id", $listType)->find();
            $this->assign("secTitle", $cols['columnname']);

    		// 空页面判断
    		if($listType == null || $cols == null){
    			abort(404,'页面不存在');
    		}

    		// 渲染标题
    		if($cols['pid'] == null){
                $title = $cols['columnname'];
	    		$this->assign("title", $title);
    		} else {
    			$pCols = db("column")->where("id", $cols['pid'])->find();
                $title = $pCols['columnname'];
	    		$this->assign("title", $title);
    		}

            // 推送栏目
            $leftColumns = db("column")->where("pid is null")->select();
            $this->assign("leftColumns", $leftColumns);

            // 推送侧边内容
            $cs = db("column")->where("pid is null")->count();

            for ($i=0; $i < count($leftColumns); $i++) { 
                $cas[$leftColumns[$i]['id']] = db("contents a")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $leftColumns[$i]['id'])
                    ->order("createtime desc")
                    ->limit(4)
                    ->select();
            }

            $this->assign("cas", $cas);

            // 推送关联内容
            $asoid = db("column")->where("columnname", $cols['columnname'])->find()['id'];
            // dump(db("column")->where("id", $asoid)->find()['pid']);die;
            if(db("column")->where("id", $asoid)->find()['pid'] == null){
                $acs = db("contents a")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $asoid)
                    ->order("createtime desc")
                    // ->select();
                    ->paginate(15);
            } else {
                $acs = db("contents a")
                    ->join("cnpse_column b", "a.cid = b.id and b.id = " . $asoid)
                    ->order("createtime desc")
                    // ->select();
                    ->paginate(15);

            }

            $this->assign("assocontent", $acs);

    		// 渲染页面
	        return $this->fetch("contentlist");
    	}

    	return $this->redirect("/");
    }
}