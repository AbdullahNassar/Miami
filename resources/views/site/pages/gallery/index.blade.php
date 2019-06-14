@extends('site.layouts.master')
@section('title')
Gallery
@endsection
@section('content')
<section class="page-header">
    <div class="container">
    </div>
</section><!--End Welcome-Home-->
<div class="page-content">
    <section class="galary section-lg">
        <div class="container">
            <div class="row galary-wrapper">
                @foreach($gallery as $gal)
                <div class="col-md-3 col-sm-6">
                    <a href="{{url('storage/uploads/gallery/'.$gal->image)}}" rel="prettyPhoto[myGallery]">
                        <img src="{{url('storage/uploads/gallery/'.$gal->image)}}" alt="gallary-img"/>
                    </a>
                </div>
                @endforeach
            </div><!--End Row-->
        </div><!--End Container-->
    </section>
</div><!--End page-content-->
@endsection
