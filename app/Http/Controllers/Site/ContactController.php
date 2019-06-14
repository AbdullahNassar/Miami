<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use App\ContactTrans;

class ContactController extends Controller
{
    //
    public function getIndex(){
        $contact = ContactTrans::where('lang' ,app()->getLocale())->get();

        return view('site.pages.contact.index' ,compact('contact'));
    }

    public  function postIndex(Request $request)
    {
        $data = new Message();

        $data->name = $request->name;
        $data->message = $request->message;
        $data->email = $request->email;

        if($data->save()){
            $return = [
                'response' => 'success'
            ];
        }else{
            $return = [
                'response' => 'error'
            ];
        }

        return response()->json($return);
    }
}
