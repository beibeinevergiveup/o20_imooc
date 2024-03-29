<?php
namespace app\common\validate;
use think\Validate;

class Bis extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'email' => 'email',
        'logo' => 'require',
        'city_id' => 'require',
        'bank_info' => 'require',
        'bank_name' => 'require',
        'faren' => 'require',
        'faren_tel' => 'require'
    ];

    protected $scene = [
        'add' => [
            'name',
            'email',
            'logo',
            'city_id',
            'bank_info',
            'bank_name',
            'bank_user',
            'faren',
            'faren_tel',
        ],// 商户入驻申请

        'addLocation' => [
            'name',
            'city_id',
        ]// 商户中心的新增门店
    ];
}