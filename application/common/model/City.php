<?php

namespace app\Common\model;

use think\Model;

class City extends Model
{
    /**
     * 通过parentid获取城市
     * @param int $parentId   要获取城市的父类id
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalCitysByParentId($parentId=0) {
        $data = [
            'status' => 1,
            'parent_id' => $parentId,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    /**
     * 获取二级城市数据 (admin/deal/index)
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalCitys() {
        $data = [
            'status' => 1,
            'parent_id' => ['gt', 0], // 不等于0
        ];

        $order = ['id'=>'desc'];

        return $this->where($data)
            ->order($order)
            ->select();

    }
}
