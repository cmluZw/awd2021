<?php

namespace app\admin\model;

use think\facade\Db;

class MatchModel
{
    public function get_MI_id()
    {
        $MI_id=Db::table('match_info')->where('is_run',1)->value('MI_id');
        if(!$MI_id)
        {
            return 0;
        }
        return $MI_id;
    }

    public function endmatch($MI_id)
    {
        if(!$MI_id)
        {
            return '当前无比赛正在进行';
        }
        $match_name=Db::table('match_info')->where('MI_id',$MI_id)->value('match_name');
        $res=Db::name('match_info')->where('MI_id',$MI_id)->update(['is_run'=>0]);
        if(!$res)
        {
            return '失败！比赛仍然在运行';
        }
        return '比赛'.$match_name.'终止';
    }

    public function runmatch($MI_id)
    {

    }


}
