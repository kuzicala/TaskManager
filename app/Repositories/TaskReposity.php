<?php
namespace App\Repositories;
use App\Project;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Image;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/30
 * Time: 14:28
 */

class TaskReposity{
    /**
     * 总共
     */
    public function total(){
        if(Auth::check()){
            return Auth::user()->tasks()->count();
        }
    }

    /**
     * 未完成
     */
    public function toDoCount(){
        if(Auth::check()) {
            return Auth::user()->tasks()->where('completed', 0)->count();
        }
    }

    /**
     * 上传图片
     */
    public function doneCount(){
        if(Auth::check()) {
            return Auth::user()->tasks()->where('completed', 1)->count();
        }
    }
}