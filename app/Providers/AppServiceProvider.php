<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Config;
use App\Language;
use App\Setting;
use App\About;
use App\CategoryTrans;
use App\Category;
use App\Staticd;
use App\StaticTrans;
use App\Gallery;
use App\Slider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $about = About::where('lang' , Config::get('app.locale'))->first();
        $allCategories = Category::where('parent_id' ,'0')->get();
        $categories = Category::where('parent_id','!=' ,'0')->get();
        $languages=Language::all();
        $settings=Setting::first();

        $static = Staticd::get();
        $static_data = new \stdClass();
        foreach ($static as $static) {
            $lang = Language::where('code' , Config::get('app.locale'))->value('code');
            $static_name = $static->flag;
            $static_data->$static_name = new \stdClass();

            $static_data->$static_name->title = StaticTrans::where('lang', $lang)
            ->where('static_id', '=', $static->id)->value('title');
            $static_data->$static_name->content = StaticTrans::where('lang', $lang)
            ->where('static_id', '=', $static->id)->value('content');

            $static_data->$static_name->image = Staticd::where('id', '=', $static->id)->value('image');
        }

        $alltrips = \App\TripTrans::where('lang' ,app()->getLocale())->get();
        $gallery=Gallery::get()->take(6);
        $slider=Slider::first();

        view()->share([
            'alltrips' => $alltrips,
            'languages'=>$languages,
            'settings'=>$settings,
            'allCategories' => $allCategories,
            'categories' => $categories,
            'about'=>$about,
            'static_data'=>$static_data,
            'static'=>$static,
             'gallery'=>$gallery,
            'slider'=>$slider,

        ]);

         Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) >= 10;
        });

        Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return 'phone number is not correct'; 
        });

        Validator::extend('password', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $value) && strlen($value) >= 8;
        });

        Validator::replacer('password', function($message, $attribute, $rule, $parameters) {
            return db_trans('validation.password');
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
