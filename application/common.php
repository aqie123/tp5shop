<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 获取状态(生活分类列表)
 * @param $status
 * @return string
 */
function status($status) {
    if($status == 1) {
        $str = "<span class='label label-success radius'>正常</span>";
    }elseif($status ==0) {
        $str = "<span class='label label-danger radius'>待审</span>";
    }else {
        $str = "<span class='label label-danger radius'>删除</span>";
    }
    return $str;
}

/**
 * 通用的分页样式
 * @param $obj
 * @return mixed
 */
function pagination($obj) {
    if(!$obj) {
        return '';
    }
    // 优化的方案 获取分页
    $params = request()->param();
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->appends($params)->render().'</div>';
}

/**
 * @param $url
 * @param int $type 0 get 1 post
 * @param array $data
 * @return mixed
 */
function doCurl($url, $type=0, $data=[]) {
    $ch = curl_init(); // 初始化
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER,0);

    if($type == 1) {
        // post
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //执行并获取内容
    $output = curl_exec($ch);
    // 释放curl句柄
    curl_close($ch);
    return $output;
}

/**
 * 商户入驻申请的文案
 * @param $status
 * @return string
 */
function bisRegister($status) {
    if($status == 1) {
        $str = "入驻申请成功";
    }elseif($status == 0) {
        $str = "待审核，审核后平台方会发送邮件通知，请关注邮件";

    }elseif($status == 2) {
        $str = "非常抱歉，您提交的材料不符合条件，请重新提交";
    }else {
        $str = "该申请已被删除";
    }
    return $str;
}

/**
 * 审查时获取二级城市
 */
function getSeCityName($path) {
    if(empty($path)) {
        return '';
    }
    // 如果存在逗号
    if(preg_match('/,/', $path)) {
        $cityPath = explode(',', $path);
        $cityId = $cityPath[1];
    }else {
        $cityId = $path;
    }

    $city = model('City')->get($cityId);
    return $city->name;
}

/**
 * 获取二级分类
 * @param $path
 * @return bool|string
 */
function getSeCategoryName($path) {

    if(empty($path)) {
        return '';
    }
    // 如果存在逗号
    $categoryPath = explode(',', $path);
    if($categoryPath[1]) {
        $categoryId = $categoryPath[1];
        $category = model('Category')->get($categoryId);
        return $category->name;
    }else {
        $categoryId = $path;
        return "";
    }


}

/**
 *  location_ids
 * @param $ids
 * @return int
 */
function countLocation($ids) {
    if(!$ids) {
        return 1;
    }

    if(preg_match('/,/', $ids)) {
        $arr = explode(',', $ids);
        return count($arr);
    }else{
        return $ids;
    }
}

/**
 * 设置订单号
 */
function setOrderSn(){
     list($t1,$t2) = explode(' ',microtime());
     $t3 = explode('.',$t1*10000);
     return $t2.$t3[0].(rand(10000,99999));
    //dump(microtime());exit;
}