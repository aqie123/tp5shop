<?php
namespace app\common\model;

/**
 * 表(o2o_del 团购商品表)
 * Class Deal
 * @package app\common\model
 */
class Deal extends BaseModel
{

    /**
     * 获取团购页面(admin/deal/index)商品信息
     * @param array $data
     * @return \think\Paginator
     */
    public function getNormalDeals($data = []) {
        $data['status'] = 1;
        $order = ['id'=>'desc'];

        $result = $this->where($data)
            ->order($order)
            ->paginate();

         // echo $this->getLastSql();
        return  $result;
    }

    public function getApplyDeals($data = []) {
        $data['status'] = 0;
        $order = ['id'=>'desc'];

        $result = $this->where($data)
            ->order($order)
            ->paginate();

        //echo $this->getLastSql();
        return  $result;
    }

    /**
     * 根据分类 以及 城市来获取 商品数据  (index/index/index)
     * @param $id 分类
     * @param $cityId 城市
     * @param int $limit 条数
     * @return mixed
     */
    public function getNormalDealByCategoryCityId($id, $cityId, $limit=10) {
        $data  = [
            'end_time' => ['gt', time()],
            'category_id' => $id,
            'sec_city_id' => $cityId,
            'status' => 1,
        ];

        $order = [
            'listorder'=>'desc',
            'id'=>'desc',
        ];

        $result = $this->where($data)
            ->order($order);
        if($limit) {
            $result = $result->limit($limit);
        }
        $res = $result->select();
        // echo $this->getLastSql();die;
        return $res;
    }

    /**
     * 根据不同排序条件获取团购商品
     * index/lists/index
     * @param array $data
     * @param $orders
     * @return \think\Paginator
     */
    public function getDealByConditions($data=[], $orders) {
        if(!empty($orders['order_sales'])) {
            $order['buy_count'] = 'desc';
        }
        if(!empty($orders['order_price'])) {
            $order['current_price'] = 'desc';
        }
        if(!empty($orders['order_time'])) {
            $order['create_time'] = 'desc';
        }
        $order['id'] = 'desc';


        $datas[] = ' end_time> '.time();   // linux  crontab status = 2
        $datas[] = ' status= 1';

        if(!empty($data['sec_category_id'])) {

            $datas[]="find_in_set(".$data['sec_category_id'].",sec_category_id)";
        }
        if(!empty($data['category_id'])) {

            $datas[]="category_id = ".$data['category_id'];
        }
        if(!empty($data['city_id'])) {

            $datas[]="sec_city_id = ".$data['city_id'];
        }

        $result = $this->where(implode(' AND ',$datas))
            ->order($order)
            ->paginate(1);
          //echo $this->getLastSql();die;
        return $result;
    }
}