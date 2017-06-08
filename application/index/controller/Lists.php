<?php

namespace app\index\controller;

use think\Controller;

class Lists extends Controller
{
    //列表页
    public function index()
    {
        return $this->fetch();
    }
}
