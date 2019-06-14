<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staticd extends Model
{
    protected $table= "statics";
   
    public function details(){
        return $this->hasMany('App\StaticTrans','static_id');
    }
    public function translated($locale = null){
        return $this->details()->where('lang_id' , Language::where('name',$locale ?: app()->getLocale())->first()->id)->first();
    }

   
   
}