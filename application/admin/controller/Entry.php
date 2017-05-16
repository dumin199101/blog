<?php

namespace app\admin\controller;



class Entry extends Common
{
    /*
     * 登录成功后的首页
     */
    public function index(){
        return $this->fetch();
    }
}
