<?php

namespace app\admin\model;


use think\facade\Db;

class LoginModel
{
    public function check_login(array $data)
    {
        $dbresult=Db::table('admin')->where('username',$data['username'])->find();
        if(!$dbresult['username'])
        {
            return '没有此用户名';
        }
        if($dbresult['password']!=$data['password'])
        {
            return '账号或者密码错误';
        }
        return '登录成功';
    }

}
