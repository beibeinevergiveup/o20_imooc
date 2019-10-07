<?php

namespace app\common\validate;

use think\Validate;

/*
 * 团购商品数据校验
 */

class Deal extends Validate
{
    protected $rule = [
        'name' => 'require|max:30',
        'city_id' => 'require',
        'se_city_id' => 'require',
        'category_id' => 'require',
        'location_ids' => 'require',
        'image' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'total_count' => 'require',
        'origin_price' => 'require',
        'current_price' => 'require',
        'coupons_begin_time' => 'require',
        'coupons_end_time' => 'require',
        'description' => 'require',
        'notes' => 'require',
    ];
    protected $message = [
        'name.require' => '商品名不能为空',
        'name.max' => '商品名字段最大为30',

    ];
}