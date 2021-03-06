<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['name','thumbnail','user_id'];
    public function user(){
       return $this->belongsTo('App\User');
    }

    public function tasks(){
        return $this->hasMany('App\Task');
    }

    public function getThumbnailAttribute($value){
        if(!$value){
            return "default.jpg";
        }
        return $value;
    }
}
