<template>
    <div>
         <div class="header-main"> 
            <div class="top-bar p-3"> 
                <div class="container"> 
                    <div class="row"> 
                        <div class="col-xl-4 col-lg-4 col-sm-4 col-7"> 
                            <div class="top-bar-left d-flex"> 
                                <div class="clearfix"> 
                                    <!-- <ul class="socials"> 
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-facebook"></i></a></li>                                         
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-twitter"></i></a> </li>                                         
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-linkedin"></i></a> </li>                                         
                                        <li><a class="social-icon text-dark" href="#"><i class="fa fa-google-plus"></i></a></li>                                         
                                    </ul>                                      -->
                                </div>                                 
                                <div class="clearfix"> 
                                    <ul class="contact border-left"> 
                                        <li class="mr-5 d-lg-none"><a href="#" class="callnumber text-dark"><span><i class="fa fa-phone mr-1"></i>: +425 345 8765</span></a></li>                                         
                                    </ul>                                     
                                </div>                                 
                            </div>                             
                        </div>                         
                        <div class="col-xl-4 col-lg-4 col-sm-8 col-5 d-none d-lg-block"> 
                            <div class="clearfix text-center"> 
                                <div class="header-search-logo d-none d-lg-block"> 
                                    <span v-if="$route.name=='home'">
                                    </span>
                                    <span v-else>
                                         <a class="header-logo" href="/"> <img src="/assets/images/brand/logo.png" class="header-brand-img" alt="dashr logo"> </a> 
                                    </span>
                                </div>                                 
                            </div>                             
                        </div>                         
                        <div class="col-xl-4 col-lg-4 col-sm-8 col-5"> 
                            <div class="top-bar-right"> 
                                <ul class="custom"> 
                                    <template v-if="isLoggedIn==false">
                                        <li> 
                                            <router-link to="/register" class="text-dark">
                                                <i class="fa fa-user mr-1"></i> <span>Register</span>
                                            </router-link>
                                        </li>                                     
                                        <li> 
                                            <router-link to="/login" class="text-dark">
                                                <i class="fa fa-sign-in mr-1"></i> <span>Login</span>
                                            </router-link>
                                        </li>   
                                    </template>  
                                     <template v-else>                                
                                        <li class="dropdown"> 
                                            <a href="#" class="text-dark" data-toggle="dropdown"><i class="fa fa-home mr-1"></i><span> My Dashboard</span></a> 
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                                                <a href="/user_profile/edit-profile" class="dropdown-item"> <i class="dropdown-icon icon icon-user"></i> My Profile</a> 
                                                <a class="dropdown-item" href="/user_profile/my-listing"> <i class="dropdown-icon icon icon-speech"></i>My Listings</a> 
                                                <a class="dropdown-item" href="/logout"> <i class="dropdown-icon icon icon-power"></i> Log out</a> 
                                            </div>                                         
                                        </li>  
                                    </template>                                   
                                </ul>                                 
                            </div>                             
                        </div>                        
                    </div>                     
                </div>                 
            </div>             
            <!-- Mobile Header -->             
            <div class="horizontal-header clearfix "> 
                <div class="container"> 
                    <a id="horizontal-navtoggle" class="animated-arrow"><span></span></a> 
                    <router-link to="/">

                    <span class="smllogo"><img src="/assets/images/brand/logo.png" width="120" alt=""/></span> 
                    </router-link>
                    <a  class="callusbtn"><i class="fa fa-phone" aria-hidden="true"></i></a> 
                </div>                 
            </div>             
            <!-- /Mobile Header -->   
             
                               
            <div class="header-style horizontal-main  bg-dark-transparent clearfix"> 
                <!-- <div class="container"> 
                    <div class="row">   
                        <div class="col-md-12"> -->
                <div class="horizontal-mainwrapper container clearfix"> 
                    <!--Nav-->                     
                    <nav class="horizontalMenu clearfix d-md-flex"> 
                        <ul class="horizontalMenu-list main_menu"> 
                            <li aria-haspopup="true">
                                <a href="/">Home </a>                                  
                            </li>                            
                        </ul>                         
                        <ul class="horizontalMenu-list mobile_menu"> 
                            <li aria-haspopup="true">
                                <a href="/">Home </a>                                  
                            </li>                           
                            <li aria-haspopup="true" class="mt-5 d-lg-block creatinggg"> 
                                <span>
                                    <router-link to="/add-post" class="ad-post btn btn-lg btn-orange">
                                        CREATE LISTING
                                    </router-link>
                                </span> 
                            </li>                                                        
                        </ul>                         
                        <ul class="mb-0 right_btns"> 
                            <li aria-haspopup="true" class="mt-5 d-none d-lg-block creatinggg"> 
                                <span>
                                    <router-link to="/add-post" class="ad-post btn btn-lg btn-orange">
                                        CREATE LISTING
                                    </router-link>
                                </span> 
                            </li>                             
                        </ul>                         
                    </nav>                     
                    <!--Nav-->                     
                <!-- </div>                 
            </div>      
                    </div> -->
                       </div>  
             </div>       
        </div> 
        <Modal v-model="isLoginModal" title="Login" :footer-hide="true" :mask-closable="false" class="popup_login">
            <div slot="close">
                <span style="font-size: 15px;color: #a8a8a8dd;" @click="isLoginModal=false" >
                    <img src="/img/close.png" alt="" style="width: 16px;">
                </span>
            </div>
            
            <div class="modal-body">
                <div class="single-page customerpage " >
                    <div class="wrapper wrapper2 box-shadow-0">
                        <form id="login" class="card-body" tabindex="500" @submit.prevent="login"> 
                            <div class="mail">
                                <input type="email" v-model="formItem.email">
                                <label>Email</label>
                            </div>
                            <div class="passwd">
                                <input type="password" v-model="formItem.password">
                                <label>Password</label>
                            </div>
                            <div class="submit">
                               <button value="submit" class="btn btn-primary btn-block" :disabled="isSending" :loading="isSending">
                                   {{isSending ? 'Loging...' : 'Login'}}
                                </button>
                            </div>
                            <p class="mb-2"><a href="/forgot_password" class="text-primary ml-1">Forgot Password</a></p>
                            <p class="text-dark mb-0">Don't have account?<router-link to="/register" class="text-primary ml-1">Sign Up</router-link></p>  
                        </form>
                        <!-- <hr class="divider"> -->
                        <!-- <div class="card-body">
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
        </Modal>
 
    </div>
