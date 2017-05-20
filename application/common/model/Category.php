<?php

namespace app\common\model;

use houdunwang\arr\Arr;
use think\Model;

class Category extends Model
{
    protected  $pk = 'n_id';
    protected  $table = 'tb_category';
    //数据添加
    public function store($data){
        //1.数据验证:模型验证
        //2.数据添加
        $result = $this->validate(true)->save($data);
        if($result===false){
            return ['valid'=>0,'msg'=>$this->getError()];
        }
        return ['valid'=>1,'msg'=>'栏目添加成功'];
    }

    //获得树状列表：
    public function getAll()
    {
        return Arr::tree($this->order('n_sort')->select(),'v_cat_name',$fieldPri='n_id',$fieldPid='n_pid');
    }
}
