<?php

namespace app\admin\controller;


use app\admin\model\LoginModel;
use app\admin\Validate\LoginValidate;
use app\BaseController;
use app\Request;
use think\facade\Session;
use think\facade\View;

class LoginController extends BaseController
{
    public function index()
    {
        $username=Session::get('admin');
        if($username)
        {
            return redirect('../AdminController/index');
        }
        else
        {
            return view('admin@login_controller/login');
        }
    }


    public function login(Request $request)
    {
        $username=Session::get('admin');
        if($username)
        {
            return redirect('index');
        }
        $data=$request->post();
        $res = validate(LoginValidate::class)->check($data);
        if($res!==true)
        {
            return '输入错误';
        }
//        var_dump($data);
        $loginmodel=new LoginModel();
        $res = $loginmodel->check_login($data);
//        var_dump($res);
        if($res!="登录成功")
        {
            return view('admin@login_controller/index');
        }
        Session::set('admin',$data['username']);
        return redirect('index');
    }



}