<?php

namespace App\Http\Controllers\Site;

use App\CabinePrice;
use App\CarPrice;
use App\HotelPrice;
use App\Http\Controllers\Controller;
use App\Price;
use App\Tour;
use App\Trip;
use App\TripTrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth.site');
    }

    public function getIndex($slug){
        $trans = TripTrans::where('slug' ,$slug)->first();
//        dd($slug);
        $trip = Trip::where('id' ,$trans->trip_id)->first();

        if(Price::where('trip_id' ,$trip->id)->value('trip_id') != null){
            return view('site.pages.booking.oneDay')->with('x' ,$x = 0)
                ->with('slug' ,$slug)->with('trip' ,$trip);
        }elseif (Tour::where('trip_id' ,$trip->id)->value('trip_id') != null){
            return view('site.pages.booking.tour')->with('x' ,$x = 1)
                ->with('slug' ,$slug)->with('trip' ,$trip);
        }elseif (CabinePrice::where('trip_id' ,$trip->id)->value('trip_id') != null){
            return view('site.pages.booking.cabine')->with('x' ,$x = 2)
                ->with('slug' ,$slug);
        }elseif (CarPrice::where('trip_id' ,$trip->id)->value('trip_id') != null){
            return view('site.pages.booking.carRental')->with('x' ,$x = 3)
                ->with('slug' ,$slug);
        }elseif (HotelPrice::where('trip_id' ,$trip->id)->value('trip_id') != null){
            return view('site.pages.booking.hotel')->with('x' ,$x = 4)
                ->with('slug' ,$slug)->with('trip' ,$trip);
        }

    }

    public function postDate(Request $request){
        $slug = $request->slug;
        $date = $request->date;
        $type = $request->type;

        $tripID = TripTrans::where('slug' ,$slug)->value('trip_id');

        if($type == 0){
            if (Price::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->get() == '[]'){
                return view('site.pages.booking.templates.noPrice')->render();
            }
            if(Price::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->value('e_adult') == null){
                return view('site.pages.booking.templates.oneDay.notAdult')->render();
            }elseif(Price::where('trip_id' ,$tripID)->value('e_after') == null){
                return view('site.pages.booking.templates.oneDay.Adult')->render();
            }
        }elseif ($type == 1){
            if (Tour::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->get() == '[]'){
                return view('site.pages.booking.templates.noPrice')->render();
            }
            return view('site.pages.booking.templates.tour.Adult')->render();
        }elseif ($type == 2){
            if (CabinePrice::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->get() == '[]'){
                return view('site.pages.booking.templates.noPrice')->render();
            }
            return view('site.pages.booking.templates.cabine.cabine')->render();

        }elseif ($type == 3){
            if (CarPrice::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->get() == '[]'){
                return view('site.pages.booking.templates.noPrice')->render();
            }
            if(CarPrice::where('trip_id' ,$tripID)->value('e_price') == null){
                return view('site.pages.booking.templates.cars.exotic')->render();
            }elseif(CarPrice::where('trip_id' ,$tripID)->value('b_price') == null){
                return view('site.pages.booking.templates.cars.economy')->render();
            }
        }elseif ($type == 4){
            if (HotelPrice::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->get() == '[]'){
                return view('site.pages.booking.templates.noPrice')->render();
            }
            $prices = HotelPrice::where('trip_id' ,$tripID)->where('date' ,Carbon::parse($date)->format('Y-m-d'))->get();
            return view('site.pages.booking.templates.hotel.hotel',compact('prices'))->render();
        }

    }
}
