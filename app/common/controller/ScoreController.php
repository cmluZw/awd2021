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
//        return View::fetch('test');
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
        /*
         * 向模板渲染
         * */
        View::assign('i',$i);
        View::assign('$match_arr',$match_arr);
        View::assign('team_name',$team_name);
        View::assign('solve_num',$solve_num);
        View::assign('grade',$grade);
        return View::fetch('common@score_controller/score');
    }
}
