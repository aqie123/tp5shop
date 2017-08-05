<?php
namespace app\common\model;

/**
 * 前台用户登录模型 (o2o_user)
 * Class User
 * @package app\common\model
 */
class User extends BaseModel
{
    /**
     * 将前台用户注册信息存入数据库
     * @param array $data
     * @return false|int
     */
    public function add($data = []) {
        // 如果提交的数据不是数组
        if(!is_array($data)) {
            exception('传递的数据不是数组');
        }

        $data['status'] = 1;
        return $this->data($data)->allowField(true)
            ->save();
    }

    /**
     * 根据用户名获取用户信息
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username) {
        if(!$username) {
            exception('用户名不合法');
        }

        $data = ['username' => $username];
        return $this->where($data)->find();
    }
}