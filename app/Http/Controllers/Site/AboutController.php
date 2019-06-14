<?php

namespace App\Http\Controllers\Site;

use App\Feature;
use App\FeatureTrans;
use App\Http\Controllers\Controller;
use App\Language;
use App\Testmonial;
use App\TestmonialTrans;
use Illuminate\Http\Request;
use App\About;
use Config;
class AboutController extends Controller {

    //
    public function getIndex() {
    	$about = About::where('lang' , Config::get('app.locale'))->first();
    //	$about = About::where('lang' , 'en')->get();

        $lang_name = app()->getLocale();
        $lang_id = Language::where('name',$lang_name)->value('id');

        $header =Feature::get();
        foreach ($header as $page) {
            $page->icon = FeatureTrans::where('lang',
                Config::get('app.locale'))->where('feature_id', $page->id)
                ->get();
        }

        $details =FeatureTrans::where('lang' , Config::get('app.locale'))->get();


        $tests = Testmonial::get();

        $testmonials = TestmonialTrans::where('lang' , Config::get('app.locale'))->get();
//        dd($testmonials);

        return view('site.pages.about.index' , compact('about','header','details','tests', 'testmonials'));
    }

}
