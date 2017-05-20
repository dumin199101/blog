<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/19
 * Time: 23:16
 */

namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'v_cat_name'=>'require',
        'n_pid'=>'require|number',
        'n_sort'=>'require|number|between:0,9999'
    ];

    protected $message = [
        'v_cat_name.require'=>'栏目名称不能为空',
        'n_pid.require'=>'所属栏目不能为空',
        'n_pid.number'=>'所属栏目必须是数字',
        'n_sort.between'=>'栏目排序必须在0-9999之间',
        'n_sort.require'=>'栏目排序不能为空',
        'n_sort.number'=>'栏目排序必须是数字',
    ];
}
