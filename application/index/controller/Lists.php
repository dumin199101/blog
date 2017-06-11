<?php

namespace app\index\controller;

use app\common\model\Category;

class Lists extends Common
{
    //列表页
    public function index()
    {
        $head_conf = [
            'title'=>'列表页'
        ];
        $this->assign('head_conf',$head_conf);
        //获取头部数据
        $cate_id = input('param.cat_id');
        if($cate_id){
            $cids = (new Category())->getSon(db('category')->select(),$cate_id);
            $cids[] = $cate_id;
            $head_data = [
                'title'=>'分类',
                'name'=>db('category')
                    ->where('n_id',$cate_id)
                    ->value('v_cat_name'),
                'count'=>db('article')->whereIn('n_cat_id',$cids)
                          ->count()
            ];
            $this->assign('head_data',$head_data);
        }
        return $this->fetch();
    }
}
