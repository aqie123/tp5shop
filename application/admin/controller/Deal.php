<?php
namespace app\admin\controller;
use think\Controller;

/**
 * 主后台商品团购
 * Class Deal
 * @package app\admin\controller
 */
class Deal extends  Base
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Deal");
    }

    /**
     * 团购展示列表
     * @return mixed
     */
    public function index() {
        $data = input('get.');
        $sdata = [];
        // 传过来时间存在
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time']) > strtotime($data['start_time'])) {
            // 创建时间大于团购开始时间,小于团购结束时间
            $sdata['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        // 团购页面传过来产品分类ID 不为空
        if(!empty($data['category_id'])) {
            $sdata['category_id'] = $data['category_id'];
        }
        // 团购页面传过来城市ID 不为空
        if(!empty($data['city_id'])) {
            $sdata['city_id'] = $data['city_id'];
        }
        // 团购页面传过来商品名称
        if(!empty($data['name'])) {
            $sdata['name'] = ['like', '%'.$data['name'].'%'];
        }
        $cityArrs = $categoryArrs = [];
        // 获取分类数据
        $categorys = model("Category")->getNormalCategoryByParentId();
        // 根据id获取分类的中文名
        foreach($categorys as $category) {
            $categoryArrs[$category->id] = $category->name;
        }

        // 获取二级城市数据
        $citys = model("City")->getNormalCitys();
        foreach($citys as $city) {
            $cityArrs[$city->id] = $city->name;
        }

        // 获取添加搜索条件后的数据
        $deals = $this->obj->getNormalDeals($sdata);
        return $this->fetch('', [
            'categorys' => $categorys,
            'citys' => $citys,
            'deals' => $deals,
            // 传递变量 保证搜索完搜索条件是选中的
            'category_id' => empty($data['category_id']) ? '' : $data['category_id'],
            'city_id' => empty($data['city_id']) ? '' : $data['city_id'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'name' => empty($data['name']) ? '' : $data['name'],
            'categoryArrs' => $categoryArrs,
            'cityArrs' => $cityArrs,
        ]);
    }

    /**
     * 图购申请页面
     * @return mixed
     */
    public function apply() {
        $data = input('get.');
        $sdata = [];
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time']) > strtotime($data['start_time'])) {
            $sdata['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if(!empty($data['category_id'])) {
            $sdata['category_id'] = $data['category_id'];
        }
        if(!empty($data['city_id'])) {
            $sdata['city_id'] = $data['city_id'];
        }
        if(!empty($data['name'])) {
            $sdata['name'] = ['like', '%'.$data['name'].'%'];
        }
        $cityArrs = $categoryArrs = [];
        $categorys = model("Category")->getNormalCategoryByParentId();
        foreach($categorys as $category) {
            $categoryArrs[$category->id] = $category->name;
        }

        $citys = model("City")->getNormalCitys();
        foreach($citys as $city) {
            $cityArrs[$city->id] = $city->name;
        }

        $deals = $this->obj->getApplyDeals($sdata);
        // echo "<pre>";var_dump($deals);die;
        return $this->fetch('', [
            'categorys' => $categorys,
            'citys' => $citys,
            'deals' => $deals,
            'category_id' => empty($data['category_id']) ? '' : $data['category_id'],
            'city_id' => empty($data['city_id']) ? '' : $data['city_id'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'name' => empty($data['name']) ? '' : $data['name'],
            'categoryArrs' => $categoryArrs,
            'cityArrs' => $cityArrs,
        ]);
    }

    public function detail(){
        return $this->fetch();
    }

}
