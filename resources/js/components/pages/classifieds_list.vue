<template>
  <div>
     	<!--Sliders Section--> 
		<div>
			<div class="cover-image bannerimg  banner_area sptb-tab bg-background2" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text1 mb-0">
					<div class="container">
						<div class="row">
							<div class="col-xl-10 col-lg-12 col-md-12 d-block mx-auto">
								<!-- <div class="text-center text-white ">
									<h1 class=""><span class="font-weight-bold">16,25,365</span> Ads Available In Hyderabad</h1>
								</div> -->
								<div class="mb-0">
									<div class="form row no-gutters classified_banner_div">
										<div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white">
											<input v-model="filterKey.key" type="text" class="form-control input-lg border-bottom-0 border-right-0 border-left-0" id="text" placeholder="Search">
										</div>
										<div class="form-group col-xl-3 col-lg-3 select2-lg  col-md-12 mb-0 bg-white">
											<!-- <select v-model="filterKey.categoryId" class="form-control select2-show-search border-bottom-0 w-100" data-placeholder="Select">
												<optgroup label="Categories">
													<option>Select</option>
													<option v-for="(item,index) in categoryData" :key="index" :value="item.id">{{item.name}}</option>
												</optgroup>
											</select> -->
											
											 <select v-model="filterKey.categoryId" class="form-control  border-bottom-0 w-100" data-placeholder="Select" >
												<option v-for="(item,index) in allCategoryData" :key="index" :value="item.id">{{ item.name }}</option>
												<option value="">Select A Category</option>
											</select>
										</div>
										 <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white border_right_one_px"> 
                                           <input v-model="filterKey.cityZip" type="text" class="form-control input-lg border-bottom-0 border-right-0  border-left-0" id="text" placeholder="city or zip" ref="location" @keyup="autocompleteSearch">
                                        </div>
										<!-- <div class="col-xl-2 col-lg-3 col-md-12 mb-0">
											<a @click="getpaginate" class="btn btn-lg btn-block btn-primary br-bl-0 br-tl-0">Search</a>
										</div> -->
										<div class="form-group col-xl-3 col-lg-3 select2-lg  col-md-12 mb-0 search_btn_div "> 
                                            <button @click="getpaginate(1)" type="button" class="btn btn-lg btn-orange" style="width: 175px; margin-right: 24px; height: 47px;">Search</button>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /header-text -->
			</div>
		</div>
		<!--/Sliders Section-->

		<!--Breadcrumb-->
		<div class="bg-white border-bottom">
			<div class="container">
				<div class="page-header">
					<h4 class="page-title">Classifieds list</h4>
					<!-- <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item"><a href="#">Pages</a></li>
						<li class="breadcrumb-item active" aria-current="page">Classifieds list</li>
					</ol> -->
				</div>
			</div>
		</div>
		<!--/Breadcrumb-->

		<!--Add listing-->
		<section class="sptb">
			<div class="container">
				<div class="row">
					<div class="col-xl-3 col-lg-4 col-md-12">
						<div class="card classified_sidebar">
							<form @submit.prevent="getpaginate(1)" >
								<div class="card-header">
									<h3 class="card-title">Category</h3>
									<span v-if="categoryData.length ==0" @click="getCategorywithLimit" class="sidebar_list_icon">
										<i class="fa fa-plus"></i>
									</span>
									<span v-else @click="minimize_category" class="sidebar_list_icon">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<div class="card-body" v-if="categoryData.length > 0">
									<div class="" id="container">
										<div class="filter-product-checkboxs">
											<!-- <CheckboxGroup v-model="filterKey.categories">
												<label class="custom-control custom-checkbox mb-3" v-for="(item,index) in categoryData" :key="index">
													<input type="checkbox" class="custom-control-input" name="checkbox1" value="option1">
													<span class="custom-control-label">
														<a  class="text-dark">{{item.name}}
															<span class="label label-secondary float-right">14</span>
														</a>
													</span>
												</label>
											</CheckboxGroup> -->
											<CheckboxGroup v-model="filterKey.categories" >
												<label class="custom-control custom-checkbox mb-3" v-for="(item,index) in categoryData" :key="index">
													<Checkbox :label="item.id">
														<span>{{item.name}}</span>
													</Checkbox>
												</label>
											</CheckboxGroup>
											<div class="showmore-button" v-if="categoryData.length > 4">
												<div class="showmore-button-inner more" v-if="showButton==false" @click="all_category">Show more</div>
												<div class="showmore-button-inner more" v-if="showButton==true" @click="getCategorywithLimit">Show less</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-header">
									<h3 class="card-title">Animal Type</h3>
									<span v-if="animalTypeData.length ==0" @click="getAnimalTypewithLimit" class="sidebar_list_icon">
										<i class="fa fa-plus"></i>
									</span>
									<span v-else @click="minimize_animal" class="sidebar_list_icon">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<div class="card-body" v-if="animalTypeData.length > 0">
									<div class="" id="container">
										<div class="filter-product-checkboxs">
											<CheckboxGroup v-model="filterKey.animalTypes" >
												<label class="custom-control custom-checkbox mb-3" v-for="(item,index) in animalTypeData" :key="index">
													<Checkbox :label="item.id">
														<span>{{item.name}}</span>
													</Checkbox>
												</label>
											</CheckboxGroup>
											<div class="showmore-button" v-if="animalTypeData.length > 4">
												<div class="showmore-button-inner more" v-if="showButton==false" @click="all_animal_type">Show more</div>
												<div class="showmore-button-inner more" v-if="showButton==true" @click="getAnimalTypewithLimit">Show less</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-header border-top">
									<h3 class="card-title">Breed</h3>
									<span v-if="breedData.length ==0" @click="getBreedwithLimit" class="sidebar_list_icon">
										<i class="fa fa-plus"></i>
									</span>
									<span v-else @click="minimize_breed" class="sidebar_list_icon">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<div class="card-body" v-if="breedData.length > 0">
									<div class="" id="container">
										<div class="filter-product-checkboxs">
											<CheckboxGroup v-model="filterKey.breeds" >
												<label class="custom-control custom-checkbox mb-3" v-for="(item,index) in breedData" :key="index">
													<Checkbox :label="item.id">
														<span>{{item.name}}</span>
													</Checkbox>
												</label>
											</CheckboxGroup>
											<div class="showmore-button" v-if="breedData.length > 4">
												<div class="showmore-button-inner more" v-if="breedShowButton==false" @click="all_breed">Show more</div>
												<div class="showmore-button-inner more" v-if="breedShowButton==true" @click="getBreedwithLimit">Show less</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-header">
									<h3 class="card-title">Discipline</h3>
									<span v-if="desipline_show==false" @click="desipline_show=true" class="sidebar_list_icon">
										<i class="fa fa-plus"></i>
									</span>
									<span v-else @click="desipline_show=false" class="sidebar_list_icon">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<div class="card-body" v-if="desipline_show==true">
									<div class="" id="container">
										<div class="filter-product-checkboxs">
											<CheckboxGroup v-model="filterKey.discipline" >
												<label class="custom-control custom-checkbox mb-3" v-for="(item,index) in allTagsLimit" :key="index">
													<Checkbox :label="item.id">
														<span>{{item.name}}</span>
													</Checkbox>
												</label>
											</CheckboxGroup>
											<div class="showmore-button" v-if="allTags.length > 4">
												<div class="showmore-button-inner more" v-if="showTagButton==false" @click="showTagButton=true">Show more</div>
												<div class="showmore-button-inner more" v-if="showTagButton==true" @click="showTagButton=false">Show less</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-header">
									<h3 class="card-title">Colors</h3>
									<span v-if="color_show==false" @click="color_show=true" class="sidebar_list_icon">
										<i class="fa fa-plus"></i>
									</span>
									<span v-else @click="color_show=false" class="sidebar_list_icon">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<div class="card-body" v-if="color_show==true">
									<div class="" id="container">
										<div class="filter-product-checkboxs">
											<CheckboxGroup v-model="filterKey.color" >
												<label class="custom-control custom-checkbox mb-3" v-for="(item,index) in allColorsLimit" :key="index">
													<Checkbox :label="item.name">
														<span>{{item.name}}</span>
													</Checkbox>
												</label>
											</CheckboxGroup>
											<div class="showmore-button" v-if="allColors.length > 4">
												<div class="showmore-button-inner more" v-if="showColorButton==false" @click="showColorButton=true">Show more</div>
												<div class="showmore-button-inner more" v-if="showColorButton==true" @click="showColorButton=false">Show less</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-header border-top">
									<h3 class="card-title">Gender</h3>
									<span v-if="gender_show==false" @click="gender_show=true" class="sidebar_list_icon">
										<i class="fa fa-plus"></i>
									</span>
									<span v-else @click="gender_show=false" class="sidebar_list_icon">
										<i class="fa fa-minus"></i>
									</span>
								</div>
								<div class="card-body" v-if="gender_show==true">
									<div class="" id="container">
										<div class="filter-product-checkboxs">
											<RadioGroup v-model="filterKey.gender" >
												<label class="custom-control custom-checkbox mb-3" >
													<Radio label="Male">
														<span>Male</span>
													</Radio>
												</label>
												<label class="custom-control custom-checkbox mb-3" >
													<Radio label="Female">
														<span>Female</span>
													</Radio>
												</label>
												<label class="custom-control custom-checkbox mb-3" >
													<Radio label="">
														<span>None</span>
													</Radio>
												</label>
											</RadioGroup>
										</div>
									</div>
								</div>
								<div class="card-header border-top">
									<h3 class="card-title">Distance</h3>
								</div>
								<div class="card-body">
									<h4>
									<label for="price">Miles</label>
									<input type="number" min="1" v-model="filterKey.distance" id="price" >
									</h4>
									
								</div>
								<div class="card-header border-top">
									<h3 class="card-title">Price Range</h3>
								</div>
								<div class="card-body">
									<h4>
									<label for="price">Min</label>
									<input type="number" min="0" v-model="filterKey.min" id="price" >
									</h4>
									<h4>
									<label for="price">Max</label>
									<input type="number" min="0" v-model="filterKey.max" id="price" >
									</h4>
								</div>
								<div class="card-header border-top">
									<h3 class="card-title">Age</h3>
								</div>
								<div class="card-body">
									<h4>
									<label for="price">Min</label>
									<input type="number" min="0" v-model="filterKey.age_min" id="price" >
									</h4>
									<h4>
									<label for="price">Max</label>
									<input type="number" min="0" v-model="filterKey.age_max" id="price" >
									</h4>
								</div>
								<div class="card-footer">
									<button value="submit" class="btn btn-secondary btn-block">Apply Filter</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-xl-9 col-lg-8 col-md-12">
						<!--Add lists-->
						<div class=" mb-lg-0">
							<div class="">
								<div class="item2-gl ">
									<div class=" mb-0">
										<div class="">
											<div class="p-5 bg-white item2-gl-nav d-flex">
												<h6 class="mb-0 mt-2 showing_text">Showing {{pagination.from}} to {{pagination.to}} of {{pagination.total}} entries</h6>
												<ul class="nav item2-gl-menu ml-auto">
													<li class=""><a href="#tab-11" class="active show" data-toggle="tab" title="List style"><i class="fa fa-list"></i></a></li>
													<li><a href="#tab-12" data-toggle="tab" class="" title="Grid"><i class="fa fa-th"></i></a></li>
												</ul>
												<div class="d-flex">
													<label class="mr-2 mt-1 mb-sm-1">Sort By:</label>
													<select v-model="orderTBy" name="item" class="form-control select-sm w-70" @change="orderBy" >
														<option value="1">Latest</option>
														<option value="2">Oldest</option>
														<option value="3">Price:Low-to-High</option>
														<option value="4">Price:Hight-to-Low</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-content classified_list_card_bg" v-if="listingData.length>0">
										<div class="tab-pane active" id="tab-11">
											<div class="card overflow-hidden" v-for="(item,index) in listingData" :key="index">
												<div class="d-md-flex">
													<div class="item-card9-img">
														
															<span>
																<div class="ribbon ribbon-top-left text-danger"><span class="bg-danger">{{item.isFeatured == 1? 'Featured':'General'}}</span></div>
															</span>
															<div class="item-card9-imgs">
																<a :href="`/listing_details/${item.id}`"></a>
																	<template v-if="item.all_images">
																		<span v-for="(i,index2) in item.all_images.slice(0,1)" :key="index2">
																			<img :src="item.all_images[index2=0].image">
																		</span>
																	</template>
																<!-- </a> -->
															</div>
															<div class="item-card9-icons">
																<span v-if="item.wishlist"> 
																	<p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)" :class=" item.wishlist.isTrue == 1 ?'active': ''"> <i class="fa fa fa-heart-o"></i></p>
																</span>
																<span v-else>
																	<p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)"> <i class="fa fa fa-heart-o"></i></p>
																</span>
															</div>
														<!-- </a> -->
													</div>
													<div class="card border-0 mb-0">
														<div class="card-body ">
															<div class="item-card9">
																<a :href="`/listing_details/${item.id}`" class="classified_list_title">{{item.title}}</a>
																<!-- <a :href="`/listing_details/${item.id}`" class="text-dark"><h4 class="font-weight-semibold mt-1">2BK flat </h4></a> -->
																<p class="mb-0 leading-tight classified_des">
																	{{item.description}}
																	
																</p>
															</div>
														</div>
														<div class="card-footer pt-4 pb-4">
															<div class="item-card9-footer d-flex">
																<div class="item-card9-cost">
																	<h4 class="text-dark font-weight-semibold mb-0 mt-0">${{item.price}}</h4>
																</div>
																<div class="ml-auto classifield_list_view">
																	<div class="location mr-3">
																		<i class="fa fa-map-marker text-muted mr-1"></i> {{item.city}} 
																		<span v-if="item.distance"> {{item.distance}} Miles</span>
																	</div>
																	<!-- <a :href="`/listing_details/${item.id}`" class="btn btn-primary btn-sm text-white">
																		<i class="fa fa-eye"></i>
																	</a> -->
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab-12">
											<div class="row">
												<div class="col-lg-6 col-md-12 col-xl-4" v-for="(item,index) in listingData" :key="index">
													<div class="card overflow-hidden" >
														<div class="item-card9-img">
															<!-- <div class="arrow-ribbon bg-primary"></div> -->
															<span>
																<div class="ribbon ribbon-top-left text-danger"><span class="bg-danger">{{item.isFeatured == 1? 'Featured':'General'}}</span></div>
															</span>
															<div class="item-card9-imgs">
																<a :href="`/listing_details/${item.id}`"></a>
																<template v-if="item.all_images">
																	<span v-for="(i,index2) in item.all_images.slice(0,1)" :key="index2">
																		<img :src="item.all_images[index2=0].image" alt="img" class="cover-image">
																	 </span>
																</template>
																
															</div>
															<div class="item-card9-icons">
																<span v-if="item.wishlist">
																	<p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)" :class=" item.wishlist.isTrue == 1 ?'active': ''"> <i class="fa fa fa-heart-o"></i></p>
																</span>
																<span v-else>
																	<p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)"> <i class="fa fa fa-heart-o"></i></p>
																</span>
															</div>
														</div>
														<div class="card-body">
															<div class="item-card9">
																<a :href="`/listing_details/${item.id}`" class="classified_list_title">{{item.title}}</a>
																<a :href="`/listing_details/${item.id}`" class="text-dark mt-2"><h4 class="font-weight-semibold mt-1">{{item.category.name}} </h4></a>
																<p class="classified_des">{{item.description}}</p>
																<!-- <div class="item-card9-desc">
																	<a href="#" class="mr-4"><span class=""><i class="fa fa-map-marker text-muted mr-1"></i> {{item.city}}</span></a>
																</div> -->
															</div>
														</div>
														<div class="card-footer">
															<div class="item-card9-footer d-flex">
																<div class="item-card9-cost grid_list_bottom">
																	<h4 class="text-dark font-weight-semibold mb-0 mt-0">${{item.price}}</h4>
																	<a><span class=""><i class="fa fa-map-marker text-muted mr-1"></i> {{item.city}}</span></a>
																</div>
																<!-- <div class="ml-auto">
																	<div class="rating-stars block">
																		<input type="number" readonly="readonly" class="rating-value star" name="rating-stars-value"  value="3">
																		<div class="rating-stars-container">
																			<div class="rating-star sm">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star sm">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star sm">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star sm">
																				<i class="fa fa-star"></i>
																			</div>
																			<div class="rating-star sm">
																				<i class="fa fa-star"></i>
																			</div>
																		</div>
																	</div>
																</div> -->
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="text-center mt-5" v-else-if="listingData.length == 0 && isLoading== true ">
										<div class="alert alert-secondary" role="alert">
											<p class="_1card_header_title text-center _padd30 no_data">Data Loading...</p>
										</div>
									</div>
									<div class="text-center mt-5" v-else-if="listingData.length == 0 && isLoading== false ">
										<div class="alert alert-secondary" role="alert">
											<p class="_1card_header_title text-center _padd30 no_data">No data found</p>
										</div>
									</div>
								</div>
								<div style="text-align:center;" class="pagination_div _mar_t30" v-if="listingData.length>0">
									<Page :current="pagination.current_page" :total="pagination.total" @on-change="getpaginate" :page-size="parseInt(pagination.per_page)" />
								</div>
								<!-- <div class="center-block text-center">
									<ul class="pagination mb-5">
										<li class="page-item page-prev disabled">
											<a class="page-link" href="#" tabindex="-1">Prev</a>
										</li>
										<li class="page-item active"><a class="page-link" href="#">1</a></li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item page-next">
											<a class="page-link" href="#">Next</a>
										</li>
									</ul>
								</div> -->
							</div>
						</div>
						<!--/Add lists-->
					</div>
				</div>
			</div>
		</section>
		<!--/Add Listings-->
  </div>
