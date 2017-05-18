<?php

namespace app\common\model;

use houdunwang\crypt\Crypt;
use think\Loader;
use think\Model;
use think\Validate;

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
    //修改密码
    public function changePwd($data){
        //1.执行验证：独立验证
        $validate = new Validate([
            'v_password'=>'require',
            'new_password'=>'require',
            'confirm_password'=>'require|confirm:new_password'
        ],[
            'v_password.require'=>'原始密码不能为空',
            'new_password.require'=>'新密码不能为空',
            'confirm_password.require'=>'确认密码不能为空',
            'confirm_password.confirm'=>'新密码跟确认密码不一致'
        ]);

        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }

        //2.密码比对
        $user_info = $this->where('n_id',session('admin.admin_id'))->where('v_password',Crypt::encrypt($data['v_password']))->find();
        if(!$user_info){
            return ['valid'=>0,'msg'=>'原始密码不正确'];
        }
        //3.修改密码
        $this->save([
           'v_password'=>Crypt::encrypt($data['new_password'])
        ],[
           $this->pk=>session('admin.admin_id')
        ]);
        return ['valid'=>1,'msg'=>'密码修改成功'];
    }
}
