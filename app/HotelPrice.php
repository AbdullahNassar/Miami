<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelPrice extends Model
{
    protected $table = 'hotel_prices';

    public function view(){
        return $this->belongsTo('App\View','view_id');
    }
}
