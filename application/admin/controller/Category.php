<?php
namespace app\admin\controller;

use think\Controller;

class Category extends Base
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Category");
    }
    /**加载生活分类管理首页
     * @return mixed
     */
    public function index()
    {
        // input获取get传参
        $parentId = input('get.parent_id', 0, 'intval');
        // 分页后的分类
        $categorys = $this->obj->getFirstCategorys($parentId);
        // 总的分类
        $allcategorys = $this->obj->getNormalFirstCategory();
        $total = count($allcategorys);
        $this->assign('total', $total);
        return $this->fetch('',[
            'categorys' => $categorys
        ]);
    }
    /**
     * 加载分类添加页面
     * @return mixed
     */
    public function add(){
        $categorys = $this->obj->getNormalFirstCategory();
        // 数据传递到模板
        return $this->fetch('', [
            'categorys'=> $categorys,
        ]);
    }

    /**
     * 存储商家分类
     */
    public function save(){
        // print_r($_POST);
        // print_r(input('post.'));
       // print_r(request()->post());
        /**
         * 做下严格判定 必须是post提交
         */
        if(!request()->isPost()) {
            $this->error('请求失败');
        }
        $data = input('post.');
        // $data['status'] = 10;   // 模拟状态进行测试
        $validate = validate('Category');
        // 添加验证场景
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        // 如果传过来id,进行编辑
        if(!empty($data['id'])) {
            return $this->update($data);
        }
        // 将数据提交给model层
        $res = $this->obj->add($data);
        if($res){
            $this->success('新增分类成功');
        }else{
            $this->error('新增失败');
        }
    }

    /**
     * 对分类进行编辑
     */
    public function edit($id=0){
        // echo input('get.id');   //技巧传 $id   echo $id;
        if(intval($id) < 1) {
            $this->error('参数不合法');
        }
        $category = $this->obj->get($id);
        // print_r($category);die; 对象
        $categorys = $this->obj->getNormalFirstCategory();
        return $this->fetch('', [
            'categorys'=> $categorys,
            'category' => $category,
        ]);
    }

    /**
     * 更新分类
     */
    public function update($data){
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success('编辑分类成功');
        }else{
            $this->error('编辑分类失败');
        }
    }

    /**
     * 更新排序
     * @param $id
     * @param $listorder
     */
    public function listorder($id, $listorder) {
        // echo $id,$listorder;die;
        $res = $this->obj->save(['listorder'=>$listorder], ['id'=>$id]);
        if($res) {
            $this->result($_SERVER['HTTP_REFERER'], 1, 'success');
        }else {
            $this->result($_SERVER['HTTP_REFERER'], 0, '更新失败');
        }
    }

    /**
     * 修改状态
     */
    public function status() {
        $data = input('get.');
        // print_r($data);die;
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if($res) {
            $this->success('状态更新成功');
        }else {
            $this->error('状态更新失败');
        }

    }

}
