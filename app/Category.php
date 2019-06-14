<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    public function catDetails(){
        return $this->hasMany('App\CategoryTrans','cat_id');
    }
    public function translated($locale = null){
        return $this->catDetails()->where('lang' , app()->getLocale())->first();
    }
    public function childs()
    {
        return $this->hasMany('App\Category','parent_id','id');
    }

    public function master_trip()
    {
        return $this->hasMany('App\Trip','cat_id');
    }

    public function places()
    {
        return $this->hasManyThrough('App\Place', 'App\Trip','cat_id','trip_id' ,'id');
    }

}
