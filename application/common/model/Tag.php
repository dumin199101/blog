<?php

namespace app\common\model;

use think\Model;

class Tag extends Model
{
    protected $pk = 'n_id';
    protected $table  = 'tb_tag';

    public function store($data){
        //验证数据   //添加
        $result = $this->validate(true)->save($data,$data['n_id']);
        if($result){
             return ['valid'=>1,'msg'=>'操作成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }


}
