<?php
namespace app\common\model;


/**商户门店信息(o2o_bis_location)
 * Class BisLocation
 * @package app\common\model
 */
class BisLocation extends BaseModel
{

    /**
     * 获取门店数据 (bis/del/add )
     * @param $bisId
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalLocationByBisId($bisId) {
        $data = [
            'bis_id' => $bisId,
            'status' => 1,
        ];

        $result = $this->where($data)
            ->order('id', 'desc')
            ->select();
        return $result;
    }

    /**
     * 获取分店信息 index/detail/index
     * @param $ids
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalLocationsInId($ids) {
        $data = [
            'id' => ['in', $ids],
            'status' => 1,
        ];
        return $this->where($data)
            ->select();
    }

    /**
     * 获取门店信息
     * @param int $status
     * @return \think\Paginator
     */
    public function getBisLocationByStatus($status=0) {
        $order = [
            'id' => 'desc',
        ];

        $data = [
            'status' => $status,
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate(5);
        // echo "<pre>"; var_dump($result);exit;
        return $result;
    }

}