<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function item_trips(){
        return $this->hasMany('App\Trip' ,'id','trip_id');
    }
     public function trips(){
    	return $this->item_trips()->first();
    }

     public function trip(){
        return $this->belongsTo('App\Trip' ,'trip_id');
    }
}
