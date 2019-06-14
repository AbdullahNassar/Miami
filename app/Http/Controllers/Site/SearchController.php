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

class SearchController extends Controller {

    //
    public function getGlobalSearch(Request $r )
    {
//        $categories = Category::where('parent_id' ,'!=' ,'0')->get();
        $search = \Request::get('search');

        $search_array = explode(' ', $search);
        if (sizeof($search_array) > 0) {
            $pro = TripTrans::select('*');
            foreach ($search_array as $search_word) {
                $pro->Where('name','like','%'.$search_word.'%')
                    ->orWhere('keywords','like','%'.$search_word.'%')
                    ->where('lang' ,app()->getLocale());
            }

            $result = $pro->paginate(5);
           // dd($result);
           return view('site.pages.search.global' ,compact('result' , 'search'));
           // return view('site.pages.global_search');
        }
        else{
            echo 'No results';
            return view('site.pages.search.global');
        }             
                
    }

    public function getPlaceSearch(Request $request) {
        // if the request is ajax request
        $location_id = $request->location_id;
        $category_id = $request->category_id;
        $sub_cats = Category::find($category_id);
        $trips = null;
        foreach ($sub_cats->childs as $sub_cat){
            $t[] =Trip::where('cat_id', $sub_cat->id)->where('place_id',$location_id)->get();
        }
        $t[] =Trip::where('cat_id', $sub_cats->id)->where('place_id',$location_id)->get();
        foreach ($t as $r){
            foreach ($r as $re){
                $trips[] = $re;
            }
        }
//        dd($trips);
        return view('site.pages.search.index', compact( 'trips'));
    }


  
}
