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
								<form id="Register" class="card-body" tabindex="500" @submit.prevent="forgot_password">
									<h3 class="pb-2">Forgot password</h3>
									<div class="mail">
										<input type="email" name="mail" v-model="formItem.email">
										<label>Email</label>
									</div>
									<div class="submit">
										<button class="btn btn-primary btn-block" :disabled="isSending" :loading="isSending">
											{{isSending ? 'Sending...' : 'Send'}}
										</button>
									</div>
									<div class="text-center text-dark mb-0">
										Forget it,
											<router-link to="/reset_password" class="text-primary ml-1">
											Send me back
										</router-link>  to the sign in.
									</div>
								</form>
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
				},
				isSending:false,
			}
        },
        methods: {
			async forgot_password(){
				if(this.formItem.email.trim()=='') return this.i('Email is required!');
				this.isSending=true
				const res=await this.callApi('post','forgot_password',this.formItem);
				if(res.status==200){
					this.s("Please Check Your Email");
					this.isSending=false
					window.location.href = `/reset_password?email=${res.data.email}`;
				}
				else if (res.status===421){
					this.e(res.data.msg);
				}
				else{
					this.swr();
				}
				this.isSending=false
            },
			
		},
		 async created(){
    	}
    }
</script>