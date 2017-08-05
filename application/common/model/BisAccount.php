<?php
namespace app\common\model;

use think\Model;

/**用户账户表(o2o_bis_account)
 * Class BisAccount
 * @package app\common\model
 */
class BisAccount extends BaseModel
{
    /**
     * 根据id更新数据
     * @param $data
     * @param $id
     * @return false|int
     */
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
}