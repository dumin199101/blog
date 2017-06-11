<?php

namespace app\index\controller;

class Content extends Common
{
    //详情页
    public function index()
    {
        $head_conf = [
            'title'=>'详情页'
        ];
        $this->assign('head_conf',$head_conf);
        $id = input('param.article_id');
        if($id){
            //文章数据
            $article = db('article')->alias('a')
                            ->where('a.n_isrecycle',2)
                            ->where('a.n_id',$id)
                            ->field('a.n_id,a.v_author,a.v_title,a.v_desc,a.n_create_time')
                            ->find();
            //标签数据：
            $tag_data = db('article_tag')->alias('a')
                ->join('__TAG__ b','a.n_tag_id = b.n_id')
                ->where('a.n_article_id',$id)
                ->field('b.n_id,b.v_tag_name')
                ->select();
            $this->assign('article',$article);
            $this->assign('tag',$tag_data);
        }
        return $this->fetch();
    }
}
