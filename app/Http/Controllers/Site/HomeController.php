<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CategoryTrans;
use App\PlaceTrans;
use App\CabinePrice;
use App\CarPrice;
use App\Price;
use App\Subscribtion;
class HomeController extends Controller {

    public function getIndex() {

        $mains_cats = Category::where('parent_id',0)->orderBy('id', 'asc')->get();

        foreach ($mains_cats as &$main_cat){
            $main_cat->slug = $main_cat->translated()->slug;
            $main_cat->childs = $main_cat->childs;
            $main_cat->catDetails = $main_cat->translated();
        }

      
        $places = PlaceTrans::where('lang',app()->getLocale())->get();
//        dd($mains_cats);
        return view('site.pages.home',compact('mains_cats' , 'places'));
    }

    public function postSubscribe(Request $request) {

        $v = validator($request->all(), [
            "email" => "required|email|unique:subscribtions",
        ]);

        if($v->fails()){
       return ['status' => 'error' , 'msg' => implode('<br>',$v->errors()->all())];
      }

      if(Subscribtion::where('email',$request->email)->first()){
        return ['status' => 'error' , 'msg' => 'this email already subscribed !'];
      }
      
        $sub =new Subscribtion;
        $sub->email = $request->email;

        if ($sub->save()) {
           return ['status' => 'success', 'msg' =>'sent successfully.'];
        }
            return ['status' => 'error', 'msg' => 'error ...try again'];
    }

}
