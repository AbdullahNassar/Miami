<?php

namespace App\Http\Controllers\Site;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    //
    public function getIndex(){
        $gallery = Gallery::get();

        return view('site.pages.gallery.index', compact('gallery'));
    }
}
