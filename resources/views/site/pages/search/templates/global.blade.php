<div class="row">
    @if(sizeof($result) < 1)

        <div class="alert alert-block" role="alert">
            <p>No Result Found</p>
        </div>

    @else
    @foreach($result as $trip)
        <div class="col-xs-4">
            <div class="widget-box" style="min-height: 600px;">
                <div class="widget-img">
                    <img class="" src="{{url('storage/uploads/trips/'.\App\Image::where('imageable_id' ,$trip->trip_id)->value('name'))}}">
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
                            <h3 class="title"><a href="{{route('site.trips.one-trip',['slug'=>$trip->slug])}}">
                                    {{$trip->name}}
                                </a></h3>
                            <p>{!! substr($trip->desc,0,90)!!}</p>
                        </div>
                        <div class="price-button-wrap">

                            <div class="widget-butons">
                                <a class="custom-btn active" href="{{route('booking',['slug'=>$trip->slug])}}">book now</a>
                                <a class="custom-btn" href="{{route('site.trips.one-trip',['slug'=>$trip->slug])}}">view details</a>
                            </div><!--End Widget buttons-->
                        </div>
                    </div><!--End widget-cont-main-->
                </div><!--End Widget-cont-->
            </div><!--End Widget-box-->
        </div><!--End Col-xs-12-->
    @endforeach
        @endif
</div><!--End Row-->