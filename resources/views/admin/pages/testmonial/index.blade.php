@extends('admin.layouts.master')
@section('title')
    Testmonial
@endsection
@section('content')
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="{{url('/admin')}}">Home</a>
                    <i class="fa fa-angle-right">Testmonials</i>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="#add" class="btn btn-circle green" data-toggle="modal" >
                    <i class="fa fa-plus"></i>Add New Testmonial
                </a>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-plane font-dark"></i>
                            <span class="caption-subject bold uppercase">Show Data</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        @if(Session::has('m'))

                            <div class="alert alert-info">

                                <p>{{Session::get('m')}}</p>

                            </div>

                        @endif
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                            <thead>
                            <tr class="">
                                <th>User Image</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>User Name</th>
                                <th>User Address</th>
                                <th class="text-center">Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($master_testmonial as $testmonial)
                                <tr>
                                    <td>
                                        <img src="{{url('storage/uploads/testmonial/'.$testmonial->image)}}" height="200px" width="150px">
                                    </td>
                                    <td>{{$testmonial->title}}</td>
                                    <td>{{$testmonial->content}}</td>
                                    <td>{{$testmonial->name}}</td>
                                    <td>{{$testmonial->address}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.editTestmonial',['id'=>$testmonial->testmonial_id])}}" class="edit-btn btn btn-circle green">
                                            <li class="fa fa-edit">
                                                Edit
                                            </li>
                                        </a>
                                        <a href="#responsive" data-id="{{$testmonial->testmonial_id}}" data-toggle="modal" class="trans-btn btn btn-circle blue">
                                            <li class="fa fa-pencil">
                                                Translate
                                            </li>
                                        </a>

                                        <a data-url="{{route('admin.deleteTestmonial',['id'=>$testmonial->testmonial_id])}}" class="btn btn-danger btndelet btn btn-circle">
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
    @include('admin.pages.testmonial.modals.add')
    @include('admin.pages.testmonial.modals.trans')
@endsection