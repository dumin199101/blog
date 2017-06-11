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
        $tag_id = input('param.tag_id');
        if($cate_id){
            $cids = (new Category())->getSon(db('category')->select(),$cate_id);
            $cids[] = $cate_id;
            $head_data = [
                'title'=>'分类',
                'name'=>db('category')
                    ->where('n_id',$cate_id)
                    ->value('v_cat_name'),
                'count'=>db('article')->where('n_isrecycle',2)
                          ->whereIn('n_cat_id',$cids)
                          ->count()
            ];
            $this->assign('head_data',$head_data);
            //获取主体数据：
            $article_datas = db('article')->alias('a')
                                ->join('__CATEGORY__ b','a.n_cat_id = b.n_id')
                                ->where('a.n_isrecycle',2)
                                ->whereIn('a.n_cat_id',$cids)
                                ->field('a.n_id,a.v_author,a.v_title,a.v_digest,a.n_create_time,a.v_cover_src,a.n_cat_id,b.v_cat_name')
                                ->select();
            foreach($article_datas as $k=>$v){
                $article_datas[$k]['tags'] = db('article_tag')->alias('a')
                    ->join('__TAG__ b','a.n_tag_id = b.n_id')
                    ->where('a.n_article_id',$v['n_id'])
                    ->field('b.n_id,b.v_tag_name')
                    ->select();
            }
            $this->assign('article_datas',$article_datas);
        }
        if($tag_id){
            $head_data = [
                'title'=>'标签',
                'name'=>db('tag')
                    ->where('n_id',$tag_id)
                    ->value('v_tag_name'),
                'count'=>db('article')->alias('a')
                    ->where('n_isrecycle',2)
                    ->join('__ARTICLE_TAG__ b','a.n_id = b.n_article_id')
                    ->where('b.n_tag_id',$tag_id)
                    ->count()
            ];
            $this->assign('head_data',$head_data);
            //获取主体数据：
            $article_datas = db('article')->alias('a')
                ->join('__CATEGORY__ b','a.n_cat_id = b.n_id')
                ->join('__ARTICLE_TAG__ c','a.n_id = c.n_article_id')
                ->where('a.n_isrecycle',2)
                ->where('c.n_tag_id',$tag_id)
                ->field('a.n_id,a.v_author,a.v_title,a.v_digest,a.n_create_time,a.v_cover_src,a.n_cat_id,b.v_cat_name')
                ->select();
            foreach($article_datas as $k=>$v){
                $article_datas[$k]['tags'] = db('article_tag')->alias('a')
                    ->join('__TAG__ b','a.n_tag_id = b.n_id')
                    ->where('a.n_article_id',$v['n_id'])
                    ->field('b.n_id,b.v_tag_name')
                    ->select();
            }
            $this->assign('article_datas',$article_datas);
        }
        return $this->fetch();
    }
}
