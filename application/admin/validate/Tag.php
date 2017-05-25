<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/25
 * Time: 21:45
 */

namespace app\admin\validate;


use think\Validate;

class Tag extends Validate
{
    protected $rule = [
        'v_tag_name'=>'require'
    ];

    protected $message = [
        'v_tag_name.require'=>'标签不能为空'
    ];
}