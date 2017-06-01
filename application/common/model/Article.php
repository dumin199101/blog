<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $pk = 'n_id';
    protected $table = 'tb_article';
    protected $auto = ['n_user_id'];
    protected $update = ['n_update_time'];
    protected $insert = ['n_create_time'];
    protected function setNUpdateTimeAttr($value)
    {
        return time();
    }
    protected function setNCreateTimeAttr($value){
        return time();
    }
    protected function setNUserIdAttr($value){
        return session('admin.admin_id');
    }

    //添加文章
    public function store($data){
        //验证器验证

        //添加
        $result = $this->validate(true)->save($data);
        if($result){
            return ['valid'=>1,'msg'=>'发布成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}
