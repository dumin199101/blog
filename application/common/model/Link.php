<?php

namespace app\common\model;

use think\Model;

class Link extends Model
{
    protected $pk = 'n_id';
    protected $table = 'tb_link';

    /**
     * 添加友链
     * @param $data
     * @return array
     */
    public function store($data){
        if($data['n_id']){
            $result = $this->validate(true)->save($data,[$this->pk=>$data['n_id']]);
        }else{
            $result = $this->validate(true)->save($data);
        }
//        halt($this->getLastSql());
        if($result){
            return ['valid'=>1,'msg'=>'操作成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }

    /**
     * 分页获取所有记录
     * @return \think\Paginator
     */
    public function getAll(){
       return $this->order('n_sort desc')
           ->paginate(10);
    }
}
