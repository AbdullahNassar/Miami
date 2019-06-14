<?php

namespace App\Http\Controllers\Site;

use App\CabinePrice;
use App\CarPrice;
use App\Category;
use App\CategoryTrans;
use App\HotelPrice;
use App\Http\Controllers\Controller;
use App\Place;
use App\PlaceTrans;
use App\Price;
use App\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Trip;
use App\TripTrans;

class SingleCategoryController extends Controller
{
    //
    public function getIndex(Request $request,$slug){
        $cat_id = CategoryTrans::where('slug' ,$slug)->value('cat_id');
        $categories = Category::where('parent_id' ,$cat_id)->get();
        foreach ($categories as $category){
            $category->count = Trip::where('cat_id' ,$category->id)->count();
            $category->name = CategoryTrans::where('cat_id',$category->id)->where('lang' ,app()->getLocale())->value('name');
        }
        $general = [];
        $places = [];
        $trips = [];
        if($categories == '[]'){
            $trips = Trip::where('cat_id' ,$cat_id)->get();
//            dd($trips);
        }else{
            foreach($categories as $cat){
                $trips[] = Trip::where('cat_id' ,$cat->id)->get();
            }
            foreach ($trips as $trip) {
                foreach ($trip as $all){
                    $general[] = $all;
                }
            }
            $trips = $general;
        }

        foreach ($trips as $trip){
            $places[] = Place::where('id' ,$trip->place_id)->get(['id']);
        }

        $places = array_unique($places);

        if($request->ajax()){
            return $this->filterTrips($request ,$trips);
        }
//        dd($categories->places);

        $base_url = route('site.category', ['slug' => $slug]);

        return view('site.pages.category.index' ,compact('trips','slug' ,'categories','places','base_url'));
    }

    //filter function
    protected function filterTrips(Request $request,$t){
        $slug = $request->slug;
        $location = $request->location;
        $cats = $request->category;
        $first_limit = floatval(str_replace('$', '', $request->first_limit));
        $last_limit = floatval(str_replace('$', '', $request->last_limit));
        $trips = null;
        $totalTrips = null;

        if ($slug == 'day-cruises')
        {
            $PriceTrips[] = Price::whereDate('date', '=', Carbon::today())->whereBetween('e_adult' ,[$first_limit,$last_limit])
                ->get();
            $PriceTrips[] = Price::whereDate('date', '=', Carbon::today())->whereBetween('e_after' ,[$first_limit,$last_limit])
                ->get();
        }elseif ($slug == 'two-night')
        {
            $PriceTrips[] = CabinePrice::whereDate('date', '=', Carbon::today())->whereBetween('second' ,[$first_limit,$last_limit])
                ->get();
        }elseif ($slug == 'Tours')
        {
            $PriceTrips[] = Tour::whereDate('date', '=', Carbon::today())->whereBetween('adult' ,[$first_limit,$last_limit])
                ->get();
        }elseif ($slug == 'car-rental')
        {
            $PriceTrips[] = CarPrice::whereDate('date', '=', Carbon::today())->whereBetween('e_price' ,[$first_limit,$last_limit])
                ->get();
            $PriceTrips[] = CarPrice::whereDate('date', '=', Carbon::today())->whereBetween('b_price' ,[$first_limit,$last_limit])
                ->get();
        }elseif ($slug == 'CRUISE-HOTEL')
        {
            $PriceTrips[] = HotelPrice::whereDate('date', '=', Carbon::today())->whereBetween('double2day' ,[$first_limit,$last_limit])
                ->get();
        }
        foreach ($PriceTrips as $PriceTr){
            foreach ($PriceTr as $Pri){
                $totalTrips[]=$Pri;
            }
        }

        if ($cats !=0 && $cats !=null){
            if ($location){
                $allTrips = Trip::where('cat_id' ,$cats)->where('place_id' ,$location)->get();
            }else{
                $allTrips = Trip::where('cat_id' ,$cats)->get();
            }
            foreach ($allTrips as $allT){
                if ($totalTrips != null){
                    if (collect($totalTrips)->where('trip_id',$allT->id)->first() != null){
                        $trips[] = $allT;
                    }
                }
            }
        }elseif($cats == 0 && $cats !=null){
            if ($location){
                $allTrips =collect($t)->where('place_id' ,$location);
            }else{
                $allTrips =$t;
            }
            foreach ($allTrips as $allT){
                if ($totalTrips != null){
                    if (collect($totalTrips)->where('trip_id',$allT->id)->first() != null){
                        $trips[] = $allT;
                    }
                }
            }
        }else{
            $c_main = CategoryTrans::where('slug',$slug)->first()->catMaster->childs;
            foreach ($c_main as $c_m){
                $allTrips[] =Trip::where('cat_id' ,$c_m->id)->get();
            }
            foreach ($allTrips as $al){
                foreach ($al as $a){
                    $data[] = $a;
                }
            }
            foreach ($data as $allT){
                if ($totalTrips != null){
                    if (collect($totalTrips)->where('trip_id',$allT->id)->first() != null){
                        $trips[] = $allT;
                    }
                }
            }
        }

        return view('site.pages.category.templates.cat',compact('trips'))->render();
    }
}