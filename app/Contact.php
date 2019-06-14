<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

    //
    protected $fillable = ['icon'];

    public function translate() {
        return $this->hasMany('App\ContactTrans', 'contact_id');
    }

}
