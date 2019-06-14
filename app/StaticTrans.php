<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticTrans extends Model
{
    protected $table = 'static_trans';
    protected $fillable = ['title', 'lang_id', 'content', 'created_at', 'updated_at'];

    public function master(){
        return $this->belongsTo('App\Staticd','static_id');
    }


     

}