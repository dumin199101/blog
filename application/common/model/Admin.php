<?php

namespace app\common\model;

use houdunwang\crypt\Crypt;
use think\Loader;
use think\Model;

class Admin extends Model
{
    protected $pk = 'n_id'; //主键
    protected $table = 'tb_admin'; //设置当前模型对应的完整数据表名称
    //登录验证
    public function login($data){
        //1.数据校验
        $validate = Loader::validate('Admin');
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //2.判断用户名密码是否匹配
        $user_info = $this->where('v_username',$data['v_username'])->where('v_password',Crypt::encrypt($data['v_password']))->find();
        if(!$user_info){
            return ['valid'=>0,'msg'=>'用户名或密码不正确'];
        }
        //3.将用户信息存入session
        session('admin.admin_id',$user_info['n_id']);
        session('admin.admin_username',$user_info['v_username']);
        return ['valid'=>1,'msg'=>'登录成功'];
    }
}
