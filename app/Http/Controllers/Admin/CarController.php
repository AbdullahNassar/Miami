<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Language;
use App\Trip;
use App\TripTrans;
use App\Place;
use App\Category;
use App\CategoryTrans;
use App\Image;
use Carbon\Carbon;
use Config;
use App\CarPrice;

class CarController extends Controller
{
    

    public function getIndex(Request $request ,$slug){
        $languages = Language::get();
        $places = Place::get();
        $general=[];
        $cat_id = CategoryTrans::where('slug' ,$slug)->value('cat_id');
        $cat  = Category::where('parent_id' ,$cat_id)->get();
        foreach ($cat as $c){
            $trips[] = Trip::where('cat_id' ,$c->id)->get();
        }
        // dd($trips);
        foreach ($trips as $trip) {
            foreach ($trip as $all){
                $general[] = $all;
            }
        }
//        dd($general);
        $trips = $general;
       //dd($cat);
        return view('admin.pages.trips.cars.index',compact('trips','languages' ,'places' ,'cat'));
    }

    public function postAdd(Request $request){
      // dd($request->all());
        $v = Validator($request->all() ,[
            'name' => 'required|min:1',
            'desc' => 'required|min:1',
            'keywords' => 'required|min:1'
        ] ,[
            'name.required' => 'Please enter Car name',
            'name.min' => 'Car name should be at least 1 word',
            'desc.required' => 'Please enter Car description',
            'desc.min' => 'Car description should be at least 1 word',
            'keywords.required' => 'Please enter Car keywords',
            'keywords.min' => 'Car keywords should be at least one word'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        $trips = new Trip();
        $trips->cat_id = $request->cat_id;
        $trips->place_id = $request->place_id;
        if($trips->save()){
            $trips->trans()->create([
                'name' => $request->name,
                'slug' => preg_replace('/[[:space:]]+/', '-', $request->name),
                'desc' => $request->desc,
                'keywords' => $request->keywords,
                'lang' => $request->lang
            ]);
            $date = Carbon::parse($request->date);
          //  $dates = $date->format('Y-m-d');

            for ($i = 0 ; $i < 365 ; $i++){
                $price = new CarPrice();
                if($request->b_price == null ){
                    $price->e_price = $request->e_price;
                }else{ 
                    $price->b_price = $request->b_price;
                    $price->tax = $request->tax;
                    $price->insurance = $request->insurance;
                    $price->deposit = $request->deposit;
                }    
                $price->trip_id = $trips->id;
                if($i == 0){
                    $price->date = $date->format('Y-m-d');
                }else{
                    $price->date = $date->addDay()->format('Y-m-d');
                }
                $price->save();
            }

            foreach($request->img_name as $image){
                $trips->images()->create([
                    'name' => $image
                ]);
            }
            return ['status' => 'success' ,'data' => 'Car has been added successfully'];
        }
        return ['status' => 'error' ,'data' => 'Error please try again later'];
    }

    public function postTranslate(Request $request){
        $v = Validator($request->all() ,[
            'name' => 'required|min:1',
            'desc' => 'required|min:1',
            'keywords' => 'required|min:1'
        ] ,[
            'name.required' => 'Please enter Car name',
            'name.min' => 'Car name should be at least 1 word',
            'desc.required' => 'Please enter Car description',
            'desc.min' => 'Car description should be at least 1 word',
            'keywords.required' => 'Please enter Car keywords',
            'keywords.min' => 'Car keywords should be at least one word'
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
            return ['status' => 'success' ,'data' => 'car data translated successfully'];
        }

        return ['status' => 'error','data' => 'Error please try again later'];
    }

    public function getEdit($id){
        $places = Place::get();
        $cars = TripTrans::where('trip_id',$id)->get();
        $images = Image::where('imageable_id' ,$id)->get();
     //   dd($trip);
        return view('admin.pages.trips.cars.edit',compact('places' ,'cars' , 'images'));
    }
    public function postEdit(Request $request , $id){
     //  dd($request->all());
        $v = Validator($request->all() ,[
            'name' => 'required|min:1',
            'desc' => 'required|min:1',
            'keywords' => 'required|min:1'
        ] ,[
            'name.required' => 'Please enter Car name',
            'name.min' => 'Car name should be at least 1 word',
            'desc.required' => 'Please enter Car description',
            'desc.min' => 'Car description should be at least 1 word',
            'keywords.required' => 'Please enter Car keywords',
            'keywords.min' => 'Car keywords should be at least one word'
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }

       // dd($request->id);
        $trips =Trip::find($id);
        $trips->place_id = $request->place_id;

        if($trips->save()){
            $trips->trans()->where('trip_id' ,$id)->where('lang' ,$request->lang)->update([
                'name' => $request->name,
                'slug' => preg_replace('/[[:space:]]+/', '-', $request->name),
                'desc' => $request->desc,
                'keywords' => $request->keywords,
            ]);

            if($request->imgs != null){
            foreach ($request->imgs as $id => $image){
                $destination = storage_path('uploads/trips');
                //                dd($destination);
                @unlink(storage_path('uploads/trips/' . $image->name));
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move($destination, $imageName);
                $trips->images()->where('id' ,$id)->create([
                    'name' => $imageName
                ]);
            }
        }

            return ['status' => 'success' ,'data' => 'Car has been updated successfully'];
        }

        return ['status' => 'error' ,'data' => 'Error please try again later'];
    }

    public function postPrice(Request $r){
        if ($r->ajax()){
            if ($r->date != ''){
                $date = Carbon::parse($r->date);
                $prices = CarPrice::where('trip_id' ,$r->id)
                ->where('date' ,$date->format('Y-m-d'))->first();
              //  dd($prices);
                if($prices->b_price == null){
                    return view('admin.pages.trips.cars.templates.economic',compact('prices'))
                    ->render();
                }
                elseif($prices->b_price != null){
                   // dd($prices);
                    return view('admin.pages.trips.cars.templates.business' ,compact('prices'))
                    ->render();
                }
            }
        }
    }
    public function postEditPrice(Request $request ){
       // dd($request->all());
        $v = Validator($request->all() ,[
            'priceType' => 'required',
        ] ,[
            'priceType.required' => 'Please Select Price Type',
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        $date = Carbon::parse($request->date);
        if ($request->priceType == 'day')
        {
            $price = CarPrice::where('trip_id' ,$request->id)->where('date' ,$date->format('Y-m-d'))
                ->first();
            $price->e_price = $request->e_price;
            $price->b_price = $request->b_price;
            $price->insurance = $request->insurance;
            $price->tax = $request->tax;
            $price->deposit = $request->deposit;
            if($price->save()){
                return ['status' => 'success' ,'data' => 'Car Rental prices has been updated'];
            }
        }elseif ($request->priceType =='year')
        {
            CarPrice::where('trip_id' ,$request->id)->update([
                'e_price'=>$request->e_price,
                'b_price'=>$request->b_price,
                'insurance'=>$request->insurance,
                'tax'=>$request->tax,
                'deposit'=>$request->deposit,
            ]);
            return ['status' => 'success' ,'data' => 'Trip prices has been updated'];
        }
        return ['status' => 'error' ,'data' => 'Error please try again later'];
    }

    public function getDelete($id = null) {
        $data = Trip::find($id);

        $data->trans()->delete();
        $price = CarPrice::where('trip_id' , $id)->delete();
        $data->images()->delete();
        $data->delete();

        return redirect()->back();
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
