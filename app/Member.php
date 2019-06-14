<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'password',
        'phone',
        'address',
        'image',
    ];
}    
