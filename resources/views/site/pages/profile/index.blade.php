@extends('site.layouts.master')
@section('title')
    Profile
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
        </div>
    </section><!--End Welcome-Home-->
    <form class="booking-form" id="edit-form" action="{{route('site.profileAdd')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
    <div class="page-content section-lg">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="filter-section">
                        <div class="filter-section-head">
                            <h4 class="title">My Profile</h4>
                        </div><!--End Filter-box-head-->
                        <div class="filter-section-body">
                            <div class="filter-box">
                                <div class="">
                                    <ul class="account-sidebar">
                                        <li class="account-img">
                                            @if(auth()->guard('members')->user()->image != null)
                                                <img class="btn-product-image" src="{{url('storage/uploads/avatars/'.auth()->guard('members')->user()->image)}}">
                                            @else
                                                <img class="btn-product-image" src="http://knowledge-commons.com/static/assets/images/avatar.png">
                                            @endif
                                                <input type="file" name="image" style="display:none;">
                                        </li><!--End account-img-->
                                        <li class="@if(Request::route()->getName()=='site.profile' ) {{'active'}} @endif">
                                            <a href="{{route('site.profile')}}">
                                                <i class="fa fa-user"></i>
                                                Account Information
                                            </a>
                                        </li>
                                        <li class="@if(Request::route()->getName()=='site.items' ) {{'active'}} @endif">
                                            <a href="{{route('site.items')}}">
                                                <i class="fa fa-pencil-square-o"></i>
                                                My Items
                                            </a>
                                        </li>
                                        <li class="@if(Request::route()->getName()=='site.wishlist' ) {{'active'}} @endif">
                                            <a href="{{route('site.wishlist')}}">
                                                <i class="fa fa-heart"></i>
                                                My Wishlist
                                            </a>
                                        </li>
                                    </ul><!--End account-sidebar-->
                                </div>
                            </div><!--End Filter-box-->

                        </div><!--End Filter-box-body-->
                    </div><!--End Filter-box-->
                </div><!--End Col-sm-3-->
                <div class="col-md-9">
                    <div class="filter-section">
                        <div class="filter-section-head">
                            <h4 class="title text-left">My info</h4>
                        </div><!--End Filter-box-head-->
                    </div><!--End Filter-section-->

                        <div class="alert alert-success hidden" id="contact-alert-success">
                            Your data has been updated successfully
                        </div>
                        <div class="alert alert-danger hidden" id="contact-alert-error">
                            Error ! please try again later
                        </div>

                        <div class="row">
                            
                            <div class="form-group col-md-5 col-sm-6">
                                <label>first name</label>
                                <input class="form-control" name="f_name" value="{{auth()->guard('members')->user()->f_name}}" type="text">
                            </div>

                            <div class="form-group col-md-5 col-sm-6">
                                <label>last name</label>
                                <input class="form-control" name="l_name" value="{{auth()->guard('members')->user()->l_name}}" type="text">
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5 col-sm-6">
                                <label>email address</label>
                                <input class="form-control" type="email" name="email" value="{{auth()->guard('members')->user()->email}}" >
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5 col-sm-6">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" >
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5 col-sm-6">
                                <label>phone number</label>
                                <input class="form-control" name="phone" value="{{auth()->guard('members')->user()->phone}}" type="text">
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5">
                                <label>home address</label>
                                <input class="form-control" name="address" value="{{auth()->guard('members')->user()->address}}" type="text">
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5">
                                <label>facebook</label>
                                <input class="form-control" name="facebook" value="{{auth()->guard('members')->user()->facebook}}" type="text">
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5">
                                <label>google</label>
                                <input class="form-control" name="google" value="{{auth()->guard('members')->user()->google}}" type="text">
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5">
                                <label>twitter</label>
                                <input class="form-control" name="twitter" value="{{auth()->guard('members')->user()->twitter}}" type="text">
                            </div><!--End Form-group-->

                            <div class="form-group col-md-5">
                                <label>Bio</label>
                                <input class="form-control" name="information" value="{{auth()->guard('members')->user()->information}}" type="text">
                            </div><!--End Form-group-->
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-5 col-sm-6 ">
                                <button class="btn-submit" type="submit">edit</button>
                            </div>
                        </div><!--End Row-->

                </div><!--End Col-sm-9-->


            </div><!--End Row-->
        </div><!--End Container-->

    </div><!--End page-content-->
    </form><!--End Booking-Form-->
@endsection