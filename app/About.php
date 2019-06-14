<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
      protected $fillable = ['title', 'lang', 'content', 'created_at', 'updated_at'];
}
