<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripTrans extends Model
{
    //main trip function

    protected $fillable = ['name', 'lang','slug', 'desc' ,'keywords', 'created_at', 'updated_at'];

    public function trip(){
        return $this->belongsTo('App\Trip' ,'trip_id');
    }


}

