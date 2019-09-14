<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class category extends Controller
{
    private $obj;
   public function _initialize()
   {
       $this->obj = model('Category');
   }

    public function getCategoryByParentId()
    {
        $id = input('post.id',0,'intval');
        if (!$id) {
            $this->error('ID不合法');
        }
        $categorys = $this->obj->getNormalFirstCategorys($id);
        if (!$categorys) {
            return show(0, 'error');
        } else {
            return show(1, 'success', $categorys);

        }
    }
}
