<?php
namespace app\index\controller;

class Pay extends Base{

    /**
     *
     */
    public function index(){
        // 调取微信支付二维码
       //  return '订单处理成功';
        return $this->fetch();
    }
}