<?php
namespace app\common\model;

use think\Model;

/**商户表(o2o_bis)
 * Class Bis
 * @package app\common\model
 */
class Bis extends BaseModel
{
    /**
     * 通过状态获取商家数据
     * @param $status
     * @return mixed  (返回是个对象)
     */
    public function getBisByStatus($status=0) {
        $order = [
            'id' => 'desc',
        ];

        $data = [
            'status' => $status,
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate(1);
        // echo "<pre>"; var_dump($result);exit;
        return $result;
    }

    /**
     *
     */
    public function getEmailById($id){
        $data = [
            'id' => $id,
        ];
        $result = $this->where($data)->find();
        return $result->email;
    }
}