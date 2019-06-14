@extends('admin.layouts.master')

@section('title')
    Slider
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
                    <a href="{{route('admin.slider')}}"> Slider </a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gears"></i>Edit Slider </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="{{route('admin.slider.update',['id'=>$slider->id])}}" enctype="multipart/form-data" method="post"
                              onsubmit="return false;">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label>Video:</label>
                                <div class="form-group">
                                    @if($slider->type == 0)
                                        <td><img style="height: 100px;width: 200px" src={{url("storage/uploads/slider/".$slider->image)}} /></td>
                                    @elseif($slider->type == 1)
                                        <td>
                                            <video width="320" height="240" controls>
                                                <source src="{{url('storage/uploads/slider/'.$slider->image)}}" type="video/mp4">
                                            </video>
                                        </td>
                                    @endif
                                </div>
                                <input type="file" name="image_name" value="" class="form-control" >
                            </div><!-- End form-group-->
                            <div class="row ">
                                <div class="col-md-offset-5 col-md-9 ">
                                    <a href="{{route('admin.slider')}}"
                                        class="btn btn-danger btn-circle">
                                        <i class="fa fa-reply"></i> Back
                                    </a>
                                    <button type="button" class="btn btn-success  btn-circle addBTN">
                                        Edit <span class="glyphicon glyphicon-save"> </span>
                                    </button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>        
@endsection