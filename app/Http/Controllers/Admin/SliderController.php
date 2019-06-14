<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function getIndex(){
        $sliders =Slider::all();
        return view('admin.pages.slider.index',compact('sliders'));
    }

    public function postIndex(Request $request){

        $v = validator($request->all(),[
            'image_name' => 'required'
        ]);

        if($v->fails()){
            return ['status' => false, 'data' => 'Please Select Video'];
        }
        $slider = new Slider();
        $destination = storage_path('uploads/slider/');
        if ($request->image_name) {
            $slider->image = md5(date('Y-m-d').time()).'_'.preg_replace('/[[:space:]]+/', '-',
            $request->image_name->getClientOriginalName());
            $request->image_name->move($destination, $slider->image);
        }
        if (explode('/',$request->file('image_name')->getClientMimeType())[0] == 'image'){
            $slider->type ="0";
        }elseif (explode('/',$request->file('image_name')->getClientMimeType())[0] == 'video'){
            $slider->type ="1";
        }
        if ($slider->save()) {
            //success message
            return ['status' => true, 'data' => 'data is added successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];

    }

    public function getEdit($id){
        $slider = Slider::find($id);
        return view('admin.pages.slider.edit',compact('slider'));
    }

    public function postUpdate(Request $request,$id){
        $slider = Slider::find($id);
        $destination = storage_path('uploads/slider/');
        if ($request->image_name) {
            unlink(storage_path('uploads/slider/'.$slider->image) );
            $slider->image = md5(date('Y-m-d').time()).'_'.preg_replace('/[[:space:]]+/', '-',$request->image_name->getClientOriginalName());
            $request->image_name->move($destination, $slider->image);
        }
        if (explode('/',$request->file('image_name')->getClientMimeType())[0] == 'image'){
            $slider->type ="0";
        }elseif (explode('/',$request->file('image_name')->getClientMimeType())[0] == 'video'){
            $slider->type ="1";
        }

        if ($slider->save()) {
            //success message
            return ['status' => true, 'data' => 'data is Update successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function getDelete($id){
        $slider = Slider::find($id);
        unlink(storage_path('uploads/slider/'.$slider->image) );
        $slider->delete();
        return redirect()->back()->with('m', 'Slider has been deleted successfully');
    }

}
