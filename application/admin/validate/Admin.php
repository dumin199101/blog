<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 21:42
 */

namespace app\admin\validate;


use think\Validate;

class Admin extends  Validate
{
    //验证规则
    protected $rule = [
        'v_username'=>'require',
        'v_password'=>'require',
        'code'=>'require|captcha'
    ];
    //提示信息
    protected $message = [
        'v_username.require'=>'用户名不能为空',
        'v_password.require'=>'密码不能为空',
        'code.require'=>'验证码不能为空',
        'code.captcha'=>'验证码不正确'
    ];
}