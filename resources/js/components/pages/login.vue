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
								<form id="Register" class="card-body" tabindex="500" @submit.prevent="login">
									<h3>Login</h3>
									<div class="name">
										<input type="email" v-model="formItem.email">
										<label>Email</label>
									</div>
									<div class="passwd">
										<input type="password" v-model="formItem.password">
										<label>Password</label>
									</div>
									<div class="submit">
										<button class="btn btn-primary btn-block" :disabled="isSending" :loading="isSending">
											{{isSending ? 'Loging...' : 'Login'}}
										</button>
									</div>
									<p class="mb-2">
										<router-link to="/forgot_password" class="text-primary ml-1">
											Forgot Password
										</router-link>
									</p>
									<p class="text-dark mb-0">Don't have account?
										 <router-link to="/register" class="text-primary ml-1">
											Sign Up
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
					email:'',
					password:''
				},
				isSending:false,
			}
        },
        methods: {
			async login(){
				if(this.formItem.email.trim()=='') return this.i('Email is required!');
				if(this.formItem.password.trim()=='') return this.i('Password is required!');
				this.isSending = true
				const res=await this.callApi('post','login',this.formItem);

				if(res.status==200){
					this.s("Login Successful");
					this.$store.commit('setAuthUser', (res.data))
					window.location = '/';
				}
				else if (res.status===421){ 
					this.s("Please activate your account!");
					this.$router.push('/activation')
				}
				else if (res.status===422){
                	this.e(res.data.msg);
				}
				else{
					this.swr();
				}
				this.isSending = false
            },
			
		},
		 async created(){
			 if(this.isLoggedIn){
				 this.$router.push('/')
			 }
    	}
    }
</script>