<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>{{$settings->name}} | @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="{{$settings->description}}" name="description" />
        <meta name="title" content="{{$settings->meta_title}}">
        <meta name="description" content="{{$settings->description}}">
        <meta name="keywords" content="{{$settings->meta_keyword}}">
        <meta name="author" content="{{$settings->meta_author}}">

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/admin/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{asset('assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/admin/global/plugins/dropzone/basic.min.css')}}" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->

        <!-- tags and keywords css  -->
        <link href="{{asset('assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/admin/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/admin/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/hotelTable.css')}}" rel="stylesheet" type="text/css" />
        @if(Request::route()->getName() == 'admin.profile')
        <link href="{{asset('assets/admin/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
        @endif
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{asset('assets/admin/layouts/layout2/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/layouts/layout2/css/themes/blue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{asset('assets/admin/layouts/layout2/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        @include('admin.layouts.header')
        <!-- END HEADER -->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->


        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            @include('admin.layouts.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                @yield('content')
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- BEGIN FOOTER -->    
        @include('admin.layouts.footer')
        <!-- END FOOTER -->

        @yield('modals')
        @yield('templates')
        <!-- delete with ajax for all project -->
        <div id="delete-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
            </div>
        </div>
        <script id="template-modal" type="text/html" >
            <div class = "modal-content" >
                <input type = "hidden" name = "_token" value="{{ csrf_token() }}" >
                <div class = "modal-header" >
                    <button type = "button" class = "close" data - dismiss = "modal" > &times; </button>
                    <h4 class = "modal-title bold" > Delete Element ?</h4>
                </div>
                <div class = "modal-body" >
                    <p > Are You Sure ?</p>
                </div>
                <div class = "modal-footer" >
                    <a
                        href = "{url}"
                        id = "delete" class = "btn btn-danger" >
                        <li class = "fa fa-trash" > </li> Delete
                    </a>

                    <button type = "button" class = "btn btn-warning" data-dismiss = "modal" >
                        <li class = "fa fa-times" > </li> Cancel </button >
                </div>
            </div>
        </script>
        <form action="#" id="csrf">{!! csrf_field() !!}</form>
        <!-- common edit modal with ajax for all project -->
        <div id="common-modal" class="modal fade" role="dialog">
                <!-- modal -->
        </div>
        <!--[if lt IE 9]>
        <script src="{{asset('assets/admin/global/plugins/respond.min.js')}}"></script>
        <script src="{{asset('assets/admin/global/plugins/excanvas.min.js')}}"></script>
        <script src="{{asset('assets/admin/global/plugins/ie8.fix.min.js')}}"></script>
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('assets/admin/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

        @include('admin.templates.delete-modal')
        @include('admin.templates.loading')
        @include('admin.templates.alerts')

        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->


        <script src="{{asset('assets/admin/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>


        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/admin/pages/scripts/form-samples.min.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/admin/global/plugins/dropzone/dropzone.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/admin/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/pages/scripts/form-dropzone.min.js')}}" type="text/javascript"></script>
        <!-- <script src="{{asset('assets/admin/pages/scripts/components-bootstrap-tagsinput.min.js')}}" type="text/javascript"></script> -->
        @if(Request::route()->getName() == 'admin.profile')
        <script src="{{asset('assets/admin/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/pages/scripts/profile.min.js')}}" type="text/javascript"></script>
        @endif
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src='http://cdn.tinymce.com/4/tinymce.min.js'></script>
        <script src="{{asset('assets/admin/layouts/layout2/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/layouts/layout2/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/admin/new.js')}}"></script>
        <script src="{{asset('assets/admin/ajax.js')}}"></script>
        <script src="{{asset('assets/admin/sweetalert.min.js')}}"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>