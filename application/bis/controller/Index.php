<?php
namespace app\bis\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {

        return $this->fetch();

    }

    public function welcome()
    {
        return "欢迎来到o2o商户管理首页！";
    }
}
