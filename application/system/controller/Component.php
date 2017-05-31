<?php

namespace app\system\controller;

use think\Controller;
use think\Db;

class Component extends Controller
{
    //图片上传
    public function uploader(){
//        halt($_FILES);
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
//            halt($_POST);
            $data = [
                'v_name'       => input('post.name'),
                'v_filename'   => $info->getFilename(),
                'v_savepath'       =>  'uploads/'  .  $info->getSaveName(),
                'v_extension'  => strtolower( $info->getExtension()),
                'n_create_time' => time(),
                'n_size'       =>$info->getSize(),//文件大小，单位字节
            ];
//            halt($data);
            Db::name( 'attachment' )->insert( $data );
            echo json_encode( [ 'valid' => 1, 'message' => WEB_ROOT .  'uploads/'  .  $info->getSaveName()] );
        }else{
            // 上传失败获取错误信息
            echo json_encode(['valid'=>0,'message'=>$file->getError()]);
        }
    }
}
