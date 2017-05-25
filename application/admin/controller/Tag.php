<?php

namespace app\admin\controller;

use think\Controller;

class Tag extends Controller
{
    protected $db;
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new \app\common\model\Tag();
    }

    //标签管理
    public function index()
    {
        $list = db('Tag')->paginate(5);
        $this->assign('list',$list);
        return $this->fetch();
    }
    //添加编辑标签
    public function store()
    {
        $n_id = input('param.tag_id');
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            if($res['valid']==1){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }else{
            if($n_id){
                $old_data = $this->db->find($n_id);
            }else{
                $old_data['v_tag_name'] = '';
            }
            $this->assign('old_data',$old_data);
            return $this->fetch();
        }
    }

    //删除标签
    public function del()
    {
        $tag_id = input('get.tag_id');
        if(\app\common\model\Tag::destroy($tag_id)){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败');
        }
    }



}
