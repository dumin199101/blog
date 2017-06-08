<?php

namespace app\index\controller;

use think\Controller;

class Content extends Controller
{
    //详情页
    public function index()
    {
        return $this->fetch();
    }
}
