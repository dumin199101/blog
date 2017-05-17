<?php

namespace app\admin\controller;

use app\common\model\Admin;

use houdunwang\crypt\Crypt;
use think\Controller;

class Login extends Controller
{
    /**
     * 登录页
     * @return mixed
     */
    public function index(){
        //测试数据库连接
//        $data = db('admin')->find(1);
//        dump($data);
        if(request()->isPost()){
//            echo Crypt::decrypt('S4cj77RLvgCEeGK2WujphQ==');
//            echo Crypt::encrypt('123456');
//            die;
            $res = (new Admin())->login(input('post.'));
            if($res['valid']){
                //登录成功：
                $this->success($res['msg'],'admin/entry/index');
            }else{
                //登录失败：
                $this->error($res['msg']);
            }
        }else{
            return $this->fetch('login');
        }
    }
}
