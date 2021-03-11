<?php

namespace app\common\controller;

use app\common\Validate\RegisterValidate;
use app\common\Validate\UserValidate;
use app\Request;
use app\common\model;
use app\BaseController;
use think\facade\Session;
use \think\facade\View;
use app\common\CommonController;

class LoginController extends BaseController
{


    public function index()
    {
        $username=Session::get('username');
        //成功传入session
        if(!$username)
        {
            redirect('login')->send();
        }
        else
        {
//              View::assign('username',$username);
//              return View::fetch();//成功
            session('user',$username);
            return redirect('../UserinfoController/index');
        }
    }


    public function  login()
    {
        $username= Session::get('username');
        if(!$username) {
            return view('common@login_controller/login');
        }
        else
            {

                return redirect('index');
            }
    }

    public function checklogin(Request $request)
    {
        $data = $request->post();
        $res = validate(UserValidate::class)->check($data);
        if($res!==true)
        {
            return '输入错误';
        }
        $userModel=new model\UserModel();
        $checkuser = $userModel->checklogin($data);
        if($checkuser=="登录成功")
        {
            Session::set('username',$data['username']);
            return redirect('index');


        }
        return view('common@login_controller/login');

    }


    public function register (Request $request)
    {
        $data=$request->post();
        if (empty($data)) {
            return view('common@login_controller/register');
        } else {
            if ($data['password'] !== $data['repassword']) {
                echo '两次密码不相同';
                return view('common@login_controller/register');
            }
            $res = validate(RegisterValidate::class)->check($data);
            if ($res !== true) {
                echo  $res;
                return view('common@login_controller/register');
            }
            $userModel = new model\UserModel();
            $checkuser = $userModel->checkregister($data);
            dump($checkuser);
            if($checkuser!=='注册成功')
            {
                return view('common@login_controller/login');
            }

        }
    }

    public function logout()
    {
        session('user', null);
        return view('common@login_controller/login');
    }

    /*
     * 用于创建session和获取session
     */



}
