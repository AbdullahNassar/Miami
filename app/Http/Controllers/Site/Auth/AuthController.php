<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Hash;
use Mail;
use Auth;
use App\Member;
use Illuminate\Http\Request;
use App\Social;
//use Socialite;
use Config;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest.site', ['except' => ['logout' , 'getLogout']]);
    }

    public function getLogin(){
      //  dd('sdfnsifn');
        return view('site.auth.login');
    }
   
    public function postLogin(Request $r){

        //dd($r->all());

        // $this->validate($r, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        $return = [
            'response' => 'success',
            'message' => Config::get('app.locale') == 'en' ? ' you logged in successfully' : 'تم تسجيل دخولك بنجاح',
            'url' => '/'
        ];
        // grapping Member credentials
        $email = $r->input('email');
        $password = $r->input('password');

        // Searching for the Member matches the passed email
        $member= Member::where('email' ,$email)->first();
        if( $member && Hash::check($password, $member->password) ){
            // login the Member
            Auth::guard('members')->login($member ,$r->has('remember'));
        }else {
            $return = [
                'response' => 'error',
                'message' => Config::get('app.locale') == 'en' ? 'Data you entered is incorrect' : 'البيانات المدخله غير صحيحه'
            ];
        }
        // failed
        return response()->json($return);
    }

    public function getLogout(){
        auth()->guard('members')->logout();

        return redirect('/login')->with('info',trans('admin_global.msg_success_logout'));
    }

    public function getRegister(){
        return view('site.auth.register');
    }

    public function postRegister(Request $r){

        $member = new Member();
        $member->f_name = $r->input('f_name');
        $member->l_name = $r->input('l_name');
        $member->email = $r->input('email');
        $member->phone = $r->input('phone');
        $member->password =  bcrypt($r->input('password'));
        $member->address = $r->input('address');


        if($member->save())
        {
           // dd($member);
            $return = [
                'response' => 'success'
            ];
            Auth::guard('members')->login($member ,$r->has('remember'));
        }else{
            $return = [
                'response' => 'error',
                'message' => Config::get('app.locale') == 'en' ? 'Data you entered is incorrect' : 'البيانات المدخله غير صحيحه'
            ];
        }

        return response()->json($return);
    }

    public function getProfile(){
        return view('site.auth.profile');
    }

    public function getRecoverPassword(){
        return view('site.auth.forget_password');
    }

    public function postRecoverPassword(Request $r){

        $this->validate($r,[
            'email' => 'required|email',
        ]);

        // grapping site credentials
        $email = $r->input('email');

        $member= Member::where('email' ,$email)->first();

        if( $member ){
            $recover_hash = str_random(128);

           // $member->update(compact('recover_hash'));
             $member->recover_hash = $recover_hash ;
             $member->save();

            Mail::send('site.mails.recover-password',
            compact('member','recover_hash'),
            function ($m) use ($member) {
                $m->to($member->email, $member->f_name)->subject('Your Reminder!');
            });

            return redirect('/login');
        }
        // failed
        return redirect()->back()->with('msg' , 'incorrect data');
        // dd($r->all());
    }

     public function getChangePassword($hash){

        $member= Member::where('recover_hash' ,$hash)->first();
	//dd($member);
        if( $member ){
            return view('site.auth.change-password' , compact('hash'));
        }

        // failed
        return redirect('/login')->with('msg' , 'incorrect data');
    }

    public function postChangePassword(Request $r){

        // Searching for the site matches the recover_hash
        $site= Member::where('recover_hash' ,$r->input('_hash'))->first();

        if( $site ){

            $this->validate($r,[
                'password' => 'required|password',
                'repassword' => 'required|same:password',
            ]);

            // grapping site credentials
            $password = bcrypt($r->input('password'));
            $recover_hash = null;

	     $site->recover_hash = $recover_hash ;
	     $site->password = $password;
             $site->save();
            //$site->update(compact('password','recover_hash'));

            return redirect('/')->with('msg' , 'incorrect data');

        }
        // failed
        return redirect()->back()->with('msg' , 'incorrect data');
    }

   
    /**
    * Redirect the user to the provider authentication page.
    *
    * @return Response
    */
    public function redirectToProvider($provider)
    {
        //return Socialite::driver($provider)->redirect();
        
    }


    /**
    * Obtain the user information from the provider.
    *
    * @return Response
    */
    public function handleProviderCallback($provider)
    {
   
      

        auth()->login($user);

        return redirect('/');

    }

}
