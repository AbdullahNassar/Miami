<div class="row">
    @foreach($wishlists as $wish)

    <div class="col-xs-4 " id="ajax-elem-{{$wish->id}}">
        <div class="widget-box">
            <div class="widget-img">
                <img class="" src="{{url('storage/uploads/trips/'.$wish->trips()->images[0]->name)}}">
            </div><!--End Widget-img-->
            <div class="widget-cont">
                <div class="widget-icons">
                    <div class="icon-item">
                        <i class="fa fa-heart"></i>
                        <span class="number">
                            {{count($wish)}}
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
                        <h3 class="title">{{$wish->trips()->translated()->name}}</h3>
                        <p>{!! substr($wish->trips()->translated()->details,0,100) !!}</p>
                    </div>
                    <div class="icon-item">
                        <button class="btn aj-delete"  type="submit" data-token="{{ csrf_token() }}"
                            data-url="{{route('site.wishlistDelete' ,['id'=>$wish->id])}}" 
                            data-id="{{$wish->id}}">
                            <i class="fa fa-trash"> delete</i>
                        </button>
                    </div>
                    <div class="price-button-wrap">
                        <div class="widget-butons">
                            <a class="custom-btn active" href="{{route('booking',['slug'=>$wish->trips()->translated()->slug])}}">book now</a>
                            <a class="custom-btn" href="{{route('site.trips.one-trip',['slug'=>$wish->trips()->translated()->slug])}}">view details</a>
                        </div><!--End Widget buttons-->
                    </div>
                </div><!--End widget-cont-main-->
            </div><!--End Widget-cont-->
        </div><!--End Widget-box-->
    </div><!--End Col-xs-12-->
    @endforeach
</div>