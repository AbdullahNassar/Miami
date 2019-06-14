<footer class="footer">
    <div class="container">
        <div class="footer-head">
            <div class="footer-logo">
                <img src="{{url('storage/uploads/logo/' . $settings->logo)}}" class="img-resonsive" alt="logo">
            </div><!--End Company Logo-->
            <div class="news-letter">
                <form  action="{{route('site.subscribe')}}" class="ajax-form" method="post" onsubmit="return false;">
                     {{csrf_field()}}
                    <div class="form-group">
                        <input class="form-control dark-input" type="email" name="email" id="subscripe" placeholder="Enter Your Email">
                        <button type="submit" class="ajax-submit btn yellow-bg larg-height btn-absolute">
                            Sign up
                        </button>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div><!--End footer-head-->
        <div class="footer-widgets">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="wedgit-title">
                            <h3 class="title small-title">
                                about us
                            </h3><!-- End title-->
                        </div>
                        <div class="widget-content">
                            <div class="about-widget">
                                <p class="lead">
                                   {!! str_limit($about->content, 250) !!}
                                </p>
                            </div><!--End about-widget-->
                            <ul class="contact-info-widget">
                                <li>
                                    <span class="li-container">
                                        <i class="fa fa-envelope-o"></i>
                                        <span>{{$settings->email}}</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="li-container">
                                        <i class="fa fa-phone"></i>
                                        <span>{{$settings->phone1}}</span>
                                    </span>
                                </li>
                            </ul><!--End contact-->
                        </div><!--End widget-content-->
                    </div><!--End widget-->
                </div><!--End Col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="wedgit-title">
                            <h3 class="title small-title">
                                popular tags
                            </h3><!-- End title-->
                        </div><!--End wedgit-title-->
                        <div class="widget-content">
                            <ul class="tags-list">
                            @foreach($alltrips as $index=>$trip)
                                @if($index <= 3)
                                    @foreach(explode("," ,$trip->keywords) as $tag)
                                        <li>
                                            <a href="{{route('site.tags' , ['tag'=>$tag])}}" name="tag">{{$tag}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endforeach
                            </ul><!--End tags-list-->
                            <ul class="social-icon social-bg">
                                @if($settings->facebook == !Null)
                                    <li>
                                        <a href="{{$settings->facebook}}">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($settings->twitter == !Null)
                                    <li>
                                        <a href="{{$settings->twitter}}">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($settings->instagram == !Null)
                                    <li>
                                        <a href="{{$settings->instagram}}">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($settings->google == !Null)
                                    <li>
                                        <a href="{{$settings->google}}">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                @endif
                                @if($settings->youtube == !Null)
                                    <li>
                                        <a href="{{$settings->youtube}}">
                                            <i class="fa fa-youtube"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul><!--End social-icon-->
                               
                        </div><!--widget-content-->
                    </div><!--End Tags-->
                </div><!--End Col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <div class="wedgit-title">
                            <h3 class="title small-title">
                                Site Map
                            </h3><!-- End title-->
                        </div><!--End wedgit-title-->
                        <div class="widget-content">
                            <ul class="site-map-list">
                                <li>
                                    <a href="{{route('site.home')}}">home</a>
                                </li>
                                <li>
                                    <a href="{{route('site.about')}}">about</a>
                                </li>
                               <!--  <li>
                                    <a href="{{route('site.home')}}">cruises</a>
                                </li>
                                <li>
                                    <a href="#">hotels</a>
                                </li> -->
                                <!-- <li>
                                    <a href="">buy online</a>
                                </li> -->
                                <!-- <li>
                                    <a href="#">help</a>
                                </li> -->
                                <li>
                                    <a href="{{route('gallery')}}">gallery</a>
                                </li>
                               <!--  <li>
                                    <a href="#">policy</a>
                                </li> -->
                                <li>
                                    <a href="{{route('site.contact')}}">contact</a>
                                </li>
                               <!--  <li>
                                    <a href="#">more</a>
                                </li> -->
                            </ul><!--End site-map-list --> 
                        </div>
                    </div><!--End widget-->
                </div><!--End Col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="gallary-wegit">
                        <div class="wedgit-title">
                            <h3 class="title small-title">
                                gallery
                            </h3><!-- End Title-->
                        </div><!--End wedgit-title-->

                        <div class="gallary-cont">
                            <ul class="gallary list-inline">
                            @foreach($gallery as $gal)
                                <li>
                                    <a href="{{url('storage/uploads/gallery/' . $gal->image)}}" data-type="prettyPhoto[gallery]">
                                        <img src="{{url('storage/uploads/gallery/' . $gal->image)}}" alt="gallary-img"/>
                                    </a>
                                </li>
                            @endforeach    
                            </ul> <!--End Gallery-->
                        </div>

                    </div><!--End Gallary-wegit-->
                </div><!--End Col-md-3 -->
            </div><!--End Row -->
        </div><!--End footer-widgets-->
        <div class="copyright">
            <div class="row">
                <div class="col-sm-6">
                    cruises © all rights reseved 
                    <a href="http://www.upureka.com">Upureka co.</a>
                </div>
                <div class="col-sm-6 text-right">
                    © 2017  Cruise And Tours center 
                </div>
            </div><!--End row--> 
        </div><!--End copyright-->
    </div><!--End Container-->
</footer><!--End Footer-->  
