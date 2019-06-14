@extends('admin.layouts.master')
@section('title')
    Car Rentals 
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
                    Car Rentals
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plane"></i>Add New Car Rental</div>
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
                        <form action="{{route('admin.cars.add',['slug'=>'car-rental'])}}" method="POST" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false" >
                            {!! csrf_field() !!}
                            <div id="dropzone_image"></div>

                            <div class="form-body row">
                                <div class="form-group col-sm-6 col-md-6">
                                    <label class="col-md-3 control-label">Title</label>
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
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9 col-sm-6">
                                        <textarea class="form-control input-circle" name="desc" placeholder="Enter Description" rows="8"></textarea>
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
                                    <label class="col-md-3 control-label">Rental Type</label>
                                    <div class="col-md-9 col-sm-6">
                                        <select class="form-control input-circle" id="car_type">
                                            <option>Select Rental type</option>
                                            <option value="1">Economic</option>
                                            <option value="2">Business</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price1 hidden">
                                    <label class="col-md-3 control-label">Economic Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" 
                                        name="e_price" placeholder="Economic Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">Business Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" 
                                        name="b_price" placeholder="Business Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">Insurance Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" 
                                        name="insurance" placeholder="Insurance Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">Tax Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" 
                                        name="tax" placeholder="Tax Price">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 price2 hidden">
                                    <label class="col-md-3 control-label">Deposit Price</label>
                                    <div class="col-md-9 col-sm-6">
                                        <input type="text" class="form-control input-circle" 
                                        name="deposit" placeholder="Deposit Price">
                                    </div>
                                </div>
                             
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="text-center ">
                                        <a href="{{route('admin.cars',['slug'=>'car-rental'])}}"
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
                            <i class="fa fa-gears"></i> Car Rentals </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-scared table-responsive">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Keywords</th>
                                        <th>Description</th>
                                        <th class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trips as $car)
                                        <tr>
                                            @if($car->images()->count() !=0)
                                            <td>
                                                <img src="{{asset('storage/uploads/trips/' . $car->images[0]->name)}}" style="width: 150px; height: 150px;">
                                            </td>
                                             @else
                                            <td><span style="color: red;"> No Image</span></td>
                                            @endif  
                                            <td>{{$car->translated()->name}}</td>
                                            <td>{{$car->category->translated()->name}}</td>
                                            <td>{{$car->translated()->keywords}}</td>
                                            <td>{{$car->translated()->desc}}</td>
                                            <td class="text-center">
                                                <a href="{{url('admin/cars/edit/'.$car->id)}}" class="edit-btn btn btn-circle green">
                                                    <li class="fa fa-edit">
                                                        Edit
                                                    </li>
                                                </a>
                                                <a href="#trans" data-id="{{$car->id}}" data-toggle="modal" class="trans-btn btn btn-circle blue" data-lang="1">
                                                    <li class="fa fa-pencil">
                                                        Translate
                                                    </li>
                                                </a>
                                                <a href="#edit" data-id="{{$car->id}}" data-toggle="modal" class="btn btn-circle green editPrice">
                                                    <li class="fa fa-edit">
                                                        Edit Prices
                                                    </li>
                                                </a>


                                                <a data-url="{{route('admin.cars.delete',['id'=>$car->id])}}" class="btn btn-danger btndelet btn btn-circle">
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
@include('admin.pages.trips.cars.modals.trans')
@include('admin.pages.trips.cars.modals.edit-price')
@endsection


