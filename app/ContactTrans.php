<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactTrans extends Model {

    //
    protected $fillable = ['title', 'content', 'lang'];

    public function contact() {
        return $this->belongsTo('App\Contact', 'contact_id');
    }

}
