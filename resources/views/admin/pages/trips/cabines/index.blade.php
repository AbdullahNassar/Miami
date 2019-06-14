@extends('admin.layouts.master')
@section('title')
    Two Night To Grand Bahamas 
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{url('/')}}">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    Two Night To Grand Bahamas
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
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gears"></i>Two Night To Grand Bahamas </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trips as $trip)
                                        <tr>
                                            @if($trip->images()->count() !=0)
                                            <td>
                                                <img src="{{asset('storage/uploads/trips/' . $trip->images[0]->name)}}" style="width: 150px; height: 150px;">
                                            </td>
                                            @else
                                            <td><span style="color: red;"> No Image</span></td>
                                            @endif  
                                            <td>{{$trip->translated()->name}}</td>
                                            <td>{{$trip->translated()->desc}}</td>
                                            <td class="text-center">
                                                <a href="{{url('admin/cabines/edit/'.$trip->id)}}" class="edit-btn btn btn-circle green">
                                                    <li class="fa fa-edit">
                                                        Edit
                                                    </li>
                                                </a>
                                                <a href="#trans" data-id="{{$trip->id}}" data-toggle="modal" class="trans-btn btn btn-circle blue" data-lang="1">
                                                    <li class="fa fa-pencil">
                                                        Translate
                                                    </li>
                                                </a>
                                                <a href="#edit" data-id="{{$trip->id}}" data-toggle="modal" class="btn btn-circle green editPrice">
                                                    <li class="fa fa-edit">
                                                        Edit Prices
                                                    </li>
                                                </a>


                                                <a data-url="{{route('admin.cabines.delete',['id'=>$trip->id])}}" class="btn btn-danger btndelet btn btn-circle">
                                                    <li class="fa fa-trash">
                                                        Delete
                                                    </li>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>
            </div>
        </div>    
         <!-- /.box-body -->
    </div>
@endsection
@section('modals')
@include('admin.pages.trips.cabines.modals.trans')
@include('admin.pages.trips.cabines.modals.edit-price')
@endsection


