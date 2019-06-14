@extends('site.layouts.master')
@section('title')
   Forget Password
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
                                                <img src="{{asset("storage/uploads/logo/$settings->logo")}}">
                                            </div>
                                            <div class="box-title">
                                                <h4>Forget password</h4>
                                            </div>
                                        </div>
                                        <div class="box-cont">
                                            <form  method="post"
                                            class="ajax-form" 
                                            action="{{route('site.pages.recover-password')}}">
                                                {!! csrf_field() !!}
                                                <div class="form-group">
                                                    <input class="form-control" type="email" placeholder="Email Address" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <button class="ajax-submit btn-submit" type="submit">Send</button>
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