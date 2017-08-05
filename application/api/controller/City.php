<?php
namespace app\api\controller;
use think\Controller;
class City extends Controller
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("City");
    }

    /**
     * 商户入驻通过省找城市
     * @return mixed
     */
    public function getCitysByParentId() {
        $id = input('post.id');
        // echo $id;die;
        if(!$id) {
            $this->error('ID不合法');
        }
        //halt($id);
        // 通过id获取二级城市  将父类id传入
        $citys = $this->obj->getNormalCitysByParentId($id);
        if(!$citys) {
            return show(0,'error');
        }
        return show(1,'success', $citys);
    }





}
