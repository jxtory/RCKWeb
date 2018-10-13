<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Validate;
use think\Loader;

class Allbase extends Controller
{
    // 各种路径定义
    protected $thumbnailPath = "uploadcenter/thumbnail";

    // 上传中心目录
    protected $uploadCenter = "uploadcenter";

    // 轮播图目录和配置文件路径、文件
    protected $bannerPath = "uploadcenter/banner";
    protected $bannerConfigPath = "config/banner/bannerConfig.json";
    protected $bannerConfig = ['__images__/banner01.jpg', '__images__/banner02.jpg', '__images__/banner03.jpg', '__images__/banner04.jpg'];

    // 通知栏配置文件路径、文件
    protected $noticeConfigPath = 'config/notice/noticeConfig.json';
    protected $noticeConfig = [];

    // 展示板配置文件路径、文件
    protected $showboardPath = "uploadcenter/showboard";
    protected $showboardConfigPath = 'config/showboard/showboardConfig.json';
    protected $showboardConfig = [
                    [
                        'caption'   =>  '演示1',
                        'value'     =>  '666',
                        'image'     =>  'framework\assets\frontend\css\img\Num1.jpg'
                    ],
                    [
                        'caption'   =>  '演示2',
                        'value'     =>  '888',
                        'image'     =>  'framework\assets\frontend\css\img\Num2.jpg'
                    ],
                    [
                        'caption'   =>  '演示3',
                        'value'     =>  '6666',
                        'image'     =>  'framework\assets\frontend\css\img\Num3.jpg'
                    ],
                    [
                        'caption'   =>  '演示4',
                        'value'     =>  '88888',
                        'image'     =>  'framework\assets\frontend\css\img\Num4.jpg'
                    ],

                ];

    protected $managerConfigPathKey = 'config/manager/key';

    public function _initialize()
    {
        // 通用初始化
        
        // 创建上传中心目录
        mkdirs("uploadcenter");
        mkdirs("uploadcenter/thumbnail");       // 缩略图
        mkdirs("uploadcenter/banner");          // 轮播图
        mkdirs("uploadcenter/showboard");       // 展示板

        // 创建配置目录
        mkdirs("config");                       // 配置目录
        mkdirs("config/banner");                //  轮播图
        mkdirs("config/notice");                //  通知栏
        mkdirs("config/showboard");             //  展示板
        mkdirs("config/manager");               //  创建后台配置

    }

}