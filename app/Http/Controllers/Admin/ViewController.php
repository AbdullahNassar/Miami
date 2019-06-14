<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\View;
use App\ViewTrans;
use App\Language;
use Config;

class viewController extends Controller
{
    public function getIndex()
    {
        $lang = Language::get();
        $views = View::get();
        return view('admin.pages.views.index', compact('views' , 'lang'));
    }

    public function postAdd(Request $r)
    {
        $v = validator($r->all(),[
            'name' => 'required|min:2',
           
        ] ,[
            'name.required' => 'Please enter view name',
            'name.min' => 'view name should be at least 1 word',
        ]);

        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        // instanciate new views and save its data
        $views = new View;
        if($views->save()){
        // save the views details
            $views->details()->create([
                'lang' => $r->lang,
                'name' => $r->name,
            ]);
        }

        return [
                'status' => 'success',
                'msg' => 'new view added Successfully',
                'data' => 'new view added Successfully',
                ];
    }

    public function postTranslate(Request $r)
    {
        $views = new ViewTrans();
        $views->lang = $r->lang;
        $views->name = $r->name;
        $views->view_id = $r->view_id;
        if ($views->save()) {
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
        $views = ViewTrans::where('view_id',$id)->get();
        return view('admin.pages.views.edit',compact('views'));
    }

    public function postEdit($id, Request $r)
    {  
      //  dd($r->all());
        $v = validator($r->all(),[
            'name' => 'required|min:2',
        ] ,[
            'name.required' => 'Please enter view name',
            'name.min' => 'view name should be at least 1 word',
        ]);
        if($v->fails()){
            return ['status' => false ,'data' => implode(PHP_EOL ,$v->errors()->all())];
        }
        // instanciate new views and save its data
        $views = ViewTrans::where('view_id' ,$id)->where('lang' ,$r->lang)->first();
// dd($views);
        $views->name = $r->name;
        // dd($views);
        if($views->save()){
        // save the views details
        return [
                'status' => 'success',
                'msg' => 'view Updated Successfully',
                'data' => 'view Updated Successfully',
                ];
            
        }



    }

    public function getDelete($id) {
        $views = View::find($id);
        $views->trash();  // deletes room , room details and images 
        return back()->withSuccess('Successfully Deleted');
    }

   
}