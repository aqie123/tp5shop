<?php
namespace app\index\controller;
use think\Controller;

/**
 * 商品详情页百度地图
 * Class Map
 * @package app\index\controller
 */
class Map extends Controller
{
    public function getMapImage($data)
    {
        return \Map::staticimage($data);
    }
}
