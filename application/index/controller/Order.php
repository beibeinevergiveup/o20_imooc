<?php
/**
 * User: beibei
 * Date: 2019/10/7
 * Time: 22:31
 */
namespace app\index\controller;
class Order extends Base
{
    public function index()
    {

    }

    public function confirm()
    {
        if (!$this->getLoginUser()) {
            $this->error('请登录', 'user/login');
        }
        $id = input('get.id', 0, 'intval');
        if (!$id) {
            $this->error('参数不合法');
        }
        $count = input('get.count', 1, 'intval');
        $deal = model('Deal')->find($id);
        if (!$deal || $deal->status!=1) {
            $this->error('商品不存在');
        }
        $deal = $deal->toArray();
        return $this->fetch('',[
            'count' => $count,
            'deal' => $deal,
            'controller' => 'pay',

        ]);
    }
}