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

            if($listType != "-1"){
                // 获取栏目
                $cols = db("column")->where("id", $listType)->find();
                $this->assign("secTitle", $cols['columnname']);

                // 渲染标题
                if($cols['pid'] == null){
                    $title = $cols['columnname'];
                    $this->assign("title", $title);
                } else {
                    $pCols = db("column")->where("id", $cols['pid'])->find();
                    $title = $pCols['columnname'];
                    $this->assign("title", $title);
                }
                
                // 推送文章
                $content = db("contents")->where("id", $contentId)->find();
                $this->assign("page", $content);
                $this->assign("contentTitle", $content['title']);
            } else {
                $this->assign("title", "机构介绍");
                $this->assign("secTitle", "机构介绍");
                $subpage = db("subpages")->where("title", $contentId)->find();
                $cols = "机构介绍";
                if(!is_null($subpage)){
                    $subpage['title'] = $this->subPageName[$contentId];
                    $subpage['createtime'] = date('y-m-d h:i:s',time());
                    $this->assign("page", $subpage);
                    $this->assign("contentTitle", $subpage['title']);
                } else {
                    $subpageNull = [
                        'title'     => $this->subPageName[$contentId],
                        'content'   =>  '<p>敬请期待</p>',
                        'createtime'    =>  date('y-m-d h:i:s',time())
                    ];
                    $this->assign("page", $subpageNull);
                    $this->assign("contentTitle", "中国专业人才库");
                }

            }

            // 空页面判断
            if($listType == null || $cols == null){
                abort(404,'页面不存在');
            }

            // 推送左侧栏目
            $leftColumns = db("column")->where("pid is null")->select();
            $this->assign("leftColumns", $leftColumns);

            // 推送侧边内容
            for ($i=0; $i < count($leftColumns); $i++) { 
                $cas[$leftColumns[$i]['id']] = db("contents a")
                    ->field("a.*,a.id as aid, b.columnname as bcolumnname")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $leftColumns[$i]['id'])
                    ->order("createtime desc")
                    ->limit(4)
                    ->select();
            }

            $this->assign("cas", $cas);


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

            // 机构介绍
            if($listType == "introduce"){
                // 推送栏目
                $leftColumns = db("column")->where("pid is null")->select();
                $this->assign("leftColumns", $leftColumns);

                // 推送侧边内容
                for ($i=0; $i < count($leftColumns); $i++) { 
                    $cas[$leftColumns[$i]['id']] = db("contents a")
                        ->field("a.*,a.id as aid, b.columnname as bcolumnname")
                        ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $leftColumns[$i]['id'])
                        ->order("createtime desc")
                        ->limit(4)
                        ->select();
                }

                $this->assign("cas", $cas);
                $acs = [
                    [
                        'title'         =>  '概况',
                        'createtime'    =>  date('y-m-d h:i:s',time()),
                        'cid'           =>  '-1',
                        'aid'           =>  'guide',
                        'bcolumnname'   =>  '机构介绍'
                    ],
                    [
                        'title'         =>  '专家委员',
                        'createtime'    =>  date('y-m-d h:i:s',time()),
                        'cid'           =>  '-1',
                        'aid'           =>  'expert',
                        'bcolumnname'   =>  '机构介绍'
                    ],
                    [
                        'title'         =>  '专业项目',
                        'createtime'    =>  date('y-m-d h:i:s',time()),
                        'cid'           =>  '-1',
                        'aid'           =>  'special',
                        'bcolumnname'   =>  '机构介绍'
                    ],
                ];
                $this->assign("assocontent", $acs);
                $this->assign("title", "机构介绍");
                $this->assign("secTitle", "机构介绍");
                return $this->fetch("contentlist");
            }

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
                    ->field("a.*,a.id as aid, b.columnname as bcolumnname")
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
                    ->field("a.*,a.id as aid, b.columnname as bcolumnname")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $asoid)
                    ->order("createtime desc")
                    // ->select();
                    ->paginate(15);
            } else {
                $acs = db("contents a")
                    ->field("a.*,a.id as aid, b.columnname as bcolumnname")
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