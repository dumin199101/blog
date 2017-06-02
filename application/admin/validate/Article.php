<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/1
 * Time: 22:41
 */

namespace app\admin\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'v_title'=>'require',
        'v_author'=>'require',
        'n_cat_id'=>'notIn:0',
        'v_cover_src'=>'require',
        'v_digest'=>'require',
        'v_desc'=>'require',
        'n_sort'=>'require|between:1,9999'
    ];
    protected $message = [
        'v_title.require'=>'文章标题不能为空',
        'v_author.require'=>'文章作者不能为空',
        'n_cat_id.notIn'=>'文章分类不能为空',
        'v_cover_src.require'=>'文章封面不能为空',
        'v_digest.require'=>'文章摘要不能为空',
        'v_desc.require'=>'文章内容不能为空',
        'n_sort.require'=>'文章排序不能为空',
        'n_sort.between'=>'文章排序范围在1-9999之间'
    ];
}