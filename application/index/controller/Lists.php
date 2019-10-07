<?php
/**
 * User: beibei
 * Date: 2019/10/3
 * Time: 11:13
 */

namespace app\index\controller;

use  think\Controller;

class Lists extends Base
{
    public function index()
    {
        $id = input('id', 1, 'intval');
        $category = model('Category')->get($id);
        $parent_id = $id;
        $category_id = 0;
        //$se_category_id = 0;
        if ($category->parent_id != 0) {
            $parent_id = $category->parent_id;
            $category_id = $id;
        }
        $data['category_id'] = $parent_id;
        if($category_id) {
            $data['se_category_id'] = $category_id;
        }
        $this->title = '商品列表';
        $this->assign('title', $this->title);
        $order_sales = input('order_sales', '');
        $order_price = input('order_price', '');
        $order_time = input('order_time', '');
        $order = [];
        if (!empty($order_sales)) {
            $overflag = 'order_sales';
            $order['buy_count'] = 'desc';
        } elseif (!empty($order_price)) {
            $overflag = 'order_price';
            $order['current_price'] = 'desc';
        } elseif (!empty($order_time)) {
            $overflag = 'order_time';
            $order['create_time'] = 'desc';
        } else {
            $overflag = '';

        }
        $se_categorys = model('Category')->getNormalFirstCategorys($parent_id);
        $categorys = model('Category')->getNormalFirstCategorys();
        $deals = model('Deal')->getDealsByConditions($data,$order);
        return $this->fetch('', [
            'categorys' => $categorys,
            'parent_id' => $parent_id,
            'category_id' => $category_id,
            'se_categorys' => $se_categorys,
            'overflag' => $overflag,
            'id' => $id,
            'deals' => $deals,



        ]);
    }
}

