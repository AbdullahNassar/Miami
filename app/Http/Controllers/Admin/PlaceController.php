<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Place;
use App\PlaceTrans;
use App\Language;
use Config;

class PlaceController extends Controller
{
    public function getIndex()
    {
        $lang = Language::get();
        $places = Place::get();
        return view('admin.pages.places.index', compact('places' , 'lang'));
    }

    public function postAdd(Request $r)
    {
        $v = validator($r->all(),[
            'name' => 'required|min:2',
           
        ] ,[
            'name.required' => 'Please enter place name',
            'name.min' => 'place name should be at least 1 word',
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        // instanciate new places and save its data
        $places = new Place;
        if($places->save()){
        // save the places details
            $places->details()->create([
                'lang' => $r->lang,
                'name' => $r->name,
            ]);
        }

        return [
                'status' => 'success',
                'msg' => 'new place added Successfully',
                'data' => 'new place added Successfully',
                ];
    }

    public function postTranslate(Request $r)
    {
        $places = new PlaceTrans();
        $places->lang = $r->lang;
        $places->name = $r->name;
        $places->place_id = $r->place_id;
        if ($places->save()) {
            return [
                   'status' => 'success',
                    'data' => 'Language updated successfully.',
                   ];
        }
        return [
            'status' => 'error',
            'data' => 'Un Expected Error please try again',
        ];
    }

    public function getEdit($id){
        $places = PlaceTrans::where('place_id',$id)->get();
        return view('admin.pages.places.edit',compact('places'));
    }

    public function postEdit($id, Request $r)
    {  
      //  dd($r->all());
        $v = validator($r->all(),[
            'name' => 'required|min:2',
           
        ] ,[
            'name.required' => 'Please enter place name',
            'name.min' => 'place name should be at least 1 word',
        ]);
        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        // instanciate new places and save its data
        $places = Place::find($id);
        if($places->save()){
        // save the places details
            $places->details()->where('place_id' ,$id)->where('lang' ,$r->lang)->update([
                'name' => $r->name,
            ]);
        }

        return [
                'status' => 'success',
                'msg' => 'place Updated Successfully',
                'data' => 'place Updated Successfully',
                ];
    }

    public function getDelete($id) {
        $places = Place::find($id);
        $places->trash();  // deletes room , room details and images 
        return back()->withSuccess('Successfully Deleted');
    }

   
}