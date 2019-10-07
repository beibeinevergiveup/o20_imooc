<?php

namespace app\index\controller;

use  think\Controller;
use think\Exception;

class User extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function register()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (!captcha_check($data['verifycode'])) {
                //校验失败
                $this->error('验证码不正确');
            }
            // 严格校验
            $validate = Validate('User');
            if (!$validate->scene('register')->check($data)) {
                $this->error($validate->getError());
            }
            //自动生成，密码的加盐字符串
            $data['code'] = mt_rand(100, 10000);
            $data['password'] = md5($data['password'] . $data['code']);
            //如保存有异常将其捕获
            try {
                $res = model('User')->add($data);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if ($res) {
                $this->success('注册成功', 'user/login');
            } else {
                $this->error('注册失败');
            }
        } else {
            return $this->fetch();
        }
    }

    public function login()
    {
        return $this->fetch();
    }

    public function logincheck()
    {
        if (!request()->isPost()) {
            $this->error('error');
        }
        $data = input('post.');
        if (!is_array($data)) {
            $this->error('error');
        }
        $vali = validate('User');
        if (!$vali->scene('login')->check($data)) {
            $this->error($vali->getError());
        }
        try {
            $user = model('User')->getUserByUsername($data);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        if (!$user) {
            $this->error('登入失败');
        }
        if (md5($data['password'] . $user['code']) != $user->password) {
            $this->error('密码错误');
        }
        session('o2o_user', $user, 'o2o');
        $this->success('登入成功',url('index/index'));


    }

    public function loginout(){
        session('o2o_user', null, 'o2o');
        $this->redirect(url('user/login'));
    }



}