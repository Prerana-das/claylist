<template>
  <div>
      <!--Breadcrumb-->
		<!-- <section>
			<div class="bannerimg cover-image bg-background3" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text mb-0">
					<div class="container">
						<div class="text-center text-white">
							<h1 class="">Register</h1>
							<ol class="breadcrumb text-center">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Pages</a></li>
								<li class="breadcrumb-item active text-white" aria-current="page">Register</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</section> -->
		<!--/Breadcrumb-->
        <!--Register-section-->
		<section class="sptb">
			<div class="container customerpage">
				<div class="row">
				    <div class="single-page" >
						<div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
							<!-- <div class="wrapper wrapper2 mt-8"> -->
							<div class="wrapper223 wrapper2 mt-8">
								<!-- <Form id="Register" class="card-body" tabindex="500" @submit.prevent="registration"> -->
								<form class="card-body" tabindex="500" @submit.prevent="registration">
									<h3>Register</h3>
									<div class="name">
										<input type="text" v-model="formItem.name">
										<label>Name</label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.username">
										<label>Username</label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.phone">
										<label>Phone</label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.address">
										<label>Address</label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.city">
										<label>City</label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.state">
										<label>State</label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.zip_code">
										<label>Zip Code </label>
									</div>
									<div class="name">
										<input type="text" v-model="formItem.email">
										<label>Email</label>
									</div>
									<div class="passwd">
										<input type="password" v-model="formItem.password">
										<label>Password</label>
									</div>
									<div class="passwd">
										<input type="password" v-model="formItem.confirm_password">
										<label>Confirm Password</label>
									</div>
									<div class="passwd">
										<div class="checkbox_item">
											<input type="checkbox" style="width:14px;" v-model="terms">
											<label>Accept terms and agreement and privacy policy</label>
										</div>	
										<p class="privacy_hypl_text">
											<span class="privacy_hypl" @click="privacyView">Click here to view</span>
											<!-- all conditions -->
										</p>
									</div>
									<div class="submit">
										<button class="btn btn-primary btn-block" :disabled="isSending" :loading="isSending">
											{{isSending ? 'Registering...' : 'Register'}}
										</button>
									</div>
									<p class="text-dark mb-0">Already have an account?
										<router-link to="/login" class="text-primary ml-1">
											Sign In
										</router-link> 
									</p>
								</form>


								<!-- <hr class="divider">
								<div class="card-body">
									<div class="text-center">
										<div class="btn-group">
											<a href="https://www.facebook.com/" class="btn btn-icon mr-2 brround">
												<span class="fa fa-facebook"></span>
											</a>
										</div>
										<div class="btn-group">
											<a href="https://www.google.com/gmail/" class="btn  mr-2 btn-icon brround">
												<span class="fa fa-google"></span>
											</a>
										</div>
										<div class="btn-group">
											<a href="https://twitter.com/" class="btn  btn-icon brround">
												<span class="fa fa-twitter"></span>
											</a>
										</div>
									</div>
								</div> -->
								<!-- <Checkbox v-model="terms">Accept terms and agreement and privacy policy</Checkbox>  -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Register-section-->
		<div class="cookie_div" v-if="term_condition_view==true">
			<div id="gdpr-cookie-message" style="">
				<h4>🍪 Accept Terms &amp; Privacy Policy?</h4>
				<span aria-hidden="true" class="close_cookie" @click="closeTermView">×</span>
				<div v-html="settingsData.description">
					{{settingsData.description}}
				</div>
				<div id="gdpr-cookie-types" style="display:none;">
			</div>
		</div>

		</div>
	</div>
</template>

<script>
    export default {
        data () {
            return {
				formItem:{
					name:'',
					username:'',
					phone:'',
					address:'',
					city:'',
					state:'',
					zip_code:'',
					email:'',
					password:'',
					confirm_password:''
				},
				terms:false,
				term_condition_view:false,
				settingsData:'',
				isSending:false,
			}
        },
        methods: {
			async registration(){
				if(this.formItem.name.trim()=='') return this.i('Name is required!');
				if(this.formItem.username.trim()=='') return this.i('Username is required!');
				if(this.formItem.phone=='') return this.i('Phone is required!');
				if(this.formItem.address.trim()=='') return this.i('Address is required!');
				if(this.formItem.city.trim()=='') return this.i('City is required!');
				if(this.formItem.state.trim()=='') return this.i('State is required!');
				if(this.formItem.zip_code=='') return this.i('Zip code is required!');
				if(this.formItem.email.trim()=='') return this.i('Email is required!');
				if(this.formItem.password.trim()=='') return this.i('Password is required!');
				if(this.formItem.confirm_password.trim()=='' ) return this.i("Password Confirmation is required!");
					if(this.formItem.password != this.formItem.confirm_password){
						this.i("The password does not match.");
						return;
					}

				if(this.terms==false) return this.i('Accept term and agreement!');
				this.isSending = true
				const res=await this.callApi('post','registration',this.formItem);

				if(res.status==201){
					this.s("Please check your email to activate your account");
					// this.$router.push('/activation')
					window.location.href = `/activation?email=${this.formItem.email}`;
				}

				else if(res.status===422){
					if(res.data.errors.email){
						this.e(res.data.errors.email[0])
					}
					if(res.data.errors.password)
					{
						this.e(res.data.errors.password[0])
					}

					if(res.data.errors.name)
					{
						this.e(res.data.errors.name[0])
					}
					if(res.data.errors.username)
					{
						this.e(res.data.errors.username[0])
					}
					if(res.data.errors.phone)
					{
						this.e(res.data.errors.phone[0])
					}
					if(res.data.errors.address)
					{
						this.e(res.data.errors.address[0])
					}
					if(res.data.errors.state)
					{
						this.e(res.data.errors.state[0])
					}
					if(res.data.errors.city)
					{
						this.e(res.data.errors.city[0])
					}
					if(res.data.errors.zip_code)
					{
						this.e(res.data.errors.zip_code[0])
					}
				}
				this.isSending = false

			 },
			 privacyView(){
				 this.term_condition_view=true
			 },
			 closeTermView(){
				 this.term_condition_view=false 
			 }
			
		},
		 async created(){
			  const res = await this.callApi('get','get_settings')
            if(res.status==200){
               this.settingsData=res.data
            }
            else{
					this.swr()
				}
    	}
    }
</script>