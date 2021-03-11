<?php

namespace app\admin\model;

use think\facade\Db;

class AdminModel
{
    public function getall_match_info()
    {
        $res=Db::table('match_info')->select()->toArray();
//        print_r($res);
        return $res;
    }
    public function getall_match()
    {
        $res=Db::table('match')->select()->toArray();
        return $res;
    }

    public function getall_flag()
    {
        $res=Db::table('flag')->select()->toArray();
        return $res;
    }
    public function getall_user()
    {
        $res=Db::table('user')->select()->toArray();
        return $res;
    }
    public function  getall_team()
    {
        $res=Db::table('team')->select()->toArray();
        return $res;
    }
}