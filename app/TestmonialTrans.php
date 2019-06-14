<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestmonialTrans extends Model
{
    public function master()
    {
        return $this->belongsTo('App\Testmonial','testmonial_id');
    }
}
