<?php
namespace app\admin\controller;
use think\Controller;

/**
 * Class Location
 * @package app\admin\controller
 */
class Location extends  Base
{
    public function _initialize()
    {
        $this->obj = model("BisLocation");
    }

    /**
     * 正常的商户列表
     * @return mixed
     */
    public function index()
    {
        $bislocation = $this->obj->getBisLocationByStatus(1);
        return $this->fetch('', [
            'bislocation' => $bislocation,
        ]);
    }

    /**
     * 门店申请
     */
    public function apply() {
        $bislocation = $this->obj->getBisLocationByStatus();
        return $this->fetch('', [
            'bislocation' => $bislocation,
        ]);
    }

    /**
     * 进行审核
     * @return mixed
     */
    public function detail(){
        return $this->fetch();
    }

    /**
     * 修改门店状态
     */
    public function status() {
        // 获取值
        $data = input('get.');
        // 利用tp5 validate 去做严格检验  id  status
        if(empty($data['id'])) {
            $this->error('id不合法');
        }
        if(!is_numeric($data['status'])) {
            $this->error('status不合法');
        }

        // 获取控制器
        $model = request()->controller();
        //echo $model;exit;
        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if($res) {
            $this->success('更新成功');
        }else {
            $this->error('更新失败');
        }
    }
}