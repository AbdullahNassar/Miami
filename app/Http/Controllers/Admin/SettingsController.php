<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;
use App\User;
use Auth;
class SettingsController extends Controller
{
    public function getIndex() {
        $settings = Setting::first();
        return view('admin.pages.settings.index', compact('settings'));
    }

    
    public function postEdit(Request $r) {
        $v = validator($r->all(), [
                'name' => 'required|min:2',
                'lang' => 'required',
                'map_lat' => 'required|numeric',
                'map_lng' => 'required|numeric',
                'phone1' => 'min:7',
                'phone2' => 'min:7',
                'email' => 'required|email',
                'address' => 'required',
                'logo' => 'image|mimes:jpeg,jpg,png,gif|max:20000'
            ], 
            [
                'name.required' => 'Please insert site name',
                'name.min' => 'site name should be at least one word',
                'lang.required' => 'Please insert default language',
                'map_lat.required' => 'Please insert the latitude',
                'map_lat.numeric' => 'Please insert a valid latitude number',
                'map_lng.required' => 'Please insert the longitude',
                'map_lng.numeric' => 'Please insert a valid longitude number',
                'email.required' => 'Please insert the email',
                'email.email' => 'Please insert a valid email',
                'address.required' => 'Please insert the address',
            ]
        );

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
           if ($v->fails()) {
            return ['status' => 'error', 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        }

        $settings = Setting::first();
        $settings->name = $r->name;
        $settings->email = $r->email;
        $settings->address = $r->address;
        $settings->phone1 = $r->phone1;
        $settings->phone2 = $r->phone2;
        $settings->lang = $r->lang;
        $settings->twitter = $r->twitter;
        $settings->facebook = $r->facebook;
        $settings->instagram = $r->instagram;
        $settings->google = $r->google;
        $settings->youtube = $r->youtube;
        $settings->linkedin = $r->linkedin;
        $settings->meta_auther = $r->meta_auther;
        $settings->meta_keyword = $r->meta_keyword;
        $settings->meta_description = $r->meta_description;
        $settings->map_lat = $r->map_lat;
        $settings->map_lng = $r->map_lng;
        $settings->about_site = $r->about_site;


        $destination = storage_path('uploads/logo');
        if ($r->logo) {
            if (is_file($destination . "/{$settings->logo}")) {
                @unlink($destination . "/{$settings->logo}");
            }
            $settings->logo = $r->logo->getClientOriginalName();
            $r->logo->move($destination, $settings->logo);
        }
        if ($settings->save()) {
            return [
                'status' => 'success',
                'data' => ' Updated Successfully'];
        }
        return [
            'status' => 'error',
            'data' => 'Error ..Please try again'];
    }


}
