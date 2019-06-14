<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\Local;

class LocaleController extends Controller
{
    public function getLang($code)
    {
        if (Language::where('code',$code)->first()){
            session(['locale'=>$code]);
        }
        return back();
    }
}
