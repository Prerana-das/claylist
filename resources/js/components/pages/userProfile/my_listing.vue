<template>
  <div>
	<div class="card mb-0">
		<div class="card-header">
			<h3 class="card-title">My Listing</h3>
		</div>
		<div class="card-body">
			<div class="ads-tabs">
				<div class="tabs-menus">
					<!-- Tabs -->
					<ul class="nav panel-tabs">
						<li class=""><a href="#tab1" class="active" data-toggle="tab">All Listing</a></li>
						<!-- <li><a href="#tab2" data-toggle="tab">Featured</a></li> -->
						<!-- <li><a href="#tab2" data-toggle="tab">Published (08)</a></li>
						<li><a href="#tab3" data-toggle="tab">Featured (05)</a></li>
						<li><a href="#tab4" data-toggle="tab">Sold (03)</a></li>
						<li><a href="#tab5" data-toggle="tab">Active (03)</a></li>
						<li><a href="#tab6" data-toggle="tab">Expired (01)</a></li> -->
					</ul>
				</div>
				<template v-if="pagination.total==0">
					<div class="alert alert-secondary" role="alert">
						<p class="_1card_header_title text-center _padd30 no_data">No data found</p>
					</div>
				</template>
				<template v-else-if="loading==true">
					<div class="alert alert-secondary" role="alert">
						<p class="_1card_header_title text-center _padd30 no_data">Loading...</p>
					</div>
				</template>
				<template v-else>
					<div class="tab-content">
						<div class="tab-pane active table-responsive border-top userprof-tab" id="tab1">
							<table class="table table-bordered table-hover mb-0 text-nowrap">
								<thead>
									<tr>
										<th>Item</th>
										<th>Category</th>
										<th>Package Type</th>
										<th>Price</th>
										<th>Listing Status</th>
										<th>Payment Status</th>
										<th >Action</th>
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
											<span v-if="item.category">
												{{item.category.name}}
											</span>
										</td>
										<td>
											<span  v-if="item.package_id == 1">
												General <button title="Change to Premium" class="btn btn-success btn-sm text-white" @click="editPackage(item, index)"><i class="fa fa-pencil"></i></button>
											</span>
											<span  v-else-if="item.package_id > 1">Premium</span>
										</td>
										<td class="font-weight-semibold fs-16">${{item.price}}</td>
										<td>
											<p class="badge badge-warning">{{item.status}}</p>
										</td>
										<td>
											<p class="badge badge-success" v-if="item.due==0" >Paid </p>
											<div v-if="item.due>0">
												<p class="badge badge-warning"  >{{item.paymentStatus}}</p>
												<a :href="`/payment/${item.id}`"><button  class="btn btn-success btn-sm text-white" >Pay Now</button></a>
												

											</div>
										</td>
										<td>
											<button title="Edit Listing" class="btn btn-success btn-sm text-white" @click="editListing(item, index)"><i class="fa fa-pencil"></i></button>
											<button title="Delete Listing" class="btn btn-danger btn-sm text-white" @click="listing_delete(item.id,index)"><i class="fa fa-trash-o"></i></button>
											<!-- <a class="btn btn-info btn-sm text-white" data-toggle="tooltip" data-original-title="Save to Wishlist"><i class="fa fa-heart-o"></i></a> -->
											<button title="View Details" class="btn btn-primary btn-sm text-white" @click="viewDetails(item, index)" data-original-title="View" data-toggle="modal" data-target="#largeModal"><i class="fa fa-eye"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
							<div style="text-align:center;" class="pagination_div _mar_t30 mt-3">
								<Page :current="pagination.current_page" :total="pagination.total" @on-change="getpaginate" :page-size="parseInt(pagination.per_page)" />
							</div>
						<!-- <div class="tab-pane  table-responsive border-top userprof-tab" id="tab2">
							<table class="table table-bordered table-hover mb-0 text-nowrap">
								<thead>
									<tr>
										<th></th>
										<th>Item</th>
										<th>Breed</th>
										<th>Price</th>
										<th>Listing Status</th>
										<th >Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(item,index) in listingData" :key="index" v-if="item.isFeatured==0">
										<td>
											<label class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" name="checkbox" value="checkbox">
												<span class="custom-control-label"></span>
											</label>
										</td>
										<td>
											<div class="media mt-0 mb-0">
												<div class="card-aside-img">
													<a href="#"></a>
													<img src="/assets/images/products/h1.png" alt="img">
												</div>
												<div class="media-body">
													<div class="card-item-desc ml-4 p-0 mt-2">
														<h4 class="font-weight-semibold text-dark">{{item.title}}</h4>
														<p><i class="fa fa-clock-o mr-1"></i> {{isMonthDate(item.created_at)}}</p>

													</div>
												</div>
											</div>
										</td>
										<td>
											<span v-if="item.category">
												{{item.category.name}}
											</span>
										</td>
										<td class="font-weight-semibold fs-16">{{item.price}}</td>
										<td>
											<a href="#" class="badge badge-warning">{{item.status}}</a>
										</td>
										<td>
											<button class="btn btn-success btn-sm text-white" @click="editListing(item, index)"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger btn-sm text-white" @click="listing_delete(item.id,index)"><i class="fa fa-trash-o"></i></button>
											<button class="btn btn-primary btn-sm text-white" @click="viewDetails(item, index)" data-original-title="View" data-toggle="modal" data-target="#largeModal"><i class="fa fa-eye"></i></button>
										</td>
									</tr>

								</tbody>
							</table>
						</div> -->
					
					</div>
				</template>
			</div>
		</div>
	</div>
	<!-- Large Modal -->
	<div id="largeModal" class="modal fade">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content ">
				<div class="modal-header pd-x-20">
					<h6 class="modal-title listing_detail_pre_title">Listing Details Preview</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pd-20">
					<div class="profile-log-switch">
						<div class="media-heading">
							<h3 class="card-title mb-3 font-weight-bold">Listing Details</h3>
						</div>
						<ul class="usertab-list mb-0">
							<li><p class="text-dark"><span class="font-weight-semibold">Title :</span> {{dataDetails.title}}</p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Location :</span> {{dataDetails.address}}</p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">City :</span> {{dataDetails.city}}</p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">State :</span>{{dataDetails.state}}</p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Zip Code :</span> {{dataDetails.zip_code}}</p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Color :</span>  {{dataDetails.color}} </p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Category :</span><span v-if="dataDetails.category">{{dataDetails.category.name}}</span></p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Breed :</span><span v-if="dataDetails.breed">{{dataDetails.breed.name}}</span></p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Gender :</span>  {{dataDetails.gender}} </p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Age :</span>  {{dataDetails.age}} </p></li>
							<li><p class="text-dark"><span class="font-weight-semibold">Status :</span>  {{dataDetails.status}}</p></li>
						</ul>
						<div class="row profie-img">
							<div class="col-md-12">
								<div class="media-heading">
									<h3 class="card-title mb-3 font-weight-bold">Description</h3>
								</div>
								<p class="mb-3">{{dataDetails.description}}</p>
							</div>
						</div>
						<div class="row profie-img">
							<div class="col-md-12">
								<div class="media-heading">
									<h3 class="card-title mb-3 font-weight-bold">Images</h3>
								</div>
								<ul class="img_list_details">
									<li v-for="(i,index) in dataDetails.all_images" :key="index">
										<span>
											<img v-if="i.image" :src="i.image" >
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div><!-- modal-body -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div><!-- modal-dialog -->
	</div><!-- modal -->

	
		<Drawer width="720" v-model="editModal" :closable="false" class="ads_details_modal">
			<div class="card-header">
				<h3 class="card-title">Edit Listing</h3>
			</div>
			<div class="card m-b-20">
				<div class="card-body">
					<form @submit.prevent> 
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Listing Title</label>
									<input type="text" v-model="edit_form.title" class="form-control" id="exampleInputname" placeholder="Enter Listing Name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Price</label>
									<input type="text" v-model="edit_form.price" class="form-control" id="exampleInputname" placeholder="Enter Price">
								</div>
							</div>
							<!-- <div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Status</label>
									<input type="text" v-model="edit_form.status" class="form-control" id="exampleInputname" placeholder="Enter Listing Name">
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Category</label>
									<Select v-model="edit_form.category_id">
										<Option v-for="item in categoryData" :value="item.id" :key="item.id">
											{{ item.name }}
										</Option>
									</Select> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Animal Type</label>
									<Select v-model="edit_form.animal_type_id">
										<Option v-for="item in animalType" :value="item.id" :key="item.id">
											{{ item.name }}
										</Option>
									</Select> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Breed</label>
									<Select v-model="edit_form.breed_id">
										<Option v-for="item in breedData" :value="item.id" :key="item.id">
											{{ item.name }}
										</Option>
									</Select> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Color</label>
									<input type="text" v-model="edit_form.color" class="form-control" id="exampleInputname" placeholder="Enter Color">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Gender</label>
									<input type="text" v-model="edit_form.gender" class="form-control" id="exampleInputname" placeholder="Enter Gender">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Age</label>
									<input type="number" v-model="edit_form.age" class="form-control" id="exampleInputname" placeholder="Enter Age">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Address</label>
									<input type="text" v-model="edit_form.address" class="form-control" id="exampleInputname" placeholder="Enter Address">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">City</label>
									<input type="text" v-model="edit_form.city" class="form-control" id="exampleInputname" placeholder="Enter City">
								</div>
							</div>
							<!-- <div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">State</label>
									<input type="text" v-model="edit_form.state" class="form-control" id="exampleInputname" placeholder="Enter State">
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Zip Code</label>
									<input type="text" v-model="edit_form.zip_code" class="form-control" id="exampleInputname" placeholder="Enter Zip Code">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Description</label>
										<Input v-model="edit_form.description" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="Enter something..."></Input>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label" for="exampleInputEmail1">Images</label>
										<template>
											<div class="row justify-content-center">
												<div class="col-12 col-md-auto col-lg-auto">
													<div class="demo-upload-list" v-for="(item,index) in uploadList" :key="index">
														<img :src="item.image">
														<div class="demo-upload-list-cover">
															<Icon type="ios-eye-outline" @click.native="handleView(item.image,index)"></Icon>
															<Icon type="ios-trash-outline" @click.native="handleRemove(item,index)"></Icon>
														</div>
													</div>

													<Upload 
														name="file"
														:show-upload-list="false"
														:default-file-list="defaultList"
														:on-success="handleSuccess2"
														:format="['jpg','jpeg','png']"
														:max-size="2048"
														:on-format-error="handleFormatError"
														:on-exceeded-size="handleMaxSize"
														multiple
														type="drag"
														action="/upload"
														style="display: inline-block;width:58px;">
														<div style="width: 58px;height:58px;line-height: 58px;">
															<Icon type="ios-camera" size="20"></Icon>
														</div>
													</Upload>
												</div>
											</div>
										<Modal title="View Image" v-model="visible">
											<img :src="imgName" v-if="visible" style="width: 100%">
										</Modal>
									</template> 
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="demo-drawer-footer text-right">
				<button type="submit" class="btn btn-primary" @click="edit_listing">Edit Listing</button>
				<button type="submit" class="btn btn-info" @click="editModal = false">Close Listing</button>
			</div>
		</Drawer>
		<Modal v-model="isPackageModal" :title="`Change '${packageItem.title}' Package Type `" :loading="loading" >
			<div class="form-group mb-0 mt-3">
				<label class="form-label">Package</label>
					<RadioGroup  v-model="packageItem.package_id" vertical>
						<Radio  v-for="(item,index) in allPackages" :key="index" :label="item.id" v-if="item.id !=2">
							<span>{{item.title}} (${{item.price}}) {{item.days}} days</span>
						</Radio >
					</RadioGroup >
			</div>
			<div class="form-group mb-0 mt-3" v-if="allPackages.length>0">
				<label class="form-label">Others</label>
				 <Checkbox v-model="packageItem.isSocialShare">{{allPackages[1].title}}</Checkbox>
			</div>
			<div slot="footer">
				 <Button    @click="cencelPackage">Cancel</Button>
				 <Button type="primary"  @click="change_listing_package">
					<span v-if="totalPay==0">Change</span> 
					<span v-if="totalPay>0">Change and Pay (${{totalPay}})</span> 
				</Button>
			</div>
			
		</Modal>
  </div>
