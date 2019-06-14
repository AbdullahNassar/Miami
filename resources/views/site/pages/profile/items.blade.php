@extends('site.layouts.master')
@section('title')
    Own Trips
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
        </div>
    </section><!--End Welcome-Home-->

    <div class="page-content section-lg">
        <div class="container">

            <div class="row">
                <div class="col-sm-3">
                    <div class="filter-section">
                        <div class="filter-section-head">
                            <h4 class="title">My Items</h4>
                        </div><!--End Filter-box-head-->
                        <div class="filter-section-body">
                            <div class="filter-box">
                                <div class="">
                                    <ul class="account-sidebar">
                                        <li class="account-img">
                                            @if(auth()->guard('members')->user()->image != null)
                                                <img src="{{url('storage/uploads/avatars/'.auth()->guard('members')->user()->image)}}">
                                            @else
                                                <img src="http://knowledge-commons.com/static/assets/images/avatar.png">
                                            @endif
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
                    <div class="">

                    </div><!--End wihte-box-->
                </div><!--End Col-sm-3-->
                <form action="{{$base_url}}">
                    <div class="col-md-9">
                        <div class="filter-section">
                            <div class="filter-section-head">
                                <div class="pull-left">
                                    <div class="form-group-inline">
                                        <span class="sortby"> Sort by :</span>
                                    </div>

                                    <div class="form-group-inline cat-head-select">
                                        <select class="" name="name" id="menu-name">
                                            <option>Name</option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>
                                    <div class="form-group-inline cat-head-select">
                                        <select class="" name="price" id="menu-price">
                                            <option>Price</option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="pull-right">
                                    <a class="list">
                                        <i class="fa fa-th-list"></i>
                                    </a>
                                    <a class="grid active">
                                        <i class="fa fa-th"></i>
                                    </a>
                                    <a class="block ">
                                        <i class="fa fa-th-large"></i>
                                    </a>
                                </div>
                            </div><!--End Filter-box-head-->
                        </div><!--End Filter-section-->

                        <div id="products-area">
                            @include('site.pages.profile.templates.items',compact('items'))
                        </div>
                    </div><!--End Col-sm-9-->
                </form>

            </div><!--End Row-->

        </div><!--End Container-->

    </div><!--End page-content-->
@endsection