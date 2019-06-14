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
                        <form action="{{route('admin.trips',['slug'=>'day-cruises'])}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false" >
                            {!! csrf_field() !!}
                            <div id="dropzone_image"></div>

                            <div class="form-body row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Trip Name</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="name" placeholder="Enter Trip Name">
                                    </div>
                                </div>

                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Trip Description</label>
                                    <div class="col-md-9 col-sm-6">
                                        <textarea class="form-control input-circle" name="desc" placeholder="Enter Trip Description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" name="cat_id">
                                            @foreach($cat as $category)
                                                @php
                                                    $trans = $category->translated()
                                                @endphp
                                                <option value="{{$category->id}}">{{$trans->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">places</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" name="place_id">
                                            @foreach($places as $place)
                                                <option value="{{$place->place_id}}">{{$place->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 date-time ">
                                    <label class="col-md-3 control-label">Date</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input  class="form-control form-control-inline input-circle input-medium date-picker" name="date" type="text" >
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 ">
                                    <label class="col-md-3 control-label">Price Type</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" id="price" >
                                            <option >Select the prices type</option>
                                            <option value="1">Adult ,Children ,Infants</option>
                                            <option value="2">Adult or under 5 years</option>
                                        </select>
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
                                    <label class="col-md-3 control-label">Keywords</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" name="keywords" class="form-control input-large input-circle" data-role="tagsinput">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-3 control-label">Price For one person</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="price" placeholder="Enter Business Grade Adults Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Business Grade Adults Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="b_adult" placeholder="Enter Business Grade Adults Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Business Grade Children Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="b_children" placeholder="Enter Business Grade Children Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Business Grade Infants Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="b_infants" placeholder="Enter Business Grade Infants Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Economy Grade Adults Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="e_adult" placeholder="Enter Economy Grade Adults Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Economy Grade Children Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="e_children" placeholder="Enter Economy Grade Children Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Economy Grade Infants Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="e_infants" placeholder="Enter Economy Grade Infants Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">Economy price for children under 5 years</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="e_before" placeholder="Enter economy price for children under 5 years">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">business price for children under 5 years</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="b_before" placeholder="Enter business price for children under 5 years">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">Economy price for adult</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="e_after" placeholder="Enter economy price for adult">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">business price for adult</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" name="b_after" placeholder="Enter economy price for adult">
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
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-plane font-dark"></i>
                            <span class="caption-subject bold uppercase">All trips in day cruises category</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                            <thead>
                            <tr class="">
                                <th> Image </th>
                                <th> name </th>
                                <th> main price </th>
                                <th> Created At </th>
                                <th width="350px"> Operations </th>
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
                                    <td> {{$trip->translated()->name}} </td>
                                    <td> {{$trip->price}} </td>
                                    <td> {{$trip->created_at}} </td>
                                    <td>
                                        <a href="edit/{{$trip->id}}" class="edit-btn btn btn-circle green">
                                            <li class="fa fa-edit">
                                                Edit Common Data
                                            </li>
                                        </a>

                                        <a href="#edit" data-id="{{$trip->id}}" data-toggle="modal" class="btn btn-circle green editPrice">
                                            <li class="fa fa-edit">
                                                Edit Price Data
                                            </li>
                                        </a>
                                        <a href="#responsive" data-id="{{$trip->id}}" data-toggle="modal" class="trans-btn btn btn-circle blue">
                                            <li class="fa fa-pencil">
                                                Translate
                                            </li>
                                        </a>

                                        <a data-url="delete/{{$trip->id}}" class="btn btn-danger btndelet btn btn-circle">
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('admin.pages.trips.modals.trans')
    @include('admin.pages.trips.modals.edit')
@endsection