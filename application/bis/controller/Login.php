<?php

namespace app\bis\controller;

use app\common\model\Bis;
use think\Controller;

class Login extends Controller
{
    public function index()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $res = model('BisAccount')->get(['username' => $data['username']]);
            if (!$res || $res->status != 1) {
                $this->error('用户不存在，或者用户未审核通过');
            }
            if ($res->password != md5($data['password'] . $res->code)) {
                $this->error('密码不正确');
            }
            model('BisAccount')->updateById(['last_login_time' => time()], $res->id);
            session('bisAccount', $res, 'bis');
            $this->success('登入成功', url('index/Index'));
        } else {
            $account = session('bisAccount', '', 'bis');
            if ($account && $account->id) {
                return $this->redirect(url('index/Index'));
            }
            return $this->fetch();
        }

    }

    public function logout()
    {
        //清楚session
        session(null, 'bis'); //清除bis作用域下bis
        $this->redirect(url('index/Index'));
    }


}