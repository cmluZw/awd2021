<?php
namespace app\common\model;



use think\facade\Db;

class UserinfoModel
{
    public function showinfo($username)
    {
        $userinfo=Db::table('user')->where('username', $username)->find();
//        var_dump($userinfo);
        $T_id=$userinfo['T_id'];
        $team_info=Db::table('team')->where('T_id', $T_id)->find();
//        var_dump($team_info);
        $data=$userinfo+$team_info;
        return $data;
    }

    public function jointeam($data)
    {
        $username=$data['username'];
        $T_id=$data['T_id'];
    }

}