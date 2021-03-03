<?php

namespace app\common\controller;

use app\common\Validate\UserValidate;
use app\Request;

class LoginController
{
    public function index()
    {
        return view('common@LoginController/login');
    }


    public function checklogin( Request $request)
    {
        $username=$request->param('username');
        $password=$request->param('password');
        echo $username.'  '.$password;
        $data = $request->post();
        try {
            validate(UserValidate::class)->check([
                'username'  => $username,
                'password' => $password,
//                'verifyCode' => $verifyCode,
            ]);
            $check=model('UserModel')->checkuser($data);

            if ($check=='登录成功'){
                    return '登录成功';
            }else{
                throw new \Exception("非法提交");
            }
            $code=200;$msg='登录成功';
        } catch (ValidateException $e) {
            return ['code'=>-200,'msg'=>$e->getError()];
        } catch (\Exception $e) {
            // 这是进行异常捕获
            return ['code'=>-200,'msg'=>$e->getMessage()];
        }



    }

}
