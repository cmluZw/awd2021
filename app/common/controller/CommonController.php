<?php


namespace app\common\controller;


use think\facade\Session;

class CommonController
{
    public function session($key,$value){
        $session = Session::set($key,$value);
        return $session;
    }

    public function getsession($key)
    {
        return Session::get($key);
    }
}