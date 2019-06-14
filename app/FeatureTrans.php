<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureTrans extends Model
{
    protected $table = 'feature_trans';
    public function master()
    {
     return $this->belongsTo('App\Feature','feature_id');
    }
}
