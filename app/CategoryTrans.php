<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTrans extends Model
{
    protected $table = "categories_trans";

    public function catMaster() {
        return $this->belongsTo('App\Category', 'cat_id');
    }
}
