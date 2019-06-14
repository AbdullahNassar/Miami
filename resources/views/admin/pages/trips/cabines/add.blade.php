@extends('admin.layouts.master')
@section('title')
    Two Night Cruise
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
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plane"></i>Add New Trip</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                        <br />
                    </div>

                    <div class="portlet-body form">
                        <br />
                        <form action="{{route('admin.cabines.dropzoneStore')}}" enctype="multipart/form-data" class="form-horizontal dropzone dropzone-file-area" id="image-upload"
                              style="border-color:#eee; width: 500px;" >
                            {!! csrf_field() !!}
                            <h3>Please Upload Your Images Here</h3>
                        </form>
                        <!-- BEGIN FORM-->
                        <form action="{{route('admin.cabines.add',['slug'=>$cat->slug])}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false" >
                            {!! csrf_field() !!}
                            <input type="hidden" name="cat_id" value="{{$cat->cat_id}}">       
                            <div id="dropzone_image"></div>

                            <div class="form-body row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Trip Name</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="name" placeholder="Enter Trip Name">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 date-time ">
                                    <label class="col-md-3 control-label">Date</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input class="form-control form-control-inline input-circle input-medium date-picker" name="date" type="text" >
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Trip Description</label>
                                    <div class="col-md-9 col-sm-6">
                                        <textarea class="form-control input-circle" name="desc" placeholder="Enter Trip Description" rows="8"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Language</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" name="lang">
                                            @foreach($languages as $language)
                                                <option value="{{$language->code}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Place</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" name="place_id">
                                            @foreach($places as $place)
                                                <option value="{{$place->id}}">{{$place->translated()->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                           
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Keywords</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-large input-circle" data-role="tagsinput" name="keywords"> </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Single Person Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="single" placeholder="Single Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Double Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="second" placeholder="Double Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Third Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="third" placeholder="Third Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Fourth Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="fourth" placeholder="Fourth Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Less Than 5 Years Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" 
                                        name="less5" placeholder="Less Than 5 Years Price">
                                    </div>
                                </div>
                             
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="text-center ">
                                        <a href="{{route('admin.cabines',['slug'=>'two-night'])}}"
                                            class="btn btn-danger btn-circle">
                                            <i class="fa fa-reply"></i> Back
                                        </a>
                                        <button type="submit" class="btn btn-circle green addBTN">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div><!--End portlet-->
            </div>

        </div>
    </div>
@endsection
