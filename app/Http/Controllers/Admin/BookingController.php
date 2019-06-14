<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Booking;
use App\Language;

class BookingController extends Controller
{

	public function getIndex() {
        $bookings =  Booking::get();
       // dd($bookings);

        return view('admin.pages.booking.index' , compact('bookings'));
    }

    public function getView($id) {
        $booking =  Booking::where('id' , $id)->first();
        
       // dd($bookings);
        
        return view('admin.pages.booking.view' , compact('booking'));
    }

   
}