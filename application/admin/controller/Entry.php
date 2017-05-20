<?php

namespace app\admin\controller;



use app\common\model\Admin;

class Entry extends Common
{
    /*
     * 登录成功后的首页
     */
    public function index(){
        return $this->fetch();
    }

    /*修改密码*/
    public function pass(){
        if(request()->isPost()){
            $res = (new Admin())->changePwd(input('post.'));
            if($res['valid']==1){
                //清空session
                session(null);
                $this->success($res['msg'],'admin/entry/index');
            }else{
                $this->error($res['msg']);
            }
        }else{
            return $this->fetch();
        }
    }
}
