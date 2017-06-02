<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $pk = 'n_id';
    protected $table = 'tb_article';
    protected $auto = ['n_user_id'];
    protected $update = ['n_update_time'];
    protected $insert = ['n_create_time'];
    protected function setNUpdateTimeAttr($value)
    {
        return time();
    }
    protected function setNCreateTimeAttr($value){
        return time();
    }
    protected function setNUserIdAttr($value){
        return session('admin.admin_id');
    }

    //添加文章
    public function store($data){
        //验证器验证
        if(empty($data['tag'])){
            return['valid'=>0,'msg'=>'请选择标签'];
        }
        //添加
        //过滤post数组中的非数据表字段数据
        $result = $this->validate(true)->allowField(true)->save($data);
        if($result){
            //文章标签中间表添加：
            foreach($data['tag'] as $v){
                $tag_data = [
                    'n_article_id'=>$this->n_id, //获取自增长ID
                    'n_tag_id'=>$v
                ];
                (new ArticleTag())->save($tag_data);
            }
            return ['valid'=>1,'msg'=>'发布成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }

    //获取首页分页数据：
    public function getAll(){
        return db('Article')->alias('a')
            ->join('__CATEGORY__ b','a.n_cat_id = b.n_id')
            ->field('a.n_id,a.v_title,a.v_author,a.n_create_time,a.n_sort,b.v_cat_name')
            ->where('a.n_isrecycle=2')
            ->order('a.n_sort desc,a.n_create_time desc')
            ->paginate(2);
    }
}
