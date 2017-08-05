<?php
namespace app\common\model;

/**
 * 推荐位模型(o2o_featured)
 * Class Featured
 * @package app\common\model
 */
class Featured extends BaseModel
{
    /**
     * 推荐位列表
     * 根据类型来获取列表数据 (admin/featured/index)
     * @param $type
     * @return mixed
     */
    public function getFeaturedsByType($type) {
        $data = [
            'type' => $type,
            'status' => ['neq', -1],
        ];

        $order = ['id'=>'desc'];

        $result = $this->where($data)
            ->order($order)
            ->paginate(5);
        return $result;
    }

    public function getBannerPics($type,$limit=5){
        $data = [
            'type' => $type,
            'status' => 1,
        ];
        $order = [
            'create_time' => 'desc',
        ];
        $result = $this->where($data)
            ->order($order);
        if($limit) {
            $result = $result->limit($limit);
        }

        // var_dump($result->select());die;
        return $result->select();
    }
}