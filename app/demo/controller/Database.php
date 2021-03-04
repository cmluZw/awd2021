<?php
namespace app\demo\controller;
use think\facade\Db;
use think\facade\Env;

class Database
{
    public function index()
    {

        //env打印配置环境变量
        dump(Env::get('database_type'));
        dump(Env::get('database_type'));
        dump(Env::get('database_hostname'));
        dump(Env::get('database_database'));
        dump(Env::get('database_username'));
        dump(Env::get('database_password'));
        dump(Env::get('database_charset'));
        dump(Env::get('database_debug'));


        // 打印数据库信息
        dump(Db::query('SELECT * FROM `user`'));


    }


    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}