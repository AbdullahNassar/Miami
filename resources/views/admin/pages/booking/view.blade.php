@extends('admin.layouts.master')
@section('title')
Booking Details
@endsection
@section('content')            
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{url('/admin')}}">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Booking Details</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#">
                                <i class="icon-bell"></i> Action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-shield"></i> Another action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-user"></i> Something else here</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-bag"></i> Separated link</a>
                        </li>
                    </ul>
                </div>
            </div><!--End page-toolbar-->
        </div><!--End page-bar-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Booking Details
                        </div>
                        <div class="tools">
                           <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="collapse"> </a>
                        </div><!--End tools-->
                    </div><!-- portlet-title-->
                    <div class="portlet-body form">
                    @for($i=0; $i<=sizeOf($booking->f_name ); $i++ )
                        <form >
                            <div class="form-body row">
                                <div class="form-group col-sm-9 col-md-9">
                                    <label class="col-md-3 control-label" style="color: red;">
                                     Person Information</label>
                                </div>
                                @if($booking->f_name)    
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->f_name) as $index=>$f_name)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$f_name}}" disabled>
                                                </br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                 @if($booking->l_name)    
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->l_name) as $index=>$l_name)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$l_name}}" disabled>
                                                 </br>
                                            @endif     
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->phone)    
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Phone</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->phone) as $index=>$phone)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$phone}}" disabled>
                                                 </br>
                                            @endif     
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->b_date)   
                                 <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Birth Date</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->b_date) as $index=>$b_date)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$b_date}}" disabled>
                                                </br>
                                            @endif    
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->gender)   
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->gender) as $index=>$gender)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$gender}}" disabled>
                                                </br>
                                            @endif    
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->email)   
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->email) as $index=>$email)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$email}}" disabled>
                                                </br>
                                            @endif    
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->passport)   
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Passport</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->passport) as $index=>$passport)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$passport}}" disabled>
                                                </br>
                                            @endif     
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->pass_expire)   
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Expire Date</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->pass_expire) as $index=>$pass_expire)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$pass_expire}}" disabled>
                                                </br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->city)   
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->city) as $index=>$city)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$city}}" disabled>
                                                </br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if($booking->date)   
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Date</label>
                                    <div class="col-md-9 col-sm-6">
                                        @foreach(explode(",",$booking->date) as $index=>$date)
                                            @if($index==$i)
                                                <input type="text" class="form-control input-circle" value="{{$date}}" disabled>
                                                </br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>                           
                        </form>
                    @endfor      
                        <!-- END FORM-->
                    </div>
                </div><!--End portlet box green-->
            </div><!--End Col-md-12-->
        </div><!--End Row-->
    </div><!-- END CONTENT BODY -->
@endsection    
