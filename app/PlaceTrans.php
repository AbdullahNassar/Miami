<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceTrans extends Model
{
    //main trip function
    protected $fillable = ['name', 'lang', 'created_at', 'updated_at'];
    public function place(){
        return $this->belongsTo('App\Place' ,'place_id');
    }




}
