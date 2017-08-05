<?php
namespace app\bis\controller;
class Deal extends  Base
{
    /**
     * @return mixed todo 商户中心的 deal列表页面
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 团购商品添加 o2o_deal(表)
     * @return mixed
     */
    public function  add() {

         // var_dump($_POST);die;
        // 通过session 获取商户id
        $bisId = $this->getLoginUser()->bis_id;
        if(request()->isPost()) {
            // 走插入逻辑
            $data = input('post.','','Htmlentities');
            // todo 严格校验提交的数据， tp5 validate

            //$data['sec_category_id'] = implode(',', $data['sec_category_id']);
            // var_dump($data['sec_category_id']);die;

            // 获取门店第一个位置
            $location = model('BisLocation')->get($data['location_ids'][0]);

            $deals = [
                'bis_id' => $bisId,
                'name' => $data['name'],
                'image' => $data['image'],
                'category_id' => $data['category_id'],
                'sec_category_id' => empty($data['sec_category_id']) ? '' : implode(',', $data['sec_category_id']),
                'city_id' => $data['city_id'],
                'sec_city_id' => $data['sec_city_id'],
                'location_ids' => empty($data['location_ids']) ? '' : implode(',', $data['location_ids']),
                'start_time' => strtotime($data['start_time']),
                'end_time' => strtotime($data['end_time']),
                'total_count' => $data['total_count'],
                'origin_price' => $data['origin_price'],
                'current_price' => $data['current_price'],
                'coupons_begin_time' => strtotime($data['coupons_begin_time']),
                'coupons_end_time' => strtotime($data['coupons_end_time']),
                'notes' => $data['notes'],
                'description' => $data['description'],
                'bis_account_id' => $this->getLoginUser()->id,
                'xpoint' => $location->xpoint,
                'ypoint' => $location->ypoint,

            ];

            $id = model('Deal')->add($deals);
            if($id) {
                $this->success('添加成功', url('deal/index'));
            }else {
                $this->error('添加失败');
            }

        }else {
            //获取一级城市的数据
            $citys = model('City')->getNormalCitysByParentId();
            //获取一级栏目的数据
            $categorys = model('Category')->getNormalCategoryByParentId();
            return $this->fetch('', [
                'citys' => $citys,
                'categorys' => $categorys,
                'bislocations' => model('BisLocation')->getNormalLocationByBisId($bisId),
            ]);
        }
    }
}
