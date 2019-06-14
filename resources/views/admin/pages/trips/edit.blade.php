@extends('admin.layouts.master')
@section('title')
    Trips
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
            @foreach($trip as $t)
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plane"></i>Edit Trip</div>
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
                        <form action="{{route('tripEdit',['id'=>$t->trip_id])}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false" >
                            {!! csrf_field() !!}

                            <input type="hidden" name="lang" value="{{$t->lang}}">
                            <div class="form-body row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="display-name">images<span class="required">*</span>
                                </label>
                                <div class="form-group col-sm-6 col-md-6">
                                    @foreach($images as $image)
                                        <div class="col-md-4 col-sm-4 col-xs-12 ajax-target">
                                            <img class="img-responsive mr-bot-15 btn-product-image" alt="user-image" src="{{url('storage/uploads/trips/'.$image->name)}}" style="cursor:pointer; width: 130px; height: 130px;" title="choose image">
                                            <input type="file" style="display:none;" name="imgs[{{$image->id}}}]">
                                            <button type="button" data-url="{{ route('admin.trips.images.delete' ,['trip_id' => $t->id , 'image_id' => $image->id ]) }}" class="ajax-delete btn btn-warning">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                    <div class="col-md-4 file-box">
                                        <img class="img-responsive mr-bot-15 btn-product-image" 
                                        style=" width: 130px; height: 130px;display: block; cursor: pointer;" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=290%C3%97180%20or%20larger&w=290&h=180" >
                                            <input type="file" role="button" name="imgs[]" accept="image/*" style="display:none;">
                                        <div class="caption text-center">
                                            <button type="button" class="file-generate btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Trip Name</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" value="{{$t->name}}" class="form-control input-circle" name="name" placeholder="Enter Trip Name">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Trip Description</label>
                                    <div class="col-md-9 col-sm-6">
                                        <textarea class="form-control input-circle" name="desc" placeholder="Enter Trip Description">{{$t->desc}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" name="cat_id">
                                            @foreach($cats as $category)
                                                <option value="{{$category->cat_id}}" @if($category->cat_id == $t->trip['cat_id']) {{'selected'}} @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">places</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" name="place_id">
                                            @foreach($places as $place)
                                                <option value="{{$place->place_id}}"@if($place->place['id'] == $t->trip['place_id']) {{'selected'}} @endif>{{$place->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Keywords</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" value="{{$t->keywords}}" name="keywords" class="form-control input-large input-circle" data-role="tagsinput">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Price For one person</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" value="{{$t->trip['price']}}" class="form-control input-circle" name="price" placeholder="Enter Business Grade Adults Price">
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
            @endforeach
        </div>
    </div>
@endsection