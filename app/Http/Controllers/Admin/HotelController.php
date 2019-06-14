<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryTrans;
use App\HotelPrice;
use App\Image;
use App\Language;
use App\PlaceTrans;
use App\Trip;
use App\TripTrans;
use App\ViewTrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    public function getIndex(Request $request){
        $general = [];
        $cat_id = CategoryTrans::where('slug' ,$request->slug)->value('cat_id');
        $cat  = Category::where('parent_id' ,$cat_id)->get();
        foreach ($cat as $c){
            $trips[] = Trip::where('cat_id' ,$c->id)->get();
        }
//        dd($trips);
        foreach ($trips as $trip) {
            foreach ($trip as $all){
                $general[] = $all;
            }
        }

//        dd($general);
        $trips = $general;
        $languages = Language::get();
        $places = PlaceTrans::where('lang' ,'en')->get();
        $views = ViewTrans::where('lang' ,'en')->get();
        return view('admin.pages.trips.hotel.index',compact('cat','languages','places','trips','views'));
    }
    public function insertView(Request $request)
    {
        $view_id = $request->view_id;
        $view_style = $request->view_style;
        return view('admin.pages.trips.hotel.templates.insertView',compact('view_id','view_style'))->render();
    }

    public function postIndex(Request $request)
    {
        //    dd($request->all());
        $v = Validator($request->all() ,[
            'name' => 'required|min:1',
            'desc' => 'required|min:1',
            'date' => 'required',
            'keywords' => 'required|min:1'
        ] ,[
            'name.required' => 'Please enter trip name',
            'name.min' => 'Trip name should be at least 1 word',
            'desc.required' => 'Please enter trip description',
            'date.required' => 'Please enter trip start date',
            'desc.min' => 'Trip description should be at least 1 word',
            'keywords.required' => 'Please enter trip keywords',
            'keywords.min' => 'Trip keywords should be at least one word'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

        $trips = new Trip();
        $trips->cat_id = $request->cat_id;
        $trips->place_id = $request->place_id;
        if($trips->save()){
            $trans = new TripTrans();
            $trans->name = $request->name;
            $trans->desc = $request->desc;
            $trans->keywords = $request->keywords;
            $trans->slug = preg_replace('/[[:space:]]+/', '-', $request->name);
            $trans->lang = $request->lang;
            $trans->trip_id = $trips->id;
            $trans->save();

            $date = Carbon::parse($request->date);
            for ($i = 0 ; $i < 365 ; $i++){
                for ($z=0;$z<count($request->view_id);$z++){
                    $price = new HotelPrice();
                    $price->single2day = $request->single2day[$z];
                    $price->double2day = $request->double2day[$z];
                    $price->third2day = $request->third2day[$z];
                    $price->fourth2day = $request->fourth2day[$z];
                    $price->less5_2day = $request->less5_2day[$z];
                    $price->single3day = $request->single3day[$z];
                    $price->double3day = $request->double3day[$z];
                    $price->third3day = $request->third3day[$z];
                    $price->fourth3day = $request->fourth3day[$z];
                    $price->less5_3day = $request->less5_3day[$z];
                    $price->single4day = $request->single4day[$z];
                    $price->double4day = $request->double4day[$z];
                    $price->third4day = $request->third4day[$z];
                    $price->fourth4day = $request->fourth4day[$z];
                    $price->less5_4day = $request->less5_4day[$z];
                    $price->single5day = $request->single5day[$z];
                    $price->double5day = $request->double5day[$z];
                    $price->third5day = $request->third5day[$z];
                    $price->fourth5day = $request->fourth5day[$z];
                    $price->less5_5day = $request->less5_5day[$z];
                    $price->single6day = $request->single6day[$z];
                    $price->double6day = $request->double6day[$z];
                    $price->third6day = $request->third6day[$z];
                    $price->fourth6day = $request->fourth6day[$z];
                    $price->less5_6day = $request->less5_6day[$z];
                    $price->view_id = $request->view_id[$z];
                    $price->trip_id = $trips->id;
                    $price->date = $date->format('Y-m-d');
                    $price->save();
                }
                $date->addDay();
            }
            foreach($request->img_name as $image){
                $trips->images()->create([
                    'name' => $image
                ]);
            }
            return ['status' => 'success' ,'data' => 'Trip has been added successfully'];
        }
        return ['status' => 'error','data' => 'Error please try again later'];
    }

    public function postTrans(Request $request){
        $v = Validator($request->all() ,[
            'name' => 'required|min:1',
            'desc' => 'required|min:1',
            'keywords' => 'required|min:1'
        ] ,[
            'name.required' => 'Please enter trip name',
            'name.min' => 'Trip name should be at least 1 word',
            'desc.required' => 'Please enter trip description',
            'desc.min' => 'Trip description should be at least 1 word',
            'keywords.required' => 'Please enter trip keywords',
            'keywords.min' => 'Trip keywords should be at least one word'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

        $trans = new TripTrans();

        $trans->name = $request->name;
        $trans->desc = $request->desc;
        $trans->slug = preg_replace('/[[:space:]]+/', '-', $request->name);
        $trans->keywords = $request->keywords;
        $trans->lang = $request->lang;
        $trans->trip_id = $request->trip_id;

        if($trans->save()){
            return ['status' => 'success' ,'data' => 'Trip has been translated successfully'];
        }

        return ['status' => 'error','data' => 'Error please try again later'];
    }

    public function getDelete($id = null){
        $trip = Trip::find($id);

        $trip->trans()->delete();
        $trip->images()->delete();
        $trip->hotelPrice()->delete();

        $trip->delete();
        return redirect()->back();
    }

    public function getEdit(Request $request ,$id){
        $trip = TripTrans::where('trip_id',$id)->get();
        $cats = CategoryTrans::where('lang' ,'en')->get();
        $places = PlaceTrans::where('lang' ,'en')->get();
        $images = Image::where('imageable_id' ,$id)->get();
        return view('admin.pages.trips.hotel.edit',compact('trip' ,'cats' ,'places','images'));
    }

    public function postEdit(Request $request ,$id){
        $v = Validator($request->all() ,[
            'name' => 'required|min:1',
            'desc' => 'required|min:1',
            'keywords' => 'required|min:1'
        ] ,[
            'name.required' => 'Please enter trip name',
            'name.min' => 'Trip name should be at least 1 word',
            'desc.required' => 'Please enter trip description',
            'desc.min' => 'Trip description should be at least 1 word',
            'keywords.required' => 'Please enter trip keywords',
            'keywords.min' => 'Trip keywords should be at least one word'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

        $trip = Trip::find($id);
        $trip->cat_id = $request->cat_id;
        $trip->place_id = $request->place_id;
        $trip->trans()->where('trip_id' ,$id)->where('lang', $request->lang)->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'slug' => preg_replace('/[[:space:]]+/', '-', $request->name),
            'keywords' => $request->keywords
        ]);
        if($request->imgs != null){
            foreach ($request->imgs as $id => $image){
                $destination = storage_path('uploads/trips');
                //                dd($destination);
                @unlink(storage_path('uploads/trips/' . $image->name));
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move($destination, $imageName);
                $trip->images()->where('id' ,$id)->create([
                    'name' => $imageName
                ]);
            }
        }

        if($trip->save()){
            return ['status' => 'success' ,'data' => 'Trip data has been updated successfully'];
        }

        return ['status' => 'error' ,'data' => 'Error in updating trip data'];
    }

    public function getPrices(Request $request)
    {
        if ($request->ajax()){
            $date = Carbon::parse($request->date);
            $prices = HotelPrice::where('trip_id' ,$request->id)->where('date' ,$date->format('Y-m-d'))->get();
            return view('admin.pages.trips.hotel.templates.showPrice',compact('prices'))->render();
        }
    }

    public function postPrice(Request $request)
    {
        $v = Validator($request->all() ,[
            'priceType' => 'required',
        ] ,[
            'priceType.required' => 'Please Select Price Type',
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        
        $date = Carbon::parse($request->date);
        for ($z=0;$z<count($request->view_id);$z++){
            if ($request->priceType == 'day')
            {
                HotelPrice::where('trip_id' ,$request->id)->where('date' ,$date->format('Y-m-d'))->where('view_id',$request->view_id[$z])->update([
                    'single2day' => $request->single2day[$z],
                    'double2day' => $request->double2day[$z],
                    'third2day' => $request->third2day[$z],
                    'fourth2day' => $request->fourth2day[$z],
                    'less5_2day' => $request->less5_2day[$z],
                    'single3day' => $request->single3day[$z],
                    'double3day' => $request->double3day[$z],
                    'third3day' => $request->third3day[$z],
                    'fourth3day' => $request->fourth3day[$z],
                    'less5_3day' => $request->less5_3day[$z],
                    'single4day' => $request->single4day[$z],
                    'double4day' => $request->double4day[$z],
                    'third4day' => $request->third4day[$z],
                    'fourth4day' => $request->fourth4day[$z],
                    'less5_4day' => $request->less5_4day[$z],
                    'single5day' => $request->single5day[$z],
                    'double5day' => $request->double5day[$z],
                    'third5day' => $request->third5day[$z],
                    'fourth5day' => $request->fourth5day[$z],
                    'less5_5day' => $request->less5_5day[$z],
                    'single6day' => $request->single6day[$z],
                    'double6day' => $request->double6day[$z],
                    'third6day' => $request->third6day[$z],
                    'fourth6day' => $request->fourth6day[$z],
                    'less5_6day' => $request->less5_6day[$z],
                    'view_id' => $request->view_id[$z],
                ]);
            }elseif ($request->priceType =='year')
            {
                HotelPrice::where('trip_id' ,$request->id)->where('view_id',$request->view_id[$z])->update([
                    'single2day' => $request->single2day[$z],
                    'double2day' => $request->double2day[$z],
                    'third2day' => $request->third2day[$z],
                    'fourth2day' => $request->fourth2day[$z],
                    'less5_2day' => $request->less5_2day[$z],
                    'single3day' => $request->single3day[$z],
                    'double3day' => $request->double3day[$z],
                    'third3day' => $request->third3day[$z],
                    'fourth3day' => $request->fourth3day[$z],
                    'less5_3day' => $request->less5_3day[$z],
                    'single4day' => $request->single4day[$z],
                    'double4day' => $request->double4day[$z],
                    'third4day' => $request->third4day[$z],
                    'fourth4day' => $request->fourth4day[$z],
                    'less5_4day' => $request->less5_4day[$z],
                    'single5day' => $request->single5day[$z],
                    'double5day' => $request->double5day[$z],
                    'third5day' => $request->third5day[$z],
                    'fourth5day' => $request->fourth5day[$z],
                    'less5_5day' => $request->less5_5day[$z],
                    'single6day' => $request->single6day[$z],
                    'double6day' => $request->double6day[$z],
                    'third6day' => $request->third6day[$z],
                    'fourth6day' => $request->fourth6day[$z],
                    'less5_6day' => $request->less5_6day[$z],
                    'view_id' => $request->view_id[$z],
                ]);
            }
        }
        return ['status' => 'success' ,'data' => 'Trip price has been updated'];
    }
      public function postDeleteImage($trip_id, $image_id)
    {
        $trip = Trip::find($trip_id);
        if (!$trip) {
            return back()->withWarning('trip not found', ['id' => $trip_id]);
        }
        $image = $trip->images()->find($image_id);
        // if no image found
        if (!$image) {
            return back()->withError('image not found', ['id' => $image_id]);
        }
        // physical delete from hard desk
        $file_path = storage_path("uploads/trips/$image->name");
        if (is_file($file_path)) {
            @unlink($file_path);
        }

        $image->delete();

        return [
            'status' => true,
            'msg' => 'Added Successfully'];
    }


}
