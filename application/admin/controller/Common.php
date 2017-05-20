<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        //登录验证
        if (!session('admin.admin_id')) {
            $this->redirect('admin/login/index');
        }
    }

}
