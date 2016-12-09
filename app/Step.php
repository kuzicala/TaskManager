<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    //
    protected $fillable = ['name','completed'];

    public function task(){
        return $this->belongsTo('App\Task');
    }

    public function getCompletedAttribute($value){
        if($value){
            return true;
        }
        return false;
    }
}
