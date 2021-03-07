<?php
namespace app\common\model;

use think\facade\Db;

class ScoreModel
{
    public function getscore()
    {
        $MI_id=Db::table('match_info')->where('is_run',1)->value('MI_id');
        if(!$MI_id)
        {
            return '当前无比赛进行';
        }
        $match_arr=Db::table('match')->where('MI_id',$MI_id)->selectOrFail()->toArray();

        /*
         * 对查出的数据进行排序，分数为第一排序，结题数量为第二排序
         * */
        foreach ($match_arr as $key=>$value)
        {
            $grade[$key]=$value['grade'];
            $solve_num[$key]=$value['solve_num'];
        }
        array_multisort($grade,SORT_DESC ,SORT_NUMERIC,$solve_num,SORT_DESC,SORT_STRING,$match_arr);
        return $match_arr;
    }

    public function getteam_name($match_arr)
    {
        $i=0;
        foreach ($match_arr as $arr) {
            $team_name[$i] = Db::table('team')->where('T_id', $arr['T_id'])->value('team_name');
            $i++;
        }
//        foreach ($team_name as $i)
//        {
//            echo $i;
//        }

        return $team_name;
    }


}
