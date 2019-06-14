@extends('site.layouts.master')  
@section('title')
Profile
@endsection 

@section('page-title')
    <li>
        <a href="index.html">
            <i class="fa fa-home"></i>home   
        </a>
    </li>  
    <li class="active">Profile</li>
@endsection 
@section('content')    
    <div class="page-content">
        <div class="container-fluid">                        
            <div class="row">
                <div class="col-sm-9">
                    <div class="top-box">
                        <h3 class="box-title">account information</h3>
                    </div><!--End top-box-->
                    <div class="profile-content">
                        <form method="" action="">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="awner-name">My Name</label>
                                    <input id="awner-name" class="form-control" type="text" placeholder="enter your name">
                                </div><!--End col-md-6-->
                                <div class="col-md-6 form-group">
                                    <label for="awner-email">My Email</label>
                                    <input id="awner-email" class="form-control" type="email" placeholder="enter your Email">
                                </div><!--End col-md-6-->
                                <div class="col-md-6 form-group">
                                    <label for="awner-country">My Country</label>
                                    <input id="awner-country" class="form-control" type="text" placeholder="enter your Country">
                                </div><!--End col-md-6-->
                                <div class="col-md-6 form-group">
                                    <label for="awner-country">My facebook</label>
                                    <input id="awner-facebook" class="form-control" type="text" placeholder="enter your facebook">
                                </div><!--End col-md-6-->
                                <div class="col-md-6 form-group">
                                    <label for="awner-country">My twitter</label>
                                    <input id="awner-twitter" class="form-control" type="text" placeholder="enter your twitter">
                                </div><!--End col-md-6-->
                                <div class="col-md-6 form-group">
                                    <label for="awner-google">My google plus</label>
                                    <input id="awner-google" class="form-control" type="text" placeholder="enter your google plus">
                                </div><!--End col-md-6-->
                                <div class="col-md-12 form-group quality">
                                    <label for="awner-info">My information</label>
                                    <textarea id="awner-info" class="form-control" type="text" placeholder="enter your information" rows="6"></textarea>
                                </div><!--End col-md-12--> 
                            </div><!--End row-->
                            <button type="submit" class="custom-btn">Edit Information</button>
                        </form>
                    </div><!--End Profile-content-->
                </div><!--End Col-sm-9-->
                <div class="col-sm-3">
                    <ul class="account-sidebar">
                        <li class="account-img">
                            <img src="images/avatar.png">
                        </li><!--End account-img-->
                        <li class="active">
                            <a href="profile.html">
                                <i class="fa fa-user"></i>
                                Account Information
                            </a>
                        </li>
                        <li>
                            <a href="profile-items.html">
                                <i class="fa fa-pencil-square-o"></i>
                                My Items
                            </a>
                        </li>
                        <li>
                            <a href="wishlist.html">
                                <i class="fa fa-heart"></i>
                                My Wishlist
                            </a>
                        </li>
                    </ul><!--End account-sidebar-->
                </div><!--End Col-sm-3-->
            </div><!--End Row-->
        </div><!--End container-fluid-->
    </div><!--End page-content-->
@endsection 
    