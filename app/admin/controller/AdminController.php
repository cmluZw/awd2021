<?php
namespace app\admin\controller;


use app\admin\model\AdminModel;
use app\BaseController;
use think\facade\View;

class AdminController extends BaseController
{

    public function index()
    {
        return 'hello';
    }

    public function getdata()
    {
        $adminmodel=new AdminModel();
        $all_match_info=$adminmodel->getall_match_info();
        $all_match=$adminmodel->getall_match();
        $all_team=$adminmodel->getall_team();
        $all_user=$adminmodel->getall_user();
        $all_flag=$adminmodel->getall_flag();
        View::assign('all_match_info',$all_match_info);
        View::assign('all_match',$all_match);
        View::assign('all_team',$all_team);
        View::assign('all_user',$all_user);
        View::assign('all_flag',$all_flag);
        return View::fetch('admin@admin_controller/data');
    }
}