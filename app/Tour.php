<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    //
    //main trip function
    public function trip(){
        return $this->belongsTo('App\Trip' ,'trip_id');
    }
}
