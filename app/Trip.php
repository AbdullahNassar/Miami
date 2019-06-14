<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //translation relation
    public function trans(){
        return $this->hasMany('App\TripTrans','trip_id');
    }

    public function booking(){
        return $this->belongsTo('App\Booking' ,'trip_id','id');
    }

    public function wishlist(){
        return $this->belongsTo('App\Wishlist' ,'trip_id' , 'id');
    }

    public function countWishlist(){
        return $this->hasMany('App\Wishlist' ,'trip_id' , 'id');
    }

    //price relation
    public function price(){
        return $this->hasMany('App\Price' ,'trip_id');
    }

    public function cabinPrices(){
        return $this->hasMany('App\CabinePrice' ,'trip_id');
    }

    public function carPrices(){
        return $this->hasMany('App\CarPrice' ,'trip_id');
    }

    public function place(){
        return $this->belongsTo('App\Place' ,'place_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'cat_id');
    }
    //images relation
    public function images(){
        return $this->morphMany('App\Image','imageable');
    }

    public function getImages()
    {
        return $this->images->map(function ($image)
        {
            $image->url = url('storage/uploads/trips/'.$image->name);
            return $image;
        });
    }


    //get all the translations
    public function translated(){
        return $this->trans()->where('lang' ,app()->getLocale())->first();
    }

    public function hotelPrice(){
        return $this->hasMany('App\HotelPrice' ,'trip_id');
    }

    public function Tour(){
        return $this->hasMany('App\Tour' ,'trip_id');
    }
}
