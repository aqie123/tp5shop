<?php
namespace app\bis\controller;
use think\Controller;
class Base extends  Controller
{
    public $account;

    /**
     * 商户表验证登录
     */
    public function _initialize() {
        $isLogin = $this->isLogin();
        if(!$isLogin) {
            return $this->redirect(url('login/index'));
        }
    }

    //判定是否登录
    public function isLogin() {
        // 获取sesssion
        $user = $this->getLoginUser();
        if($user && $user->id) {
            return true;
        }
        return false;

    }

    /**
     * 获取登录商户信息
     * @return mixed
     */
    public function getLoginUser() {
        if(!$this->account) {
            $this->account = session('bisAccount', '', 'bis');
        }
        return $this->account;
    }

}
