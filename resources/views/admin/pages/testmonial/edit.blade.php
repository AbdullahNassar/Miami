@extends('admin.layouts.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($details as $d)
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-plane"></i>Edit {{$d->lang}} Data</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a href="javascript:;" class="reload"> </a>
                                <a href="javascript:;" class="remove"> </a>
                            </div>
                            <br />
                        </div>

                        <div class="portlet-body form">
                            <br />
                            <!-- BEGIN FORM-->
                            <form action="{{route('admin.updateTestmonial',['id'=>$d->testmonial_id])}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false" >
                                {!! csrf_field() !!}
                                <input type="hidden" name="lang" value="{{$d->lang}}">
                                <input type="hidden" name="id" value="{{$d->id}}">
                                <div class="form-body row">
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label class="col-md-3 control-label">Title</label>
                                        <div class="col-md-9 col-sm-6">
                                            <input type="text" class="form-control input-circle" value="{{$d->title}}" name="title" placeholder="Enter title">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label class="col-md-3 control-label">Content</label>
                                        <div class="col-md-9 col-sm-6">
                                            <textarea class="form-control input-circle" name="content" placeholder="Enter Content">{{$d->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label class="col-md-3 control-label">User Name</label>
                                        <div class="col-md-9 col-sm-6">
                                            <input type="text" class="form-control input-circle" value="{{$d->name}}" name="name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label class="col-md-3 control-label">User Address</label>
                                        <div class="col-md-9 col-sm-6">
                                            <input type="text" class="form-control input-circle" value="{{$d->address}}" name="address" placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label class="col-md-3 control-label">User Image</label>
                                        <div class="col-md-9 col-sm-6">
                                            <img src="{{url('storage/uploads/testmonial/'.$d->master->image)}}">
                                            <input type="file" class="form-control input-circle" name="image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="text-center ">
                                            <button type="submit" class="btn btn-circle green addBTN">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div><!--End portlet-->
                @endforeach
            </div>
        </div>
    </div>
@endsection
