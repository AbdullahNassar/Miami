@extends('site.layouts.master')
@section('title')
    Contact US
@endsection
@section('content')
    <section class="page-header">
        <div class="container">
        </div>
    </section><!--End Welcome-Home-->
    <div class="page-content">
        <section class="section-settings">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-10">
                        <div class="section-description">
                            <h2 class="section-title">
                                CONTACT US
                            </h2>
                        </div><!--End Section description-->
                    </div><!--End Col-sm-5-->
                </div><!--End Row-->
                <div class="row">
                    @foreach($contact as $d)
                    <div class="col-md-4">
                        <div class="contact-widget">
                            <div class="contact-widget-icon">
                                <i class="fa {{$d->contact['icon']}}"></i>
                            </div>
                            <div class="contact-widget-cont">
                                <h5 class="title">
                                    {{$d->title}}
                                </h5>
                                <span>{{$d->content}}</span>
                            </div>
                        </div><!--End Contact-widget-->
                    </div><!--End Col-md-4-->
                    @endforeach
                </div><!--End Row-->
            </div><!--End Container-->
            <div class="contact-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="contact-box">
                                <form class="contactUs" action="{{route('site.contact')}}" method="post">
                                    {!! csrf_field() !!}
                                    <div class="alert alert-success hidden" id="contact-alert-success">
                                        Your message has been sent successfuly
                                    </div>
                                    <div class="alert alert-danger hidden" id="contact-alert-error">
                                        Error please try again later
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="name" data-msg-required="Please enter your name" type="text" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" name="email" data-msg-required="Please enter your email" type="email" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" data-msg-required="Please enter your message" placeholder="Your Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-submit" type="submit">Send</button>
                                    </div>
                                </form>
                            </div><!--End Contact-box-->
                        </div><!--End Col-md-5-->
                        <div class="col-md-7">
                            <div class="contact-map">
                                <div class="map-wrap">
                                    <div id="map"></div>
                                </div><!--End map-wrap-->
                            </div>
                        </div><!--End Col-md-7-->
                    </div><!--End Row-->
                </div><!--End Container-->
            </div><!--End Contact-->
        </section>
    </div><!--End page-content-->
@endsection