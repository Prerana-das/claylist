<template>
    <div>
		
        <!--Sliders Section-->         
        <section class="home_page">  
            <div class="banner-1 cover-image sptb-2 sptb-tab bg-background2" data-image-src="/assets/images/banners/banner2.jpg"> 
                <div class="header-text mb-0"> 
                    <div class="container"> 
                        <div class="text-center text-white mb-7"> 
                            <!-- <h1 class="mb-1" style="color: #ffffff;">Find Your Best Classified</h1> 
                            <p style="color: #ffffff;">It is a long established fact that a reader will be distracted by the readable.</p>  -->
                             <a class="home_logo" href="/"> <img src="/assets/images/home_logo.png" class="header-brand-img" alt="dashr logo"> </a> 
                        </div>                         
                        <div class="row"> 
                            <div class="col-xl-10 col-lg-12 col-md-12 d-block mx-auto"> 
                                <div class="search-background bg-transparent"> 
                                    <div class="form row no-gutters for_select" style="justify-content: center;"> 
                                        <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white border_right_one_px"> 
                                           <input v-model="filterKey.key" type="text" class="form-control input-lg border-right-0 border-left-0" id="text" placeholder="Search">
                                        </div>                                         
                                        <!-- <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white"> 
                                            <input type="text" class="form-control input-lg br-md-0" id="text5" placeholder="Enter Location"> 
                                            <span><i class="fa fa-map-marker location-gps mr-1"></i> </span> 
                                        </div>-->
                                        <div class="form-group col-xl-3 col-lg-3 col-md-12 select2-lg  mb-0 bg-white"> 
                                             <select v-model="filterKey.categoryId" class="form-control  border-bottom-0 w-100" data-placeholder="Please Select One" >
												<option v-for="(item,index) in categoryData" :key="index" :value="item.id">{{ item.name }}</option>
												<option value="">Select A Category</option>
											</select>  
                                            <!-- <Select v-model="filterKey.categoryId" class="w-100" data-placeholder="Select" >
                                                <Option v-for="(item,index) in categoryData" :key="index" :value="item.id">{{ item.name }}</Option>
                                                <Option value="">None</Option>
                                            </Select> -->
                                        </div>  
                                        <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white border_right_one_px"> 
                                           <input v-model="filterKey.cityZip" type="text" class="form-control input-lg border-right-0 border-left-0" id="text" ref="location" placeholder="city or zip" @keyup="autocompleteSearch">
                                        </div> 
                                         <div class="form-group search_btn_div col-xl-3 col-lg-3 col-md-3 mb-0"> 
                                             <router-link :to="`/classifieds_list?key=${filterKey.key}&category=${filterKey.categoryId}&cityZip=${filterKey.cityZip}&lat=${filterKey.lat}&lng=${filterKey.lng}`">
                                                <button type="button" class="btn btn-lg btn-orange" style="width: 175px; height: 47px;">Search</button> 
                                             </router-link>
                                        </div>
                                                                               
                                    </div>                                     
                                </div>                                 
                                <!-- <div style="margin-top: 25px;text-align: center;">
                                    <router-link :to="`/classifieds_list?key=${filterKey.key}&category=${filterKey.categoryId}&cityZip=${filterKey.cityZip}&lat=${filterKey.lat}&lng=${filterKey.lng}`" >
                                         <button type="button" class="btn btn-lg btn-orange buy_btn" style="width: 175px; margin-right: 24px; height: 47px;">
                                            BUY
                                        </button>
                                    </router-link>
                                    <router-link to="/add-post">
                                        <button type="button" class="btn btn-lg btn-orange buy_btn" style="width: 175px; height: 47px;">
                                            SALE
                                        </button>
                                    </router-link>
                                </div> -->
                            </div>                             
                        </div>                         
                    </div>                     
                </div>
                <!-- /header-text -->                 
            </div>             
        </section>         
        <!--Sliders Section-->         
        <!--Categories-->                  
        <!--/Categories-->         
        <!--Latest Ads-->         
        <!--Latest Ads-->         
        <!--Featured Ads-->         
        <section class="sptb bg-patterns features_bg"> 
            <div class="container"> 
                <div class="section-title center-block text-center"> 
                    <h2>Featured</h2> 
                    <!-- <p>Mauris ut cursus nunc. Morbi eleifend, ligula at consectetur vehicula</p>  -->
                </div>
                <template v-if="listData.length>0">
                    <hooper :itemsToShow="2"   :infiniteScroll="true" :autoPlay="true" :playSpeed="3000">
                        <slide v-for="(item,index) in listData" :key="index">
                            <div > 
                                <div class="item"> 
                                    <div class="card mb-0"> 
                                        <div class="item-card7-imgs"> 
                                            <a :href="`/listing_details/${item.id}`">
                                                <template v-if="item.all_images.length>0">
                                                    <img :src="item.all_images[0].image" alt="img" class="cover-image"> 
                                                </template>
                                            </a> 
                                        </div>                             
                                        <div class="item-card7-overlaytext"> 
                                            <router-link :to="`/classifieds_list?category=${item.category_id}`" class="text-white">{{item.category.name}}</router-link> 
                                            <a :href="`/listing_details/${item.id}`" class="text-white"> </a> 
                                            <h4 class=" fs-20 mb-0">$ {{item.price}}</h4> 
                                        </div>                             
                                        <div class="card-body"> 
                                            <div class="item-card7-desc"> 
                                                <div class="item-card7-text"> 
                                                    <a :href="`/listing_details/${item.id}`" class="text-dark"><h4 class="feature_title">{{item.title}}</h4></a> 
                                                </div>  
                                                <div class="home_feature_list">                                  
                                                    <ul class="item-cards7-ic  home_feature_ul mb-0"> 
                                                        <li>
                                                            <a ><span class="text-muted"><i class="icon icon-eye mr-1"></i> {{item.view_count>1?  item.view_count+` Views`: item.view_count+` View`}}</span></a>
                                                        </li>                                         
                                                        <li>
                                                            <a  class="icons"><i class="icon icon-location-pin text-muted mr-1"></i> {{item.address}} {{item.city}}</a>
                                                        </li>                                                                                  
                                                    </ul> 
                                                    <ul class="item-cards7-ic home_feature_ul mb-0">                                         
                                                        <li>
                                                            <a  class="icons"><i class="icon icon-event text-muted mr-1"></i>{{item.created_at | timeAgo}}</a>
                                                        </li>                                         
                                                        <li v-if="item.user">
                                                            <a class="icons" v-if="item.user.phone_isTrue==1"><i class="icon icon-phone text-muted mr-1"></i> 
                                                                {{item.user.phone}}
                                                            </a>
                                                        </li>                                         
                                                    </ul>  
                                                </div>                                    
                                                <p class="mb-0">
                                                    <span class="feature_des">
                                                        {{item.description}}
                                                    </span>
                                                </p> 
                                            </div>                                 
                                        </div>                             
                                        <div class="card-footer"> 
                                            <div class="footerimg d-flex mt-0 mb-0"> 
                                                <div class="d-flex footerimg-l mb-0"> 
                                                    <div>
                                                        <span v-if="item.user.image">
                                                            <img :src="item.user.image" alt="image" class="avatar brround  mr-2"> 
                                                        </span>
                                                        <span v-else>
                                                            <img src="/img/profile.png" alt="image" class="avatar brround  mr-2"> 
                                                        </span>
                                                    </div>
                                                    <h5 class="time-title text-muted p-0 leading-normal mt-2 mb-0">
                                                        <span v-if="item.user">
                                                            {{item.user.username}}
                                                        </span>
                                                        <i class="icon icon-check text-success fs-12 ml-1" data-toggle="tooltip" data-placement="top" title="verified"></i></h5> 
                                                </div>                                     
                                                <div class="footerimg-r ml-auto">
                                                    <span v-if="item.wishlist">
                                                        <p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)" :class=" item.wishlist.isTrue == 1 ?'active': ''"> <i class="fa fa fa-heart-o"></i></p>
                                                    </span>
                                                    <span v-else>
                                                        <p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)"> <i class="fa fa fa-heart-o"></i></p>
                                                    </span>
                                                </div>                                     
                                            </div>                                 
                                        </div>                             
                                    </div>                         
                                </div>                         
                            </div>   
                        </slide>
                        <hooper-navigation slot="hooper-addons"></hooper-navigation>
                    </hooper>                  
                    <hooper :itemsToShow="2"   :infiniteScroll="true" :autoPlay="true" :playSpeed="3000">
                        <slide v-for="(item,index) in listData" :key="index">
                            <div > 
                                <div class="item"> 
                                    <div class="card mb-0"> 
                                        <div class="item-card7-imgs"> 
                                            <a :href="`/listing_details/${item.id}`">
                                                <template v-if="item.all_images.length>0">
                                                    <img :src="item.all_images[0].image" alt="img" class="cover-image"> 
                                                </template>
                                            </a> 
                                        </div>                             
                                        <div class="item-card7-overlaytext"> 
                                            <router-link :to="`/classifieds_list?category=${item.category_id}`" class="text-white">{{item.category.name}}</router-link> 
                                            <a :href="`/listing_details/${item.id}`" class="text-white"> </a> 
                                            <h4 class=" fs-20 mb-0">$ {{item.price}}</h4> 
                                        </div>                             
                                        <div class="card-body"> 
                                            <div class="item-card7-desc"> 
                                                <div class="item-card7-text"> 
                                                    <a :href="`/listing_details/${item.id}`" class="text-dark"><h4 class="feature_title">{{item.title}}</h4></a> 
                                                </div>  
                                                <div class="home_feature_list">                                  
                                                    <ul class="item-cards7-ic  home_feature_ul mb-0"> 
                                                        <li>
                                                            <a ><span class="text-muted"><i class="icon icon-eye mr-1"></i> {{item.view_count>1?  item.view_count+` Views`: item.view_count+` View`}}</span></a>
                                                        </li>                                         
                                                        <li>
                                                            <a  class="icons"><i class="icon icon-location-pin text-muted mr-1"></i> {{item.address}} {{item.city}}</a>
                                                        </li>                                                                                  
                                                    </ul> 
                                                    <ul class="item-cards7-ic home_feature_ul mb-0">                                         
                                                        <li>
                                                            <a  class="icons"><i class="icon icon-event text-muted mr-1"></i>{{item.created_at | timeAgo}}</a>
                                                        </li>                                         
                                                       <li v-if="item.user">
                                                            <a class="icons" v-if="item.user.phone_isTrue==1"><i class="icon icon-phone text-muted mr-1"></i> 
                                                                {{item.user.phone}}
                                                            </a>
                                                        </li>                                          
                                                    </ul>  
                                                </div>                                    
                                                <p class="mb-0">
                                                    <span class="feature_des">
                                                        {{item.description}}
                                                    </span>
                                                </p> 
                                            </div>                                 
                                        </div>                             
                                        <div class="card-footer"> 
                                            <div class="footerimg d-flex mt-0 mb-0"> 
                                                <div class="d-flex footerimg-l mb-0"> 
                                                    <div>
                                                        <span v-if="item.user.image">
                                                            <img :src="item.user.image" alt="image" class="avatar brround  mr-2"> 
                                                        </span>
                                                        <span v-else>
                                                            <img src="/img/profile.png" alt="image" class="avatar brround  mr-2"> 
                                                        </span>
                                                    </div>
                                                    <h5 class="time-title text-muted p-0 leading-normal mt-2 mb-0">
                                                        <span v-if="item.user">
                                                            {{item.user.username}}
                                                        </span>
                                                        <i class="icon icon-check text-success fs-12 ml-1" data-toggle="tooltip" data-placement="top" title="verified"></i></h5> 
                                                </div>                                     
                                                <div class="footerimg-r ml-auto">
                                                    <span v-if="item.wishlist">
                                                        <p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)" :class=" item.wishlist.isTrue == 1 ?'active': ''"> <i class="fa fa fa-heart-o"></i></p>
                                                    </span>
                                                    <span v-else>
                                                        <p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(item,index)"> <i class="fa fa fa-heart-o"></i></p>
                                                    </span>
                                                </div>                                     
                                            </div>                                 
                                        </div>                             
                                    </div>                         
                                </div>                         
                            </div>   
                        </slide>
                        <hooper-navigation slot="hooper-addons"></hooper-navigation>
                    </hooper>  
                </template>
                <template v-else>
                    <div class="alert alert-secondary" role="alert">
                        <p class="_1card_header_title text-center _padd30 no_data">No data found</p>
                    </div>
                </template>                
            </div>             
        </section>                            
		
    </div>
