<template>
  <div>
      <!--Breadcrumb-->
		<section>
			<div class="bannerimg cover-image bg-background3" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text mb-0">
					<div class="container">
						<div class="text-center text-white">
							<h1 class="">Add Listing</h1>
							<ol class="breadcrumb text-center">
								<li class="breadcrumb-item"><a href="/">Home</a></li>
								<li class="breadcrumb-item active text-white" aria-current="page">Add Listing</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/Breadcrumb-->
        <!--Add posts-section-->
		<section class="sptb add_post_bg">
			<div class="container">
				<div class="row ">
					<div class="col-lg-8 col-md-12 col-md-12">
						<div class="card ">
							<div class="card-header ">
								<h3 class="card-title">Add Listing</h3>
							</div>
								<div class="card-body">
									<div class="form-group">
										<label class="form-label text-dark">Listing Title*</label>
										<input type="text" class="form-control" v-model="formItem.title" placeholder="">
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Animal Type*</label>
										<Select v-model="formItem.animal_type_id" filterable>
											<Option v-for="item in animalType" :value="item.id" :key="item.id">{{ item.name }}</Option>
										</Select> 
									</div> 
									<div class="form-group">
										<label class="form-label text-dark">Category*</label>
										<Select v-model="formItem.category_id" filterable>
											<Option v-for="item in categoryData" :value="item.id" :key="item.id">{{ item.name }}</Option>
										</Select> 
									</div> 
									<div class="form-group">
										<label class="form-label text-dark">Breed</label>
										<Select v-model="formItem.breed_id" filterable>
											<Option v-for="item in breedData" :value="item.id" :key="item.id">{{ item.name }}</Option>
										</Select> 
									</div> 
									<div class="form-group">
										<label class="form-label text-dark">Gender</label>
										<Select v-model="formItem.gender"  >
											<Option  value="Male" >Male</Option>
											<Option  value="Female" >Female</Option>
										</Select> 
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Age</label>
										<input type="number" class="form-control" v-model="formItem.age" placeholder="">
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Color</label>
										<Select v-model="formItem.color" filterable>
											<Option v-for="item in colorData" :value="item.name" :key="item.id">{{ item.name }}</Option>
										</Select> 
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Discipline</label>
										 <Select v-model="formItem.tags" multiple :max-tag-count="5">
											<Option v-for="item in tagData" :value="item.id" :key="item.id">{{ item.name }}</Option>
										</Select>
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Price*</label>
										<input type="text" class="form-control" v-model="formItem.price" placeholder="$">
									</div>
									<div class="form-group">
										<label class="form-label text-dark">Description*</label>
										<textarea class="form-control" name="example-textarea-input" v-model="formItem.description" rows="6" placeholder="Text here.."></textarea>
									</div>
									<div class="form-group">
										<div class="custom-file upload_ad_img">
											<template class="mb-4">
												<Alert
													type="warning"
													v-if="uploadListSizeOverFlow"
													show-icon
													closable
												>Upto 20 Images Can Be Uploaded</Alert>
												<Upload
													multiple
													ref="uploads"
													:on-success="handleSuccess"
													:format="['jpg','jpeg','png']"
													:before-upload="handleBeforeUpload"
													:on-exceeded-size="handleMaxSize"
													:max-size="20480"
													action="/upload">
													<div style="padding: 20px 0; width:100%;">
														<Button icon="ios-cloud-upload-outline">Upload Images*</Button>
													</div>
												</Upload>
											</template>
										</div>
									</div>
									<div class="p-2 border mb-4" v-for="(item, index) in uploadList" :key="index">
										<div class="upload-images d-flex">
											<div>
												<img v-if="formItem.image" :src="item.image" class="w73 h73 border p-0">
											</div>
											<!-- <div class="ml-3 mt-2">
												<h6 class="mb-0 mt-3 font-weight-bold">h1.jpg</h6>
												<small>4.5kb</small>
											</div> -->
											<div class="float-right ml-auto">
												<div class="float-right btn btn-icon btn-danger btn-sm mt-5">
													<i class="fa fa-trash-o" @click="deleteImage(item,index)"></i>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
									
										<div class="col-sm-6 col-md-6">
											<div class="form-group">
												<label class="form-label">City*</label>
												<input type="text"  class="form-control" v-model="formItem.city" placeholder="" @keyup="autocompleteSearch" ref="location">
											</div>
										</div>
										<!-- <div class="col-sm-6 col-md-6">
											<div class="form-group mb-0">
												<label class="form-label">State</label>
												<input type="text" class="form-control" v-model="formItem.state" placeholder="">
											</div>
										</div> -->
										<div class="col-sm-6 col-md-6">
											<div class="form-group mb-0">
												<label class="form-label">Zip Code*</label>
												<input type="text" class="form-control" v-model="formItem.zip_code" placeholder="">
											</div>
										</div>
										<div class="col-sm-12 col-md-12">
											<div class="form-group">
												<label class="form-label">Address</label>
												<input type="text" class="form-control" v-model="formItem.address" placeholder="" >
											</div>
										</div>
										<div class="col-sm-6 col-md-6">
											<div class="form-group mb-0 mt-3">
												<label class="form-label">Package</label>
												<div class="new-radio-group" v-for="(item,index) in subcriptions" :key="index" :label="item.id" v-if="item.id != 2">
													<input type="radio" v-model="formItem.package_id" :id="`radio${index}`" :value="item.id" class="new-radio-button">
													<label :id="`radio${index}`">
														<span>{{item.title}} (${{item.price}}) <span v-if="index!=0" >{{item.days}} days</span></span>
														<span >({{item.description}})</span>
													</label>
												</div>
											</div>
											<div class="form-group mb-0 mt-3" v-if="subcriptions.length > 0">
												<label class="form-label">Social Package </label>
												<Checkbox v-model="formItem.isSocialShare" :falseValue="0" :trueValue="1">
													{{subcriptions[1].title}} (${{subcriptions[1].price}}) <span>({{subcriptions[1].description}})</span>
												</Checkbox>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer ">
									<button class="btn btn-primary" @click="add_listing()" v-if="isSending==false">
										<span v-if="totalPay==0">Submit Now</span>
										<span v-else-if="totalPay >0">Submit and Pay (${{totalPay}})</span>
									</button>
									<button v-else-if="isSending" class="btn btn-primary"  :disabled="isSending" :loading="isSending">
										Submitting...
									</button>
								</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Terms And Conditions</h3>
							</div>
							<div class="card-body">
								<ul class="list-unstyled widget-spec  mb-0">
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>Payment is Non Refundable.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>You can renew your Premium ad after it has expired.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>Premium ads are active for the length of each package.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>Premium ads do not guarantee your listing will sell.
									</li>
									<!-- <li class="ml-5 mb-0">
										<a href="tips.html"> View more..</a>
									</li> -->
								</ul>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Benefits Of Premium Ads</h3>
							</div>
							<div class="card-body pb-2">
								<ul class="list-unstyled widget-spec vertical-scroll mb-0">
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>Premium ads are displayed on the homepage.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>Premium ads will be shown in Google search results.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i>Premium ads will get more viewers and increase your chance of selling your listing.
									</li>	
								</ul>
							</div>
						</div>
						<div class="card mb-0">
							<div class="card-header">
								<h3 class="card-title">Safety Tips For Buyers</h3>
							</div>
							<div class="card-body">
								<ul class="list-unstyled widget-spec  mb-0">
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i> Meet the seller at a public place.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i> Inspect items before you buy.
									</li>
									<li>
										<i class="fa fa-check text-success" aria-hidden="true"></i> Pay only after collecting the items.
									</li>
									<!-- <li class="ml-5 mb-0">
										<a href="tips.html"> View more..</a>
									</li> -->
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!--/Add posts-section-->
  </div>
