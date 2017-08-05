<?php
namespace app\common\model;
use think\Model;
/**
 * 订单模型
 * Class Order
 * @package app\common\model
 */
class Order extends Model{
    protected $autoWriteTimestamp = true;

    /**
     * @param $data
     * @return mixed
     */
    public function add($data){
        $data['status'] = 1;
        $result =  $this->save($data);
        return $result;
    }
}