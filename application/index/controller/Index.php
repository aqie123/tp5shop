<?php
namespace app\index\controller;
use think\Controller;

class Index extends Base
{
    public function index()
    {
        // 获取首页大图 相关数据
        $bannerPics = model('Featured')->getBannerPics(0);
        // 获取广告位相关的数据
        $adPics = model('Featured')->getBannerPics(1,1);
        // 商品分类
        // 1.数据-手机 推荐的数据 (商品分类：3，城市id:6)
        $clothes = model('Deal')->getNormalDealByCategoryCityId(3, $this->city->id);
         // var_dump($this->city->id);
        // var_dump($datas);die;
        // 获取4个子分类
        $clothcats = model('Category')->getNormalRecommendCategoryByParentId(3, 4);
        // 2.男鞋 （商品分类7，城市分类2）
        $shoes = model('Deal')->getNormalDealByCategoryCityId(7, $this->city->id);
        $shoecats = model('Category')->getNormalRecommendCategoryByParentId(7, 4);
        // 3.女装  (商品分类：4城市：5)
        $dress = model('Deal')->getNormalDealByCategoryCityId(4, $this->city->id);
        $dresscats = model('Category')->getNormalRecommendCategoryByParentId(4, 4);

        return $this->fetch('',[
            'bannerPics' => $bannerPics,
            'adPics' => $adPics,
            'clothcats' => $clothcats,
            'clothes' => $clothes,
            'shoes' => $shoes,
            'shoecats' => $shoecats,
            'dress' => $dress,
            'dresscats' => $dresscats,
            'controller' => 'index',
        ]);
    }
    public function test(){
        echo 'aqie';
    }
}
