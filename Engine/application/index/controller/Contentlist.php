<?php
namespace app\index\controller;

class Contentlist extends RCKBase
{


    public function contentlist()
    {
        // 渲染
        return $this->fetch("contentlist");
    }
}

