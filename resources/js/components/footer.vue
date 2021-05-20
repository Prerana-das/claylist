<template>
    <div>    
        <!--Footer Section-->         
        <section> 
            <footer class="bg-dark-purple text-white"> 
                <div class="footer-main"> 
                    <div class="container"> 
                        <div class="row"> 
                            <div class="col-lg-3 col-md-12"> 
                                <h6>About</h6> 
                                <hr class="deep-purple  accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
                                <p>“Hoof Barter was designed with buyers, sellers, and barterers of hoofed animals in mind. This is a space created to connect animals and their services with new farm homes and animal lovers. Enjoy a user-user friendly platform to advertise today.”</p> 
                            </div>   
                            <div class="col-lg-1"> 
                            </div>                          
                            <!-- <div class="col-lg-2 col-md-12"> 
                                <h6>Our Services</h6> 
                                <hr class="deep-purple text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
                                <ul class="list-unstyled mb-0"> 
                                    <li>
                                        <a href="javascript:;">Our Team</a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;">Contact US</a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;">About</a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;">Services</a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;">Blog</a>
                                    </li>                                     
                                    <li>
                                        <a href="javascript:;">Terms and Services</a>
                                    </li>                                     
                                </ul>                                 
                            </div>                              -->
                            <div class="col-lg-4 col-md-12"> 
                                <h6>Contact</h6> 
                                <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
                                <ul class="list-unstyled mb-0"> 
                                    <li> 
                                        <p class="text-white"><i class="fa fa-home mr-3 text-primary"></i> Charlotte, NC 28216</p> 
                                    </li>                                     
                                    <li> 
                                        <a :href="`mailto:hoofbarter@gmail.com`" target="_blank" class="text-white"><i class="fa fa-envelope mr-3 text-primary"></i>hoofbarter@gmail.com</a>
                                    </li>                                     
                                    <!-- <li> 
                                        <p class="text-white"><i class="fa fa-phone mr-3 text-primary"></i>828-612-8600</p> 
                                    </li>                                                                          -->
                                </ul>                                 
                                <ul class="list-unstyled list-inline mt-3"> 
                                    <li class="list-inline-item"> 
                                        <a :href="settingsData.facebook" target="_blank" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-facebook bg-info"></i> </a> 
                                    </li>                                     
                                    <li class="list-inline-item"> 
                                        <a :href="settingsData.instagram" target="_blank" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light"> <i class="fa fa-instagram bg-info"></i> </a> 
                                    </li>                                                                         
                                </ul>                                 
                            </div>                             
                            <div class="col-lg-4 col-md-12"> 
                                <h6>Subscribe</h6> 
                                <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto"> 
                                <div class="clearfix"></div>                                 
                                <div class="input-group w-70"> 
                                    <input type="email" v-model="formItem.email" class="form-control br-tl-3  br-bl-3 " placeholder="Email"> 
                                    <div class="input-group-append "> 
                                        <button type="button" @click="submit_subscription" class="btn btn-primary br-tr-3  br-br-3"
                                        :disabled="isSending" :loading="isSending"> 
                                            {{isSending ? 'Subscribing...' : 'Subscribe'}}
                                        </button>                                         
                                    </div>                                     
                                </div>                                 
                                <h6 class="mb-0 mt-5">Payments</h6> 
                                <hr class="deep-purple  text-primary accent-2 mb-2 mt-3 d-inline-block mx-auto"> 
                                <div class="clearfix"></div>                                 
                                <ul class="footer-payments"> 
                                    <li class="pl-0">
                                        <a><i class="fa fa-cc-amex text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a><i class="fa fa-cc-visa text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a><i class="fa fa-credit-card-alt text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a><i class="fa fa-cc-mastercard text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                    <li>
                                        <a><i class="fa fa-cc-paypal text-muted" aria-hidden="true"></i></a>
                                    </li>                                     
                                </ul>                                 
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
                <div class="bg-dark-purple text-white p-0"> 
                    <div class="container"> 
                        <div class="row d-flex"> 
                            <div class="col-lg-12 col-sm-12 mb-3 mt-3 text-center"> 
                                Copyright © 2019 
                                <a href="/" class="fs-14 text-primary">Hoof Barter</a>.  All rights reserved. | Designed by              
                                <a class="fs-14 text-primary">Lail.inc</a>
                            </div>                             
                        </div>                         
                    </div>                     
                </div>                 
            </footer>             
        </section> 
    </div>
</template>


<script>


export default {
    data(){
        return{
          formItem:{
              email:''
          },
          settingsData:{},
          isSending:false,
        }
    },
    methods:{
        async submit_subscription(){
            if(this.formItem.email.trim()=='') return this.e('Email is required')
            this.isSending = true
            const res = await this.callApi('post','submit_subscription',this.formItem)
            if(res.status==201){
                this.s('Subscriptions successful!');
                this.formItem={}
            }
           else{
				if(res.status==422){
					if(res.data.errors.email){
						this.e(res.data.errors.email[0])
					}	
				}else{
					this.swr()
				}
            }
            this.isSending = false
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
    },

}
</script>