@extends('site.layouts.master')
@section('title')
    Register
@endsection

@section('content')

    <div class="page-content">
        <section class="page-header">
            <div class="container"></div>
        </section><!--End Welcome-Home-->

        <section class="login-register">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                        <div class="login-register-box">
                            <div class="box-head">
                                <div class="logo">
                                    <img src="{{asset('storage/uploads/logo/' .$settings->logo)}}">
                                </div>
                            </div>
                            <div class="box-cont">
                                <form action="{{action('Site\Auth\AuthController@postRegister')}}" method="post" class="reg-form" >
                                    <div class="alert alert-success hidden reg-alert-success" >
                                        <strong>Success!</strong> You registered successfully!
                                    </div>
                                    <div class="alert alert-danger hidden reg-alert-error" >
                                        <strong>Error!</strong> You are not registered successfully.
                                    </div>
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <input class="form-control" type="text" 
                                        placeholder="First Name" data-msg-required="please enter first name" name="f_name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" 
                                        placeholder="Last Name" name="l_name" data-msg-required="please enter last name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="email" placeholder="Email Address" name="email" data-msg-required="please enter email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" 
                                        placeholder="Phone" name="phone" data-msg-required="please enter phone">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="text" 
                                        placeholder="Address" name="address" data-msg-required="please enter address">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="reg_pass" type="password" placeholder="Password" name="password" data-msg-required="please enter password">
                                    </div>
                                    <div class="form-group">
                                        <input id="reg_password_confirmation" class="form-control" type="password" placeholder="Re Type Password" name="repassword" data-msg-required="please reenter password">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-submit" type="submit">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                        </div><!--End Login-register-box-->
                    </div>
                </div><!--End Row-->
            </div><!--End Container-->
        </section><!--End Login-register-->
    </div><!--End page-content-->

@endsection