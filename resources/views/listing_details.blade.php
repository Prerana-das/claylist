<!doctype html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>      
        <!-- META DATA -->         
        <meta charset="UTF-8"> 
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'> 
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="description" content="Buy , Sale , Barter">
        {{-- <meta name="description" content="Claylist - Classifieds, Directory, Multipurpose Listing HTML Template"> 
        <meta name="author" content="Spruko Technologies Private Limited"> 
        <meta name="keywords" content="directory listing html template, bootstrap html template, directory html template, directory website template, directory listing html template, directory listing template, listing website template, business directory template, membership directory template, directory template, service directory template, bootstrap business directory template, directory listing website template, business directory html template, online directory template, online directory website templates, best website templates, html template, html5 template, themeforest html, themeforest html templates">  --}}
        <link rel="icon" href="favicon.ico" type="image/x-icon"/> 
        <!--Favicon-->	
	    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/fav/favicon.ico"> 
        <!-- Title -->         
        <title>{{$product->title}} - HOOFBARTER</title>  
        <!-- Bootstrap Css -->         
        <link href="/assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet"/> 
        <!-- Dashboard Css -->         
        <link href="/assets/css/dashboard.css" rel="stylesheet"/> 
        <!-- Font-awesome  Css -->         
        <link href="/assets/css/icons.css" rel="stylesheet"/> 
        <!--Horizontal Menu-->         
        <link href="/assets/plugins/Horizontal2/Horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet"/> 
        <link href="/assets/plugins/Horizontal2/Horizontal-menu/horizontal.css" rel="stylesheet"/> 
        <!--Select2 Plugin -->         
        <link href="/assets/plugins/select2/select2.min.css" rel="stylesheet"/> 
        <!-- Cookie css -->         
        <link href="/assets/plugins/cookie/cookie.css" rel="stylesheet"> 
        <!-- Owl Theme css-->         
        <link href="/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet"/> 
        {{-- <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel="stylesheet"/>  --}}
        <!-- Custom scroll bar css-->         
        <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/> 
        <!-- COLOR-SKINS -->         
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="/assets/webslidemenu/color-skins/color10.css"/> 
    </head>  
	<script>
		(function () {
			window.Laravel = {
				csrfToken: '{{ csrf_token() }}'
			};
			@if(Auth::check())
				window.authUser={!! Auth::user() !!}
				@else
				window.authUser=false
				@endif
		})();
   </script>
    <body>
		<div class="header-main"> 
            <div class="top-bar p-3"> 
                <div class="container"> 
                    <div class="row"> 
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-7"> 
                            <div class="top-bar-left d-flex"> 
                                <div class="clearfix"> 
                                    <!-- <ul class="socials"> 
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-facebook"></i></a></li>                                         
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-twitter"></i></a> </li>                                         
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-linkedin"></i></a> </li>                                         
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-google-plus"></i></a></li>                                         
                                    </ul>                                      -->
                                </div>                                 
                                <div class="clearfix"> 
                                    <ul class="contact border-left"> 
                                        <li class="mr-5 d-lg-none"><a href="#" class="callnumber text-dark"><span><i class="fa fa-phone mr-1"></i>: +425 345 8765</span></a></li>                                         
                                    </ul>                                     
                                </div>                                 
                            </div>                             
                        </div>                         
                        <div class="col-xl-4 col-lg-4 col-sm-8 col-5 d-none d-lg-block"> 
                            <div class="clearfix text-center"> 
                                <div class="header-search-logo d-none d-lg-block"> 
                                    <a class="header-logo" href="/"> <img src="/assets/images/brand/logo.png" class="header-brand-img" alt="dashr logo"> </a> 
                                </div>                                 
                            </div>                             
                        </div>                         
                        <div class="col-xl-4 col-lg-4 col-sm-8 col-5"> 
                            <div class="top-bar-right"> 
                                <ul class="custom"> 
                                    <!-- <template v-if="isLoggedIn==false"> -->
									@if(!Auth::check())
                                        <li> 
                                            <a href="/register" class="text-dark">
                                                <i class="fa fa-user mr-1"></i> <span>Register</span>
											</a>
										</li>                                   
                                        <li> 
                                            <a href="/login" class="text-dark">
                                                <i class="fa fa-sign-in mr-1"></i> <span>Login</span>
											</a>
										</li>
									@else 
                                        <li class="dropdown"> 
                                            <a href="#" class="text-dark" data-toggle="dropdown"><i class="fa fa-home mr-1"></i><span> My Dashboard</span></a> 
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                                                <a href="/user_profile/edit-profile" class="dropdown-item"> <i class="dropdown-icon icon icon-user"></i> My Profile</a> 
                                                <a class="dropdown-item" href="/user_profile/my-listing"> <i class="dropdown-icon icon icon-speech"></i>My Listing</a> 
                                                <a class="dropdown-item" href="/logout"> <i class="dropdown-icon icon icon-power"></i> Log out</a> 
                                            </div>                                         
                                        </li>  
									@endif    
                                </ul>                                 
                            </div>                             
                        </div>                        
                    </div>                     
                </div>                 
            </div>             
            <!-- Mobile Header -->             
            <div class="horizontal-header clearfix "> 
                <div class="container"> 
					<a  id="horizontal-navtoggle" class="animated-arrow"><span></span>
					</a> 
					<a href="/">
						<span class="smllogo"><img src="/assets/images/brand/logo.png" width="120" alt=""/></span> 
					</a>
                    <a href="tel:245-6325-3256" class="callusbtn"><i class="fa fa-phone" aria-hidden="true"></i></a> 
                </div>                 
            </div>             
            <!-- /Mobile Header -->             
            <div class="header-style horizontal-main  bg-dark-transparent clearfix"> 
                <div class="horizontal-mainwrapper container clearfix"> 
                    <!--Nav-->                     
                    <nav class="horizontalMenu clearfix d-md-flex">   
						<ul class="horizontalMenu-list main_menu"> 
							<li aria-haspopup="true">
                                <a href="/">Home </a>                                  
                            </li>                       
                            <!-- <li aria-haspopup="true">
                              <a href="/coming-soon">
                                    <span>Stud Service</span>
                                </a>                                
                            </li>  
                                                                               -->
                        </ul>     
                        <ul class="horizontalMenu-list mobile_menu"> 
                             <li aria-haspopup="true">
                                <a href="/">Home </a>                                  
                            </li>                           
                            <li aria-haspopup="true" class="mt-5 d-lg-block creatinggg"> 
                                <span>
                                    <a href="/add-post" class="ad-post btn btn-lg btn-orange">
                                        CREATE LISTING
                                     </a>
                                </span> 
                            </li>                                                        
                        </ul>                  
						<ul class="mb-0 right_btns"> 
                            <li aria-haspopup="true" class="mt-5 d-none d-lg-block creatinggg"> 
                                <span>
									<a href="/add-post" class="ad-post btn btn-lg btn-orange">
                                        CREATE LISTING
                                    </a>
                                </span> 
                            </li>                             
                        </ul>                         
                    </nav>                     
                    <!--Nav-->                     
                </div>                 
            </div>             
        </div> 
		<div class="bannerimg cover-image bg-background3 sptb-2" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text mb-0">
					<div class="container">
						<div class="text-center text-white ">
							<h1 class="">Listing Details</h1>
							<ol class="breadcrumb text-center">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item"><a href="/classifieds_list">Classifieds List</a></li>
								<li class="breadcrumb-item active text-white" aria-current="page">Listing Details</li>
							</ol>
						</div>
					</div>
				</div>
			</div>

		<!--Breadcrumb-->
		<div class="bg-white border-bottom">
			<div class="container">
				<div class="page-header">
					<h4 class="page-title">Listing Details</h4>
					<!-- <ol class="breadcrumb">
						<li class="breadcrumb-item">Home</li>
						<li class="breadcrumb-item">Classifieds List</li>
						<li class="breadcrumb-item active" aria-current="page">Listing Details</li>
					</ol> -->
				</div>
			</div>
		</div>
		<!--/Breadcrumb-->

		<!--Add listing-->
		<section class="sptb">
			<div class="container">
				<div class="row">
					<div class="col-xl-8 col-lg-8 col-md-12">
						<!--Add Description-->
						<div class="card overflow-hidden slider_bg">
							<!-- <div class="ribbon ribbon-top-right text-danger"><span class="bg-danger">featured</span></div> -->
							<div class="card-body" >
								<div class="item-det mb-4">
									<h3 class="text-dark listing_details_title">{{$product->title}}</h3>
									<ul class="d-flex">
										<li class="mr-5"><a href="#" class="icons"><i class="icon icon-briefcase text-muted mr-1"></i> {{$product->category['name']}}</a></li>
										<li class="mr-5"><a href="#" class="icons"><i class="icon icon-location-pin text-muted mr-1"></i> {{$product->city}}</a></li>
										<li class="mr-5"><a href="#" class="icons"><i class="icon icon-calendar text-muted mr-1"></i> {{$product->created_at}}</a></li>
										<li class="mr-5"><a href="#" class="icons"><i class="icon icon-eye text-muted mr-1"></i> {{$product->view_count}}</a></li>
									</ul>
								</div>
								<div class="product-slider">
									<div class="property_top_slider">
										<div class="property_images_one owl-carousel">
											<!-- ITEM -->
											@foreach($product->allImages as $rowww)
											<div class="single-pro-img"> 
												<img src="{{asset($rowww->image)}}" alt="image">
											</div>
											@endforeach
										</div>
									</div>
									<div class="property_bottom_slider">
										<div class="property_images owl-carousel">
											<!-- ITEM -->
											@foreach($product->allImages as $rowww)
											<div class="single-pro-img"> 
												<img src="{{asset($rowww->image)}}" alt="image">
											</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card des_card">
							<div class="card-header">
								<h3 class="card-title">Description</h3>
							</div>
							<div class="card-body">
								<div class="mb-4">
									<p>{{$product->description}}</p>
								</div>
								<h4 class="mb-4">Specifications</h4>
								<div class="row">
									<div class="col-md-12">
										<ul class="list-unstyled widget-spec mb-0">
                                            @if(!empty($product->category))
											<li class="">
												<i class="fa fa-codepen text-muted w-5"></i> Category : {{$product->category['name']}}
											</li>
                                            @endif
                                            @if(!empty($product->animal_type))
											<li class="">
                                                <i class="fa fa-pagelines text-muted w-5"></i> Animal Type : 
                                                {{$product->animal_type['name']}}
											</li>
                                            @endif
                                            @if(!empty($product->breed))
											<li class="">
                                                <i class="fa fa-eject text-muted w-5"></i> Breed : 
                                                {{$product->breed['name']}}
											</li>
                                            @endif
                                            @if(!empty($product->gender))
											<li class="">
												<i class="fa fa-building-o text-muted w-5"></i> Gender : {{$product->gender}}
											</li>
                                            @endif
                                            @if(!empty($product->age))
											<li class="">
												<i class="fa fa-trophy text-muted w-5"></i> Age : {{$product->age}}
											</li>
                                            @endif
                                            @if(!empty($product->color))
											<li class="">
												<i class="fa fa-lock text-muted w-5"></i> Color : {{$product->color}}
											</li>
                                            @endif
                                            @if(!empty($product->price))
											<li class="">
												<i class="fa fa-tag text-muted w-5"></i> Price : ${{$product->price}}
											</li>
                                            @endif
										</ul>
									</div>
									<!-- <div class="col-xl-6 col-md-12">
										<ul class="list-unstyled widget-spec mb-0">
                                            
										</ul>
									</div> -->
								</div>
							</div>
							<!-- <div class="card-footer">
								<div class="icons">
									<a href="#" class="btn btn-info icons"><i class="icon icon-share mr-1"></i> Share Ad</a>
									<a href="#" class="btn btn-danger icons" data-toggle="modal" data-target="#report"><i class="icon icon-exclamation mr-1"></i> Report Abuse</a>
									<a href="#" class="btn btn-primary icons"><i class="icon icon-heart  mr-1"></i> 678</a>
									<a href="#" class="btn btn-secondary icons"><i class="icon icon-printer  mr-1"></i> Print</a>
								</div>
							</div> -->
						</div>
						<!--/Add Description-->
						<div id="app">
							<comment></comment>
						</div>
						
					</div>

					<!--Right Side Content-->
					<div class="col-xl-4 col-lg-4 col-md-12">
						<div class="card posted_by">
							<div class="card-header">
								<h3 class="card-title">Posted By</h3>
							</div>
							<div class="card-body  item-user">
								<div class="profile-pic mb-0">
									<!-- <span>
									@if($product->user['image']!= null)
										<img src="{{$product->user['image']}}" class="brround avatar-xxl" alt="user">
									@else
										<img src="../../img/profile.png" class="brround avatar-xxl" alt="user">
									@endif
									</span> -->
									<div class="">
										<h4 class="mt-3 mb-1 font-weight-semibold">{{$product->user['username']}}</h4>
										<!-- <span class="text-muted">Member Since November 2008</span> -->
										<h6 class="mt-2 mb-0"><a href="/user-profile/{{ $product->user['id'] }}" class="btn btn-primary btn-sm">View all listings</a></h6>
									</div>
								</div>
							</div>
							<div class="card-body item-user ">
								<h4 class="mb-4 contact_info_title">Contact Info</h4>
								<!-- <div> -->
                                @if($product->user['email_isTrue']==1)
                                    <h6><span class="font-weight-semibold "><i class="fa fa-envelope mr-2 mb-2"></i></span><a href="mailto:{{$product->user['email']}}" target="_blank" class="text-body contact_info_item"> {{$product->user['email']}}</a></h6>
                                @endif 
                                @if($product->user['phone_isTrue']==1)
                                    <h6><span class="font-weight-semibold "><i class="fa fa-phone mr-2  mb-2"></i></span><span class="text-body contact_info_item"> {{$product->user['phone']}}</span></h6>
                                @endif 
                                    
                                    
								<!-- </div> -->
							</div>
						</div>
					</div>
					<!--Right Side Content-->
				</div>
			</div>
		</section>
		 <!--Footer Section-->         
		 <section> 
            <footer class="bg-dark-purple text-white"> 
                <div class="footer-main"> 
                    <div class="container"> 
                        <div class="row"> 
                            <div class="col-lg-3 col-md-12"> 
                                <h6>About</h6> 
                                <hr class="deep-purple  accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
								<p>“Hoof Barter. A space created to connect buyers, sellers and barters of hooved animals and accessories”</p> 
                            </div>   
							<div class="col-lg-1"> 
                            </div>                                                       
							<div class="col-lg-4 col-md-12"> 
                                <h6>Contact</h6> 
                                <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
                                <ul class="list-unstyled mb-0"> 
                                    <li> 
                                        <p class="text-white"><i class="fa fa-home mr-3 text-primary"></i> Charlotte, NC 28216</p> 
                                    </li>                                     
                                    <li> 
                                        <a href="mailto:hoofbarter@gmail.com" class="text-white" target="_blank"><i class="fa fa-envelope mr-3 text-primary"></i>hoofbarter@gmail.com</a>
                                    </li>                                     
                                    <!-- <li> 
                                        <p class="text-white"><i class="fa fa-phone mr-3 text-primary"></i>828-612-8600</p> 
                                    </li>                                                                          -->
                                </ul>                                 
                                <ul class="list-unstyled list-inline mt-3"> 
                                    <li class="list-inline-item"> 
										@if($settings->facebook) 
                                        <a href='{{ $settings->facebook }}' target="_blank" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-facebook bg-info"></i></a> 
										@else
										<a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-facebook bg-info"></i></a> 
										@endif
                                    </li>                                     
                                    <li class="list-inline-item">
										@if($settings->twitter) 
                                        <a href='{{ $settings->twitter }}' target="_blank" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-twitter bg-info"></i> </a> 
										@else
                                        <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-twitter bg-info"></i> </a> 
										@endif
                                    </li>                                     
                                    <li class="list-inline-item"> 
										@if($settings->google)
                                        <a href='{{ $settings->google }}' target="_blank" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-google-plus bg-info"></i> </a> 
										@else
                                        <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-google-plus bg-info"></i> </a> 
										@endif
                                    </li>                                     
                                    <li class="list-inline-item"> 
										@if($settings->linkedin)
                                        <a href='{{ $settings->linkedin }}' target="_blank" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-linkedin bg-info"></i> </a>
										@else 
                                        <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-linkedin bg-info"></i> </a> 
										@endif
                                    </li>                                     
                                </ul>                                 
                            </div>                              
                            <div class="col-lg-4 col-md-12"> 
                                <h6>Subscribe</h6> 
                                <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
                                <div class="clearfix"></div>                                 
                                <div class="input-group w-70"> 
									<form method="POST" action="/submit_subscription2">
										@csrf		
										<div class="subbb_div">
											<input type="email" name="email" id="email" class="form-control br-tl-3  br-bl-3{{ $errors->has('email') ? ' is-invalid' : '' }}" 
											placeholder="Email" > 
											<div class="input-group-append "> 
												<input type="submit" value="Subscribe" class="btn btn-primary br-tr-3  br-br-3"> </input>                                         
											</div> 
										</div>
										@if ($errors->has('email'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('email') }}</strong>
											</span>
										@endif
									</form>                                    
                                </div>                                 
                                <h6 class="mb-0 mt-5">Payments</h6> 
                                <hr class="deep-purple  text-primary accent-2 mb-2 mt-3 d-inline-block mx-auto"> 
                                <div class="clearfix"></div>                                 
                                <ul class="footer-payments"> 
                                    <li class="pl-0">
                                        <a href="javascript:;"><i class="fa fa-cc-amex text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-cc-visa text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-credit-card-alt text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-cc-mastercard text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-cc-paypal text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                </ul>                                 
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
                <div class="bg-dark-purple text-white p-0"> 
                    <div class="container"> 
                        <div class="row d-flex"> 
                            <div class="col-lg-12 col-sm-12 mb-3 mt-3 text-center"> 
                                Copyright © 2019 
                                <a href="#" class="fs-14 text-primary">Hoof Barter</a>.  All rights reserved. | Designed by              
                                <a href="#" class="fs-14 text-primary">Lail.inc</a>
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
            </footer>             
        </section> 

		

		<!--/Add listing-->
		{{-- <script>
            (function () {
                window.Laravel = {
                    csrfToken: '{{ csrf_token() }}'
                };
                @if(Auth::check())
                    window.authUser={!! Auth::user() !!}
                    @else
                    window.authUser=false
                    @endif
            })();
       </script> --}}

        <script src="/js/app.js"></script>
         <!-- JQuery js-->         
         <script src="/assets/js/vendors/jquery-3.2.1.min.js"></script>         
        <!-- Bootstrap js -->         
        <script src="/assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js"></script>         
        <script src="/assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>         
        <!--JQuery Sparkline Js-->         
        <script src="/assets/js/vendors/jquery.sparkline.min.js"></script>         
        <!-- Circle Progress Js-->         
        <script src="/assets/js/vendors/circle-progress.min.js"></script>         
        <!-- Star Rating Js-->         
        <script src="/assets/plugins/rating/jquery.rating-stars.js"></script>         
        <!--Counters -->         
        <script src="/assets/plugins/counters/counterup.min.js"></script>         
        <script src="/assets/plugins/counters/waypoints.min.js"></script>         
        <script src="/assets/plugins/counters/numeric-counter.js"></script>         
        <!--Owl Carousel js -->         
        <script src="/assets/plugins/owl-carousel/owl.carousel.js"></script>         
        <!--Horizontal Menu-->         
        <script src="/assets/plugins/Horizontal2/Horizontal-menu/horizontal.js"></script>         
        <!--JQuery TouchSwipe js-->         
        <script src="/assets/js/jquery.touchSwipe.min.js"></script>         
        <!--Select2 js -->         
        <script src="/assets/plugins/select2/select2.full.min.js"></script>         
        <script src="/assets/js/select2.js"></script>         
        <!-- sticky Js-->         
        <script src="/assets/js/sticky.js"></script>         
        <!-- Cookie js -->         
        <script src="/assets/plugins/cookie/jquery.ihavecookies.js"></script>         
        <script src="/assets/plugins/cookie/cookie.js"></script>         
        <!-- Custom scroll bar Js-->         
        <script src="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>         
        <!-- Swipe Js-->         
        <script src="/assets/js/swipe.js"></script>         
        <!-- Scripts Js-->         
        <script src="/assets/js/scripts2.js"></script>         
        <!-- Custom Js-->         
        <script src="/assets/js/custom.js"></script>       

    </body>
</html>
