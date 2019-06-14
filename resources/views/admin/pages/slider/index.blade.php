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
                    <a href="{{route('admin.slider')}}">Slider </a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row" style="margin-bottom: 20px; margin-left: 20px;">
                    <a href="#add" class="btn btn-circle blue" data-toggle="modal" >
                        <i class="fa fa-plus"></i>Add New 
                    </a>
                </div>    
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gears"></i>Slider </div>
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
                                        <th>Video</th>
                                        <th class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $slider)
                                        <tr>
                                            @if($slider->type == 0)
                                                <td><img style="height: 100px;width: 200px" src={{url("storage/uploads/slider/".$slider->image)}} /></td>
                                            @elseif($slider->type == 1)
                                            <td>
                                                <video width="320" height="240" controls>
                                                    <source src={{url("storage/uploads/slider/".$slider->image)}} type="video/mp4">
                                                </video>
                                            </td>
                                            @endif
                                            <td>
                                                <a href="{{route('admin.slider.edit',['id'=>$slider->id])}}" class="btn btn-success btn-circle">
                                                    <li class="fa fa-pencil"> Edit</li>
                                                </a>
                                                <a href="{{route('admin.slider.delete',['id'=>$slider->id])}}" class="btn btn-danger btn-circle btn-delet">
                                                    <li class="fa fa-pencil"> Delete</li>
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
    </div>  

@endsection

@section('modals')
    @include('admin.pages.slider.modals.add')
@endsection