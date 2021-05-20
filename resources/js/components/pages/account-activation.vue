<template>
  <div>
    <div class="construction-image coming_soon" >
		<!-- Page -->
		<div class="page page-h">
			<div class="page-content z-index-10">
				<div class="container text-center">
					<h1 class="h2 text-white coming_soon_title mb-3">An activation link is sent to your email. Please Check! </h1>
					<p class="h2  text-white  mb-3" style="font-size: 20px;">"Don't forget to check your junk and spam folder!"</p>
					<button @click="resend_email" class="btn btn-primary" :disabled="isSending" :loading="isSending">
						{{isSending ? 'Sending...' : 'Resend Email'}}
					</button>
					<a href="/" class="btn btn-warning">
						Back To Home
					</a>
				</div>
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
					email:''
				},
				isSending:false,
			}
        },
        methods: {
			async resend_email(){
				this.formItem.email=this.$route.query.email
				this.isSending=true
				const res=await this.callApi('post','resend_email',this.formItem);
				if(res.status==200){
					this.s("Please Check Your Email");
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