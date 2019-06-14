@extends('site.layouts.master')
@section('title')
    Category
@endsection
@section('content')
    <section class="page-header">
        <div class="container"></div>
    </section><!--End Welcome-Home-->
    <div class="page-content section-lg">
    <div class="container">
        <form action="{{$base_url}}">
            <div class="row">
                <div class="col-sm-3">
                    <div class="filter-section">
                        <div class="filter-section-head">
                            <h4 class="title"> refine result</h4>
                        </div><!--End Filter-box-head-->
                        <div class="filter-section-body">
                            <div class="filter-box">
                                <div class="filter-box-head">
                                    <h4 class="title">categoris</h4>
                                </div><!--End Filter-box-head-->
                                <div class="filter-box-cont">
                                    <div class="cat-item">
                                        <div class="radio-item">
                                            <input type="radio" id="all" name="category" value="0">
                                            <label for="all" class="cat-label">all {{\App\CategoryTrans::where('slug' ,$slug)->where('lang' ,app()->getLocale())->value('name')}}</label>
                                        </div><!--End Radio item-->
                                        <div class="number-count">
                                            <span></span>
                                        </div>
                                    </div><!--End cat-item-->
                                    @foreach($categories as $category)
                                    <div class="cat-item">
                                        <div class="radio-item">
                                            <input type="radio" id="{{$category->name}}" name="category" value="{{$category->id}}" >
                                            <label for="{{$category->name}}" class="cat-label">{!! substr($category->name,0,15)!!}</label>
                                        </div><!--End Radio item-->
                                        <div class="number-count">
                                            <span>{{$category->count}}</span>
                                        </div>
                                    </div><!--End cat-item-->
                                    @endforeach
                                </div><!--End Filter-box-cont-->
                            </div><!--End Filter-box-->

                            <div class="filter-box">
                                <div class="filter-box-head">
                                    <h4 class="title">price</h4>
                                </div><!--End Filter-box-head-->
                                <div class="filter-box-cont">
                                    <div class="widget-range">
                                        <div class="clearfix">
                                            <input class="first_limit" readonly name="first_limit" type="text" data-value="1" value="$1">
                                            <input class="last_limit" readonly name="last_limit" type="text" data-value="500" value="$500">
                                        </div>
                                        <div class="price-ranger" id="price"></div>
                                    </div><!--End widget-range-->
                                </div><!--End Filter-box-cont-->
                            </div><!--End Filter-box-->

                            <div class="filter-box">
                                <div class="filter-box-head">
                                    <h4 class="title">location</h4>
                                </div><!--End Filter-box-head-->
                                <div class="filter-box-cont">
                                @foreach($places as $place)
                                    @foreach ($place as $pl)
                                        <div class="cat-item">
                                            <div class="radio-item">
                                                <input type="radio" id="{{$pl->translated()->name}}" name="location" value="{{$pl->id}}" >
                                                <label for="{{$pl->translated()->name}}" class="cat-label">{{$pl->translated()->name}}</label>
                                            </div><!--End Radio item-->
                                        </div><!--End cat-item-->
                                    @endforeach
                                @endforeach
                                </div><!--End Filter-box-cont-->
                            </div><!--End Filter-box-->
                        </div><!--End Filter-box-body-->
                    </div><!--End Filter-box-->
                </div><!--End Col-sm-3-->
                <div class="col-sm-9">
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
                        @include('site.pages.category.templates.cat',compact('trips'))
                    </div>
                </div><!--End Col-sm-8-->
            </div><!--End Row-->
        </form>
    </div><!--End Container-->
    </div>
@endsection