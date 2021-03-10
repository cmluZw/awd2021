<?php

namespace app\common\model;


use think\facade\Db;

class SubmitModel
{
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

        foreach ($arr as $flag_arr)
        {
            $i=1;
            for($j=0;$j<5;$j++) {
                $index = 'flag' . $i;
                if ($flag_arr[$index] == $flag)
                {
                    return '提交成功';
//                    echo 'flag'.$i;
                }
                else
                {
                    return '没有该flag';
                }
                $i++;
            }
        }
    }

    public function add_submit($index,$attack_T_id,$T_id,$MI_id)
    {
        $submit = Db::table('match')->where([
            ['T_id', '=', $attack_T_id],
            ['MI_id', '=', $MI_id],
        ])->value('submit');
        if ($submit == null) {
            $res = Db::name('match')
                ->where([
                    ['T_id', $attack_T_id],
                    ['MI_id', $MI_id]
                ])
                ->update(['submit' => 'thinkphp']);
            return $res;
//            if(!$res)
//            {
//                return '没有进行插入';
//            }
//            return  '插入成功';
//        }
//        $submit = explode(',',$submit);
//        if(in_array($T_id,$submit,true))
//        {
//            echo '已经提交过该flag';
//        }
//        else
//        {
//            $res=Db::name('match')->where([
//                ['T_id','=',$attack_T_id],
//                ['MI_id','=',$MI_id],
//            ])->exp('submit','submit+$T_id.$index.','')->update();
//            if(!$res)
//            {
//                echo '没有进行插入';
//            }
//            echo '提交成功';
//        }
        }
    }

    
}