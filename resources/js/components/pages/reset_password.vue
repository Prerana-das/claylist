<template>
  <div>
      <!--Breadcrumb-->
		<!-- <section>
			<div class="bannerimg cover-image bg-background3" data-image-src="/assets/images/banners/banner2.jpg">
				<div class="header-text mb-0">
					<div class="container">
						<div class="text-center text-white">
							<h1 class="">Login</h1>
							<ol class="breadcrumb text-center">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Pages</a></li>
								<li class="breadcrumb-item active text-white" aria-current="page">Login</li>
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
							<div class="wrapper wrapper2 mt-8">
								<form id="Register" class="card-body" tabindex="500" @submit.prevent="PasswordReset">
									<h3>Reset Password</h3>
									<div class="passwd">
										<input type="password" v-model="formItem.newPassword">
										<label>New Password</label>
									</div>
									<div class="passwd">
										<input type="password" v-model="formItem.confirmPassword">
										<label>Confirm Password</label>
									</div>
									<div class="passwd">
										<input type="number" v-model="formItem.token">
										<label>Code</label>
									</div>
									<div class="submit">
										<button class="btn btn-primary btn-block" :disabled="isSending" :loading="isSending">
											{{isSending ? 'Updating...' : 'Update Password'}}
										</button>
									</div>
									<div class="text-center text-dark mb-0">
										Forget it,
											<router-link to="/login" class="text-primary ml-1">
											Send me back
										</router-link>  to the sign in.
									</div>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--Register-section-->
  </div>
</template>

<script>
    export default {
        data () {
            return {
				formItem:{
					newPassword:'',
					confirmPassword:'',
					token:'',
					email:''
				},
				isSending:false,
			}
        },
        methods: {
			async PasswordReset(){
				if(this.formItem.newPassword=='') return this.i('New password is required!');
				if(this.formItem.confirmPassword =='') return this.i('Confirm password is required!');
				if(this.formItem.token =='') return this.i('Token is required!');
				this.isSending=true
				const res=await this.callApi('post','PasswordReset',this.formItem);

				if(res.status==200){
					this.s("Your Password Is Successfully Changed");
					this.isSending=false
					window.location.href = '/login';
				}
				else if (res.status===421){
					this.e(res.data.msg);
					// this.$router.push()
				}
				else if (res.status===422){
                	this.e(res.data.msg);
				}
				else{
					this.swr();
				}
				this.isSending=false
            },
			
		},
		 async created(){
			this.formItem.email = this.$route.query.email
			// console.log(this.formItem.email);
    	}
    }
</script>