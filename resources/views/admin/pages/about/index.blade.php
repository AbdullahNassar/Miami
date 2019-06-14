@extends('admin.layouts.master')
@section('title')
    About Site 
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
                    <a href="{{route('admin.about')}}">About Site </a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gears"></i>About Site </div>
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
                                        <th>Language</th>
                                        <th class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                         <form action="{{route('admin.about.info')}}" method="post" enctype="multipart/form-data">
                                                    {!! csrf_field() !!}
                                           <td class=" text-center">
                                                 <select name="lang" class="select-lang form-control">
                                                    @foreach($languages as $lang)
                                                    <option value="{{$lang->code}}">{{$lang->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td> 
                                            <td class="text-center">
                                                <button type="submit" class="edit-btn btn btn-success" >
                                                    <i class="fa fa-pencil"></i>
                                                    Edit
                                                </button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
