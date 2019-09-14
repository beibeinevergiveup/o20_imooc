<?php

namespace app\admin\controller;

use phpmailer\Email;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
       // \phpmailer\Email::send('tttbd@qq.com','thinkphp 5.02  phpmailer test','hello beibei');
        return "欢迎来到o2o主后台首页！";
    }

    public function test()
    {
        return \Map::staticimage("北京昌平沙河地铁");
    }
}
