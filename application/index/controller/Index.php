<?php
namespace app\index\controller;

class Index extends  Common
{
    //网站首页
    public function index()
    {
        //获取文章数据
        $article_data  = db('article')->alias('a')
            ->join('__CATEGORY__ b','a.n_cat_id = b.n_id')
            ->where('a.n_isrecycle',2)
            ->field('a.n_id,a.v_author,a.v_title,a.v_digest,a.n_create_time,a.v_cover_src,a.n_cat_id,b.v_cat_name')
            ->select();
        foreach($article_data as $k=>$v){
            $article_data[$k]['tags'] = db('article_tag')->alias('a')
                ->join('__TAG__ b','a.n_tag_id = b.n_id')
                ->where('a.n_article_id',$v['n_id'])
                ->field('b.n_id,b.v_tag_name')
                ->select();
        }
        $this->assign('article_data',$article_data);
        return $this->fetch();
    }
}
