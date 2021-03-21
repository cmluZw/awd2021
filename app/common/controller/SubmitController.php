<?php

namespace app\common\controller;


use app\common\model\SubmitModel;
use app\Request;
use think\facade\Session;
use think\facade\View;

class SubmitController
{

    public function index()
    {
        $username=Session::get("username");
        $submitmodel=new SubmitModel();
        $is_team=$submitmodel->check_is_team($username);
        if(!$is_team)
        {
            return '请先加入或者创建一个队伍';
        }
        return View::fetch('common@submit_controller/index');
    }

    public function submitflag(Request $request)
    {
        $data=$request->post();
        $flag=$data['flag'];
        $token=$data['token'];
        $submitModel=new SubmitModel();
        $MI_id=$submitModel->getM_id();
        $res=$submitModel->submit($flag,$token,$MI_id);
//        var_dump($res);
        if($res!=='提交成功')
        {
            echo $res;
        }
        else
        {
        $res=$submitModel->add_grade($token);
        echo '提交成功';
        }
    }


}