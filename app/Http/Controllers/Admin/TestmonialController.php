<?php

namespace App\Http\Controllers\Admin;

use App\Testmonial;
use App\TestmonialTrans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestmonialController extends Controller
{
    public function getIndex()
    {
        $master_testmonial = TestmonialTrans::where('lang',app()->getLocale())->get();
        foreach ($master_testmonial as $master_t)
        {
            $master_t->image = $master_t->master->image;
        }
//        dd($master_testmonial);
        return view('admin.pages.testmonial.index',compact('master_testmonial'));
    }

    public function postIndex(Request $request)
    {
//        dd($request->all());
        // basic validation rules

        $v = validator($request->all(), [

            'title' => 'required|min:1',
            'content' => 'required|min:1',
            'name' => 'required|min:1',
            'address' => 'required|min:1',
            'image' => 'required'

        ]);

        // if the validation has been failed return the error msgs

        if ($v->fails()) {

            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];

        }

        $master = new Testmonial();
        $destination = storage_path('uploads/testmonial/');
        if ($request->image) {
            $master->image = md5(date('Y-m-d').time()).'_'.preg_replace('/[[:space:]]+/', '-',$request->image->getClientOriginalName());
            $request->image->move($destination, $master->image);
        }

        if ($master->save()){
            $details = new TestmonialTrans();
            $details->title = $request->title;
            $details->content = $request->content;
            $details->lang = $request->lang;
            $details->testmonial_id = $master->id;
            $details->name = $request->name;
            $details->address = $request->address;
            $details->save();
            //success message
            return ['status' => true, 'data' => ' Testmonial is added successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function getEdit($id)
    {
        $details =TestmonialTrans::where('testmonial_id',$id)->get();
        return view('admin.pages.testmonial.edit',compact('details'));
    }

    public function postUpdate(Request $request)
    {
//        dd($request->all());
        // basic validation rules
        $v = validator($request->all(), [

            'title' => 'required|min:1',
            'content' => 'required|min:1',
            'name' => 'required|min:1',
            'address' => 'required|min:1',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        $details = TestmonialTrans::find($request->id);
        $details->title =$request->title;
        $details->content =$request->content;
        $details->name =$request->name;
        $details->address =$request->address;
        if ($details->save())
        {
            if ($request->image){
                $master=Testmonial::find($details->testmonial_id);
                $destination = storage_path('uploads/testmonial/');
                unlink($destination.$master->image);
                $master->image = md5(date('Y-m-d').time()).'_'.preg_replace('/[[:space:]]+/', '-',$request->image->getClientOriginalName());
                $request->image->move($destination, $master->image);
                $master->save();
            }
            return ['status' => true, 'data' => ' Testmonial is Updated successfully.'];
        }
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function postTrans(Request $request)
    {
        // basic validation rules
        $v = validator($request->all(), [

            'title' => 'required|min:1',
            'content' => 'required|min:1',
            'name' => 'required|min:1',
            'address' => 'required|min:1',
            'lang' => 'required',

        ]);
        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        $detail =new TestmonialTrans();
        $detail->title = $request->title;
        $detail->content = $request->content;
        $detail->name = $request->name;
        $detail->address = $request->address;
        $detail->lang = $request->lang;
        $detail->testmonial_id = $request->testmonial_id;
        if ($detail->save())
        {
            return ['status' => true, 'data' => ' Testmonial is Translated successfully.'];
        }
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function getDelete($id,Request $request)
    {
        $master = Testmonial::find($id);
        unlink(storage_path('uploads/testmonial/').$master->image);
        $master->details()->delete();
        $master->delete();
        return redirect()->back();
    }
}
