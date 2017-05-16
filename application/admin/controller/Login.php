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
        //测试数据库连接
        $data = db('admin')->find(1);
        dump($data);
        return $this->fetch('login');
    }
}
