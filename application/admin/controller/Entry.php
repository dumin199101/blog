<?php

namespace app\admin\controller;

use think\Controller;

class Entry extends Controller
{
    /*
     * 登录成功后的首页
     */
    public function index(){
        return $this->fetch();
    }
}
