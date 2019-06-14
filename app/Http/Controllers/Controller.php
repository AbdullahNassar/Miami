<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(Request $request) {
        if (!empty($request->cookie('lang'))) {
            $session_lang = decrypt($request->cookie('lang'));
        }
        //var_dump(decrypt($session_lang));
        if (!empty($session_lang) && in_array($session_lang, ['sw', 'en'])) {
            App::setLocale($session_lang);
            //var_dump(App::getLocale());
        } else {
            App::setLocale('en');
        }
        // exit;
    }
}
