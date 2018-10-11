<?php
namespace app\manager\controller;

class Passport extends ManagerBase
{
    public function _initialize()
    {
        return;
    }

    // 后台登陆
    public function login()
    {
        $auth = file_get_contents("config/manager/key");
        $authac = explode("|", $auth)[0];
        $authpa = explode("|", $auth)[1];

        if(request()->isPost()){
            $data = input('post.');
            if($data['account'] == $authac && $data['password'] == $authpa){
                session("manager", "ok");
                $this->redirect("manager/index/index");
            } else {
                $this->redirect("passport/adminerror");
            }
        }
        return $this->fetch('');
    }

    // 退出登录
    public function logout()
    {
        session(null);
        $this->redirect('/admin');
    }

    public function adminerror()
    {
        return $this->fetch('');
    }

}
