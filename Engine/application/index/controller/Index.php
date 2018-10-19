<?php
namespace app\index\controller;

class Index extends RCKBase
{
    public function index()
    {
    	// 渲染首页
        $indexTitle = "首页";
        $this->assign("indexTitle", $indexTitle);

        $url_Manager = url("manager/index/index");

        // S开发中首页开放入口
        $frontcode = "<!-- S乱入代码 -->\n\t";
        $frontcode .= "<div style=\"text-align: center;font-size: 16px;\"><a href=\"{$url_Manager}\" target=\"_blank\">后台入口</a> |-<i>仅开发中可见</i></div>";
        $frontcode .= "\n\t<!-- E乱入代码 -->";
        if(APD){
	        $this->assign('port_Manager', $frontcode);
        } else {
        	$this->assign('port_Manager', '');
        }
        // E开发中首页开放入口


        // 轮播图推送
        if(file_exists($this->bannerConfigPath)){$this->bannerConfig = json_decode(file_get_contents($this->bannerConfigPath));}
        foreach ($this->bannerConfig as $key => $value) {
            $i = $key + 1;
            if(!file_exists($value)){$this->bannerConfig[$key] = "__images__/banner0{$i}.jpg";}
        }
        $this->assign('banners', $this->bannerConfig);

        // 通知栏推送
        if(file_exists($this->noticeConfigPath)){
            $this->noticeConfig = json_decode(file_get_contents($this->noticeConfigPath));
        } else {
            $this->noticeConfig = json_decode(json_encode(['title'=>'通知栏', 'content' => '未设置']));
        }
        $this->assign('notice', $this->noticeConfig);

        // 展示板推送
        if(file_exists($this->showboardConfigPath)){
            $this->showboardConfig = json_decode(file_get_contents($this->showboardConfigPath), true);
        } else {
            $this->showboardConfig = json_decode(json_encode($this->showboardConfig), true);
        }

        $this->assign('showboard', $this->showboardConfig);

    	return $this->fetch("index");
    }

    // 首页发出注册事件
    public function register()
    {
        if(input("post.action") == "register"){
            $datas = input();
            unset($datas['action']);
            // file_put_contents("user.txt", implode("----", $datas) . PHP_EOL, FILE_APPEND);

            $data = [
                'username'      =>      $datas['username'],
                'password'      =>      md5($datas['password']),
                'email'         =>      $datas['email'],
                'mobile'        =>      $datas['mobile'],
                'regtime'       =>      date("Y-m-d h:i:s", time())
            ];

            if(db('users')->where("username", $datas['username'])->find()){
                return "username repeat";
            }

            $user = db("users")->insert($data);

            if($user){
                return "true";
            } else {
                return "false";
            }            

        }

        if(input("post.action") == "askuserrepeat"){
            $datas = input();
            unset($datas['action']);

            if(db('users')->where("username", $datas['username'])->find()){
                return "true";
            }
        }

        return "false";
    }

    // 首页发出登录事件
    public function login()
    {
        if(request()->isPost()){
            $data = input('post.');
            // if(!captcha_check($data['captcha'])){
            //     $this->error("验证码错误");
            //  //验证失败
            // };
            $user = db('users')->where('username', $data['username'])->find();
            if($user){
                if($user['password'] == md5($data['password'])){
                    // $loginsum = ['loginsum' =>  $user['loginsum'] + 1, "loginlast" => date('Y-m-d H:i:s')];
                    // $loginsum = db('user', $this->dbUser)->where("id", $user['id'])->update($loginsum);
                    session("username", $data['username']);
                    session("uid", $user['id']);
                    // Login time
                    ini_set('session.gc_maxlifetime', "3600"); // 秒
                    ini_set("session.cookie_lifetime","3600"); // 秒
                    // session("loginsum", $loginsum + 1);
                    return "true";
                } else {
                    return "false";
                }

            } else {
                return "false";
            }
            // $this->success('登陆成功', 'index/index');
        }
        return;
    }

    // 退出登录
    public function logout()
    {
        session(null);
        session_destroy();
        // return $this->redirect("index");
        return "
            <script>
                window.location.assign('/');
            </script>
        ";
    }

    public function contentlist()
    {
        // 渲染
        return $this->fetch("contentlist");
    }
}