</template>

<script>
    export default {
        data () {
            return {
				listingData:[],
				allColors:[],
				allTags:[],
				page:1,
				total:"10",
				pagination: {
					current_page: 1,
					per_page: "10",
					total: 0,
					from: 0,
					to: 0,
				},
				wishItem:{
					product_id:'',
					user_id:'',
					isTrue:'',
				},
				filterKey:{
					categoryId:'',
					categories:[],
					animalTypes:[],
					breeds:[],
					key:'',
					min:'',
					max:'',
					lat:'',
					lng:'',
					age_max:'',
					age_min:'',
					gender:'',
					distance:50,
					orderBy:['id','desc'],
					cityZip:'',
					discipline:[],
					color:[]
				},
				categoryData:[],
				isFlat:false,
				isLoading:true,
				orderTBy:1,
				breedData:[],
				showButton:false,
				breedShowButton:false,
				showTagButton:false,
				showColorButton:false,
				allCategoryData:[],
				animalTypeData:[],
				desipline_show:false,
				color_show:false,
				gender_show:false,
			}
		},
		computed:{
			allTagsLimit(){

				if(this.showTagButton == true || this.allTags.length <4) return this.allTags;
				let data = [];
				for(let i=0;i<4;i++){
					data.push(this.allTags[i])
				}
				return data;
				
			},
			allColorsLimit(){

				if(this.showColorButton == true || this.allColors.length <4 ) return this.allColors;
				let data = [];
				let size = this.allColors.length
				for(let i=0;i<4;i++){
					data.push(this.allColors[i])
				}
				return data;
				
			},
		},
        methods: {
			async  autocompleteSearch () {		
				if(this.filterKey.cityZip == '') return 
				// if(this.formItem.address.length < 3) return
				// this.i(this.formItem.address)

				var  autocomplete = new google.maps.places.Autocomplete((this.$refs['location']), {  
					types: ['(regions)'],
				});
				var self = this
				google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
					var near_place = autocomplete.getPlace();
					self.changeData(near_place);
					
					console.log("places")
					console.log(near_place)
				});
			},
			changeData(data){
				console.log("chagnedata")
				this.filterKey.cityZip = data.name
				this.filterKey.lat = data.geometry.location.lat();
				this.filterKey.lng = data.geometry.location.lng();
				console.log(this.filterKey)
			},
			async orderBy(value){
				if(this.orderTBy==1){
					this.filterKey.orderBy = ['id','desc']; 
				}
				else if(this.orderTBy==2){
					this.filterKey.orderBy = ['id','asc'];
				}
				else if(this.orderTBy==3){
					this.filterKey.orderBy = ['price','asc'];
				}
				else if(this.orderTBy==4){
					this.filterKey.orderBy = ['price','desc'];
				}
				this.getpaginate(1)
			},
			async getpaginate(page = 1){
				this.isLoading = true
				const res  = await this.callApi('get',`all_listing_pagi?page=${page}&total=${ parseInt(this.total)}&key=${this.filterKey.key}&categoryId=${this.filterKey.categoryId}&cityZip=${this.filterKey.cityZip}&lat=${this.filterKey.lat}&lng=${this.filterKey.lng}&distance=${this.filterKey.distance}&categories=${this.filterKey.categories}&animalTypes=${this.filterKey.animalTypes}&breeds=${this.filterKey.breeds}&min=${this.filterKey.min}&max=${this.filterKey.max}&orderBy=${this.filterKey.orderBy}&age_min=${this.filterKey.age_min}&age_max=${this.filterKey.age_max}&gender=${this.filterKey.gender}&color=${this.filterKey.color}&discipline=${this.filterKey.discipline}`)
				if(res.status == 200){
					this.listingData = res.data.data
					this.pagination = res.data
				}
				else{
					this.swr()
				}
				this.isLoading = false
			},
			async wishlists(item,index){
				if(!this.isLoggedIn){
					return this.i("Please Login first  !")
				}
				if(item.wishlist){
					if(item.wishlist.isTrue==0){
						this.wishItem.isTrue=1
					}
					else{
						this.wishItem.isTrue=0
					}
				}
				this.wishItem.product_id=item.id
				this.wishItem.user_id=this.authUser.id
				const res = await this.callApi('post','add_wishlists',this.wishItem)
				if(res.status==201){
					this.s('This item added to your favorite list!')
					// this.wishItem={}
					this.listingData[index].wishlist = {
						isTrue:1
					}
				}
				else if(res.status==200){
					// this.s('Wishlist updated!')
					this.listingData[index].wishlist.isTrue = this.wishItem.isTrue
				}
				else{
					this.swr()
				}
			},
			 async all_category(){
				const res = await this.callApi('get','all_category')
					if(res.status===200){
						this.categoryData = res.data
						this.showButton=true
					}
					else{
						this.swr();
					}
				},
			 async all_animal_type(){
				const res = await this.callApi('get','all_animal_type')
					if(res.status===200){
						this.animalTypeData = res.data
						this.showButton=true
					}
					else{
						this.swr();
					}
				},
				async getAnimalTypewithLimit(){
				const res = await this.callApi('get','getAnimalTypewithLimit')
					if(res.status===200){
						this.animalTypeData = res.data
						this.showButton=false
					}
					else{
						this.swr();
					}
				},
			 async all_breed(){
				const res = await this.callApi('get','all_breed')
					if(res.status===200){
						this.breedData = res.data
						this.breedShowButton=true
					}
					else{
						this.swr();
					}
				},
			 async getCategorywithLimit(){
				const res = await this.callApi('get','getCategorywithLimit')
					if(res.status===200){
						this.categoryData = res.data
						this.showButton=false
					}
					else{
						this.swr();
					}
				},
			 async getBreedwithLimit(){
				const res = await this.callApi('get','getBreedwithLimit')
					if(res.status===200){
						this.breedData = res.data
						this.breedShowButton=false
					}
					else{
						this.swr(); 
					}
				},
				minimize_category(){
					this.categoryData=[]
				},
				minimize_animal(){
					this.animalTypeData=[]
				},
				minimize_breed(){
					this.breedData=[]
				}
			
		},
		 async created(){
			 this.filterKey.key = (this.$route.query.key)?  this.$route.query.key : ''
			 this.filterKey.categoryId = (this.$route.query.category)?  this.$route.query.category : ''
			 this.filterKey.cityZip = (this.$route.query.cityZip)?  this.$route.query.cityZip : ''
			 this.filterKey.lat = (this.$route.query.lat)?  this.$route.query.lat : ''
			 this.filterKey.lng = (this.$route.query.lng)?  this.$route.query.lng : ''
			 const [res1,res2,res3,res4,res5,res6,res7] = await Promise.all([ 
				this.callApi('get',`all_listing_pagi?total=${this.total}&orderBy=${this.filterKey.orderBy}&key=${this.filterKey.key}&categoryId=${this.filterKey.categoryId}&cityZip=${this.filterKey.cityZip}&lat=${this.filterKey.lat}&lng=${this.filterKey.lng}&distance=${this.filterKey.distance}`),
				this.callApi('get','getCategorywithLimit'),
				this.callApi('get','getBreedwithLimit'),
				this.callApi('get','all_category'),
				this.callApi('get','all_color'),
				this.callApi('get','all_tag'),
				this.callApi('get','getAnimalTypewithLimit'),
				])
				if(res1.status == 200 && res2.status == 200) {
					this.listingData = res1.data.data
					this.pagination = res1.data
					// this.categoryData = res2.data
					// this.breedData = res3.data
					this.allCategoryData = res4.data
					this.allColors = res5.data
					this.allTags = res6.data
					// this.animalTypeData = res7.data
				}
			else{
				this.swr()
			}
			this.isLoading = false
			
    	}
    }
</script>