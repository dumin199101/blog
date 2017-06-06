<?php

namespace app\admin\controller;

use think\Controller;

class Webset extends Controller
{
    public function index(){
        if(request()->isPost()){

        }else{
            return $this->fetch();
        }
    }
}
