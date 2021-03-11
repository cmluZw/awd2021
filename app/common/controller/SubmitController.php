<?php

namespace app\common\controller;


use app\common\model\SubmitModel;
use app\Request;
use think\facade\View;

class SubmitController
{

    public function index()
    {
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