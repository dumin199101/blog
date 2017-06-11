<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        //1.获取公共配置数据
        $webset_data = $this->loadWebsetData();
        $this->assign('webset_data',$webset_data);
        //2.获取顶级分类数据：3个
        $top_cate_data = $this->loadTopCateData();
        $this->assign('top_cate_data',$top_cate_data);
        //3.获取所有分类数据
        $all_cate_data = $this->loadAllCateData();
        $this->assign('all_cate_data',$all_cate_data);
        //4.获取所有的标签数据：
        $all_tag_data = $this->loadAllTagData();
        $this->assign('all_tag_data',$all_tag_data);
        //5.获取最新的三篇文章(3篇)
        $article_data = $this->loadArticleData();
        $this->assign('article_data',$article_data);
        //6.获取友链数据：（3个）
        $link_data = $this->loadLinkData();
        $this->assign('link_data',$link_data);
    }

    private function loadWebsetData(){
        return db('webset')
            ->column('v_value','v_key');
    }

    private function loadTopCateData()
    {
        return db('category')->where('n_pid',0)
            ->order('n_sort desc')
            ->limit(3)
            ->select();
    }

    private function loadAllCateData()
    {
        return db('category')
            ->order('n_sort desc')
            ->select();
    }

    private function loadAllTagData()
    {
        return db('tag')
            ->select();
    }

    private function loadArticleData()
    {
        return db('article')
            ->where('n_isrecycle',2)
            ->order('n_create_time desc')
            ->limit(3)
            ->select();
    }

    private function loadLinkData()
    {
        return db('link')
            ->order('n_sort desc')
            ->limit(3)
            ->select();
    }


}
