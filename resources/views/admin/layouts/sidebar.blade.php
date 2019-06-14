<div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start @if(Request::route()->getName() == 'admin.home') {{'active'}} @endif">
                <a href="{{url('/admin')}}" class="nav-link nav-toggle">
                    <i class="fa fa-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item start @if(Request::route()->getName() == 'admin.settings' ) {{'active'}} @endif ">
                <a href="{{route('admin.settings')}}" class="nav-link nav-toggle">
                    <i class="fa fa-gears"></i>
                    <span class="title">Settings</span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item @if(Request::route()->getName() == 'admin.slider' ) {{'active'}} @endif ">
                <a href="{{route('admin.slider')}}" class="nav-link nav-toggle">
                    <i class="fa fa-image"></i>
                    <span class="title">Slider</span>
                </a>
            </li>
            <li class="nav-item @if(Request::route()->getName() == 'admin.about' ) {{'active'}} @endif ">
                <a href="{{route('admin.about')}}" class="nav-link nav-toggle">
                    <i class="fa fa-info"></i>
                    <span class="title">About Us</span>
                    <span class="arrow"></span>
                </a>
            </li>
             <li class="nav-item @if(Request::route()->getName() == 'admin.trips' || Request::route()->getName() == 'admin.tours' || Request::route()->getName() == 'admin.cabines' ) {{'active'}} @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-plane"></i>
                    <span class="title">Trips</span>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start @if(Request::route()->getName() == 'admin.trips' ) {{'active'}} @endif ">
                        <a href="{{route('admin.trips',['slug'=>'day-cruises'])}}" class="nav-link nav-toggle">

                            <span class="title">Day Cruise Trips</span>
                            <span class="arrow"></span>
                        </a>
                    </li> 
        
                    <li class="nav-item start @if(Request::route()->getName() == 'admin.cabines' ) {{'active'}} @endif ">
                        <a href="{{route('admin.cabines',['slug'=>'two-night'])}}" class="nav-link nav-toggle">

                            <span class="title">Two Night Trips</span>
                            <span class="arrow"></span>
                        </a>
                    </li>

                    <li class="nav-item start @if(Request::route()->getName() == 'admin.tours') {{'active'}} @endif ">
                        <a href="{{route('admin.tours',['slug'=>'Tours'])}}" class="nav-link nav-toggle">

                            <span class="title">Tours Trips</span>
                            <span class="arrow"></span>
                        </a>
                    </li>

                    <li class="nav-item start @if(Request::route()->getName() == 'admin.cars') {{'active'}} @endif ">
                        <a href="{{route('admin.cars',['slug'=>'car-rental'])}}" class="nav-link nav-toggle">

                            <span class="title">Car Rental</span>
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <li class="nav-item start @if(Request::route()->getName() == 'admin.hotels') {{'active'}} @endif ">
                        <a href="{{route('admin.hotels',['slug'=>'CRUISE-HOTEL'])}}" class="nav-link nav-toggle">

                            <span class="title">CRUISE & HOTEL</span>
                            <span class="arrow"></span>
                        </a>
                    </li>

                </ul>
            </li>
            
            <li class="nav-item start @if(Request::route()->getName() == 'admin.booking.index' ) {{'active'}} @endif ">
                <a href="{{route('admin.booking.index')}}" class="nav-link nav-toggle">
                    <i class="fa fa-info"></i>
                    <span class="title">Booking Details</span>
                    <span class="arrow"></span>
                </a>
            </li>
            
           <li class="nav-item start @if(Request::route()->getName() == 'admin.places' ) {{'active'}} @endif ">
                <a href="{{route('admin.places')}}" class="nav-link nav-toggle">
                    <i class="fa fa-map-marker"></i>
                    <span class="title">Places</span>
                    <span class="arrow"></span>
                </a>
            </li>
           
           <li class="nav-item start @if(Request::route()->getName() == 'admin.views' ) {{'active'}} @endif ">
                <a href="{{route('admin.views')}}" class="nav-link nav-toggle">
                    <i class="fa fa-building"></i>
                    <span class="title">Hotel Views</span>
                    <span class="arrow"></span>
                </a>
            </li>
           

            <li class="nav-item start @if(Request::route()->getName() == 'admin.static.index' ) {{'active'}} @endif ">
                <a href="{{route('admin.static.index')}}" class="nav-link nav-toggle">
                    <i class="fa fa-bookmark"></i>
                    <span class="title">Static Pages</span>
                    <span class="arrow"></span>
                </a>
            </li> 

            {{--Abd El-ghany --}}
            <li class="nav-item start @if(Request::route()->getName() == 'features' ) {{'active'}} @endif ">
                <a href="{{route('admin.features')}}" class="nav-link nav-toggle">
                    <i class="fa fa-check"></i>
                    <span class="title">Features</span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="nav-item start @if(Request::route()->getName() == 'admin.gallery') {{'active'}} @endif">
                <a href="{{route('admin.gallery')}}" class="nav-link nav-toggle">
                    <i class="fa fa-image"></i>
                    <span class="title">Gallery</span>
                    <span class="arrow"></span>
                </a>
           </li>

            <li class="nav-item start @if(Request::route()->getName() == 'testmonials' ) {{'active'}} @endif ">
                <a href="{{route('admin.testmonials')}}" class="nav-link nav-toggle">
                    <i class="fa fa-child"></i>
                    <span class="title">Testmonials</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.contact') {{'active'}} @endif">
                <a href="{{route('admin.contact')}}" class="nav-link nav-toggle">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Contact Us</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item start @if(Request::route()->getName() == 'admin.messages') {{'active'}} @endif">
                <a href="{{route('admin.messages')}}" class="nav-link nav-toggle">
                    <i class="fa fa-envelope-o"></i>
                    <span class="title">Messages</span>
                    <span class="arrow"></span>
                </a>
            </li>

            <li class="treeview">
                <a href="{{route('admin.subscribtions.index')}}">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Subscribtions</span>
                </a>
            </li>

          
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>