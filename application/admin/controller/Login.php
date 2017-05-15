<?php

namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    /**
     * 登录页
     * @return mixed
     */
    public function index(){
        return $this->fetch('login');
    }
}