</template>

<script>
    export default {
        data () {
            return {
				categoryData:[],
				formItem:{
					title:'',
					color:'',
					isSocialShare:0,
					category_id:'',
					gender:'',
					age:'',
					user_id:'',
					price:'$',
					description:'',
					address:'',
					city:'',
					lat:'',
					lng:'',
					state:'',
					zip_code:'',
					package_id:1,
					image:[],	
					breed_id:'',
					animal_type_id:'',
					tags:[]
				},
				uploadList:[],
				subcriptions:[],
				selectedPackage:1,
				uploadListSizeOverFlow:false,
				breedData:[],
				tagData:[],
				colorData:[],
				isSending:false,
				animalType:[]
			}
		},
		computed:{
			totalPay(){
				let t = 0;
				let index = this.subcriptions.findIndex(d => d.id == this.formItem.package_id )
				if(index != -1) t= t + parseFloat(this.subcriptions[index].price)
				if(this.formItem.isSocialShare) t = t + parseFloat(this.subcriptions[1].price)
				return t;
			}
		},
        methods: {
			async  autocompleteSearch () {		
				if(this.formItem.city == '') return 
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
				this.formItem.city = data.formatted_address
				this.formItem.lat = data.geometry.location.lat();
				this.formItem.lng = data.geometry.location.lng();
			},
				//Add
			async add_listing(){
				if(this.formItem.title.trim()=='') return this.e('Listing Title is required')
				if(this.formItem.animal_type_id=='') return this.e('Animal type is required')
				if(this.formItem.category_id=='') return this.e('Category is required')
				if(this.formItem.price=='') return this.e('Price is required')
				if(this.formItem.description.trim()=='') return this.e('Description is required')
				if(this.formItem.city.trim()=='') return this.e('City is required')
				if(this.formItem.zip_code=='') return this.e('Zip code is required')
				// if(this.formItem.address.trim()=='') return this.e('Address is required')

				var price = this.formItem.price;
				var checkk =price.split("$");
				this.formItem.price=checkk[checkk.length-1]

				console.log(this.formItem.price);


				this.formItem.user_id=this.authUser.id
				let index = this.subcriptions.findIndex(d => d.id == this.formItem.package_id )
				this.formItem.validity = this.subcriptions[index].days
				if(this.subcriptions[index].price > 0){
					
					this.formItem.isActive = 0
				}
				if(this.formItem.package_id != 1){
					this.formItem.isFeatured = 1
					this.formItem.validity = this.subcriptions[index].days
				}
			
				if (this.uploadList.length == 0) {
				return this.i("Please Upload atleast one picture");
				}
				if(this.totalPay > 0){
					this.formItem.paymentStatus = "Pending"
					this.formItem.due = this.totalPay
				}
				else{
					this.formItem.paymentStatus  == "Paid"
				}
				this.formItem.image=this.uploadList
				this.isSending=true
				const res = await this.callApi('post','add_listing',this.formItem)
				if(res.status==201){
					this.addModal=false
					if(this.totalPay > 0){
						this.s('Listing added successfully. Please complete the payment.')
						window.location = `/payment/${res.data.id}`;
						
					}
					else {
						this.s('Listing added successfully!');
						window.location = `/listing_details/${res.data.id}`
						
					}
					this.listingData = res.data
					this.formItem={}
					this.uploadList={}
				}
				else{
					if(res.status==422){
						if(res.data.errors.price){
							this.e(res.data.errors.price[0])
						}
						if(res.data.errors.age){
							this.e(res.data.errors.age[0])
						}
						this.formItem.price=price
						
					}else{
						this.swr()
					}
					
				}
				this.isSending=false
			},
			//upload multipleimg
			handleSuccess (res, file) {
				if(this.uploadList.length == 0){
					this.formItem.image = res
				}
				this.uploadList.push({image:res})
			},
			handleBeforeUpload() {
				const check = this.uploadList.length < 20;
				if (!check) {
					this.uploadListSizeOverFlow = true;
				}
				return check;
			},
			handleMaxSize(res,file) {
				if (file) {
					this.$Notice.warning({
					title: "Exceeding file size limit",
					desc: "This file is too large, no more than 20Mb.",
					});
				}
			},

			//delete img from server
			async deleteImage(item,index,isAdd=true){
				let image
				if(!isAdd){ // for editing....
					this.isIconImageNew = true
					image = this.editData.iconImage
					this.editData.iconImage = ''
					this.$refs.editDataUploads.clearFiles()
				}else{
					this.uploadList.splice(index,1)
				}
				
				const res = await this.callApi('post', 'delete_image', {imageName: item.image})
				if(res.status!=200){
					// this.data.iconImage = image
					this.swr()
				}
			this.isSending=false
			},
			//upload multipleimg
			handleSuccess (res, file) {
				if(this.uploadList.length == 0){
					this.formItem.image = res
				}
				this.uploadList.push({image:res})
			},
			handleBeforeUpload() {
				const check = this.uploadList.length < 20;
				if (!check) {
					this.uploadListSizeOverFlow = true;
				}
				return check;
			},

			//delete img from server
		
			
		},
		 async created(){
			//  window.location = '/';
			 const [res1,res2,res3,res4,res5,res6] = await Promise.all([ 
				this.callApi('get','all_category'),
				this.callApi('get','app/subcriptions'), 
				this.callApi('get','all_breed'),
				this.callApi('get','all_tag'),
				this.callApi('get','all_color'),
				this.callApi('get','all_animal_type'),
				])
				if(res1.status == 200 && res2.status == 200 && res3.status == 200 && res4.status == 200 && res5.status == 200 && res6.status == 200) {
					this.categoryData= res1.data
					this.subcriptions= res2.data
					this.breedData= res3.data
					this.tagData= res4.data
					this.colorData= res5.data
					this.animalType= res6.data
				}
			else{
				this.swr()
			}
    	}
    }
</script>

<style  scoped>

	.new-radio-group {
		display : flex;
		margin-bottom: 10px;
	}

	.new-radio-group input {
		margin-top: 2px;
	}

	.new-radio-group label {
		margin-bottom: 0;
    	margin-left: .5rem;
		cursor: pointer;
	}
</style>