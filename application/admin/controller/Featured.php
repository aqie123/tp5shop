<?php
namespace app\admin\controller;
class Featured extends  Base
{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Featured");
    }

    /**
     * 推荐位列表
     * @return mixed
     */
    public function index() {
        // 获取推荐位类别
        $types = config('featured.featured_type');
        // 没有提交type 默认值为0
        $type = input('get.type', 0 ,'intval');
        // 获取列表数据
        $results = $this->obj->getFeaturedsByType($type);

        return $this->fetch('', [
            'types' => $types,
            'results' => $results,

        ]);
    }

    /**
     * 添加推荐位
     * @return mixed
     */
    public function add() {
        if(request()->isPost()) {
            // 入库的逻辑
            $data = input('post.','','Htmlentities');
            // 数据需要做严格校验 validate  todo

            $id = model('Featured')->add($data);
            if($id) {
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else {
            // 获取推荐位类别
            $types = config('featured.featured_type');
            return $this->fetch('', [
                'types' => $types,
            ]);
        }
    }
    public function edit(){
        return $this->fetch();
    }


}
