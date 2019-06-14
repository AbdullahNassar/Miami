<div class="row">
    @if(sizeof($trips) < 1)

        <div class="alert alert-block" role="alert">
            <p>No trips Found</p>
        </div>

    @else
        @foreach($trips as $trip)
            <div class="col-xs-4">
                <div class="widget-box" style="min-height: 600px;">
                    <div class="widget-img">
                        <img class="" src="{{url('storage/uploads/trips/'.\App\Image::where('imageable_id' ,$trip->id)->value('name'))}}">
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
                                <p>{!! substr($trip->translated()->desc,0,90)!!}</p>
                            </div>
                            <div class="price-button-wrap">
                                <div class="widget-cont-price">
                                    <p class="price">
                                        <span class="price-num">$
                                            @if(\App\Price::where('trip_id' ,$trip->id)->value('e_adult') != null)
                                                {{App\Price::select('e_adult')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('e_adult')}}
                                            @else
                                                {{App\Price::select('e_after')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('e_after')}}
                                            @endif
                                            @if(App\HotelPrice::select('double2day')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('double2day') != null)
                                                {{App\HotelPrice::select('double2day')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('double2day')}}
                                            @endif
                                            @if(App\CabinePrice::select('second')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('second') != null)
                                                {{App\CabinePrice::select('second')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('second')}}
                                            @endif
                                            @if(\App\CarPrice::where('trip_id' ,$trip->id)->value('e_price') != null)
                                                {{App\CarPrice::select('e_price')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('e_price')}}
                                            @else
                                                {{\App\CarPrice::select('b_price')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('b_price')}}
                                            @endif
                                            @if(App\Tour::select('adult')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('adult') != null)
                                                {{App\Tour::select('adult')->where('trip_id' , $trip->id)->whereDate('date', '=', Carbon\Carbon::today())->value('adult')}}
                                            @endif
                                        </span>
                                    </p>
                                </div><!--End Widget-cont-price-->
                                <div class="widget-butons">
                                    <a class="custom-btn active" href="{{route('booking',['slug'=>$trip->translated()->slug])}}">book now</a>
                                    <a class="custom-btn" href="{{route('site.trips.one-trip',['slug'=>$trip->translated()->slug])}}">view details</a>
                                </div><!--End Widget buttons-->
                            </div>
                        </div><!--End widget-cont-main-->
                    </div><!--End Widget-cont-->
                </div><!--End Widget-box-->
            </div><!--End Col-xs-12-->
        @endforeach
    @endif
</div><!--End Row-->