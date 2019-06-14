<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function wish_trips(){
        return $this->hasMany('App\Trip' ,'id','trip_id');
    }
    public function trips(){
    	return $this->wish_trips()->first();
    }
}
