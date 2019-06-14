@extends('site.layouts.master')
@section('title')
    Search
@endsection
@section('content')
    <section class="page-header">
        <div class="container"></div>
    </section><!--End Welcome-Home-->
    <div class="page-content section-lg">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-9">
                    <div class="filter-section">
                        <div class="filter-section-head">
                        
                            <div class="pull-right">
                                <a class="list">
                                    <i class="fa fa-th-list"></i>
                                </a>
                                <a class="grid active">
                                    <i class="fa fa-th"></i>
                                </a>
                                <a class="block ">
                                    <i class="fa fa-th-large"></i>
                                </a>
                            </div>
                        </div><!--End Filter-box-head-->
                    </div><!--End Filter-section-->

                    <div id="trips-area">
                        @include('site.pages.search.templates.global',compact('result'))
                    </div>
                </div><!--End Col-sm-8-->
            </div><!--End Row-->
        </div><!--End Container-->
    </div>
@endsection