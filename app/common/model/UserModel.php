<?php


class UserModel extends Model
{

    protected $table='user';

    public function checkuser(array $data)
    {
        $dbresult=$this->Where('username',$data['username'])->find();
        if(!$dbresult)
        {
            return '没有此用户名';
        }
        if($dbresult['password']!==$dara['password'])
        {
            return '账号或者密码错误';
        }

        session('user_session',$dbresult);
        return '登录成功';

    }


}