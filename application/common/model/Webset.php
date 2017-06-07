<?php

namespace app\common\model;

use think\Model;

class Webset extends Model
{
    protected $pk = 'n_id';
    protected $table = 'tb_webset';

    /**
     * 编辑
     */
    public function edit($data)
    {
        $result = $this->validate([
            'v_value'=>'require'
        ],[
            'v_value.require'=>'配置值不能为空'
        ])->save($data,[$this->pk=>$data['n_id']]);
        if($result){
            return ['valid'=>1,'msg'=>'修改成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}
