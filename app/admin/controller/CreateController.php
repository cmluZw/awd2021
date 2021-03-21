<?php

namespace app\admin\controller;

use app\admin\model\CreateModel;
use app\BaseController;
use app\Request;
use think\facade\Db;
use think\facade\Session;

class CreateController extends BaseController
{
    public function index(Request $request)
    {
        $createmodel=new CreateModel();
//        $is_run=$createmodel->check_create();
//        if($is_run)
//        {
//            return $is_run;
//        }
//        $visit_code=$createmodel->create_visit_code();
//        $data=Session::get("data");
//        $res=$createmodel->create_db_data($data['match_name'],$visit_code);
//        var_dump($res);

        $res=$createmodel->create_flag(2);
         var_dump($res);
    }
}