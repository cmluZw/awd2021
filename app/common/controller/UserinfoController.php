<?php


namespace app\common\controller;


use app\common\model\UserinfoModel;
use app\common\Validate\CreateteamValidate;
use app\common\Validate\TeamcodeValidate;
use app\Request;
use think\facade\Session;
use think\facade\View;
use app\common\CommonController;

class UserinfoController
{


    public function index()
    {

        $username=Session::get('user');
        View::assign('username',$username);
        $this->getuserinfo();
        session('username',$username);
        return View::fetch();

    }


    public function getuserinfo()
    {
        $username=Session::get('user');
//        echo $username;
        $userinfo=new UserinfoModel();
        $data=$userinfo->getinfo($username);
        var_dump($data);
    }

    public function jointeam(Request $request)
    {
        $username=Session::get('username');
//        echo $username;
        $data = $request->post();
        $team_code=$data['team_code'];
        $res = validate(TeamcodeValidate::class)->check(
            ['team_code'=>$team_code,]);
        if($res!==true)
        {
            return '输入错误';
        }
        $userinfomodel=new UserinfoModel();
        $result=$userinfomodel->jointeam($team_code,$username);
        echo $result;
    }

    public function createteamview()
    {
        return View::fetch('createteam');
    }

    public function jointeamview()
    {
        return View::fetch('jointeam');
    }



    public function createteam(Request $request)
    {
        $data=$request->post();
        $username=$username=Session::get('username');
        $res = validate(CreateteamValidate::class)->check($data);
        if(!$res)
        {
            return '输入错误';
        }
        $userinfomodel=new UserinfoModel();
        $result=$userinfomodel->createteam($username,$data);
        echo $result;
    }

}