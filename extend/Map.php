<?php
/**
 * 百度地图业务封装
 */
class Map{
    /**
     * 根据地址获取经纬度
     * @param $address
     * @return array
     */
    public static function  getLngLat($address){
        if(!$address){
            return '';
        }
        // http://api.map.baidu.com/geocoder/v2/?address=北京市海淀区上地十街10号&output=json&ak=E4805d16520de693a3fe707cdc962045&callback=showLocation
        $data = [
            'address' => $address,
            'ak' => Config('map.ak'),
            'output' => 'json',
        ];
        // 转换成上面形式
        $url = config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);
         // file_get_contents($url);
        // curl
        $result = doCurl($url);
        // print_r($result);
        if($result){
            return json_decode($result,true);
        }else{
            return [];
        }
    }


    /**http://api.map.baidu.com/staticimage/v2
     * 根据经纬度获取百度地图
     * @param $center
     * @return mixed
     */
    public static function staticimage($center){
        if(!$center){
            return '';
        }
        $data = [
            'ak' => Config('map.ak'),
            'width' => config('map.width'),
            'height' => config('map.height'),
            'center' => $center,
            'markers' => $center
        ];
        $url = config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);
        $result = doCurl($url);
        return $result;
    }
}


