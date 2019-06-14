@extends('site.layouts.master')
@section('title')
 Single Cruise
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
        </div>
    </section><!--End Welcome-Home-->
    
    <div class="page-content section-lg has-background">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="single-cruises white-box">
                        <div class="cruises-img">
                        <!-- Start Flex-Slider-->
                            <div id="slider" class="flexslider">
                                <ul class="slides">
                                @foreach($images as $image)
                                    @if($images->count() !=0)
                                        <li>
                                            <img src="{{asset('storage/uploads/trips/' . $image->name)}}">
                                        </li>
                                    @else
                                        <li><span style="color: red;"> No Image</span></li>
                                    @endif
                                @endforeach
                                <!-- items mirrored twice, total of 12 -->
                                </ul>
                            </div>
                            <div id="carousel" class="flexslider">
                              <ul class="slides">
                                @foreach($images as $image)
                                    @if($images->count() !=0)
                                        <li>
                                            <img src="{{asset('storage/uploads/trips/' . $image->name)}}">
                                        </li>
                                    @else
                                        <li><span style="color: red;"> No Image</span></li>
                                    @endif
                                @endforeach
                              
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                        </div><!--End Cruises-img-->
                        <div class="cruises-details">
                            <div class="cruises-details-head">
                                <div class="title">
                                    <h2 class="cruises-name">{{$trip->name}}</h2>
                                    @php
                                        $num=0;
                                        foreach ($reviews as $review){
                                        $num +=$review->rate;
                                        }
                                        if (count($reviews) == 0){
                                        $mRate = 0;
                                        }else{
                                        $mRate = $num / count($reviews);
                                        }
                                    @endphp
                                    <div class="rating">
                                        @for($i=0;$i< 5;$i++)
                                            <span class="fa fa-star @if($i <$mRate)colored @endif"></span>
                                        @endfor
                                    </div>
                                </div>
                            </div><!--END Cruises details-head-->
                            <div class="cruises-details-cont">
                                <div class="p">
                                    <p>
                                       {!! $trip->desc !!}
                                    </p>
                                </div>

                            </div><!--End Cruises-details-cont-->
                            @include('site.pages.trips.templates.price-table')
                            <div class="cruises-timline">
                                <div class="item-title">
                                    <h4 class="title">Comments :</h4>
                                </div>
                                <div class="item-cont-wrap">
                                    @foreach($reviews as $review)
                                        <div class="item-cont">
                                        <div class="item-cont-head">
                                            <h5>{{$review->username}}</h5>
                                            <ul class="rating">
                                              @for($i=0;$i< 5;$i++)
                                                <li @if($i <$review->rate) class="active" @endif>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                              @endfor
                                            </ul>
                                        </div>
                                        <div class="item-cont-body">
                                            <p>
                                                {{$review->comment}}
                                            </p>
                                        </div>
                                    </div><!--End Item-cont-->
                                    @endforeach
                                    <div id="insert_new_review">

                                    </div>
                                </div><!--End item-cont-wrap-->
                                <div class="add-comment">
                                        <div class="item-title">
                                            <h4 class="title"> Add Comment :</h4>
                                        </div>
                                    <div class="comment-cont">
                                        <form class="comment-form" method="post" action="{{route('postReview')}}">
                                            {{ csrf_field() }}
                                            <div class="alert alert-success hidden" id="comment-alert-success">
                                                Your Review Has Been Added Success
                                            </div>
                                            <div class="alert alert-error hidden" id="comment-alert-error">
                                                Error please try again later
                                            </div>
                                            <input type="hidden" name="trip_id" value="{{ $trip->trip_id }}">
                                            <div class="form-group">
                                                <label>Your Rating</label>
                                                <div class="rateit" data-rateit-mode="font" data-rateit-icon="" style="font-family:fontawesome">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control clearInput" type="text" name="username"
                                                       placeholder="Your Name" data-msg-required="Please Enter Your Name">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control clearInput" type="email" name="email"
                                                       placeholder="Your Email" data-msg-required="Please Enter Your Email">
                                            </div>
                                            <div class="form-group">
                                                    <textarea class="form-control clearInput" placeholder="Your Comment"
                                                              name="comment" data-msg-required="Please Enter Your Comment"
                                                              rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                                    <button class="btn-submit pull-right addReview" type="submit" >
                                                        Send
                                                    </button>
                                                <div class="clearfix"></div>
                                            </div>
                                        </form>
                                    </div><!--Comment Cont-->
                                    </div><!--Add Comment-->
                            </div><!--End Timline-->
                        </div><!--End Cruises Details-->
                    </div><!--End Single-cruises-->
                </div><!--End Col-sm-9-->
                <div class="col-sm-3">
                    <div class="white-box">
                            <div class="white-box-title">
                                <h4 class="title">
                                    Booking Details
                                </h4>
                            </div><!--End White box-title-->
                            <div class="booking-widget">
                                <div class="booking-widget-img">
                                    @foreach($images as $index=>$image)
                                        @if($index == 0)
                                        <img src="{{asset('storage/uploads/trips/' . $image->name)}}">
                                        @endif
                                    @endforeach
                                </div>
                                
                                <div class="clearfix"></div>
                                <hr>
                                <div class="rating">
                                    <div class="pull-left">
                                        @for($i=0;$i< 5;$i++)
                                            <span class="fa fa-star @if($i <$mRate)colored @endif"></span>
                                        @endfor
                                    </div>
                                    <div class="pull-right">
                                        {{count($reviews)}} reviews
                                    </div>
                                </div><!--End Rating-->
                                <div class="clearfix"></div>
                                <hr>

                                @if(Auth::guard('members')->guest())
                                    <button class="custom-btn" disabled>Login first please</button>
                                @else
                                    <form class="wishlistForm" action="{{route('wishlist')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="trip_id" value="{{$trip->trip_id}}">
                                        <button type="submit" class="custom-btn">Add to Wishlist</button>
                                        <a class="custom-btn"
                                           href="{{route('booking', ['slug'=>$trip->slug])}}">book
                                            now</a>
                                        {{--<button type="submit" class="custom-btn">Add to Wishlist</button>--}}
                                    </form>
                                @endif
                            </div><!--End Booking Widget-->
                        </div><!--End wihte-box-->
                        
                        <div class="white-box">
                            <div class="white-box-title">
                                <h4 class="title">
                                    Need A Help?
                                </h4>
                            </div><!--End White box-title-->
                            <div class="content">
                                <p class="lead">{{$static_data->home_about->title}}</p>
                                <div class="call-us">
                                <i class="fa fa-phone"></i> 
                                <span class="number">{{$settings->phone1}}</span>
                            </div>
                            </div>
                        </div><!--End wihte-box-->
                
                        <div class="white-box">
                            <div class="white-box-title">
                                <h4 class="title">
                                    why book with us?
                                </h4>
                            </div><!--End White box-title-->
                            <div class="content">
                                @foreach($features as $feature)
                                    <div class="feat-box">
                                    <div class="feat-icon">
                                        <i class="fa {{$feature->icon}}"></i>
                                    </div><!--End Feat-icon-->
                                    <div class="feat-cont">
                                        <h5 class="feat-title">{{$feature->translated()->title}}</h5>
                                        <p class="custom-p">
                                            {{$feature->translated()->content}}
                                        </p>
                                    </div><!--End Feat-content-->
                                </div><!--End Feat-box-->
                                @endforeach
                            </div><!--End Content-->
                        </div><!--End wihte-box-->
                </div><!--End Col-sm-3-->
            </div><!--End Row-->
        </div><!--End Container-->
    </div>
@endsection