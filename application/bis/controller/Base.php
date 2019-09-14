<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/12
 * Time: 18:12
 */
//用于判断是否登入 的公共模块
namespace app\bis\Controller;

use app\common\model\Bis;
use think\Controller;

class Base extends Controller
{
    public $account;

    public function _initialize()
    {
       $isLogin = $this->isLogin();
        if (!$isLogin) {
            return $this->redirect(url('login/Index'));
        }
    }

    public function isLogin()
    {
        $user = $this->getLoginUser();
        if ($user && $user->id) {
            return true;
        }
        return false;
    }

    public function getLoginUser()
    {
        if (!$this->account) {
            $this->account = session('bisAccount', '', 'bis');
        }
        return $this->account;
    }
}
