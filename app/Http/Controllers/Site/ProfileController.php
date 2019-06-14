<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\Wishlist;
use App\Booking;
use App\Trip;
use App\TripTrans;

class ProfileController extends Controller
{
    //
    public function getIndex(){
        return view('site.pages.profile.index');
    }

    public function getWishlist(){
        $base_url = route('site.wishlist');

        $wishlists = Wishlist::where('user_id' , auth()->guard('members')->user()->id)->get();
        
        return view('site.pages.profile.wishlist' ,compact('wishlists' , 'base_url' , '$item_trips'));
    }

    public function postWishlistDelete(Request $request , $id){
        $wishlist = Wishlist::find($id);
        //$wishlist->delete();
        $wishlist->delete();
        return response(['status' => 'success' ,'msg' => 'Deleted successfully']);
    }
   
    public function getItems(){
         $base_url = route('site.items');

        $items = Booking::where('user_id' , auth()->guard('members')->user()->id)->get();
//        dd($items);
       // $trip_id = Booking::where('user_id' , auth()->guard('members')->user()->id)->value('trip_id');
        //$item_trips = Trip::where('id' , $trip_id)
        //->where('user_id' , auth()->guard('members')->user()->id)->get();
        //dd($wishlist);
        return view('site.pages.profile.items' ,compact('items' , 'base_url'));
    }

    public function postIndex(Request $request){
        $member = Member::where('id',auth()->guard('members')->user()->id)->first();

        $member->f_name = $request->f_name;
        $member->l_name = $request->l_name;
        $member->email = $request->email;
        if($request->password != null){
            $member->password = $request->password;
        }
        $member->phone = $request->phone;
        $member->address = $request->address;
        $member->facebook = $request->facebook;
        $member->google = $request->google;
        $member->twitter = $request->twitter;
        $member->information = $request->information;

        $destination = storage_path('uploads/avatars/');
        if ($request->image) {
            if(auth()->guard('members')->user()->image != null){
                unlink(storage_path('uploads/avatars/'.$member->image) );
            }
            $member->image = md5(date('Y-m-d').time()).'_'.preg_replace('/[[:space:]]+/', '-',$request->image->getClientOriginalName());
            $request->image->move($destination, $member->image);
        }

        if($member->save()){
            $op_array = [
                'response' => 'success',
                'message' => ''
            ];
        }else{
            $op_array = [
                'response' => 'error',
                'message' => ''
            ];
        }

        return response()->json($op_array);

    }
}
