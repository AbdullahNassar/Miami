<header id="header">
    <div class="container">
        <div class="header-top">
            <div class="row">  
                <div class="col-xs-8 col-sm-8">
                    <div class="social-lang">
                        <div class="dropdown">
                            <button data-toggle="dropdown">
                                English
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($languages as $lang)
                                <li><a href="{{route('lang',['code'=>$lang->code])}}">{{$lang->name}}</a></li>
                                <li><a class="google-translate" id="google_translate_element"></a></li>
                                @endforeach
                            </ul>
                        </div><!--End dropdown-->
                        <ul class="social-icon">
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
                    </div><!--End social-lang-->
                </div><!--End col-sm-8-->
                <div class="col-xs-4 col-sm-4">
                    <div class="login-register">
                        @if(!auth()->guard('members')->check())
                            <a href="{{route('site.pages.login')}}"> Login</a>
                            <a href="{{route('site.pages.register')}}"> Register</a>
                        @else
                           <span style="color: white;">Welcome: {{Auth()->guard('members')->user()->f_name}} </span>
                            <a href="{{route('site.pages.logout')}}"> Logout</a>
                            <a href="{{route('site.profile')}}">Profile</a>
                        @endif
                    </div><!--End login-register-->
                </div><!--End col-sm-4-->
            </div><!--End row-->
        </div><!--End Header Top-->
    </div><!--End container-->
    <div class="container">
        <a href="{{url('/')}}" class="logo">
            <img src="{{url('storage/uploads/logo/'. $settings->logo)}}">
        </a>
        <button class="btn btn-responsive-nav" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>
        <div class="dropdown serch-dropdown">
            <a href="" class="search-header" data-toggle="dropdown"><i class="fa fa-search"></i></a>
            <div class="dropdown-menu">
                <form class="" action="{{route('globalSearch')}}" method="GET">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" class="form-control inline" name="search" placeholder="Type Search Words">
                        <button type="submit" class="serch-btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div><!--End Dropdown-menu-->
        </div><!--End Dropdown-->

    </div><!--End container-->   
    <div class="navbar-collapse nav-main-collapse collapse">
        <div class="container">
            <nav class="nav-main">
                <ul class="nav navbar-nav">
                    <li><a href="{{url('/')}}">home</a></li>
                    @foreach($allCategories as $all)
                        <li><a href="{{route('site.category',['slug'=>$all->translated()->slug])}}">{{substr($all->translated()->name,0,14)}}</a></li>
                    @endforeach
                    <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                            more...
                            <b class="caret"></b>
                        </a>  
                        <ul class="dropdown-menu">
                            <li>
                                <a href="http://www.admiralbusline.com">TRANSPORTATION</a>
                            </li>
                            <li>
                                <a href="{{route('site.about')}}">About us</a>
                            </li>
                            <li>
                                <a href="{{route('gallery')}}">Gallery</a>
                            </li>
                            <li><a href="{{route('site.contact')}}">contact us</a></li>
                        </ul>
                    </li>

                </ul><!--End .nav navbar-nav -->
            </nav><!--kololo-menu -->
        </div><!--End Container-->
    </div><!--End navbar-collapse-->
</header><!--End Header-->