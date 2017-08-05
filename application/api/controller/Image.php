<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;
// thinkphp/ibrary/think/Request.php file(上传图片方法)
class Image extends Controller
{
    public function upload() {
        $file = Request::instance()->file('file');
        // 给定一个目录
        $info = $file->move('upload');
        // print_r($info);die;
        if($info && $info->getPathname()) {
            return show(1, 'success','/'.$info->getPathname());
        }
        return show(0,'upload error');
    }
}