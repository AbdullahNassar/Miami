@extends('admin.layouts.master')
@section('title')
   subscribtions
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
                    <a href="#">Subscribtions</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plane"></i>Send Message </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                        <br />
                    </div>

                    <div class="portlet-body form">
                        <form action="{{ route('admin.subscribtions.send')}}"
                        onsubmit="return false;" method="post">
                                 {!! csrf_field() !!}
                            <div class="form-body row">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>
                                            Subject
                                        </label>
                                        <input type="text" name="subject" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>
                                            Content
                                        </label>
                                        <textarea class="form-control" rows="10" ></textarea>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn addBTN btn-app"
                                 data-loading ="loading">
                                    <i class="fa fa-send"></i>
                                            Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div><!--End portlet-->
            </div>
        </div>

        <div class="row">
            <form action="{{ url('admin/subscribtions/') }}" onsubmit="return false;">
                {!! csrf_field() !!}
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-plane font-dark"></i>
                            <span class="caption-subject bold uppercase">All subscribtions</span>
                        </div>
                    </div>
                    <div class="margin-bottom row">
                        <div class="row top-table">
                            <div class=" col-md-8 col-xs-8">
                                <div class="col-md-8 col-xs-8">
                                    <div class="btn-group" data-toggle="buttons">

                                        <label class="btn btn-sm btn-default" title="All Products">
                                            <input type="radio" name="options" class="btn-filter" data-filter="all" autocomplete="off" >
                                            all
                                        </label>
                                        <label class="btn btn-sm btn-default" title="Active Products">
                                            <input type="radio" name="options"  class="btn-filter" data-filter="seen" autocomplete="off">
                                            <i class="fa fa-eye text-success"></i>
                                            seen
                                        </label>
                                        <label class="btn btn-sm btn-default" title="Rejected Products">
                                            <input type="radio" name="options" class="btn-filter" data-filter="unseen" autocomplete="off">
                                            <i class="fa fa-eye-slash text-danger"></i>
                                            unseen
                                        </label>
                                        <label class="btn btn-sm btn-default" title="Today products">
                                            <input type="radio" name="options" class="btn-filter" data-filter="today" autocomplete="off">
                                            <i class="fa fa-bell text-info "></i>
                                            today
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            change to <i class="fa fa-cogs text-danger"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#" class="btn-action"  data-action="seen"><span><i class="fa fa-eye text-primary"></i></span> &nbsp;seen</a></li>
                                            <li><a href="#" class="btn-action"  data-action="unseen"><span><i class="fa fa-eye-slash text-danger"></i></span> &nbsp;unseen</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class=" ser-a-del col-md-4 col-xs-4">
                                <div class="col-xs-8 inner-col">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-sm"  id="input-search" placeholder="search her...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-success btn-search" data-search="product" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="addNew col-md-4 bcol-xs-4">
                                    <button type="button" class="btn btn-danger btn-sm btn-action"  data-action="deleted">
                                        <i class="fa fa-trash"></i>
                                        delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body" id="ajax-table">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped table-responsive text-center">
                                <thead>
                                    <tr >
                                        <th id="ID" style="width: 50px;">
                                            <input id="chk-all" type="checkbox">
                                        </th>
                                        <th>Email</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscribtions as $subscribtion)
                                        <tr class="{{ $subscribtion->seen ? 'success':'warning'}}">
                                            <td class="ID">
                                                <input name="ids[]" class="chk-box" value="{{ $subscribtion->id}}" type="checkbox">
                                            </td>
                                            <td>{{ $subscribtion->email }}</td>
                                            <td>{{ $subscribtion->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
            </form>
        </div>

    </div>
@endsection
