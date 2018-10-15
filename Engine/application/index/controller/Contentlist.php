<?php
namespace app\index\controller;

class Contentlist extends RCKBase
{
    public function contentPage()
    {
        // ��Ⱦ
        if(request()->isGet()){
            // ��ȡ��������
            $listType = input("listType");
            $contentId = input("cid");
            // ��ȡ��Ŀ
            $cols = db("column")->where("id", $listType)->find();
            $this->assign("secTitle", $cols['columnname']);

            // ��ҳ���ж�
            if($listType == null || $cols == null){
                abort(404,'ҳ�治����');
            }

            // ��Ⱦ����
            if($cols['pid'] == null){
                $title = $cols['columnname'];
                $this->assign("title", $title);
            } else {
                $pCols = db("column")->where("id", $cols['pid'])->find();
                $title = $pCols['columnname'];
                $this->assign("title", $title);
            }

            // ������Ŀ
            $leftColumns = db("column")->where("pid is null")->select();
            $this->assign("leftColumns", $leftColumns);

            // ���Ͳ������
            $cs = db("column")->where("pid is null")->count();

            for ($i=0; $i < count($leftColumns); $i++) { 
                $cas[$leftColumns[$i]['id']] = db("contents a")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $leftColumns[$i]['id'])
                    ->order("createtime desc")
                    ->limit(4)
                    ->select();
            }

            $this->assign("cas", $cas);

            // ��������
            $content = db("contents")->where("id", $contentId)->find();
            $this->assign("page", $content);

            // ��Ⱦҳ��
            return $this->fetch("contentPage");
        }

        return $this->redirect("/");
    }

    public function contentlist()
    {
        // ��Ⱦ
    	if(request()->isGet()){
    		// ��ȡ��������
    		$listType = input("listType");
    		// ��ȡ��Ŀ
    		$cols = db("column")->where("id", $listType)->find();
            $this->assign("secTitle", $cols['columnname']);

    		// ��ҳ���ж�
    		if($listType == null || $cols == null){
    			abort(404,'ҳ�治����');
    		}

    		// ��Ⱦ����
    		if($cols['pid'] == null){
                $title = $cols['columnname'];
	    		$this->assign("title", $title);
    		} else {
    			$pCols = db("column")->where("id", $cols['pid'])->find();
                $title = $pCols['columnname'];
	    		$this->assign("title", $title);
    		}

            // ������Ŀ
            $leftColumns = db("column")->where("pid is null")->select();
            $this->assign("leftColumns", $leftColumns);

            // ���Ͳ������
            $cs = db("column")->where("pid is null")->count();

            for ($i=0; $i < count($leftColumns); $i++) { 
                $cas[$leftColumns[$i]['id']] = db("contents a")
                    ->join("cnpse_column b", "a.cid = b.id and b.pid = " . $leftColumns[$i]['id'])
                    ->order("createtime desc")
                    ->limit(4)
                    ->select();
            }

            $this->assign("cas", $cas);

            // ���͹�������
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

    		// ��Ⱦҳ��
	        return $this->fetch("contentlist");
    	}

    	return $this->redirect("/");
    }
}