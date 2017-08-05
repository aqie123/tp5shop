<?php
namespace app\index\controller;
/**
 * 订单详情页 (继承base，默认传递用户信息)
 * Class Order
 * @package app\index\controller
 */
class Order extends Base{

    public function index(){
        // dump(input('get.'));
        $user = $this->getLoginUser();
        if(!$user){
            $this->error("请登录再购买",'user/login');
        }
        $id = input('get.id',0,'intval');
        if(!$id){
            $this->error('参数不合法');
        }
        $dealCount = input('get.deal_count',0,'intval');
        $totalPrice = input('get.total_price',0,'intval');
        $deal = model('Deal')->find($id);
        if(!$deal || $deal->status != 1){
            $this->error('商品不存在');
        }
        // 来源不存在
        if(empty($_SERVER['HTTP_REFERER'])){
            $this->error('请求不合法');
        }
        $orderSn = setOrderSn();
        // echo $orderSn;die;
        // 组装入库数据
        $data = [
            'out_trade_no' => $orderSn,
            'user_id' => $user->id,
            'username' => $user->username,
            'deal_id' => $id,
            'deal_count' =>$dealCount,
            'total_price' => $totalPrice,
            'referer' => $_SERVER['HTTP_REFERER'],
        ];
        try{
            $orderId = model('Order')->add($data);
        }catch (\Exception $e){
            $this->error('订单处理失败');
        }
        // 跳转
        $this->redirect(url('pay/index',['id'=>$orderId])); // 订单id

    }
    /**
     * 订单确认页面
     * @return mixed
     */
    public function confirm(){
        if(!$this->getLoginUser()){
            $this->error("请登录再购买",'user/login');
        }
        $id = input('get.id',0,'intval');
        if(!$id){
            $this->error('参数不合法');
        }
        $count = input('get.count',1,'intval');

        $deal = model('Deal')->find($id);   // get()
        //echo model('Deal')->getLastSql();exit;
        if(!$deal || $deal->status != 1){
            $this->error('商品不存在');
        }
        // dump($deal);exit; // $deal 默认是对象
        $deal = $deal->toArray();
        return $this->fetch('',[
            'controller' => 'pay',
            'count' => $count,
            'deal' => $deal
        ]);
    }
}