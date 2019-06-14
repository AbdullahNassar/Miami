<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewTrans extends Model
{
    //main trip function
    protected $fillable = ['name', 'lang', 'created_at', 'updated_at'];
    public function view(){
        return $this->belongsTo('App\View' ,'view_id');
    }




}
