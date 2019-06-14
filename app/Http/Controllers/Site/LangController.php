<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LangController extends Controller
{
    //
    public function postIndex(Request $request) {
        $op_array = [];
        $locale = $request->get('locale');
        if (!empty($locale) && in_array($locale, ['en' , 'ar'])) {
            $op_array = [
            'response' => 'success',
            'lang' => session('lang')
            ];
        }
        //dd($locale);
        //var_dump(Cookie::get('lang'));
        return response()->json($op_array)->cookie('lang', $locale);
    }
}
