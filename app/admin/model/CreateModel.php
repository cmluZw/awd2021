<?php

namespace app\admin\model;

use think\facade\Db;


class CreateModel
{
        public function check_create()
        {
            $MI_id=Db::table('match_info')->where('is_run',1)->value('MI_id');
            if($MI_id)
            {
                $match_name=Db::table('match_info')->where('MI_id',$MI_id)->value('match_name');
                return $match_name.'比赛正在进行中...';
            }
            return 0;//可以创建
        }

        public function create_db_data($match_name,$visit_code)
        {
            $current_date = date('Y-m-d h:i:s',time());
            $end_time = date('Y-m-d h:i:s',strtotime("$current_date + 1 day"));
//            if(strtotime($current_date)<strtotime($end_time))
            $data=['is_run'=>'1','match_name'=>$match_name,'end_time'=>$end_time,'visit_code'=>$visit_code];
            $res=Db::name('match_info')->insert($data);
            var_dump($res);
            if(!$res)
            {
                return '创建失败';
            }
            return '比赛信息插入成功';
        }

        public function create_file()
        {
            $current_date = date('Y-m-d h:i:s',time());
            $end_time = date('Y-m-d h:i:s',strtotime("$current_date + 1 day"));
            $end_time=strtotime($end_time);//将结束时间转换为时间戳


        }

        public function create_flag($MI_id)
        {
         /*
          * 默认为为当前所有队伍创建flag
          * */
            $team_arr=Db::table('team')->select();
            $num=count($team_arr);
            for($i=0;$i<(int)$num;$i++) {
                $web_ip = "148.70.34.179:" . (8800 + $i+1);
                $port = 2200 + $i+1;
                $code = rand(99*($i+1), 999999);
                $token=substr(md5($code), 8, 16);
                for ($j = 0; $j < 5; $j++)
                {
                    $flag[$i][$j] = $this->flag();
                }
                $flag_data=['T_id'=>$team_arr[$i]['T_id'],'MI_id'=>$MI_id,'flag1'=>$flag[$i][0],'flag2'=>$flag[$i][1],'flag3'=>$flag[$i][2],'flag4'=>$flag[$i][3],'flag5'=>$flag[$i][4]];
//                var_dump($flag_data);
                $res=Db::name('flag')->save($flag_data);
                if(!$res)
                {
                    return 'flag插入错误';
                }
                $docker_data=['web_ip'=>$web_ip,'port'=>$port,'T_id'=>$team_arr[$i]['T_id'],'MI_id'=>$MI_id];
                $docker_res=Db::name('docker_info')->save($docker_data);
                if(!$docker_res)
                {
                    return '队伍docker信息插入错误';
                }
                $match_data=['T_id'=>$team_arr[$i]['T_id'],'MI_id'=>$MI_id,'token'=>$token];
                $tokenres=Db::name('match')->save($match_data);
                if(!$tokenres)
                {
                    return '队伍token插入错误';
                }
            }
            return '各队伍flag插入成功';
        }

        public function  rand_str()
        {
            $i = rand(0, 3);
            $rand_str=array('ring','+v','yuyan','hhh');
            return $rand_str[$i];
        }

        public function flag()
        {
            $rand_str=$this->rand_str();
            $i = rand(0, 3);
            $code = rand(99*$i, 999999);
            $key=base64_encode($code).$rand_str;
            $flag="flag{awd-".$key."}";
            $password=$flag;
            return $password;
        }


        public function create_visit_code()
        {
            $visit_code=time();
            return $visit_code;
        }


        public function get_MI_id()
        {
            $MI_id=Db::table('match_info')->where('is_run',1)->value('MI_id');
            if(!$MI_id)
            {
                return '当前无比赛正在进行';
            }
            return $MI_id;
        }

}
