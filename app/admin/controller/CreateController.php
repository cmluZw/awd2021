<?php

namespace app\admin\controller;

use app\admin\model\CreateModel;
use app\BaseController;
use app\Request;
use think\facade\Db;
use think\facade\Session;

class CreateController extends BaseController
{
    public function create(Request $request)
    {
        $createmodel=new CreateModel();
        $is_run=$createmodel->check_create();
        if($is_run)
        {
            return $is_run;
        }
        $visit_code=$createmodel->create_visit_code();
        $data=Session::get("data");
        $res=$createmodel->create_db_data($data['match_name'],$visit_code);
        var_dump($res);
        $MI_id=$createmodel->get_MI_id();
        $res=$createmodel->create_flag($MI_id);
         var_dump($res);
    }


}