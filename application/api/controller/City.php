<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/8/30
 * Time: 17:01
 */

namespace app\api\controller;

use think\Controller;

class City extends Controller
{
    private $obj;

    public function _initialize()
    {
        $this->obj = model("City");
    }

    public function getCitysByParentId()
    {
        $id = input('post.id');
        if (!intval($id)) {
            $this->error('ID不合法');
        }
        $citys = $this->obj->getNomarlCitysByParentId($id);
        if (!$citys) {
            return show(0, 'error');
        } else {
            return show(1, 'success', $citys);

        }
    }
}