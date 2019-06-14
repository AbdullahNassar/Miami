<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    //translation relation
    public function details(){
        return $this->hasMany('App\ViewTrans','view_id');
    }

    // //price relation
    // public function trips(){
    //     return $this->hasMany('App\Trip' ,'place_id');
    // }

    //get all the translations
    public function translated(){
        return $this->details()->where('lang' ,app()->getLocale())->first();
    }
    public function trash()
    {
        // trash details
        $this->trashDetails();

        // trash original products
        $this->trashSelf();

        // // trash related rooms
        // $this->trashTrips();
    }

    protected function trashDetails()
    {
        $this->details()->delete();
    }

    protected function trashSelf()
    {
        $this->delete();
    }

    // protected function trashTrips()
    // {
    //     $this->trips()->delete();
    // }

}
