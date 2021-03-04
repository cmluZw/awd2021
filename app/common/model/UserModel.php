<?php

namespace app\common\model;

use think\Model;

class UserModel extends Model
{
    protected $pk = 'Id'; // 设置主键名称
    protected $table = 'user'; // 设置当前模型对应的完整数据表名称
    public function checklogin(array $data)
    {
        $dbresult=$this->Where('username',$data['username'])->find();
        if(!$dbresult)
        {
            return '没有此用户名';
        }
        if($dbresult['password']!==$data['password'])
        {
            return '账号或者密码错误';
        }

        session('user_session',$dbresult);
        return '登录成功';

    }

    public function checkregister(array $data)
    {
        $dbusername=$this->Where('username',$data['username'])->find();
        if ($dbusername)
        {
            return '用户名已经存在';
        }
        $dbresult=$this->strict(false)->insert($data);
        if(!$dbresult)
        {
            return '注册失败，请稍后再试';
        }
        return '注册成功';
    }


}