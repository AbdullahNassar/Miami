<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{

//    protected $fillable = ['*'];

    //main trip function
    public function trip(){
        return $this->belongsTo('App\Trip' ,'trip_id');
    }
}
