<?php
namespace app\admin\controller;
use think\Controller;
class Bis extends  Controller
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Bis");
    }
    /**
     * 正常的商户列表
     * @return mixed
     */
    public function index() {
        $bis = $this->obj->getBisByStatus(1);
        return $this->fetch('', [
            'bis' => $bis,
        ]);
    }
    /**
     * 入驻申请列表
     * @return mixed
     */
    public function apply() {
        $bis = $this->obj->getBisByStatus();
        return $this->fetch('', [
            'bis' => $bis,
        ]);
    }

    /**
     * 审核详情页
     * @return mixed|void
     */
    public function detail() {
        $id = input('get.id');
        if(empty($id)) {
            return $this->error('ID错误');
        }
        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        // 获取商户数据
        $bisData = model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id, 'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id, 'is_main'=>1]);
        return $this->fetch('',[
            'citys' => $citys,
            'categorys' => $categorys,
            'bisData' => $bisData,
            'locationData' => $locationData,
            'accountData' => $accountData,
        ]);
    }

    /**
     * 修改状态(待审，通过,不通过，删除)
     */
    public function status() {
        $data = input('get.');
        // todo 完成校验
        /*$validate = validate('Bis');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }*/

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        $location = model('BisLocation')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        $account = model('BisAccount')->save(['status'=>$data['status']], ['bis_id'=>$data['id'], 'is_main'=>1]);
        $data['email'] = $this->obj->getEmailById($data['id']);
        if($res && $location && $account) {
            // todo 发送邮件 (register.php申请入驻)
            if($data['status'] == 1){
                \phpmailer\Email::send($data['email'],"申请通过", "您本次申请通过");
            }elseif ($data['status'] == 2){
                \phpmailer\Email::send($data['email'],"申请未通过", "您本次申请未通过");
            }else{
                \phpmailer\Email::send($data['email'],"违规", "您本次申请被删除");
            }
            // status 1  status 2  status -1
            // \phpmailer\Email::send($data['email'],$title, $content);
            $this->success('状态更新成功');
        }else {
            $this->error('状态更新失败');
        }

    }

}
