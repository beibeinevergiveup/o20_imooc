<?php
/**
 * Created by PhpStorm.
 * User: beibei
 * Date: 2019/9/26
 * Time: 21:20
 */

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require|max:15',
        'password' => 'require|max:15',
        'repassword' => 'require|confirm:password'
    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'username.max' => '用户名长度不能大于15',
        'password.require' => '密码不能为空',
        'password.max' => '密码长度不能大于15',
        'repassword.require' => '请输入确认密码',
        'repassword.confirm' => '两次输入密码不一致'
    ];

    protected $scene = [
        'register' => [
            'username', 'password', 'repassword',

        ],

        'login' => [
            'username', 'password',

        ]
    ];

}