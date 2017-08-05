<?php
namespace app\index\controller;
use think\Controller;

class Base extends Controller
{
    public $city = '';
    public $account = '';

    public function _initialize() {
        // 拿到二级城市数据
        $citys = model('City')->getNormalCitys();
        //用户数据

        $this->getCity($citys);
        // 获取首页分类的数据
        $cats = $this->getRecommendCats();
        // print_r($cats);die;
        $this->assign('citys', $citys);
        $this->assign('city', $this->city);
        $this->assign('cats', $cats);
        // 加载不同css
        $this->assign('controller', strtolower(request()->controller()));
        $this->assign('user', $this->getLoginUser());
        $this->assign('title', 'o2o啊切团购网');
    }

    /**
     * 获取前台首页城市数据
     * @param $citys
     */
    public function getCity($citys) {
        foreach($citys as $city) {
            // city 默认是对象，转换成数组
            $city = $city->toArray();
            if($city['is_default'] == 1) {
                $defaultuname = $city['uname'];
                break; // 终止foreach
            }
        }

        $defaultuname = $defaultuname ? $defaultuname : 'nanchang';
        // session中存在city，用户没有点击切换城市
        if(session('cityuname', '', 'o2o') && !input('get.city')) {
            $cityuname = session('cityuname', '', 'o2o');
        }else {
            $cityuname = input('get.city', $defaultuname, 'trim');
            session('cityuname', $cityuname, 'o2o');
        }

        $this->city = model('City')->where(['uname'=>$cityuname])->find();
    }

    /**
     * 获取前台首页用户信息
     * @return mixed|string
     */
    public function getLoginUser() {
        if(!$this->account) {
            $this->account = session('o2o_user', '', 'o2o');
        }
        return $this->account;
    }

    /**
     * 获取首页推荐当中中的商品分类数据
     */
    public function getRecommendCats() {
        $parentIds = $sedcatArr = $recomCats = [];
        // 获取一级分类
        $cats = model('Category')->getNormalRecommendCategoryByParentId(0,5);
        // print_r($cats);  拿到的是对象
        foreach($cats as $cat) {
            // 一级分类主键id
            $parentIds[] = $cat->id;
        }
        // 获取二级分类的数据
        $sedCats = model('Category')->getNormalCategoryIdParentId($parentIds);

        // 遍历二级分类
        foreach($sedCats as $sedcat) {
            // todo 这里是数组
            $sedcatArr[$sedcat->parent_id][] = [
                'id' => $sedcat->id,
                'name' => $sedcat->name,
            ];
        }

        // 遍历一级分类
        foreach($cats as $cat) {
            // recomCats 代表是一级 和 二级数据，  []第一个参数是 一级分类的name, 第二个参数 是 此一级分类下面的所有二级分类数据
            $recomCats[$cat->id] = [$cat->name, empty($sedcatArr[$cat->id]) ? [] : $sedcatArr[$cat->id]];
        }
        return $recomCats;
    }
}
