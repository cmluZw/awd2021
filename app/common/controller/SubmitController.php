<?php

namespace app\common\controller;


use app\common\model\SubmitModel;
use think\facade\View;

class SubmitController
{

    public function index()
    {
        return View::fetch('common@submit_controller/index');
    }

    public function submitflag()
    {
        $flag='978';
        $MI_id=2;
        $token='867uytrgd';
        $T_id='100016';
        $attack_T_id='100001';
//        $index= 被攻击的t_id+flag几；
        $index='flag1';
        $submitModel=new SubmitModel();
        $res=$submitModel->add_submit($index,$attack_T_id,$T_id,$MI_id);
        var_dump($res);

    }


}