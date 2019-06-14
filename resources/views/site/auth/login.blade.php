@extends('site.layouts.master')
@section('title')
    Login
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
                                <div class="box-title">
                                    <h4>Login</h4>
                                </div>
                            </div>
                            <div class="box-cont">
                                <form action="{{action('Site\Auth\AuthController@postLogin')}}"   method="post" id="head-log-form">
                                        {{ csrf_field() }}
                                        <div id="headLogActionSuccess" class="alert alert-success hidden"></div>
                                        <div id="headLogActionError" class="alert alert-danger hidden"></div>
                                    <div class="form-group">
                                        <input class="form-control" type="email" placeholder="Email Address" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-submit" type="submit">login</button>
                                    </div>
                                    <div class="form-group">
                                        <p>Don't have an account ? <a 
                                        href="{{route('site.pages.register')}}">Register now!</a></p>
                                        <p>Forget Password ? 
                                        <a href="{{route('site.pages.forget-password')}}" >Reset now!</a></p>
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