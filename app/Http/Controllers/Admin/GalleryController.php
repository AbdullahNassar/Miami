<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function getIndex()
    {
        $gallery = Gallery::all();
        return view('admin.pages.gallery.index', compact('gallery'));
    }

     //add files to dropzone
    public function dropzoneStore(Request $request) {
        $destination = storage_path('uploads/gallery/');
        $image = $request->file('file');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move($destination, $imageName);

        return response()->json(['success' => $imageName]);
    }

    //delete image from dropzone
    public function dropzoneDelete(Request $request) {
        unlink(storage_path('uploads\gallery\\' . $request->name));
        return response()->json(['name' => $request->name]);
    }
    /*
     * add function
     */
    public function postAdd(Request $request)
    {
        $v = validator($request->all(), [
            'img_name' => 'required'
        ]);
        if ($v->fails()) {
            return ['status' => false, 'data' => 'Please Select Photo'];
        }
        $gallery = new Gallery();
//        dd($request->img_name);
        foreach ($request->img_name as $image){
            $destination = storage_path('uploads/gallery/');
            $gallery->create([
                'image' => $image
            ]);
        }
        if ($gallery->save()) {
            //success message
            return ['status' => true, 'data' => 'data is added successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    /*
    * getEdit function
    */
    public function getEdit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.pages.gallery.edit', compact('gallery'));
    }

    /*
     * postEdit function
     */
    public function postEdit(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $destination = storage_path('uploads/gallery/');
        if ($request->image_name) {
            @unlink(storage_path('uploads/gallery/' . $gallery->image));
            $gallery->image = md5(date('Y-m-d') . time()) . '_' . preg_replace('/[[:space:]]+/', '-', $request->image_name->getClientOriginalName());
            $request->image_name->move($destination, $gallery->image);
        }

        if ($gallery->save()) {
            //success message
            return ['status' => true, 'data' => 'data is Update successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    /*
     * Delete function
     */
    public function getDelete($id)
    {
        $gallery = Gallery::find($id);
        @unlink(storage_path('uploads/gallery/' . $gallery->image));
        $gallery->delete();
        return redirect()->back()->with('m', 'Gallery has been deleted successfully');
    }


    /*
    * dropZoneStore function
    // */
    // public function dropzoneStore(Request $request)
    // {
    //     $destination = storage_path('uploads/gallery/');
    //     $image = $request->file('file');
    //     $imageName = $image->getClientOriginalName();
    //     $image->move($destination, $imageName);
    // }
}
