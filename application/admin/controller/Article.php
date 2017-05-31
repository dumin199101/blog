<?php

namespace app\admin\controller;

use app\common\model\Category;
use think\Controller;

class Article extends Controller
{
    //文章首页
    public function index(){
        return $this->fetch();
    }

    //添加文章
    public function store(){
        //1.获取文章分类信息
        $cate_list = (new Category())->getAll();
        $this->assign('cate_list',$cate_list);
        //2.获取标签数据
        $tag_list = db('tag')->select();
        $this->assign('tag_list',$tag_list);
        return $this->fetch();
    }

}
