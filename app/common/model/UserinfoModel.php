<?php
namespace app\common\model;



use think\facade\Db;

class UserinfoModel
{
    public function getinfo($username)
    {
        $userinfo=Db::table('user')->where('username', $username)->findOrFail();
//        var_dump($userinfo);
        $T_id=$userinfo['T_id'];
        if($T_id==null)
        {
            return '未加入队伍';
        }
        $team_info=Db::table('team')->where('T_id', $T_id)->find();
//        var_dump($team_info);
        $data=$userinfo+$team_info;
        return $data;
    }

    public function jointeam($team_code,$username)
    {
        //判断是否已经加入队伍
        $isjoin=Db::table('user')->where('username',$username)->value('T_id');
        if($isjoin)
        {
            $team_name=Db::table('team')->where('T_id',$isjoin)->value('team_name');
//            echo $team_name;
            return '您已加入战队'.$team_name;
        }
        //根据邀请码找到T_id,然后将T_id添加到user表中
        $data=Db::table('team')->where('team_code', $team_code)->find();
        if($data==null)
        {
            return '邀请码错误';
        }
        $T_id=$data['T_id'];
        $result=Db::name('user')
            ->where('username', $username)
            ->update(['T_id' => $T_id]);
        if(!$result)
        {
            return '加入队伍失败';
        }
        return '加入成功';
    }


    public function createteam($username,$data)
    {
        $isjoin=Db::table('user')->where('username',$username)->value('T_id');
        if($isjoin)
        {
            $team_name=Db::table('team')->where('T_id',$isjoin)->value('team_name');
//            echo $team_name;
            return '您已加入战队'.$team_name." 不可创建";
        }
        $dbdata = ['team_name' => $data['team_name'], 'team_code' => $data['team_code']];
        $T_id=Db::table('team')->where('team_name',$data['team_name'])->value('T_id');
        if($T_id)
        {
            return '队伍名已存在';
        }
        $res=Db::name('team')->save($dbdata);
        if (!$res)
        {
            return '创建失败';
        }
        $T_id=Db::table('team')->where('team_name',$data['team_name'])->value('T_id');
        Db::name('user')
            ->where('username', $username)
            ->update(['T_id' => $T_id]);
        return '创建成功';
    }

}