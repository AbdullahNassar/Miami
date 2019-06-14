<?php

namespace App\Http\Controllers\Admin;

use App\CategoryTrans;
use App\Http\Controllers\Controller;
use App\Image;
use App\Language;
use App\Price;
use App\TripTrans;
use Illuminate\Http\Request;
use App\Trip;
use App\Category;
use Carbon\Carbon;
use App\PlaceTrans;

class TripController extends Controller
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


    public function getIndex(Request $request){
        $general = [];
        $cat_id = CategoryTrans::where('slug' ,$request->slug)->value('cat_id');
        $cat  = Category::where('parent_id' ,$cat_id)->get();
        foreach ($cat as $c){
            $trips[] = Trip::where('cat_id' ,$c->id)->get();
        }
        foreach ($trips as $trip) {
            foreach ($trip as $all){
                $general[] = $all;
            }
        }

//        dd($general);
        $trips = $general;
        $languages = Language::get();
        $places = PlaceTrans::where('lang' ,'en')->get();

        return view('admin.pages.trips.index',compact('cat','languages','places','trips'));
    }

    public function getEdit(Request $request ,$id){
        $trip = TripTrans::where('trip_id',$id)->get();
        $cats = CategoryTrans::where('lang' ,'en')->get();
        $places = PlaceTrans::where('lang' ,'en')->get();
        $images = Image::where('imageable_id' ,$id)->get();

//        dd($id);
        return view('admin.pages.trips.edit',compact('trip' ,'cats' ,'places','images'));
    }

    public function postPrices(Request $request ){
//        dd($request->id);
        if ($request->ajax()){
            if ($request->date != ''){
                $date = Carbon::parse($request->date);
                $prices = Price::where('trip_id' ,$request->id)->where('date' ,$date->format('Y-m-d'))->first();
//            dd($prices);
                if($prices->e_adult == null && $prices->e_after != null){
                    return view('admin.pages.trips.templates.notadult',compact('prices'))->render();
                }elseif($prices->e_adult != null && $prices->e_after == null){
//                    dd($prices);
                    return view('admin.pages.trips.templates.adult' ,compact('prices'))->render();
                }
            }
        }
    }

    public function postIndex(Request $request){
             //    dd($request->all());
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
        $trips->price = $request->price;

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
//            dd($date);

            for ($i = 0 ; $i < 365 ; $i++){
                $price = new Price();
                if($request->e_adult == null){
                    $price->e_before = $request->e_before;
                    $price->b_before = $request->b_before;
                    $price->e_after = $request->e_after;
                    $price->b_after = $request->b_after;
                }else{
                    $price->e_adult = $request->e_adult;
                    $price->b_adult = $request->b_adult;
                    $price->e_children = $request->e_children;
                    $price->b_children = $request->b_children;
                    $price->e_infants = $request->e_infants;
                    $price->b_infants = $request->b_infants;
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

            return ['status' => 'success' ,'data' => 'Trip has been added successfully'];
        }

        return ['status' => 'error','data' => 'Error please try again later'];
    }

    //translation function
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

         //        dd($trip);
        $trip->cat_id = $request->cat_id;
        $trip->place_id = $request->place_id;
        $trip->price = $request->price;

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
            $price = Price::where('trip_id' ,$request->id)->where('date' ,$date->format('Y-m-d'))->first();
            if($request->e_adult == null && $request->e_after != null){
                $price->e_after = $request->e_after;
                $price->b_after = $request->b_after;
                $price->e_before = $request->e_before;
                $price->b_before = $request->b_before;
            }elseif($request->e_adult != null && $request->e_after == null){
                $price->e_adult = $request->e_adult;
                $price->b_adult = $request->b_adult;
                $price->e_children = $request->e_children;
                $price->b_children = $request->b_children;
                $price->e_infants = $request->e_infants;
                $price->b_infants = $request->b_infants;
            }

            if($price->save()){
                return ['status' => 'success' ,'data' => 'Trip price has been updated'];
            }
        }elseif ($request->priceType =='year')
        {
            Price::where('trip_id' ,$request->id)->update([
                'e_after'=>$request->e_after,
                'b_after'=>$request->b_after,
                'e_before'=>$request->e_before,
                'b_before'=>$request->b_before,
                'e_adult'=>$request->e_adult,
                'b_adult'=>$request->b_adult,
                'e_children'=>$request->e_children,
                'b_children'=>$request->b_children,
                'e_infants'=>$request->e_infants,
                'b_infants'=>$request->b_infants,
            ]);
            return ['status' => 'success' ,'data' => 'Trip prices has been updated'];
        }
        return ['status' => 'error' ,'data' => 'Error please try again later'];

    }

    public function getDelete($id = null){
        $trip = Trip::find($id);

        $trip->trans()->delete();
        $trip->images()->delete();
        $trip->price()->delete();

        $trip->delete();
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