</template> 

<script>
import moment from "moment";
    export default {
        data () {
            return {
				listingData:[],
				uploadList:[],
				defaultList:[],
				page:1,
				total:"7",
				pagination: {},
				loading:false,
				dataDetails:{},
				editModal:false,
				editIndex:-1,
				edit_form:{
					title:'',
					price:'',
					description:'',
					address:'',
					city:'',
					state:'',
					zip_code:'',
					category_id:'',
					breed_id:'',
					animal_type_id:'',
					color:'',
					gender:'',
					age:''
				},
				loading:false,
				visible:false,
				categoryData:[],
				breedData:[],
				animalType:[],
				allPackages:[],
				isPackageModal:false,
				packageItem:{
					package_id:-1,
					isSocialShare:0
				},
				packageItemIndex:-1,
			}
		},
		computed:{
			
			totalPay(){
				let t = 0;
				let index = this.allPackages.findIndex(d => d.id == this.packageItem.package_id )
				if(index != -1) t= t + parseFloat(this.allPackages[index].price)
				if(this.packageItem.isSocialShare==1) t = t + parseFloat(this.allPackages[1].price)
				return t;
			},
			totalBefore(){
				let t = 0;
				if(this.packageItemIndex == -1) return t;
				let index = this.allPackages.findIndex(d => d.id == this.listingData[this.packageItemIndex].package_id )
				if(index != -1) t= t + parseFloat(this.allPackages[index].price)
				if(this.listingData[this.packageItemIndex].isSocialShare==1) t = t + parseFloat(this.allPackages[1].price)
				return t;
			}
		},
        methods: {
			async change_listing_package(){

				let index = this.allPackages.findIndex(d => d.id == this.packageItem.package_id )
				this.packageItem.validity = this.allPackages[index].days
				if(this.allPackages[index].price > 0){ 
					
					this.packageItem.isActive = 0
				}
				if(this.packageItem.package_id != 1){
					this.packageItem.isFeatured = 1
					this.packageItem.validity = this.allPackages[index].days
				}
				let total = this.totalPay-this.totalBefore
				if(this.totalPay > this.totalBefore){
					this.packageItem.paymentStatus = 'Pending'
					this.packageItem.due = total
				}

			
				
				this.loading=true
				const res = await this.callApi('post','/change_package',this.packageItem)
				if(res.status==200){
					this.isPackageModal=false
					if(this.totalPay > this.totalBefore){
						
						this.s('Listing Package changed successfully. Please complete the payment!.')
						window.location = `/change_package_payment/${this.packageItem.id}`;
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
						
					}else{
						this.swr()
					}
					
				}
				this.loading=true
			},
			async getpaginate(page = 1){
				const res  = await this.callApi('get',`all_listing_user?page=${page}&total=${ parseInt(this.total)}&user_id=${this.authUser.id}`)
				if(res.status == 200){
					this.listingData = res.data.data
					this.pagination = res.data
				}
				else{
					this.swr()
				}
			},
			handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
			handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
			handleSuccess2(res, file){
                    this.uploadList.push({image:res})
                    
            },
			handleView (item,index) {
                this.imgName = item;
                this.visible = true;
			},
			handleRemove (item,index) {
                this.uploadList.splice(index,1)
            },
			viewDetails(item, index){
                this.dataDetails=item
			},
			//Edit
			async edit_listing(){
				if(this.edit_form.title.trim()=='') return this.e('Listing name is required')
				if(this.edit_form.category_id=='') return this.e('Category is required')
				if(this.edit_form.animal_type_id=='') return this.e('Animal type is required')
				if(this.edit_form.price=='') return this.e('Price is required')
				if(this.edit_form.description.trim()=='') return this.e('Description is required')
				// if(this.edit_form.address.trim()=='') return this.e('Address is required')
				if(this.edit_form.city.trim()=='') return this.e('City is required')
				// if(this.edit_form.state.trim()=='') return this.e('State is required')
				if(this.edit_form.zip_code=='') return this.e('Zip code is required')
				
				if(this.uploadList.length == 0 ) return this.e('You have to upload at least one image')
				this.loading = true
				this.edit_form.uploadList = this.uploadList
				const res = await this.callApi('post', 'edit_listing',this.edit_form)
				if(res.status==200){
					this.s('Listing updated successfully!')
					this.editModal = false
					this.listingData[this.editIndex] = res.data
					this.loading = false
				}
				else{
					if(res.status==422){
						if(res.data.errors.price){
							this.e(res.data.errors.price[0])
						}
						if(res.data.errors.age){
							this.e(res.data.errors.age[0])
						}
						
					}else{
						this.swr()
					}
					
				}
			},
			//Delete
			async listing_delete(id,index){
				if(!confirm("Are you sure to delete this Listing")){
					return;
				}
				let ob = {
					id:id,
					user_id:this.authUser.id
				}
				this.loading = true
				const res = await this.callApi('post',`listing_delete?total=${this.total}`,ob)
				if(res.status == 200){
					this.i('Listing have been successfully Deleted!')
					this.listingData.splice(index,1)
					this.listingData = res.data.data
					this.pagination = res.data
					this.loading = false
				}
				else{
					this.swr();
				}
			},
			isMonthDate(date) {
				return moment(date).format("MMM Do");
			},
			editListing(item, index){
				this.edit_form.id = item.id
				this.edit_form.title = item.title
				this.edit_form.price = item.price
				this.edit_form.description = item.description
				this.edit_form.address = item.address
				this.edit_form.city = item.city
				this.edit_form.state = item.state
				this.edit_form.zip_code = item.zip_code
				this.edit_form.category_id = item.category_id
				this.edit_form.breed_id = item.breed_id
				this.edit_form.animal_type_id = item.animal_type_id 
				this.edit_form.color = item.color
				this.edit_form.gender = item.gender
				this.edit_form.age = item.age
				this.uploadList = item.all_images
				this.editIndex = index
				this.editModal = true
			},
			editPackage(item, index){
				
				this.packageItem.id = item.id
				this.packageItem.title = item.title
				this.packageItem.package_id = item.package_id
				this.packageItem.isSocialShare = item.isSocialShare
				this.packageItemIndex = index;
				this.isPackageModal = true
				
			},
			cencelPackage(){
				
				this.packageItem = {
					package_id:-1,
					isSocialShare:0
				}
				this.packageItemIndex = -1;
				this.isPackageModal = false
				
			}
				
		},
		 async created(){
			this.loading = true
			const [res1,res2,res3,res4,res5] = await Promise.all([ 
			this.callApi('get',`all_listing_user?total=${this.total}&user_id=${this.authUser.id}`),
			this.callApi('get','all_category'),
			this.callApi('get','all_breed'),
			this.callApi('get','all_animal_type'),
			this.callApi('get','/app/subcriptions'),
			])
			if(res1.status == 200 && res2.status == 200 && res3.status == 200) {
				this.listingData = res1.data.data
				this.pagination = res1.data
				this.categoryData = res2.data
				this.breedData= res3.data
				this.animalType= res4.data
				this.allPackages= res5.data
			}
			else{
				this.swr()
			}
		this.loading = false
		}, 
    }
</script>

<style>
    .demo-upload-list{
        display: inline-block;
        width: 120px;
        height: 120px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent; 
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .addImageClass{
        text-align:center
    }
    .addImageClass:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>