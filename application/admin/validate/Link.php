<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/3
 * Time: 23:50
 */

namespace app\admin\validate;


use think\Validate;

class Link extends Validate
{
    protected $rule = [
       'v_title'=>'require',
       'v_link'=>'require',
       'n_sort'=>'require|between:1,9999'
    ];
    protected $message = [
       'v_title.require'=>'友链名称不能为空',
       'v_link.require'=>'友链地址不能为空',
       'n_sort.require'=>'友链排序不能为空',
       'n_sort.between'=>'友链排序在1-9999之间',
    ];
}