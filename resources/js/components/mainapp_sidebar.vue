<template>
    <div>
       <!--Breadcrumb-->
		<section>
			<div class="bannerimg cover-image bg-background3" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text mb-0">
					<div class="container">
						<div class="text-center text-white">
							<h1 class="">My Dashboard</h1>
							<ol class="breadcrumb text-center">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active text-white" aria-current="page">My Dashboard</li> 
							</ol>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Breadcrumb-->
      
       <!--User Dashboard-->
		<div class="sptb my_profile_bg">
			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-12 col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">My Dashboard</h3>
							</div>
							<div class="card-body text-center item-user border-bottom">
								<div class="profile-pic">
									<div class="profile-pic-img">
										<!-- <span class="bg-success dots" data-toggle="tooltip" data-placement="top" title="online"></span> -->
										<template v-if="authUser.image">
											<img :src="authUser.image" alt="image" class="avatar brround  mr-2"> 
										</template>
										<template v-else>
											<img src="/img/profile.png" class="brround" alt="user">
										</template>
									</div>
									<a  class="text-dark"><h4 class="mt-3 mb-0 font-weight-semibold">{{ authUser.username }}</h4></a>
								</div>
							</div>
							<div class="item1-links  mb-0">
								<router-link to="/user_profile/edit-profile" class="d-flex border-bottom" :class=" $route.path == '/user_profile/edit-profile' ?'active': ''">
									<span class="icon1 mr-3"><i class="icon icon-user"></i></span> Account info
								</router-link>
								<router-link to="/user_profile/my-listing" class=" d-flex  border-bottom" :class=" $route.path == '/user_profile/my-listing' ?'active': ''">
									<span class="icon1 mr-3"><i class="icon icon-diamond"></i></span> My Listings
								</router-link>
								<router-link to="/user_profile/my-favorite" class=" d-flex  border-bottom" :class=" $route.path == '/user_profile/my-favorite' ?'active': ''">
									<span class="icon1 mr-3"><i class="icon icon-heart"></i></span> My Favorites
								</router-link>
								<router-link to="/add-post" class=" d-flex  border-bottom" >
									<span class="icon1 mr-3"><i class="dropdown-icon icon icon-speech"></i></span> Add Listing
								</router-link>

								<a href="/logout" class="d-flex">
									<span class="icon1 mr-3"><i class="icon icon-power"></i></span> Logout
								</a>
							</div>
						</div>
						<!-- <div class="card my-select">
							<div class="card-header">
								<h3 class="card-title">Search </h3>
							</div>
							<div class="card-body">
								<div class="form-group">
									<input type="text" class="form-control" id="text" placeholder="What are you looking for?">
								</div>
								<div class="form-group">
									<select name="country" id="select-countries" class="form-control custom-select select2-show-search">
										<option value="1" selected="">All Categories</option>
										<option value="2">RealEstate</option>
										<option value="3">Restaurant</option>
										<option value="4">Beauty</option>
										<option value="5">Jobs</option>
										<option value="6">Services</option>
										<option value="7">Vehicle</option>
										<option value="8">Education</option>
										<option value="9">Electronics</option>
										<option value="10">Pets &amp; Animals</option>
										<option value="11">Computer</option>
										<option value="12">Mobile</option>
										<option value="13">Events</option>
										<option value="14">Travel</option>
										<option value="15">Clothing</option>
									</select>
								</div>
								<div class="">
									<a href="#" class="btn  btn-primary">Search</a>
								</div>
							</div>
						</div>
						<div class="card mb-xl-0">
							<div class="card-header">
								<h3 class="card-title">Safety Tips For Buyers</h3>
							</div>
							<div class="card-body">
								<ul class="list-unstyled widget-spec  mb-0">
									<li class="">
										<i class="fa fa-check text-success" aria-hidden="true"></i> Meet Seller at public Place
									</li>
									<li class="">
										<i class="fa fa-check text-success" aria-hidden="true"></i> Check item before you buy
									</li>
									<li class="">
										<i class="fa fa-check text-success" aria-hidden="true"></i> Pay only after collecting item
									</li>
									<li class="ml-5 mb-0">
										<a href="tips.html"> View more..</a>
									</li>
								</ul>
							</div>
						</div> -->
					</div>
					<div class="col-xl-9 col-lg-12 col-md-12">
						<router-view/>
					</div>

				</div>
			</div>
		</div>
		<!--/User Dashboard-->
    </div>
</template>

<script>
export default {
   
    data(){
       return {
   
       }
    }, 
    created(){
		// this.$store.commit('setAuthUser', (window.authUser));
    }
}
</script>