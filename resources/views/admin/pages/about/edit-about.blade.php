@extends('admin.layouts.master')
@section('title')
    About 
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
                        <i class="fa fa-plane"></i>Edit {{$about->lang}} Data</div>
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
                    <form action="{{route('admin.about.edit')}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;" >
                        {!! csrf_field() !!}
                        <input type="hidden" id="hidden_id" name="id" value="{{$about->id}}">
                        <input type="hidden" id="hidden_lang" name="lang" value="{{$about->lang}}">

                        <div class="form-body row">

                            <div class="row">
                                <div class="form-group col-sm-9 col-md-9">
                                    <label class="col-md-3 control-label">Title</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" value="{{$about->title}}" name="title" placeholder="Enter title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12">
                                    <label class="col-md-2 control-label">Content</label>
                                    <div class="col-md-10 col-sm-10">
                                        <textarea class="form-control input-circle tiny-editor" 
                                        name="content1"> {{$about->content}}</textarea>
                                    </div>
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
        </div>
    </div>
</div>
@endsection