</template>

<script>


export default {
    data(){
        return{
            isLoginModal:false,
            time:0,
            routeName:'/',
            formItem:{
                email:'',
                password:''
            },
            isSending:false,
        }
    },
    watch: { 
      '$route.name': function(newVal, oldVal) { // watch it
        console.log('Prop changed: ', newVal, ' | was: ', oldVal)
        window.scrollTo(0, 0);
        this.routeName = newVal
        if(newVal == 'login' || newVal == "register"){
            this.isLoginModal=false
        }
        

      } 
    },
    methods:{
        loginTimer(){
            this.time++;
            if(this.time ==10){
                let newVal = this.routeName;
                console.log('newVal')
                console.log(newVal)
                if(newVal != 'login' && newVal != "register"){
                    this.isLoginModal = true;
                }
                
            }
        },
        async login(){
            if(this.formItem.email.trim()=='') return this.i('Email is required!');
            if(thishis.isSending=true.formItem.password.trim()=='') return this.i('Password is required!');
            t
            const res=await this.callApi('post','login',this.formItem);

            if(res.status==200){
                this.s("Login Successful");
                this.$store.commit('setAuthUser', (res.data))
                    window.location = '/';
            }
            else if (res.status===202){
                this.e(res.data.msg);
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
  
    created(){
       this.$store.commit('setAuthUser', (window.authUser));
       this.routeName = this.$route.name
       setInterval(() => {
             if(!this.isLoggedIn){ this.loginTimer();}
         }, 1000);
    },

}
</script>