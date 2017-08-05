<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;
    /**
     * 添加生活分类到数据库
     * @param $data
     * @return bool
     */
    public function add($data){
        $data['status'] = 1;
        //$data['create_time'] = time();
        $result =  $this->save($data);
        return $result;
    }

    /**
     * 获取一级分类 在添加页面
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalFirstCategory() {
        $data = [
            'status' => 1,
            'parent_id' => 0,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    /**
     * 获取一级分类 在分类列表页(用于分页)
     * @param int $parentId
     * @return \think\Paginator
     */
    public function getFirstCategorys($parentId = 0) {
        $data = [
            'parent_id' => $parentId,
            'status' => ['neq',-1],
        ];

        $order =[
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        // 获取分页后的分类数据
        $result = $this->where($data)
            ->order($order)
            //->select()
            ->paginate(10);
        // echo $this->getLastSql();

        return $result;
    }

    /**
     * 获取分类数据  (admin/deal/index)
     * @param int $parentId
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalCategoryByParentId($parentId=0) {
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
     * 前台首页获取推荐的分类 index/base/getRecommendCats
     * @param int $id
     * @param int $limit
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalRecommendCategoryByParentId($id=0, $limit=5) {
        $data = [
            'parent_id' => $id,
            'status' => 1,
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order);
        if($limit) {
            $result = $result->limit($limit);
        }

        return $result->select();

    }

    /**
     * index/lists/index
     * 获取正常栏目分类
     * @param $ids
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getNormalCategoryIdParentId($ids) {
        $data = [
            'parent_id' => ['in', implode(',', $ids)],
            'status' => 1,
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->order($order)
            ->select();

        return $result;
    }

}