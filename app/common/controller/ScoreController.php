<?php
namespace app\common\controller;

use app\BaseController;
use app\common\model\format;
use app\common\model\ScoreModel;
use think\facade\View;

class ScoreController extends BaseController
{
//    public function scoreview()
//    {
//        return View::fetch('score');
//    }

    public function getscore()
    {
        $scoremodel=new ScoreModel();
        $match_arr=$scoremodel->getscore();
        $team_name=$scoremodel->getteam_name($match_arr);
        $i=0;
        foreach ($match_arr as $arr)
        {
            $solve_num[$i]=$arr['solve_num'];
            $grade[$i]=$arr['grade'];
            $i++;
        }

        $n=$i;


        for($j=0;$j<$n;$j++)
        {
            if($grade[$j]||$grade[$j]==0)
            {
                $rank[$j]=new format($j+1,$team_name[$j],$solve_num[$j],$grade[$j]);
                $list_str[$j]=$rank[$j]->tostring();
                $rank_list=json_encode($list_str);
            }
        }
        echo "<script>var q=[];q=$rank_list;</script>";
        /*
         * 向js传值
         * */
        echo "<script>var n=$i;</script>";
//        echo "<script>var team_name=$team_name;</script>";
//        echo "<script>var solve_num=$solve_num;</script>";
//        echo "<script>var grade=$grade;</script>";
        /*
         * 向模板渲染
         * */
        View::assign('n',$n);
        View::assign('team_name',$team_name);
        View::assign('solve_num',$solve_num);
        View::assign('grade',$grade);
        return View::fetch('common@score_controller/score');
    }





}
