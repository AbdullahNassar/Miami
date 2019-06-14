<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //translation relation
    public function details(){
        return $this->hasMany('App\PlaceTrans','place_id');
    }

    //price relation
    public function trips(){
        return $this->hasMany('App\Trip' ,'place_id');
    }

    //get all the translations
    public function translated()
    {
        return $this->details()->where('lang' ,app()->getLocale())->first();
    }

     public function trash() {


        // trash details
        $this->trashDetails();

        // trash reviews
        $this->trashTrips();

        // trash original products
        $this->trashSelf();
    }

  
    protected function trashDetails() {
        $this->details()->delete();
    }

    protected function trashTrips() {
        $this->trips()->delete();
    }

    /**
     * Trash the self product.
     *
     * @return void
     */
    protected function trashSelf() {
        $this->delete();
    }



}
