<?php

namespace app\admin\controller;

use app\admin\model\MatchModel;
use app\BaseController;

class MatchController extends BaseController
{

    public function runmatch()
    {
        $matchModel=new MatchModel();
        $res=$matchModel->runmatch(2,'esay_cmd');
        echo $res;
    }

    public function endmatch()
    {
        $matchModel=new MatchModel();
        $MI_id=$matchModel->get_MI_id();
        $res=$matchModel->endmatch($MI_id);
        echo $res;
    }



}