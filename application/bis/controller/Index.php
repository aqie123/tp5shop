<?php
namespace app\bis\controller;
use think\Session;
class Index extends Base
{
    public function index()
    {
        // 在模板显示当前管理员
        $userinfo = $this->getLoginUser();
        $username = $userinfo['username'];
        $this->assign('username',$username);
        return $this->fetch();
    }
    /**
     * 加载商户后台首页欢迎页面
     * @return mixed
     */
    public function welcome(){

        return $this->fetch();
    }
}
