<?php

namespace app\admin\controller;


use app\admin\model\LoginModel;
use app\admin\Validate\LoginValidate;
use app\BaseController;
use app\Request;
use think\facade\Cookie;
use think\facade\View;

class LoginController extends BaseController
{

    public function index()
    {

        $username=Cookie::get('username');
        if($username)
        {
            return 'hello';
        }
        else
        {
            return View::fetch('login');
        }
    }

    public function viewlogin()
    {

    }


    public function login(Request $request)
    {
        $username=Cookie::get('username');
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
        var_dump($data);
        $loginmodel=new LoginModel();
        $res = $loginmodel->check_login($data);
//        var_dump($res);
        if($res!="登录成功")
        {
            return view('admin@login_controller/login');
        }
        Cookie::set('username',$data['username'],43,200);
        return redirect('index');

    }



}