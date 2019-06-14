<!DOCTYPE html>
<html>
    <head>
        <!-- Basic page needs
                ===========================-->
        <title>Cruis&amp;Tours</title>
        <meta charset="utf-8">
        <meta name="author" content="">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Mobile specific metas
                ===========================-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Favicon
                ===========================-->
        <link rel="shortcut icon" type="image/x-icon" href="">

        <!-- Google Web Fonts
                ===========================-->

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

        <!-- Css Base And Vendor
                ===========================-->
        <link rel="stylesheet" href="{{asset('assets/site/vendor/bootstrap/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/jquery-ui/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/prettyPhoto/css/prettyPhoto.css')}}" />
         <link rel="stylesheet" href="{{asset('assets/site/vendor/Flex-slider/flexslider.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/rating-plugin/rateit.css')}}">
        <link rel="stylesheet" href="{{asset('assets/site/vendor/datepicker/jquery.datetimepicker.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link href="{{asset('assets/admin/hotelTable.css')}}" rel="stylesheet" type="text/css" />

        <!-- Site Style
                ===========================-->
        <link rel="stylesheet" href="{{asset('assets/site/css/style.css')}}">
        @if(app()->getLocale() != 'en')
            <link rel="stylesheet" href="{{asset('assets/site/css/style-ar.css')}}">
        @endif
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="wrapper">
            @include('site.layouts.header')
            <div class="main" role="main">
                @if(Request::route()->getName() == 'site.home')
                @include('site.layouts.slider')
                @endif
                <div class="page-content">
                    @yield('content')
                </div>
                @include('site.layouts.footer')
            </div>
        </div>
        @include('site.modals.quote')
        <script type="text/javascript" src="//miami4tours.com/livechat/php/app.php?widget-init.js"></script>
        <!--Scripts Plugins-->
        @yield('foot')
        <script src="{{asset('assets/site/vendor/jquery/jquery.js')}}"></script>
        <script src="{{asset('assets/site/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/site/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/site/vendor/prettyPhoto/js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('assets/site/vendor/datepicker/moment.js')}}"></script>
        <script src="{{asset('assets/site/vendor/datepicker/jquery.datetimepicker.full.min.js')}}"></script>
        <script src="{{asset('assets/site/vendor/Flex-slider/jquery.flexslider.js')}}"></script>
        <script src="{{asset('assets/site/vendor/Flex-slider/demo/js/demo.js')}}"></script>
        <script src="{{asset('assets/site/vendor/rating-plugin/jquery.rateit.min.js')}}"></script>
        <script src="{{asset('assets/admin/noty/js/noty/packaged/jquery.noty.packaged.min.js')}}"></script>
        <script src="{{asset('assets/admin/sweetalert.min.js')}}"></script>

        @if(Request::route()->getName() == 'site.contact')
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCVu1jeF2l0f-WxirNpnicC1rYxVqKJIS4"></script>
        <script src="{{asset('assets/site/js/google.js')}}"></script>
        @endif
        <script src="{{asset('assets/site/vendor/select2/js/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/site/vendor/jquery-validation/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assets/site/vendor/jquery-validation/js/additional-methods.min.js')}}"></script>
        <script src="{{asset('assets/site/vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
        <script src="{{asset('assets/site/js/form-wizard.js')}}"></script>
        <script src="{{asset('assets/site/js/main.js')}}"></script>
        <script src="{{asset('assets/admin/jquery.validate.js')}}"></script>
        <script src="{{asset('assets/site/js/main.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>
        <script src="{{asset('assets/site/js/site.js')}}"></script>
        <script src="{{asset('assets/admin/login.js')}}"></script>
        <script src="{{asset('assets/admin/ajax.js')}}"></script>
        <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
        }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    </body>
</html>
