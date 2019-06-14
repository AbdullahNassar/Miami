<?php

namespace App\Http\Controllers\Site;

use App\Feature;
use App\HotelPrice;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use App\Language;
use App\Trip;
use App\TripTrans;
use App\Category;
use App\CategoryTrans;
use App\CabinePrice;
use App\CarPrice;
use App\Price;
use App\Image;
use App\Tour;
use Carbon\Carbon;
use App\Wishlist;
use Auth;

class TripController extends Controller {

    public function getTripDetails($slug) {

        $trip = TripTrans::where('slug' ,$slug)->first();

//         dd($trip);
        $id = TripTrans::where('slug' ,$slug)->value('trip_id');
        //dd($trip_id);
        $images = Image::where('imageable_id' ,$id)->get();

     	$cabine_price = CabinePrice::where('trip_id' ,$id)
     	->whereDate('date', '=', Carbon::today())->first();
//         dd($cabine_price);

     	$car_price = CarPrice::where('trip_id' ,$id)
     	 ->whereDate('date', '=', Carbon::today())->first();
         // dd($car_price);

     	$day_price= Price::where('trip_id' ,$id)
     	->whereDate('date', '=', Carbon::today())->first();

     	$tour_price= Tour::where('trip_id' ,$id)
     	->whereDate('date', '=', Carbon::today())->first();

        $hotel_price= HotelPrice::where('trip_id' ,$id)
            ->whereDate('date', '=', Carbon::today())->get();

     	//get prices by main category
     	$cat_id = $trip->trip->cat_id;
     	$slug = CategoryTrans::where('cat_id' , $cat_id)->first()->slug;

     	$features = Feature::all();
     	$reviews = Review::where('trip_id',$id)->get();

        return view('site.pages.trips.one-trip' , compact('trip' , 'images' , 'slug' , 'cabine_price' ,'car_price' , 'day_price' , 'tour_price','hotel_price','features','reviews'));
    }

    public function postWishlist(Request $request){
        if (Auth::guard('members')->guest()) {
            return [
                'status' => 'warning',
                'msg' => 'Please login first'
            ];
        }

        $item = Wishlist::where('user_id' ,Auth::guard('members')->user()->id)->where('trip_id' ,$request->trip_id)->first();
        if($item != null){
            return [
                'status' => 'warning',
                'msg' => 'Trip is already added'
            ];
        }else{
            $user = new Wishlist();

            $user->user_id = Auth::guard('members')->user()->id;
            $user->trip_id = $request->trip_id;

            if($user->save()){
                return [
                    'status' => 'success',
                    'msg' => 'Trip added to wishlist successfully'
                ];
            }else{
                return [
                    'status' => 'error',
                    'msg' => 'Error please try again later'
                ];
            }
        }
    }

    public function postReview(Request $request)
    {
        $data = new Review();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->comment = $request->comment;
        $data->trip_id = $request->trip_id;
//        $data->rate = $request->rate;
        if ($data->save()){
            $review= view('site.pages.trips.templates.insertReview',compact('data'))->render();
            return response()->json(['response' => 'success','info'=>$review]);
        }
        return response()->json(['response' => 'error']);
    }


}
