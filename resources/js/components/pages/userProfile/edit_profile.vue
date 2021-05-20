<template>
  <div>
		<div class="card mb-3">
			<div class="card-header">
				<h3 class="card-title">Edit Profile</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">Name</label>
							<input type="text" class="form-control" v-model="formItem.name" placeholder="Name">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">Username</label>
							<input type="text" class="form-control" v-model="formItem.username" placeholder="Username">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">Phone Number</label>
							<input type="text" class="form-control" v-model="formItem.phone" placeholder="Number">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">Address</label>
							<input type="text" class="form-control" v-model="formItem.address" placeholder="Home Address">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">City</label>
							<input type="text" class="form-control" v-model="formItem.city" placeholder="City">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">State</label>
							<input type="text" class="form-control" v-model="formItem.state" placeholder="State">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">Zip Code</label>
							<input type="text" class="form-control" v-model="formItem.zip_code" placeholder="ZIP Code">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<label class="form-label">Email address</label>
							<input type="email" class="form-control" v-model="formItem.email" placeholder="Email">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="form-group">
							<div class="custom-file upload_ad_img">
								<template class="mb-4">
									<!-- <Alert
										type="warning"
										show-icon
										closable
									>Upto 20 Images Can Be Uploaded</Alert> -->
									<label class="form-label">Image</label>
									<Upload
										multiple
										ref="uploads"
										:on-success="handleSuccess"
										:format="['jpg','jpeg','png']"
										:max-size="2048"
										action="/upload">
										<div style="padding: 20px 0; width:100%;">
											<Button icon="ios-cloud-upload-outline">Upload Image</Button>
										</div>
									</Upload>
								</template>
							</div>
						</div>
						<div class="p-2 border mb-4" v-if="uploadList">
							<div class="upload-images d-flex">
								<div>
									<img v-if="formItem.image" :src="formItem.image" class="w73 h73 border p-0">
								</div>
								
								<!-- <div class="ml-3 mt-2">
									<h6 class="mb-0 mt-3 font-weight-bold">h1.jpg</h6>
									<small>4.5kb</small>
								</div> -->
								<div class="float-right ml-auto">
									<div class="float-right btn btn-icon btn-danger btn-sm mt-5">
										<i class="fa fa-trash-o" @click="deleteImage"></i>
									</div>
									<div class="float-right btn btn-icon btn-primary btn-sm mt-5 mr-2">
										<Icon type="ios-eye-outline" @click="handleView()"></Icon>
									</div>
								</div>
							</div>
						</div>
						<Modal title="View Image" v-model="visible">
							<img :src="formItem.image" v-if="visible" style="width: 100%">
						</Modal>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary" @click="updateUser()"> Updated Profile</button>
			</div>
		</div>

	
		<div class="card mb-0">
			<div class="card-header">
				<h3 class="card-title">Edit Privacy</h3>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<span class="privacy_sub">
								Email visibility on public
							</span>
							<RadioGroup v-model="formData.privacyData" @on-change="privacyChange()">
								<Radio label="1">Visible</Radio>
								<Radio label="0">Not Visible</Radio>
							</RadioGroup>
						</div>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="form-group">
							<span class="privacy_sub">
								Phone number visibility on public
							</span>
							<RadioGroup v-model="formData.privacyData2" @on-change="privacyChange2()">
								<Radio label="1">Visible</Radio>
								<Radio label="0">Not Visible</Radio>
							</RadioGroup>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="card-footer">
				<button type="submit" class="btn btn-primary" @click="updateUser()"> Updated Profile</button>
			</div> -->
		</div>
  </div>
</template>

<script>
    export default {
        data () {
            return {
				formItem:{
					name:authUser.name,
					username:authUser.username,
					phone:authUser.phone,
					address:authUser.address,
					city:authUser.city,
					state:authUser.state,
					zip_code:authUser.zip_code,
					email:authUser.email,
					id:authUser.id
				},
				user:[],
				uploadList:'',
				visible:false,
				formData:{
					privacyData:'',
					privacyData2:'',
					id:authUser.id
				},
				
			}
        },
        methods: {
			async privacyChange(){
			this.formData.privacyData=parseInt(this.formData.privacyData)
			const res = await this.callApi("post",'privacyChange', this.formData);
				if (res.status == 200) {
					this.formData.privacyData=this.formData.privacyData.toString()
				}else{
					this.swr();
				}
			},
			async privacyChange2(){
			this.formData.privacyData2=parseInt(this.formData.privacyData2)
			const res = await this.callApi("post",'privacyChange', this.formData);
				if (res.status == 200) {
					this.formData.privacyData2=this.formData.privacyData2.toString()
				}else{
					this.swr();
				}
			},

			
			async updateUser(){
				//if(this.user_name == '') return this.i("User Type is empty!");
				const res = await this.callApi('post','edit_user',this.formItem)
				if(res.status == 200){
					this.user[this.editIndex] = _.clone(this.formItem) 
					this.s("User Updated  !")
					this.$store.commit('setAuthUser',(res.data));
				}
				else{
					this.swr();
				}
			},
				//upload multipleimg
			handleSuccess (res, file) {
				this.formItem.image = res
				this.uploadList = res
			},

			//delete img from server
			async deleteImage(isAdd=true){
				
				const res = await this.callApi('post', 'delete_image', {imageName: this.formItem.image})
				if(res.status==200){
					// this.data.iconImage = image
					
					this.formItem.image=''
					this.uploadList=''
				}
				else{
					this.swr()
				}
			},
			handleView(){
				this.visible=true
			}
			
		},
		 async created(){
			 if(this.authUser){
				if(this.authUser.email_isTrue==1){
					this.formData.privacyData='1'
				}
				else{
					this.formData.privacyData='0'
				}
			 }
			 if(this.authUser){
				 if(this.authUser.phone_isTrue==1){
					this.formData.privacyData2='1'
				}
				else{
					this.formData.privacyData2='0'
				}
			 }
			
    	}
    }
</script>