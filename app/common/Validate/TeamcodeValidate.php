<?php

namespace app\common\Validate;
use think\Validate;

class TeamcodeValidate extends Validate
{
    protected $rule = [
        'team_code' => 'require|alphaNum',
    ];
    protected $message  =   [
        'team_code.require' =>'请填写队伍邀请码',
        'team_code.alphaNum'=>'邀请码是只能是字母和数字',
//        'team_code.length'=>'长度必须5位',
    ];

}