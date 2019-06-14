<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\FeatureTrans;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use SMKFontAwesome\SMKFontAwesome;

class FeatureController extends Controller
{
    public function getIndex()
    {
        $master_feature = FeatureTrans::where('lang',app()->getLocale())->get();
        foreach ($master_feature as $master_f)
        {
            $master_f->icon = $master_f->master->icon;
        }
//        dd($master_feature);
        $icons = SMKFontAwesome::getArray();
        return view('admin.pages.features.index',compact('master_feature','icons'));
    }

    public function postIndex(Request $request)
    {
//        dd($request->all());
        // basic validation rules

        $v = validator($request->all(), [

            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'icon' => 'required',
            'lang' => 'required',

        ]);

        // if the validation has been failed return the error msgs

        if ($v->fails()) {

            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];

        }

        $master = new Feature();
        $master->icon = $request->icon;

        if ($master->save()){
            $details = new FeatureTrans();
            $details->title = $request->title;
            $details->content = $request->content;
            $details->lang = $request->lang;
            $details->feature_id = $master->id;
            $details->save();
            //success message
            return ['status' => true, 'data' => ' Feature is added successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function getEdit($id)
    {
        $details =FeatureTrans::where('feature_id',$id)->get();
        $icons = SMKFontAwesome::getArray();
        return view('admin.pages.features.edit',compact('details','icons'));
    }

    public function postUpdate(Request $request)
    {
//        dd($request->all());
        // basic validation rules
        $v = validator($request->all(), [

            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'icon' => 'required',

        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $details = FeatureTrans::find($request->id);
        $details->title =$request->title;
        $details->content =$request->content;
        if ($details->save())
        {

           $master=Feature::find($details->feature_id);
           $master->icon = $request->icon;
           $master->save();
            return ['status' => true, 'data' => ' Feature is Updated successfully.'];
        }
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function postTrans(Request $request)
    {
        // basic validation rules
        $v = validator($request->all(), [

            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'lang' => 'required',

        ]);
        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        $detail =new FeatureTrans();
        $detail->title = $request->title;
        $detail->content = $request->content;
        $detail->lang = $request->lang;
        $detail->feature_id = $request->feature_id;
        if ($detail->save())
        {
            return ['status' => true, 'data' => ' Feature is Translated successfully.'];
        }
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function getDelete($id,Request $request)
    {
        $master = Feature::find($id);
        $master->details()->delete();
        $master->delete();
        return redirect()->back();
    }

}
