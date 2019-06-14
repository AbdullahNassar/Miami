@extends('site.layouts.master')
@section('title')
    {{$settings->name}} | {{trans('home_name')}}
@endsection
@section('content')
<section class="section-lg no-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-7 col-sm-6">
                <div class="section-description padding-top-50">
                    <h2 class="section-title">
                        {{$static_data->home_about->title}}
                    </h2>
                    <p>
                        {{$static_data->home_about->content}}
                    </p>
                    <div class="call-us">
                        <i class="fa fa-phone"></i>
                        {{trans('site.call_us_now')}} :
                        <span class="number">{{$settings->phone1}}</span>
                    </div>
                </div><!--End Section description-->
            </div><!--End Col-md-5-->
            <div class="col-lg-3 col-md-5 col-sm-6">
                <div class="serch-box">
                    <div class="serch-box-head">
                        <div class="head-icon">
                            <img src="{{asset('assets/site/images/earth.png')}}">
                        </div>
                        <div class="serch-box-title">
                            <h3>{{trans('site.search_now')}}</h3>
                            <p>{{trans('site.perfect_tours')}}</p>
                        </div>
                    </div>
                    <div class="serch-box-body">
                        <form class="form" method="GET" action="{{action('Site\SearchController@getPlaceSearch')}}">
                            <div class="form-group">
                                <select class="menu-select" name="location_id">
                                   @foreach($places as $place)
                                        <option value="{{$place->place_id}}">{{$place->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="menu-select" name="category_id">
                                    @foreach($allCategories as $category)
                                        <option value="{{$category->id}}">{{$category->translated()->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn-submit">
                                {{trans('site.search')}}
                            </button>
                        </form>
                    </div>
                </div><!--End Search-box-->
            </div><!--End Col-md-4-->
        </div><!--End Row-->
    </div><!--End Container-->
</section><!--End Section Search-box-->

<!-- for day cruises-->
@foreach($mains_cats as $main_catsData)
    @if(strtolower($main_catsData->slug) =='day-cruises')
        <section class="section-lg has-background">
            <div class="container">
                <div class="row">
                    @foreach($main_catsData->childs as $sub)

                        <div class="col-md-6">
                            <div class="section-description">
                                <a class="section-title" href="{{route('site.category',['slug'=>$sub->translated()->slug])}}">
                                    {{$sub->translated()->name}}
                                </a>

                            </div><!--End Section description-->
                            <div class="row">
                                @foreach($sub->master_trip->take(2) as $trip)
                                    <div class="col-md-6">
                                        <div class="widget-box style-widget-block">
                                            <div class="widget-img">
                                                <img class=""
                                                     src="{{asset('storage/uploads/trips/' . $trip->images()->first()->name)}}">
                                            </div><!--End Widget-img-->
                                            <div class="widget-cont">
                                                <div class="widget-icons">
                                                    <div class="icon-item">
                                                           <span class="number">
                                                               {{--{{App\Wishlist::where('trip_id', $trip->id)->count()}}--}}
                                                           </span>
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="icon-item">
                                                        <i class="fa fa-eye"></i>
                                                        <span class="number">
                                                               240
                                                           </span>
                                                    </div>
                                                </div><!--End Icons-->
                                                <div class="widget-cont-main">
                                                    <div class="widget-cont-title">
                                                        <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                            {{$trip->translated()->name}}
                                                        </a></h3>
                                                        <p>
                                                            {!! substr($trip->translated()->desc, 0, 100) !!}
                                                        </p>
                                                    </div>
                                                    <div class="widget-info">
                                                        <div class="info-item">
                                                            <i class="fa fa-map-marker"></i>
                                                            <span class="name">{{trans('site.Date')}}</span>
                                                            <span class="value">mon,jan26,2017</span>
                                                        </div><!--End info-item-->
                                                        <div class="info-item">
                                                            <i class="fa fa-map-marker"></i>
                                                            <span class="name">{{trans('site.Date')}}</span>
                                                            <span class="value">mon,jan26,2017</span>
                                                        </div><!--End info-item-->
                                                        <div class="info-item">
                                                            <i class="fa fa-map-marker"></i>
                                                            <span class="name">{{trans('site.Date')}}</span>
                                                            <span class="value">mon,jan26,2017</span>
                                                        </div><!--End info-item-->
                                                    </div><!--End Widget-Info-->
                                                    <div class="price-button-wrap">
                                                        <div class="widget-cont-price">
                                                            <p class="price">
                                                            <span class="price-num">
                                                                @if(\App\Price::where('trip_id' ,$trip->id)->value('e_adult') != null)
                                                                  From  ${{App\Price::select('e_adult')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('e_adult')}}
                                                                @else
                                                                 From   ${{App\Price::select('e_after')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('e_after')}}
                                                                @endif
                                                            </span>
                                                        
                                                            </p>
                                                        </div><!--End Widget-cont-price-->
                                                        <div class="review">
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="review-num">270 reviews</span>
                                                        </div><!--End Review-->
                                                        <div class="widget-butons">
                                                            <a class="custom-btn active"
                                                               href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">{{trans('site.book_now')}}</a>
                                                            <a class="custom-btn view"
                                                               href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">{{trans('site.view_details')}}</a>
                                                        </div><!--End Widget buttons-->

                                                    </div><!--End price-button-wrap-->
                                                </div><!--End widget-cont-main-->
                                            </div><!--End Widget-cont-->
                                        </div><!--End Widget-box-->
                                    </div><!--End Col-md-6-->
                                @endforeach
                            </div><!--End Row-->
                        </div><!--End col-md-6-->
                    @endforeach
                </div><!--End Row-->
            </div><!--End Container-->
        </section><!--End Section OfWidget-box-->
    @endif

    @if($main_catsData->slug =='CRUISE-HOTEL')
        <section class="section-lg">
            <div class="container">
                @foreach($main_catsData->childs as $sub)
                    @if(strtoupper($sub->translated()->slug) == 'CRUISE-HOTEL-TO-FREEPORT-GRAND-BAHAMAS-ISLAND')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-description">

                                    <a class="section-title" href="{{route('site.category',['slug'=>$sub->translated()->slug])}}">
                                        {{$sub->translated()->name}}
                                    </a>
                                </div><!--End Section description-->
                            </div><!--End col-md-6-->
                        </div><!--End Row-->

                        <div class="row">
                            @foreach($sub->master_trip->take(3) as $trip)
                                <div class="col-md-4">
                                    <div class="widget-box">
                                        <div class="widget-img">
                                            <img class="" src="{{asset('storage/uploads/trips/' . $trip->images()->first()->name)}}">
                                        </div><!--End Widget-img-->
                                        <div class="widget-cont">
                                            <div class="widget-icons">
                                                <div class="icon-item">
                                                    <i class="fa fa-heart"></i>
                                                    <span class="number">
                                                           @if(count($trip->countWishlist) > 0)
                                                                {{count($trip->countWishlist)}}
                                                            @else
                                                                0
                                                            @endif
                                                </span>

                                                </div>

                                                <div class="icon-item">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="number">
                                                   240
                                               </span>
                                                </div>
                                            </div><!--End Icons-->
                                            <div class="widget-cont-main">
                                                <div class="widget-cont-title">

                                                    <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                       {{$trip->translated()->name}}
                                                    </a></h3>
                                                </div>
                                                <div class="widget-info">
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                </div><!--End Widget-Info-->
                                                <div class="price-button-wrap">
                                                    <div class="widget-cont-price">
                                                        <p class="price">
                                                            <span class="price-num">
                                                              From  ${{App\HotelPrice::select('double2day')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('double2day')}}
                                                            </span>
                            
                                                        </p>
                                                    </div><!--End Widget-cont-price-->
                                                    <div class="review">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="review-num">270 {{trans('site.reviews')}}</span>
                                                    </div><!--End Review-->
                                                    <div class="widget-butons">
                                                        <a class="custom-btn active"
                                                           href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">{{trans('site.book_now')}}</a>
                                                        <a class="custom-btn view"
                                                           href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">{{trans('site.view_details')}}</a>
                                                    </div><!--End Widget buttons-->
                                                </div>
                                            </div><!--End widget-cont-main-->
                                        </div><!--End Widget-cont-->
                                    </div><!--End Widget-box-->
                                </div><!--End Col-md-4-->
                            @endforeach
                        </div><!--End Row-->
                    @elseif(strtoupper($sub->translated()->slug) == 'CRUISE-HOTEL-TO-HILTON-RESORT-BIMINI')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-description">
                                    <a class="section-title" href="{{route('site.category',['slug'=>$sub->translated()->slug])}}">
                                        {{$sub->translated()->name}}
                                    </a>
                                </div><!--End Section description-->
                            </div><!--End col-md-12-->
                            @foreach($sub->master_trip->take(2) as $trip)
                                <div class="col-md-6">
                                    <div class="widget-box style-widget-3">
                                        <div class="widget-img">
                                            <img class="" src="{{asset('storage/uploads/trips/' . $trip->images()->first()->name)}}">
                                        </div><!--End Widget-img-->
                                        <div class="widget-cont">
                                            <div class="widget-icons">
                                                <div class="icon-item">
                                                    <i class="fa fa-heart"></i>
                                                    <span class="number">
{{--                                                           {{App\Wishlist::where('trip_id', $trip->id)->count()}}--}}
                                                </span>
                                                </div>
                                                <div class="icon-item">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="number">
                                                   240
                                               </span>
                                                </div>
                                            </div><!--End Icons-->
                                            <div class="widget-cont-main">
                                                <div class="widget-cont-title">

                                                    <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                        {{$trip->translated()->name}}
                                                    </a></h3>
                                                    
                                                </div>
                                                <div class="widget-info">
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                </div><!--End Widget-Info-->
                                                <div class="price-button-wrap">
                                                    <div class="widget-cont-price">
                                                        <p class="price">
                                                            <span class="price-num">
                                                               From  ${{App\HotelPrice::select('double2day')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('double2day')}}
                                                            </span>
                                                            
                                                        </p>
                                                    </div><!--End Widget-cont-price-->
                                                    <div class="review">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="review-num">270 {{trans('site.reviews')}}</span>
                                                    </div><!--End Review-->
                                                    <div class="widget-butons">
                                                        <a class="custom-btn active"
                                                           href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">book
                                                            now</a>
                                                        <a class="custom-btn view"
                                                           href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">view
                                                            details</a>
                                                    </div><!--End Widget buttons-->
                                                </div>
                                            </div><!--End widget-cont-main-->
                                        </div><!--End Widget-cont-->
                                    </div><!--End Widget-box-->
                                </div><!--End Col-md-6-->
                            @endforeach
                        </div><!--End Row-->
                    @endif

                @endforeach
            </div><!--End Container-->
        </section><!--End Section style-widget-2-->
    @endif
@endforeach

<section class="book-now">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="book-now-img">
                    <img
                    src="{{url('storage/uploads/statics/' .$static_data->home_journey->image)}}">

                </div>
            </div><!--End Col-sm-5-->
            <div class="col-md-7">
                <div class="book-now-cont">
                    <h4 class="book-now-cont-title">{{$static_data->home_journey->title}}</h4>
                    <div class="text">
                        <p class="text-to-book">
                           {{$static_data->home_journey->content}} <span class="phone-number">{{$settings->phone1}}</span> <span class="phone-number">{{$settings->phone2}}</span>
                           </p>
                    </div>
                </div><!--End Book-now-cont-->
            </div><!--End Col-sm-7-->
        </div><!--End Row-->
    </div><!--End Container-->
</section><!--End Book-Now-->

<!-- for two nights cruises-->
@foreach($mains_cats as $main_catsData)
    @if(strtolower($main_catsData->slug) =='two-night')
        <section class="section-lg has-background">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-description">
                            <a class="section-title" href="{{route('site.category',['slug'=>$main_catsData->translated()->slug])}}">
                                {{trans('site.2_NIGHT_CRUISE_TO_GRAND_BAHAMAS')}}
                            </a>
                        </div><!--End Section description-->
                    </div><!--End col-md-6-->
                </div><!--End Row-->
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            @foreach($main_catsData->master_trip as $key=>$trip)
                            @if($key <=1 )
                                <div class="col-xs-12">
                                    <div class="widget-box style-widget-block">
                                        <div class="widget-img">
                                            <img class="" src="{{asset('storage/uploads/trips/' . $trip->images[0]->name)}}">

                                        </div><!--End Widget-img-->
                                        <div class="widget-cont">
                                            <div class="widget-icons">
                                                <div class="icon-item">
                                                    <i class="fa fa-heart"></i>
                                                    <span class="number">
                                                               {{--{{App\Wishlist::where('trip_id', $trs->master_trip[0]->id)->count()}}--}}
                                                           </span>

                                                </div>
                                                <div class="icon-item">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="number">
                                                               240
                                                           </span>
                                                </div>
                                            </div><!--End Icons-->
                                            <div class="widget-cont-main">
                                                <div class="widget-cont-title">

                                                    <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                            {{$trip->translated()->name}}
                                                    </a></h3>
                                                    
                                                </div>
                                                <div class="widget-info">
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                </div><!--End Widget-Info-->
                                                <div class="price-button-wrap">
                                                    <div class="widget-cont-price">
                                                        <p class="price">
                                                            <span class="price-num">From $ {{App\CabinePrice::select('second')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('second')}}</span>
                                                
                                                        </p>
                                                    </div><!--End Widget-cont-price-->
                                                    <div class="review">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="review-num">270 {{trans('site.reviews')}}</span>
                                                    </div><!--End Review-->
                                                    <div class="widget-butons">
                                                        <a class="custom-btn active"
                                                           href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">{{trans('site.book_now')}}</a>
                                                        <a class="custom-btn view"
                                                       href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">{{trans('site.view_details')}}</a>
                                                    </div><!--End Widget buttons-->
                                                </div><!--End price-button-wrap-->
                                            </div><!--End widget-cont-main-->
                                        </div><!--End Widget-cont-->
                                    </div><!--End Widget-box-->
                                </div><!--End Col-xs-12-->
                            @endif
                            @endforeach
                        </div><!--End Row-->
                    </div><!--End Col-md-4-->
                    <div class="col-md-6">
                        <div class="widget-box style-widget-block lg-display">
                            <div class="widget-img">
                                <img class=""
                                     src="{{asset('storage/uploads/trips/2nightTrip.jpg')}}">
                            </div><!--End Widget-img-->
                            <div class="widget-cont">
                                <div class="widget-icons">
                                    <div class="icon-item">
                                        <i class="fa fa-heart"></i>
                                        <span class="number">
                                           25
                                        </span>
                                    </div>
                                    <div class="icon-item">
                                        <i class="fa fa-eye"></i>
                                        <span class="number">
                                           240
                                        </span>
                                    </div>
                                </div><!--End Icons-->
                                <div class="widget-cont-main">
                                    <div class="widget-cont-title">
                                        <a class="title" href="{{route('site.category',['slug'=>'two-night'])}}">
                                        {{trans('site.2_NIGHT_CRUISE_TO_GRAND_BAHAMAS')}}</a>
                                        <p>

                                        </p>
                                    </div>
                                    <div class="widget-info">
                                        <div class="info-item">
                                            <i class="fa fa-map-marker"></i>
                                            <span class="name">{{trans('site.Date')}}</span>
                                            <span class="value">mon,jan26,2017</span>
                                        </div><!--End info-item-->
                                        <div class="info-item">
                                            <i class="fa fa-map-marker"></i>
                                            <span class="name">{{trans('site.Date')}}</span>
                                            <span class="value">mon,jan26,2017</span>
                                        </div><!--End info-item-->
                                        <div class="info-item">
                                            <i class="fa fa-map-marker"></i>
                                            <span class="name">{{trans('site.Date')}}</span>
                                            <span class="value">mon,jan26,2017</span>
                                        </div><!--End info-item-->
                                    </div><!--End Widget-Info-->
                                    <div class="price-button-wrap">
                                        <div class="widget-butons">
                                            <a class="custom-btn view"
                                               href="{{route('site.category',['slug'=>'two-night'])}}">{{trans('site.view_details')}}</a>
                                        </div><!--End Widget buttons-->
                                    </div><!--End price-button-wrap-->
                                </div><!--End widget-cont-main-->
                            </div><!--End Widget-cont-->
                        </div><!--End Widget-box-->
                    </div><!--End Col-md-4-->
                    <div class="col-md-3">
                        <div class="row">
                            @foreach($main_catsData->master_trip as $key=>$trip)
                            @if($key >1 && $key<=3)
                                <div class="col-xs-12">
                                    <div class="widget-box style-widget-block">
                                        <div class="widget-img">
                                            <img class="" src="{{asset('storage/uploads/trips/' . $trip->images[0]->name)}}">

                                        </div><!--End Widget-img-->
                                        <div class="widget-cont">
                                            <div class="widget-icons">
                                                <div class="icon-item">
                                                    <i class="fa fa-heart"></i>
                                                    <span class="number">
                                                               {{--{{App\Wishlist::where('trip_id', $trs->master_trip[0]->id)->count()}}--}}
                                                           </span>

                                                </div>
                                                <div class="icon-item">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="number">
                                                               240
                                                           </span>
                                                </div>
                                            </div><!--End Icons-->
                                            <div class="widget-cont-main">
                                                <div class="widget-cont-title">

                                                    <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                            {{$trip->translated()->name}}
                                                    </a></h3>
                                                
                                                </div>
                                                <div class="widget-info">
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                </div><!--End Widget-Info-->
                                                <div class="price-button-wrap">
                                                    <div class="widget-cont-price">
                                                        <p class="price">
                                                            <span class="price-num">From  ${{App\CabinePrice::select('second')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('second')}}</span>
                                            
                                                        </p>
                                                    </div><!--End Widget-cont-price-->
                                                    <div class="review">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="review-num">270 {{trans('site.reviews')}}</span>
                                                    </div><!--End Review-->
                                                    <div class="widget-butons">
                                                        <a class="custom-btn active"
                                                           href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">{{trans('site.book_now')}}</a>
                                                        <a class="custom-btn view"
                                                           href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">{{trans('site.view_details')}}</a>
                                                    </div><!--End Widget buttons-->
                                                </div><!--End price-button-wrap-->
                                            </div><!--End widget-cont-main-->
                                        </div><!--End Widget-cont-->
                                    </div><!--End Widget-box-->
                                </div><!--End Col-xs-12-->
                            @endif
                            @endforeach
                        </div><!--End Row-->
                    </div><!--End Col-md-4-->
                </div><!--End Row-->
            </div><!--End Container-->
        </section>
    @endif
@endforeach

<!-- for car rentals-->
@foreach($mains_cats as $main_catsData)
    @if(strtolower($main_catsData->slug) =='car-rental')
        <section class="section-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                    </div><!--End col-md-6-->
                </div><!--End Row-->
                <div class="row">
                    @foreach($main_catsData->childs->take(2) as $sub)
                        <div class="col-md-6">
                            <div class="section-description">
                                <a class="section-title" href="{{route('site.category',['slug'=>$sub->translated()->slug])}}">
                                    {{$sub->translated()->name}}
                                </a>
                            </div><!--End Section description-->
                            @foreach($sub->master_trip->take(3) as $trip)
                                <div class="widget-box style-widget-3">
                                    <div class="widget-img">
                                        <img class=""
                                             src="{{asset('storage/uploads/trips/' . $trip->images()->first()->name )}}">
                                    </div><!--End Widget-img-->
                                    <div class="widget-cont">
                                        <div class="widget-icons">
                                            <div class="icon-item">
                                                   <span class="number">
                                                        {{--{{App\Wishlist::where('trip_id', $trip->id)->count()}}--}}
                                                    </span>
                                                <i class="fa fa-heart"></i>
                                            </div>
                                            <div class="icon-item">
                                                <i class="fa fa-eye"></i>
                                                <span class="number">
                                                       240
                                                   </span>
                                            </div>
                                        </div><!--End Icons-->
                                        <div class="widget-cont-main">
                                            <div class="widget-cont-title">

                                                 <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                            {{$trip->translated()->name}}
                                                        </a></h3>
                                                
                                            </div>
                                            <div class="widget-info">
                                                <div class="info-item">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span class="name">{{trans('site.Date')}}</span>
                                                    <span class="value">mon,jan26,2017</span>
                                                </div><!--End info-item-->
                                                <div class="info-item">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span class="name">{{trans('site.Date')}}</span>
                                                    <span class="value">mon,jan26,2017</span>
                                                </div><!--End info-item-->
                                                <div class="info-item">
                                                    <i class="fa fa-map-marker"></i>
                                                    <span class="name">{{trans('site.Date')}}</span>
                                                    <span class="value">mon,jan26,2017</span>
                                                </div><!--End info-item-->
                                            </div><!--End Widget-Info-->
                                            <div class="price-button-wrap">
                                                <div class="widget-cont-price">
                                                    <p class="price">
                                                        <span class="price-num"> @if(\App\CarPrice::where('trip_id' ,$trip->id)->value('e_price') != null)
                                                           From ${{App\CarPrice::select('e_price')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('e_price')}}
                                                        @else
                                                           From ${{\App\CarPrice::select('b_price')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('b_price')}}
                                                        @endif
                                                             </span>
                                                       
                                                    </p>
                                                </div><!--End Widget-cont-price-->
                                                <div class="review">
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="review-num">270 reviews</span>
                                                </div><!--End Review-->
                                                <div class="widget-butons">
                                                    <a class="custom-btn active"
                                                       href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">{{trans('site.book_now')}}</a>
                                                    <a class="custom-btn view"
                                                       href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">{{trans('site.view_details')}}</a>
                                                </div><!--End Widget buttons-->
                                            </div><!--End price-button-wrap-->
                                        </div><!--End widget-cont-main-->
                                    </div><!--End Widget-cont-->
                                </div><!--End Widget-box-->
                            @endforeach
                        </div><!--End Col-md-6-->
                    @endforeach
                </div><!--End Row-->
            </div><!--End Container-->
        </section>
    @endif
@endforeach

<!-- for tours-->
@foreach($mains_cats as $main_catsData)
    @if(strtolower($main_catsData->slug) =='tours')
        @foreach($main_catsData->childs as $sub)
            @php
                $trips = \App\Trip::where('cat_id' ,$sub->id)->get();
            @endphp
                <section class="section-lg has-background">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-description">
                                    <a class="section-title"
                                    href="{{route('site.category',['slug'=>$sub->translated()->slug])}}">
                                           {{strtoupper($sub->translated()->name)}}
                                    </a>
                                </div><!--End Section description-->
                            </div><!--End col-md-6-->
                        </div><!--End Row-->
                        <div class="row">
                            @foreach($trips as $trip)
                                <div class="col-md-3">
                                    <div class="widget-box style-widget-block">
                                        <div class="widget-img">
                                            <img class=""
                                                 src="{{ asset('storage/uploads/trips/' . $trip->images[0]->name) }}">
                                        </div><!--End Widget-img-->
                                        <div class="widget-cont">
                                            <div class="widget-icons">
                                                <div class="icon-item">
                                       <span class="number">
                                          {{--App\Wishlist::where('trip_id', $trip->id)->count()--}}
                                       </span>
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                                <div class="icon-item">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="number">
                                           240
                                       </span>
                                                </div>
                                            </div><!--End Icons-->
                                            <div class="widget-cont-main">
                                                <div class="widget-cont-title">
                                                    <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">
                                                            {{$trip->translated()->name}}
                                                        </a></h3>
                                                    
                                                </div>
                                                <div class="widget-info">
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                    <div class="info-item">
                                                        <i class="fa fa-map-marker"></i>
                                                        <span class="name">{{trans('site.Date')}}</span>
                                                        <span class="value">mon,jan26,2017</span>
                                                    </div><!--End info-item-->
                                                </div><!--End Widget-Info-->
                                                <div class="price-button-wrap">
                                                    <div class="widget-cont-price">
                                                        <p class="price">
                                                            <span class="price-num">
                                                       From  ${{App\Tour::select('adult')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('adult')}}
                                                            </span>

                                                    
                                                        </p>
                                                    </div><!--End Widget-cont-price-->
                                                    <div class="review">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="review-num">270 {{trans('site.reviews')}}</span>
                                                    </div><!--End Review-->
                                                 <div class="widget-butons">
                                                    <a class="custom-btn active"
                                                       href="{{route('booking', ['slug'=>$trip->translated()->slug])}}">{{trans('site.book_now')}}</a>
                                                    <a class="custom-btn view"
                                                       href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">{{trans('site.view_details')}}</a>
                                                </div><!--End Widget buttons-->

                                                </div><!--End price-button-wrap-->
                                            </div><!--End widget-cont-main-->
                                        </div><!--End Widget-cont-->
                                    </div><!--End Widget-box-->
                                </div><!--End Col-md-3-->
                            @endforeach
                        </div>
                    </div><!--End Container-->
                </section><!--End Section-->
        @endforeach
    @endif
@endforeach
<section class="section-lg has-background">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-description">
                    <a class="section-title" href="http://www.admiralbusline.com/">
                        {{trans('site.Tarnsportaion_services')}}
                    </a>
                </div><!--End Section description-->
            </div><!--End col-md-6-->
            <div class="col-xs-12">
                <div class="img-wrapper">
                    <img class=""
                         src="{{asset('storage/uploads/logo/last-section.PNG')}}">
                </div>
            </div><!--End Col-xs-12-->
        </div><!--End Row-->
    </div><!--End container-->
</section><!--End Section-->
</div><!--End page-content-->


@endsection