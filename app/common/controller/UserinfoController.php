<?php


namespace app\common\controller;


use app\common\model\UserinfoModel;
use think\facade\Session;
use think\facade\View;
use app\common\CommonController;

class UserinfoController
{


    public function index()
    {

        $username=Session::get('user');
        View::assign('username',$username);
        $this->showuserinfo();
        return View::fetch();

    }


    public function showuserinfo()
    {
        $username=Session::get('user');
        echo $username;
        $userinfo=new UserinfoModel();
        $data=$userinfo->showinfo($username);
        var_dump($data);
    }

    public function jointeam()
    {

    }
}