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
use App\CabinePrice;

class CabineController extends Controller
{
    //

    //add files to dropzone
    public function dropzoneStore(Request $request) {
        $destination = storage_path('uploads/trips/');
        $image = $request->file('file');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move($destination, $imageName);
        return response()->json(['success' => $imageName]);
    }

    //delete image from dropzone
    public function dropzoneDelete(Request $request) {
        unlink(storage_path('uploads\trips\\' . $request->name));
        return response()->json(['name' => $request->name]);
    }


    public function getIndex(Request $request,$slug){
        $places = Place::get();
        $cat = CategoryTrans::where('lang' , Config::get('app.locale'))->where('slug' , 'two-night')->first();
        // dd(Config::get('app.locale'));
        $trips = Trip::where('cat_id' , $cat->cat_id)->get();
       // dd($trips);
        return view('admin.pages.trips.cabines.index',compact('places' , 'trips' , 'cat'));
    }
    public function postAdd(Request $request){
      //  dd($request->all());
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

            $trips->cabinPrices()->create([
                'single' => $request->single,
                'second' => $request->second,
                'third' => $request->third,
                'fourth' => $request->fourth,
                'less5' => $request->less5,
                'date' => $date
            ]);

            for ($i=1 ; $i < 365 ; $i++){
                $trips->cabinPrices()->create([
                    'single' => $request->single,
                    'second' => $request->second,
                    'third' => $request->third,
                    'fourth' => $request->fourth,
                    'less5' => $request->less5,
                   // 'date' => $date->strtotime(addDays($i))
                    'date' => $date->addDay()->format('Y-m-d')
                ]);
            }

            foreach($request->img_name as $image){
                $trips->images()->create([
                    'name' => $image
                ]);
            }

            return ['status' => 'success' ,'data' => 'Trip has been added successfully'];
        }

        return ['status' => 'error' ,'data' => 'Error please try again later'];
    }

    public function postTranslate(Request $request){
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

    public function getEdit($id){
        $places = Place::get();
        $trips = TripTrans::where('trip_id',$id)->get();
        $images = Image::where('imageable_id' ,$id)->get();
     //   dd($trip);
        return view('admin.pages.trips.cabines.edit',compact('places' ,'trips' , 'images'));
    }
    public function postEdit(Request $request , $id){
     //  dd($request->all());
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

       // dd($request->id);
        $trips =Trip::find($id);
//        dd($trips);
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

            return ['status' => 'success' ,'data' => 'Trip has been added successfully'];
        }

        return ['status' => 'error' ,'data' => 'Error please try again later'];
    }

    public function postPrice(Request $r){
        if ($r->ajax()){
            if ($r->date != ''){
                $date = Carbon::parse($r->date);
                $prices = CabinePrice::where('trip_id' ,$r->id)
                ->where('date' ,$date->format('Y-m-d'))->first();
               // dd($prices);
               
                return view('admin.pages.trips.cabines.templates.prices' ,compact('prices'))
                    ->render();
            }
        }
    }
    public function postEditPrice(Request $request ){
//        dd($request->all());
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
            $price = CabinePrice::where('trip_id' ,$request->id)->where('date' ,$date->format('Y-m-d'))->first();
            $price->single = $request->single;
            $price->second = $request->second;
            $price->third = $request->third;
            $price->fourth = $request->fourth;
            $price->less5 = $request->less5;
            if($price->save()){
                return ['status' => 'success' ,'data' => 'Trip prices has been updated'];
            }
        }elseif ($request->priceType =='year')
        {
             CabinePrice::where('trip_id' ,$request->id)->update([
                'single'=>$request->single,
                'second'=>$request->second,
                'third'=>$request->third,
                'fourth'=>$request->fourth,
                'less5'=>$request->less5,
            ]);
            return ['status' => 'success' ,'data' => 'Trip prices has been updated'];
        }

        return ['status' => 'error' ,'data' => 'Error please try again later'];
    }

    public function getDelete($id = null) {
        $data = Trip::find($id);

        $data->trans()->delete();
        $price = CabinePrice::where('trip_id' , $id)->delete();
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
