<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testmonial extends Model
{
    public function details()
    {
        return $this->hasMany('App\TestmonialTrans','testmonial_id');
    }
}
