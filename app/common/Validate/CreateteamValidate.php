<?php

namespace app\common\Validate;
use think\Validate;

class CreateteamValidate extends Validate
{
    protected $rule = [
        'team_code' => 'require|alphaNum',
        'team_name' => 'require|chsAlphaNum',
    ];
    protected $message  =   [
        'team_code.require' =>'请填写队伍邀请码',
        'team_code.alphaNum'=>'邀请码是只能是字母和数字',
//        'team_code.length'=>'长度必须5位',
        'team_name.require' =>'请填写队伍名字',
        'team_name.alphaNum'=>'队伍名字是只能是字母，数字和汉字',
    ];

}