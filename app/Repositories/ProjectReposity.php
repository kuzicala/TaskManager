<?php
namespace App\Repositories;
use App\Project;
use Image;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/30
 * Time: 14:28
 */

class ProjectReposity{

    /**
     * 新增
     * @param $request
     */
    public function newProject($request){
        $request->user()->projects()->create([
            'name' =>$request->name,
            'thumbnail'=>$this->thumbnail($request)
        ]);
    }

    /**
     * 更新
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateProject($request,$id){
        $project = Project::findOrFail($id);
        $project->name = $request->name;
        if($request->hasFile('thumbnail')){
            $project->thumbnail = $this->thumbnail($request);
        }
        return $project->save();
    }

    /**
     * 上传图片
     * @param $request
     * @return string 文件名
     */
    private function thumbnail($request){
        if($request->hasFile('thumbnail')){
            $file = $request->thumbnail;
            $fileName = str_random(10).'.jpg';
            $destinationPath = public_path() . '/thumbnail/'.$fileName;
            Image::make($file)->resize(261,98)->save($destinationPath);
            return $fileName;
        }
    }
}