<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    public function upload()
    {
        $file = Request::instance()->file('file');
        $info = $file->move('upload');
        //print_r($info);
        if ($info&&$info->getPathname()) {
            return show(1, 'success', '/' .  str_replace('\\', '/', $info->getPathname()));
        }
        return show(0, 'upload error');
    }

}