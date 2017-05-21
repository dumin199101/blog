<?php

namespace app\common\model;

use houdunwang\arr\Arr;

use think\Model;

class Category extends Model
{
    protected  $pk = 'n_id';
    protected  $table = 'tb_category';
    //数据添加
    public function store($data){
        //1.数据验证:模型验证
        //2.数据添加
        $result = $this->validate(true)->save($data);
        if($result===false){
            return ['valid'=>0,'msg'=>$this->getError()];
        }
        return ['valid'=>1,'msg'=>'栏目添加成功'];
    }

    //获得树状列表：
    public function getAll()
    {
        return Arr::tree($this->order('n_sort')->select(),'v_cat_name',$fieldPri='n_id',$fieldPid='n_pid');
    }

    //查找当前栏目的子栏目：
    public function getCatId($cate_id)
    {
        //1.查找子栏目
        $son_ids = $this->getSon(db('category')->select(),$cate_id);
        //2.把自己追加进去
        $son_ids[] = intval($cate_id);
        //3.查找除了这些之外的数据,并做树状结构处理
        $data = db('category')->whereNotIn('n_id',$son_ids)->select();
        return Arr::tree($data,'v_cat_name',$fieldPri='n_id',$fieldPid='n_pid');
    }

    private function getSon($data,$cate_id){
        static $temp = [];
        foreach($data as $v){
            if($v['n_pid']==$cate_id){
                $temp[] = $v['n_id'];
                //递归查找当前子类的子类：
                $this->getSon($data,$v['n_id']);
            }
        }
        return $temp;
    }

    //编辑栏目
    public function edit($data){
        $result = $this->validate(true)->save($data,[$this->pk=>$data['n_id']]);
        if($result){
            return ['valid'=>1,'msg'=>'编辑成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }

    //删除栏目：
    public function del($id)
    {
        //删除栏目后，将子集数据向上提升一级
        $pid = $this->where('n_id',$id)->value('n_pid');
        $this->where('n_pid',$id)->update(['n_pid'=>$pid]);
        //删除
        if(Category::destroy($id)){
            return ['valid'=>1,'msg'=>'数据删除成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}
