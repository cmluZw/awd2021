<?php

namespace app\admin\controller;

use app\admin\model\MatchModel;
use app\BaseController;

class MatchController extends BaseController
{

    public function runmatch()
    {
        return 'run';
    }

    public function endmatch()
    {
        $matchModel=new MatchModel();
        $MI_id=$matchModel->get_MI_id();
        $res=$matchModel->endmatch($MI_id);
        echo $res;
    }
}