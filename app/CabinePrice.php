<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CabinePrice extends Model
{
    protected $fillable = ['single', 'second', 'third' ,'fourth', 'less5','date', 'created_at', 'updated_at'];
    protected $dates = ['date'];
    //price relation
    public function cabine(){
        return $this->belongsTo('App\Trip' ,'trip_id');
    }

  
}