</template>


<script>
import {mapGetters} from 'vuex' 
import { Hooper, Slide, Navigation as HooperNavigation } from 'hooper';
import 'hooper/dist/hooper.css';
export default {
    components: {
        Hooper,
        Slide,
        HooperNavigation
    },
	data(){
		return { 
            categoryData:[],
            listData:[],
            latestListData:[],
            filterKey:{
                categoryId:'',
                key:'',
                cityZip:'',
                lat:'',
                lng:'',
                distant:50,
            },
            wishItem:{
                product_id:'',
                user_id:'',
                isTrue:'',
            },
		}
	},

	methods : {
        async  autocompleteSearch () {		
            if(this.filterKey.cityZip == '') return 
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
            this.filterKey.cityZip = data.name
            this.filterKey.lat = data.geometry.location.lat();
            this.filterKey.lng = data.geometry.location.lng();
            console.log(this.filterKey)
        },
        async wishlists(item,index){
            if(!this.isLoggedIn){
                return this.i("Please Login first  !")
            }
            if(item.wishlist){
                if(item.wishlist.isTrue==0){
                    this.wishItem.isTrue=1
                }
                else{
                    this.wishItem.isTrue=0
                }
            }
            this.wishItem.product_id=item.id
            this.wishItem.user_id=this.authUser.id
            const res = await this.callApi('post','add_wishlists',this.wishItem)
            if(res.status==201){
                this.s('This item added to your favorite list!')
                // this.wishItem={}
                this.listData[index].wishlist = {
                    isTrue:1
                }
            }
            else if(res.status==200){
                // this.s('Wishlist updated!')
                this.listData[index].wishlist.isTrue = this.wishItem.isTrue
            }
            else{
                this.swr()
            }

        }
			
    }, 
    filters:{
        timeAgo(date){
            var current = new Date(); 
            var previous = new Date(date); 
            var msPerMinute = 60 * 1000;
            var msPerHour = msPerMinute * 60;
            var msPerDay = msPerHour * 24;
            var msPerMonth = msPerDay * 30;
            var msPerYear = msPerDay * 365;

            var elapsed = current - previous;
            var result = ''

            if (elapsed < msPerMinute) {
                result= Math.round(elapsed/1000) + ' seconds ago';   
            }

            else if (elapsed < msPerHour) {
                result = Math.round(elapsed/msPerMinute) + ' minutes ago';   
            }

            else if (elapsed < msPerDay ) {
                result = Math.round(elapsed/msPerHour ) + ' hours ago';   
            }

            else if (elapsed < msPerMonth) {
                result =  Math.round(elapsed/msPerDay) + ' days ago';   
            }

            else if (elapsed < msPerYear) {
                result =  Math.round(elapsed/msPerMonth) + ' months ago';   
            }

            else {
                result =  Math.round(elapsed/msPerYear ) + ' years ago';   
            }
            return result
        }
    },

	 async created(){
			 const [res2,res1,res3,res4] = await Promise.all([  
                this.callApi('get','all_category'),
                this.callApi('get',`all_lists?isFeatured=1`),
                this.callApi('get','latest_lists'),
                this.callApi('get','/checkExpiredDate'),
				])
				if( res1.status == 200 && res2.status == 200 && res3.status == 200) {
                    this.categoryData = res2.data
                    this.listData = res1.data
                    this.latestListData = res3.data
				}
			else{
				this.swr()
            }
            
           
			
    	}
	
	
}
</script>