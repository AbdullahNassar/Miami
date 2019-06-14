<div class="row">
    @foreach($items as $item)
        <div class="col-xs-4">
            <div class="widget-box">
                <div class="widget-img">
                    <img class="" src="{{asset('storage/uploads/trips/' . $item->trips()->images()->first()->name)}}">
                </div><!--End Widget-img-->
                <div class="widget-cont">
                    <div class="widget-icons">
                        <div class="icon-item">
                            <i class="fa fa-heart"></i>
                            <span class="number">
                            {{count($item)}}
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
                            <h3 class="title">{{$item->trips()->translated()->name}}</h3>
                            <p>{!! substr($item->trips()->translated()->details,0,100) !!}</p>
                        </div>
                        <div class="price-button-wrap">
                            <div class="widget-butons">
                                <a class="custom-btn active" href="{{route('booking',['slug'=>$item->trips()->translated()->slug])}}">book now</a>
                                <a class="custom-btn" href="{{route('site.trips.one-trip',['slug'=>$item->trips()->translated()->slug])}}">view details</a>
                            </div><!--End Widget buttons-->
                        </div>
                    </div><!--End widget-cont-main-->
                </div><!--End Widget-cont-->
            </div><!--End Widget-box-->
        </div><!--End Col-xs-12-->
    @endforeach
</div>