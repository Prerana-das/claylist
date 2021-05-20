<template>
  <div>
     <!--Breadcrumb-->
		<section>
			<div class="bannerimg cover-image bg-background3" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text mb-0">
					<div class="container">
						<div class="text-center text-white">
							<h1 class="">User Profile</h1>
							<ol class="breadcrumb text-center">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active text-white" aria-current="page">User Profile</li> 
							</ol>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!--User Profile-->
		<section class="sptb">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body pattern-1">
								<div class="wideget-user">
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<div class="wideget-user-desc text-center">
												<div class="wideget-user-img p_user_pro_img">
													<template v-if="userData.image">
														<img class="brround" :src="userData.image" alt="user">
													</template>
													<template v-else>
														<img src="/img/profile.png" class="brround" alt="user">
													</template>
												</div>
												<div class="user-wrap wideget-user-info p_user_title">
													<a class="text-white"><h4 class="font-weight-semibold">{{ userData.name }}</h4></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<div class="wideget-user-tab">
									<div class="tab-menu-heading">
										<div class="tabs-menu1">
											<ul class="nav">
												<li class=""><a href="#tab-5" class="active" data-toggle="tab">Profile</a></li>
												<li><a href="#tab-7" data-toggle="tab" class="">All listings</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-0 p_user_profile_bg">
							<div class="card-body">
								<div class="border-0">
									<div class="tab-content">
										<div class="tab-pane active" id="tab-5">
											<div class="profile-log-switch">
												<div class="media-heading">
													<h3 class="card-title mb-3 font-weight-bold">Personal Details</h3>
												</div>
												<ul class="usertab-list mb-0">
													<li><p class="text-dark"><span class="font-weight-semibold">Full Name :</span> {{ userData.name }}</p></li>
													<li><p class="text-dark"><span class="font-weight-semibold">Location :</span> {{ userData.city }}</p></li>
													<li v-if="userData.email_isTrue==1"><a class="text-dark" :href="`mailto:${userData.email}`" target="_black"><span class="font-weight-semibold text-dark">Email :</span> {{ userData.email }}</a></li>
													<li v-if="userData.phone_isTrue==1"><p class="text-dark"><span class="font-weight-semibold">Phone :</span> {{ userData.phone }} </p></li>
												</ul>
											</div>
										</div>
										<div class="tab-pane userprof-tab" id="tab-7">
											<div class="table-responsive border-top">
												<table class="table table-bordered table-hover mb-0 text-nowrap">
												<thead>
													<tr>
														<th>Item</th>
														<th>Breed</th>
														<th>Category</th>
														<th>Price</th>
														<th>Listing Status</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="(item,index) in listingData" :key="index">
														<td>
															<div class="media mt-0 mb-0">
																<div class="card-aside-img">
																	<template v-if="item.all_images">
																		<span v-for="(i,index2) in item.all_images.slice(0,1)" :key="index2">
																			<img :src="item.all_images[index2=0].image" alt="img" class="cover-image">
																			</span>
																	</template>
																</div>
																<div class="media-body">
																	<div class="card-item-desc ml-4 p-0">
																		<h4 class="font-weight-semibold text-dark">{{item.title}}</h4>
																		<p><i class="fa fa-clock-o mr-1"></i> {{isMonthDate(item.created_at)}}</p>
																		<a :href="`/listing_details/${item.id}`"><i class="fa fa-tag mr-1"></i> Open</a>

																	</div>
																</div>
															</div>
														</td>
														<td>
															<span v-if="item.breed">
																{{item.breed.name}}
															</span>
														</td>
														<td>
															<span v-if="item.category">
																{{item.category.name}}
															</span>
														</td>
														<td class="font-weight-semibold fs-16">${{item.price}}</td>
														<td>
															<p class="badge badge-warning">{{item.status}}</p>
														</td>
													</tr>
												</tbody>
											</table>
											</div>
											<div style="text-align:center;" class="pagination_div _mar_t30 mt-3">
												<Page :current="pagination.current_page" :total="pagination.total" @on-change="getpaginate" :page-size="parseInt(pagination.per_page)" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
  </div>
</template>

<script>
import moment from "moment";
    export default {
        data () {
            return {
				userData:{},
				listingData:[],
				page:1,
				total:"7",
				pagination: {},
			}
        },
        methods: {
			async getpaginate(page = 1){
				const res  = await this.callApi('get',`get_approved_listing?page=${page}&total=${ parseInt(this.total)}&user_id=${this.$route.params.id}`)
				if(res.status == 200){
					this.listingData = res.data.data
					this.pagination = res.data
				}
				else{
					this.swr()
				}
			},
			isMonthDate(date) {
				return moment(date).format("MMM Do");
			},
			
		},
		 async created(){
			const [res1,res2] = await Promise.all([ 
				this.callApi('get',`get_user?user_id=${this.$route.params.id}`),
				this.callApi('get',`get_approved_listing?total=${this.total}&user_id=${this.$route.params.id}`),
			])
			if(res1.status == 200 && res2.status) {
				this.userData = res1.data
				this.listingData = res2.data.data
				this.pagination = res2.data
			}
			else{
				this.swr()
			}
    	}
    }
</script>