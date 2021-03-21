<?php

namespace app\common\model;


use think\facade\Db;

class SubmitModel
{
    public function check_is_team($username)
    {
        $t_id=Db::table('user')->where('username',$username)->value('T_id');
        if($t_id==null)
        {
            return 0;
        }
        return $t_id;
    }


    public function submit($flag,$token,$MI_id)
    {
        $T_id=Db::table('match')->where([
            ['token','=',$token],
            ['MI_id','=',$MI_id],
            ])->value('T_id');
        if(!$T_id)
        {
            return 'token错误';
        }
        $arr=Db::table('flag')->where([
            ['T_id','<>',$T_id],
            ['MI_id','=',$MI_id]
        ])->selectOrFail()->toArray();
        $k=0;
        $index2=0;
        /*
         * 设置为旗帜，用于判断是否全部查完flag;
         * */
        $i=1;
        foreach ($arr as $flag_arr)
        {
//            $index = 'flag' . $i;
            for($j=1;$j<=6;$j++) {
                $index = 'flag' . $j;
                    if (@$flag_arr[$index] == $flag) {
                        $k=1;
                        $index2=$index;
                        break;
                    }
            }
            $i++;
        }
        $attach_T_id = Db::table('flag')->where($index2, $flag)->value('T_id');
        if(!$attach_T_id)
        {
            return '数据库错误';
        }
        $result = $this->add_submit($index, $attach_T_id, $T_id, $MI_id);
        return $result;

    }

    public function add_submit($index,$attack_T_id,$T_id,$MI_id)
    {
        $update=$T_id.$index.',';
        /*
         * 找出被攻击的队伍的submit
         * */
        $submit = Db::table('match')->where([
            ['T_id', '=', $attack_T_id],
            ['MI_id', '=', $MI_id],
            ])->value('submit');
             /*
             * 找出被攻击者的M_id，通过M_id为唯一标识符来对数据库中的submit进行更新
             * */
        $M_id=Db::table('match')->where([
            ['T_id', '=', $attack_T_id],
            ['MI_id', '=', $MI_id],
        ])->value('M_id');
        if ($submit == null) {
            $res = Db::name('match')
                ->where('M_id',$M_id)
                ->update(['submit'=>$update]);
            if(!$res)
            {
                return '没有进行插入';
            }
            return   '提交成功';
        }
        $submit1=$submit;
        $submit = explode(',',$submit);//以，为分界打乱
        $update=substr($update, 0, -1);//去掉最后的,
        if(in_array($update,$submit,true))
        {
            return '已经提交过该flag';
        }
        else
        {
            $update=$submit1.$update.',';
            $res = Db::name('match')
                ->where('M_id',$M_id)
                ->update(['submit'=>$update]);
            if(!$res)
            {
                return '没有进行插入';
            }
            return '提交成功';
        }
        }


        public function add_grade($token)
        {
            $res=Db::table('match')
                ->where('token', $token)
                ->inc('grade', 50)
                ->update();
        }

        public function getM_id()
        {
            $MI_id=Db::table('match_info')->where('is_run',1)->value('MI_id');
            if(!$MI_id)
            {
                return '当前无比赛进行';
            }
            return $MI_id;
        }


    
}