<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';
    public function details()
    {
        return $this->hasMany('App\FeatureTrans','feature_id');
    }

    //get all the translations
    public function translated(){
        return $this->details()->where('lang' ,app()->getLocale())->first();
    }
}
