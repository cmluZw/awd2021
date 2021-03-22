<?php
namespace app\admin\controller;


use app\admin\model\AdminModel;
use app\BaseController;
use app\Request;
use think\facade\Session;
use think\facade\View;

class AdminController extends BaseController
{

    public function index()
    {
        return View::fetch('admin@admin_controller/index');
    }

    public function create(Request $request)
    {
        $data=$request->post();
        Session::set('data',$data);
        return redirect('../CreateController/create');
    }

    public function runmatch()
    {
        return redirect('../MatchController/runmatch');
    }

    public function endmatch()
    {
        return redirect('../MatchController/endmatch');
    }

    public function getdata()
    {
        $adminmodel=new AdminModel();
        $MI_id=$adminmodel->get_MI_id();
        $all_match_info=$adminmodel->getall_match_info($MI_id);
        $all_match=$adminmodel->getall_match($MI_id);
        $all_team=$adminmodel->getall_team();
        $all_user=$adminmodel->getall_user();
        $all_flag=$adminmodel->getall_flag($MI_id);
        View::assign('all_match_info',$all_match_info);
        View::assign('all_match',$all_match);
        View::assign('all_team',$all_team);
        View::assign('all_user',$all_user);
        View::assign('all_flag',$all_flag);
        return View::fetch('admin@admin_controller/data');
    }

//    public function


}