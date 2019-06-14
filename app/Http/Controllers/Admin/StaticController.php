<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Staticd;
use App\StaticTrans;
use App\Language;

class StaticController extends Controller
{
	public function getIndex() {
        $lang = Language::get();
        $statics = StaticTrans::where('lang',app()->getLocale())->get();
       // $static_img = static::where('flag' , 'static')->get();
        return view('admin.pages.statics.index' , compact('lang' , 'statics'));
    }

    public function getInfo($id,Request $r)
    {
        // dd($r->all());
        $static = StaticTrans::where('static_id',$id)->where('lang',app()->getLocale())->first();
        // dd($static->section_title);
        $lang = Language::get();
        // compile the edit modal view
        return view('admin.pages.statics.templates.edit-static',compact('static' , 'lang'))->render();
    }
    public function postEdit(Request $r)
    {
        // validate data and return errors
        $v = validator($r->all(),[
            'title' => 'required|min:2',
            'content' => 'required|min:2',
        ]);
       
        if($v->fails()){
            return [
                'status' => 'error',
                'msg' => implode('<br>', $v->errors()->all()),
                'data' => implode('<br>', $v->errors()->all()),
                ];
         }
        // instanciate new static and save its data
        //$static = static::find($id);
        $static = StaticTrans::where('static_id',$r->static_id)->where('lang',$r->lang)->first();
        // dd($static);
        $static->title = $r->input('title');
        $static->content = $r->input('content');
        // dd($static);
        $destination = storage_path('uploads/statics');
        if ($r->image) {
            if (is_file($destination . "/{$static->image}")) {
                @unlink($destination . "/{$static->image}");
            }
            $static->master->image = $r->image->getClientOriginalName();
            $r->image->move($destination, $static->master->image);
            
            $static->master->save();
        }

        if($static->save()){  
        
            return [
                'status' => 'success',
                'msg' => ' Data Updated Successfully',
                'data' => ' Data Updated Successfully',
                ];
        }
    }

	
  
}