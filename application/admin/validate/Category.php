<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate{
    protected $rule = [
        ['name','require|max:10','分类名不能为空|分类名不能超过十个字符'],
        ['parent_id','number'],
        ['id','number'],
        ['status','number|in:-1,0,1','状态必须是数字|状态范围不合法'],
        ['listorder','number','排序必须是数字'],
    ];
    /**
     * 场景设置
     */
    protected $scene = [
        'add' => ['name','parent_id','id'],  // 添加场景
        'listorder' => ['id','listorder'],
        'status' => ['id', 'status'],
    ];
}