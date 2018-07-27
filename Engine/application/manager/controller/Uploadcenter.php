<?php
namespace app\manager\controller;

use \think\Controller;

class Uploadcenter extends ManagerBase
{
    public function index()
    {
    	return $this->fetch("index");
    }

    public function banner_add()
    {
        // 轮播图上传
        if(request()->isPost()){
            // 文件上传处理
            $files = request()->file();

            foreach ($files as $file) {
                // 文件取名规则 —— function myUploadRule 定义在 Common.php
                $mUR = 'myUploadRule';
                $info = $file->rule($mUR)->move($this->bannerPath);
            }

        }

    	return $this->fetch('banner_add');
    }

    public function showboard_add($offset = 0)
    {
        // 获取修改哪一个展示板

        $i = $offset - 1;

        if(request()->isGet()){
            $this->assign("pos_offset", input("get.offset"));
        }

        // 读取配置文件
        if(file_exists($this->showboardConfigPath)){
            $this->showboardConfig = json_decode(file_get_contents($this->showboardConfigPath), true);
        } else {
            $this->showboardConfig = json_decode(json_encode($this->showboardConfig), true);
        }

        $this->assign("showboard", $this->showboardConfig[$i]);

        // 展示板图上传
        if(request()->isPost()){
            // 文件上传处理
            $files = request()->file();

            foreach ($files as $file) {
                $info = $file->move($this->showboardPath, $offset);
            }


            $this->showboardConfig[$i]['image'] = $this->showboardPath . DS . $info->getSavename();
            $this->assign("pos_offset", input("get.offset"));

            if(!file_put_contents($this->showboardConfigPath, json_encode($this->showboardConfig))){
                return false;
            }

        }

        return $this->fetch('showboard_add');
    }

    public function uploadcenter_handle()
    {
        // 各种提交请求处理
        // 删除Banner
        if(input("post.types") == "delBanner"){
            $datas = input();
            unset($datas['types']);
            $files = explode(",", $datas['files']);

            foreach ($files as $value) {
                if(strlen($value) > 0){
                    if(!unlink($this->bannerPath . DS . $value)){
                        exception('删除Banner错误');
                        // throw new Exception("删除Banner错误");
                    }
                }
            }

            return true;
        }

        // 设置轮播图
        if(input("post.types") == "addBanner"){
            $datas = input();
            unset($datas['types']);

            if(!file_exists($this->bannerConfigPath)){
                // 配置文件不存在
                $this->bannerConfig[$datas['offset']] = $this->bannerPath . DS . $datas['filename'];
                if(file_put_contents($this->bannerConfigPath, json_encode($this->bannerConfig))){
                    return true;
                } else {
                    return false;
                }

            } else {
                // 配置文件存在
                $this->bannerConfig = json_decode(file_get_contents($this->bannerConfigPath));
                $this->bannerConfig[$datas['offset']] = $this->bannerPath . DS . $datas['filename'];

                if(file_put_contents($this->bannerConfigPath, json_encode($this->bannerConfig))){
                    return true;
                } else {
                    return false;
                }

            }

        }
    }

}
