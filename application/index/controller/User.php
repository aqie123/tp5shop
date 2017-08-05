<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    /**
     * 前台用户登录模块
     * @return \think\Response
     */
    public function login()
    {
        // 获取session
        $user = session('o2o_user','', 'o2o');
        // 登陆后就跳转到首页
        if($user && $user->id) {
            $this->redirect(url('index/index'));
        }
        return $this->fetch();
    }

    /**
     * 前台用户注册模块
     * @return mixed
     */
    public function register()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['verifycode'])) {
                // 校验失败
                $this->error('验证码不正确');
            }
            // var_dump($data);exit;
            //严格校验 todo tp5 validate

            if($data['password'] != $data['repassword']) {
                $this->error('两次输入的密码不一样');
            }
            // 自动生成 密码的加盐字符串
            $data['code'] = mt_rand(100, 10000);
            $data['password'] = md5($data['password'].$data['code']);
            // $data = 12;// test  传递不是数组数据
            try {
                $res = model('User')->add($data);
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if($res) {
                // 本身就会抛异常
                $this->success('注册成功',url('user/login'));
            }else{
                $this->error('注册失败');
            }

        }else {
            return $this->fetch();
        }

    }

    /**
     * 前台用户验证登录
     */
    public function logincheck() {

        //判定
        if(!request()->isPost()) {
            $this->error('提交不合法');
        }
        $data = input('post.');
        //todo 严格检验 tp5 validate
        try {
            $user = model('User')->getUserByUsername($data['username']);
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }

        if(!$user || $user->status != 1) {
            $this->error('该用户不存在');
        }
        // 判定密码是否合理
        if(md5($data['password'].$user->code) != $user->password) {
            $this->error('密码不正确');
        }

        // 登录成功
        model('User')->updateById(['last_login_time'=>time()], $user->id);

        //把用户信息记录到session
        session('o2o_user', $user, 'o2o');

        $this->success('登录成功', url('index/index'));

    }

    /**
     * 前台用户退出
     */
    public function logout() {
        session(null, 'o2o');
        $this->redirect(url('user/login'));
    }


}
