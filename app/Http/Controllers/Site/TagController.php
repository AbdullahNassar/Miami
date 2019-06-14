<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\CategoryTrans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Trip;
use App\TripTrans;
use App\PlaceTrans;
use App\Language;
//use App\PlaceTrans;

class TagController extends Controller {

    //
    public function getIndex(Request $r , $tag )
    {
        
        $result = TripTrans::where('keywords','like' ,'%'.$r->tag.'%')->get();
       // dd($trips);   
        return view('site.pages.search.global' ,compact('result'));
    }
      
}
