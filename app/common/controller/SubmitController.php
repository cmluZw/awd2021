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
        $t_id=$submitmodel->check_is_team($username);
        if(!$t_id)
        {
            return '请先加入或者创建一个队伍';
        }
        $submitModel=new SubmitModel();
        $MI_id=$submitModel->getMI_id();
        if($MI_id=='当前无比赛进行')
        {
            return '当前无比赛进行';
        }
        $docker_info=$submitModel->get_docker_info($MI_id,$t_id);
        $token=$submitModel->get_token($MI_id,$t_id);
        View::assign('docker_info',$docker_info);
        View::assign('token',$token);
        return View::fetch('common@submit_controller/index');
    }

    public function submitflag(Request $request)
    {
        $data=$request->post();
        $flag=$data['flag'];
        $token=$data['token'];
        $submitModel=new SubmitModel();
        $MI_id=$submitModel->getMI_id();
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