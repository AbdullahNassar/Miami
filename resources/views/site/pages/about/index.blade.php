@extends('site.layouts.master')
@section('title')
    About Us
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
        </div>
    </section><!--End Welcome-Home-->
    <div class="page-content">
    <section class="section-lg no-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-6">
                    <div class="section-description padding-top-60">
                        <h2 class="section-title">
                            {{$about->title}}
                        </h2>
                        <p>
                            {!! $about->content !!}
                        </p>
                        <div class="call-us">
                            <i class="fa fa-phone"></i> 
                            call us now :
                            <span class="number">{{$settings->phone1}}</span>
                        </div>
                    </div><!--End Section description-->
                </div><!--End Col-md-5-->
                <div class="col-lg-4 col-md-5 col-sm-6">
                    <div class="padding-top-60">
                        <img src="{{url('storage/uploads/about/' . $about->image)}}">
                    </div>
                </div><!--End Col-md-5-->
            </div><!--End Row-->
        </div><!--End Container-->
    </section><!--End Section Search-box-->

    <!--Section Features-->
    <section class="section-settings sec-features has-background">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="col-md-10">

                        <div class="section-description">
                                <h2 class="section-title">
                                  {{$static_data->about_header->title}}
                                </h2>
                                <p>
                                    {{$static_data->about_header->content}}
                                </p>
                            </div><!--End Section description-->

                    </div><!--End col-md-6-->
                    <div class="spacer-30"></div>
                    @foreach($details as $detail)
                        <div class="col-md-6">
                            <div class="feat-box">
                                <div class="feat-icon active">
                                    <i class="fa {{$detail->master['icon']}}"></i>
                                </div><!--End Feat-icon-->
                                <div class="feat-cont">
                                    <h4 class="feat-title">{{$detail->title}}</h4>
                                    <p class="custom-p">
                                        {{$detail->content}}
                                    </p>
                                </div><!--End Feat-content-->
                            </div><!--End Feat-Box-->
                        </div><!--End Col-md-6-->
                    @endforeach

                </div><!--End Col-md-8-->
                <div class="col-md-4 hidden-xs">

                        <div class="feat-img">
                            <img src="{{asset('assets/site/images/about-us.png')}}"/>
                        </div>
                </div><!--End Col-md-4-->
            </div><!--End Row-->
        </div><!--End Container-->
    </section><!--End Section Fof Features-->


    <section class="section-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-7">

                        <div class="section-description">
                            <h2 class="section-title">
                                {{$static_data->about_footer->title}}
                            </h2>
                            <p>
                                {{$static_data->about_footer->content}}
                            </p>
                        </div><!--End Section description-->
                </div><!--End col-md-6-->
            </div>
            <div class="spacer-30"></div>
            <div class="row">
                <div class="col-xs-12 testmonials">
                    <div id="testmonials-carousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($testmonials as $index=>$test)
                                <li data-target="#testmonials-carousel" data-slide-to="{{$index}}"
                                    class="@if($index == 0) {{'active'}}@endif"></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($testmonials as $index=>$test)
                                <div class="item @if($index == 0){{'active'}}@endif">
                                    <div class="test">
                                        <h3 class="test-title">
                                            {{$test->title}}
                                        </h3>
                                        <p>
                                            {{$test->content}}
                                        </p>
                                    </div>
                                    <div class="client">
                                        <div class="client-img">
                                            <img src="{{url('storage/uploads/testmonial/'.$test->master['image'])}}">
                                        </div>
                                        <div class="client-info">
                                            <h5 class="client-name">{{$test->name}}</h5>
                                            <span class="client-address">{{$test->address}}</span>
                                        </div>
                                    </div>
                                </div><!--End Item-->
                            @endforeach
                        </div><!--End carousel-inner-->
                    </div><!--End Slider-->
                </div><!--End Testmonials-->
            </div><!--End Row-->
        </div><!--End Container-->
    </section><!--End Section Testmonials-->
    </div><!--End page-content-->
@endsection