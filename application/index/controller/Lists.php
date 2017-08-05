<?php
namespace app\index\controller;
use think\Controller;
use think\Log;
class Lists extends Base
{
    /**
     * 前台商品列表页
     * @return mixed
     */
    public function index()
    {
        $firstCatIds = [];
        // 思路 首先需要一级栏目
        $categorys = model("Category")->getNormalCategoryByParentId();
        // 所有一级分类
        foreach($categorys as $category) {
            $firstCatIds[] = $category->id;
        }
        $id = input('id', 0, 'intval');
        $data = [];
        // id=0 一级分类 二级分类
        if(in_array($id, $firstCatIds)) { // 一级分类
            $categoryParentId = $id;
            $data['category_id'] = $id;
        }elseif($id) { // 二级分类
            // 获取二级分类的数据
            $category = model('Category')->get($id);
            if(!$category || $category->status !=1) {
                $this->error('数据不合法');
            }
            $categoryParentId = $category->parent_id;
            $data['sec_category_id'] = $id;
        }else{ // 0
            $categoryParentId = 0;
        }
        $sedcategorys = [];
        //获取父类下的所有 子分类
        if($categoryParentId) {
            $sedcategorys = model('Category')->getNormalCategoryByParentId($categoryParentId);
        }
        $orders = [];
        // 排序数据获取的逻辑
        $order_sales = input('order_sales','');
        $order_price = input('order_price','');
        $order_time = input('order_time','');
        if(!empty($order_sales)) {
            $orderflag = 'order_sales';
            $orders['order_sales'] = $order_sales;
        }elseif(!empty($order_price)) {
            $orderflag = 'order_price';
            $orders['order_price'] = $order_price;
        }elseif(!empty($order_time)) {
            $orderflag = 'order_time';
            $orders['order_time'] = $order_time;
        }else{
            $orderflag = '';
        }
        //Log::write('o2o-log-list-id'.$id, 'log');
         trace('o2o-log-list-id'.$id, 'log');
        $data['city_id'] = $this->city->id; // add
        // var_dump($data['city_id']);die;
        // var_dump($data['sec_category_id']);die;   // 8
        // var_dump($data['category_id']);die;   // 8
        // 根据上面条件来查询商品列表数据
        $deals = model('Deal')->getDealByConditions($data, $orders);
        return $this->fetch('', [
            'categorys' => $categorys,
            'sedcategorys' => $sedcategorys,
            'id' => $id,
            'categoryParentId' => $categoryParentId,
            'orderflag' => $orderflag,
            'deals' => $deals,
        ]);
    }
}
