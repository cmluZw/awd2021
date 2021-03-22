<?php

namespace app\admin\model;

use think\facade\Db;

class AdminModel
{

    public function get_MI_id()
    {
        $MI_id=Db::table('match_info')->where('is_run',1)->value('MI_id');
        if(!$MI_id)
        {
            return '当前无比赛进行';
        }
        return $MI_id;
    }

    public function getall_match_info($MI_id)
    {
        $res=Db::table('match_info')->where('MI_id',$MI_id)->select()->toArray();
//        print_r($res);
        return $res;
    }
    public function getall_match($MI_id)
    {
        $res=Db::table('match')->where('MI_id',$MI_id)->select()->toArray();
        return $res;
    }

    public function getall_flag($MI_id)
    {
        $res=Db::table('flag')->where('MI_id',$MI_id)->select()->toArray();
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