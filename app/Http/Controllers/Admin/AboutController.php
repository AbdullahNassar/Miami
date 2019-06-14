<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\About;
use App\Language;

class AboutController extends Controller
{
	public function getIndex() {
        $lang = Language::get();
        return view('admin.pages.about.index' , compact('lang' , 'abouts'));
    }

    public function postInfo(Request $r)
    {

        $about = About::where('lang',$r->lang)->first();
        // dd($about);
       
        return view('admin.pages.about.edit-about',compact('about'));
    }

    public function postEdit(Request $r )
    {
      //  dd($r->all());
        // validate data and return errors
        $v = validator($r->all(),[
            'title' => 'required|min:2',
            'content1' => 'required|min:2',
        ]);
       
        if($v->fails()){
            return [
                'status' => 'error',
                'msg' => implode('<br>', $v->errors()->all()),
                ];
         }
        // instanciate new about and save its data
        //$about = About::find($id);
        $about = About::find($r->id);
        $about->title = $r->input('title');
        $about->content = $r->input('content1');
        // dd($about);
        $destination = storage_path('uploads/about');
        if ($r->image) {
            if (is_file($destination . "/{$about->image}")) {
                @unlink($destination . "/{$about->image}");
            }
            $about->image = $r->image->getClientOriginalName();
            $r->image->move($destination, $about->image);
        }

        if($about->save()){  
        
            return [
                'status' => 'success',
                'msg' => 'About Us Data Updated Successfully',
                ];
        }
    }

    // public function postTranslate(Request $r)
    // {
    //     //dd($r->all());
    //     $about = new About();
    //     $about->title = $r->title1;
    //     $about->content = $r->content1;
    //     $about->lang = $r->lang;

    //     if ($about->save()) {
    //         return [
    //                'status' => 'success',
    //                 'msg' => 'Language updated successfully.',
    //                ];
    //     }
    //     return [
    //         'status' => 'error',
    //         'msg' => 'Un Expected Error please try again',
    //     ];
    // }
	
  
}