<?php

namespace app\admin\controller;

use think\Controller;

class Article extends Controller
{
    //文章首页
    public function index(){
        return $this->fetch();
    }

    //添加文章
    public function store(){
        return $this->fetch();
    }

}
