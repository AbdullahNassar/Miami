@extends('admin.layouts.master')
@section('title')
Booking Details
@endsection
@section('content')            
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
       
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{url('/admin')}}">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Booking</span>
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
                            <i class="fa fa-gift"></i>Booking
                        </div>
                        <div class="tools">
                           <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="collapse"> </a>
                        </div><!--End tools-->
                    </div><!-- portlet-title-->
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th>Trip Name</th>
                                    <th>Customer Name</th>
                                    <th>Booking Date</th>
                                    <th>Total Price</th>
                                    <th>Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $book)
                                    <tr>
                                        <td>
                                           {{$book->trip->translated()->name}}
                                        </td>
                                        <td>
                                            @foreach(explode(",",$book->f_name) as $index=>$f_name)
                                                @if($index == 0)
                                                    {{$f_name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$book->created_at->format('Y,m,d')}}
                                        </td>
                                        <td>
                                             {{$book->total_price}}$
                                        </td>
                                        <td>
                                            <a href="{{route('admin.booking.view' , ['id'=>$book->id])}}" class="btn green btn-sm btn-outline sbold uppercase">
                                                <i class="fa fa-share"></i> View </a>
                                        </td>
                                    </tr>
                                @endforeach    
                                </tbody>
                            </table>
                        </div><!--End table-scrollable-->
                    </div><!--End portlet-body-->
                </div><!--End portlet box green-->
            </div><!--End Col-md--12-->
        </div><!--End Row-->
    </div><!-- END CONTENT BODY -->
@endsection    
