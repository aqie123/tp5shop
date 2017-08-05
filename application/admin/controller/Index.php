<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    /**加载后台首页
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }
    /**
     * 加载后台首页欢迎页面
     * @return mixed
     */
    public function welcome(){
        return $this->fetch();
        //return '欢迎你';
    }

    /**
     *展示地图
     */
    public function map(){
        return \Map::staticimage('杭州西湖');
    }

    /**
     * 用来测试的方法
     * @return mixed
     */
    public function aqie(){
        \phpmailer\Email::send('1469036546@qq.com','啊切你好','222');
        return '发送邮件成功';
        return $this->fetch();
    }

}
