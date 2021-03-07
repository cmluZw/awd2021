<?php

namespace app\common\Validate;
use think\Validate;

class RegisterValidate extends Validate
{
    protected $rule = [
//        'username'  => 'require|chsAlphaNum|length:6,30',
        'username'  => 'require|chsAlphaNum',
        'password'   => 'require|length:6,30',
//        'verifyCode'   => 'require|length:4',
        'email' => 'email',
    ];
    protected $message  =   [
        'username.require' => '用户名必须填写',
        'username.length'     => '用户名长度范围6-30个字符',
//        'username.chsAlphaNum'     => '用户名只能是汉字、字母和数字',
        'password.require'   => '密码必须填写',
        'password.length'   => '密码必须6-30个字符',
//        'verifyCode.require'   => '验证码必须填写',
//        'verifyCode.length'   => '验证码必须5位',
        'email'        => '邮箱格式错误',
    ];

}