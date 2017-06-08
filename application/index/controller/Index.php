<?php
namespace app\index\controller;

class Index extends  Common
{
    //网站首页
    public function index()
    {
        return $this->fetch();
    }
}
