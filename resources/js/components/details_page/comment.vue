<template>
    <div class="comment_area">
		<div class="card-footer report_area mb-5">
			<div class="icons">
				<!-- <a href="#" class="btn btn-info icons"><i class="icon icon-share mr-1"></i> Share Ad</a> -->
				<a href="#" class="btn btn-danger icons" @click="modal1 = true"><i class="icon icon-exclamation mr-1"></i> Report Abuse</a>
				 <span v-if="addsData.wishlist">
					<p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(addsData)" :class=" addsData.wishlist.isTrue == 1 ?'active': ''"> <i class="fa fa fa-heart-o"></i></p>
				</span>
				<span v-else>
					<p class="item-card9-icons1 wishlist wishlist_btn" @click="wishlists(addsData)"> <i class="fa fa fa-heart-o"></i></p>
				</span>
				<!-- <a  class="btn btn-primary icons"><i class="icon icon-heart  mr-1"></i></a>  -->
			</div>
		</div>

			<!--Comments-->
			<div class="card comment_area_bg">
				<div class="card-header">
					<h3 class="card-title">Comments</h3>
				</div>
				<!-- <div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="mb-4">
								<p class="mb-2">
									<span class="fs-14 ml-2"><i class="fa fa-star text-yellow mr-2"></i>5</span>
								</p>
								<div class="progress progress-md mb-4 h-4">
									<div class="progress-bar bg-success w-100">9,232</div>
								</div>
							</div>
							<div class="mb-4">
								<p class="mb-2">
									<span class="fs-14 ml-2"><i class="fa fa-star text-yellow mr-2"></i>4</span>
								</p>
								<div class="progress progress-md mb-4 h-4">
									<div class="progress-bar bg-info w-80">8,125</div>
								</div>
							</div>
							<div class="mb-4">
								<p class="mb-2">
									<span class="fs-14 ml-2"><i class="fa fa-star text-yellow mr-2"></i>  3</span>
								</p>
								<div class="progress progress-md mb-4 h-4">
									<div class="progress-bar bg-primary w-60">6,263</div>
								</div>
							</div>
							<div class="mb-4">
								<p class="mb-2">
									<span class="fs-14 ml-2"><i class="fa fa-star text-yellow mr-2"></i>  2</span>
								</p>
								<div class="progress progress-md mb-4 h-4">
									<div class="progress-bar bg-secondary w-30">3,463</div>
								</div>
							</div>
							<div class="mb-5">
								<p class="mb-2">
									<span class="fs-14 ml-2"><i class="fa fa-star text-yellow mr-2"></i>  1</span>
								</p>
								<div class="progress progress-md mb-4 h-4">
									<div class="progress-bar bg-orange w-20">1,456</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<div class="card-body p-0" v-for="(item,index) in commentData" :key="index">
					<div class="media mt-0 p-5">
						<div class="d-flex mr-3">
							<span v-if="item.user.image">
								<img :src="item.user.image" alt="image" class="avatar brround  mr-2"> 
							</span>
							<span v-else>
								<img class="media-object brround" alt="64x64" src="/img/profile.png"> 
							</span>
						</div>
						<div class="media-body">
							<h5 class="mt-0 mb-1 font-weight-semibold comment_user_name" v-if="item.user">{{item.user.name}}
								<span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title="verified"><i class="fa fa-check-circle-o text-success"></i></span>
							</h5>
							<small class="text-muted">
								<i class="fa fa-calendar"></i> <span> {{isMonthDate(item.created_at)}}</span> 
								<i class=" ml-3 fa fa-clock-o"></i> {{isTime(item.created_at)}} 
								<span v-if="item.user">
									<i class=" ml-3 fa fa-map-marker"></i> {{item.user.city}}
								</span>
							</small>
							<p class="font-13  mb-2 mt-2">
								{{item.description}}
							</p>
							<!-- <a href="#" class="mr-2"><span class="badge badge-primary">Helpful</span></a>
							<a href="" class="mr-2" data-toggle="modal" data-target="#Comment"><span >Comment</span></a>
							<a href="" class="mr-2" data-toggle="modal" data-target="#report"><span >Report</span></a> -->
							<!-- <div class="media mt-5">
								<div class="d-flex mr-3">
									<a href="#"> <img class="media-object brround" alt="64x64" src="/assets/images/faces/female/2.jpg"> </a>
								</div>
								<div class="media-body">
									<h5 class="mt-0 mb-1 font-weight-semibold">Rose Slater <span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title="verified"><i class="fa fa-check-circle-o text-success"></i></span></h5>
									<small class="text-muted"><i class="fa fa-calendar"></i> Dec 22st  <i class=" ml-3 fa fa-clock-o"></i> 6.00  <i class=" ml-3 fa fa-map-marker"></i> Brezil</small>
									<p class="font-13  mb-2 mt-2">
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris   commodo Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur consequat.
									</p>
									<a href="" data-toggle="modal" data-target="#Comment"><span class="badge badge-default">Comment</span></a>
								</div>
							</div> -->
						</div>
					</div>
					<!-- <div class="media p-5 border-top mt-0">
						<div class="d-flex mr-3">
							<a href="#"> <img class="media-object brround" alt="64x64" src="/assets/images/faces/male/3.jpg"> </a>
						</div>
						<div class="media-body">
							<h5 class="mt-0 mb-1 font-weight-semibold">Edward
							<span class="fs-14 ml-0" data-toggle="tooltip" data-placement="top" title="verified"><i class="fa fa-check-circle-o text-success"></i></span>
							<span class="fs-14 ml-2"> 4 <i class="fa fa-star text-yellow"></i></span>
							</h5>
							<small class="text-muted"><i class="fa fa-calendar"></i> Dec 21st  <i class=" ml-3 fa fa-clock-o"></i> 16.35  <i class=" ml-3 fa fa-map-marker"></i> UK</small>
							<p class="font-13  mb-2 mt-2">
								Ut enim ad minim veniam, quis Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et  nostrud exercitation ullamco laboris   commodo consequat.
							</p>
							<a href="#" class="mr-2"><span class="badge badge-primary">Helpful</span></a>
							<a href="" class="mr-2" data-toggle="modal" data-target="#Comment"><span >Comment</span></a>
							<a href="" class="mr-2" data-toggle="modal" data-target="#report"><span >Report</span></a>
						</div>
					</div> -->
				</div>
			</div>
       
		<div class="card mb-lg-0 leave_comment_area">
			<div class="card-header">
				<h3 class="card-title">Leave a comment</h3>
			</div>
			<div class="card-body">
				<div>
					<!-- <div class="form-group">
						<input type="text" class="form-control" id="name1" placeholder="Your Name">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" id="email" placeholder="Email Address">
					</div> -->
					<div class="form-group">
						<textarea class="form-control" v-model="commentItem.description" name="example-textarea-input" rows="6" placeholder="Comment"></textarea>
					</div>
					<button class="btn btn-primary" @click="comment()">Send</button>
				</div>
			</div>
		</div>
		
		<Modal
			v-model="modal1"
			title="Report Abuse"
			:mask-closable="false"
			:closable="false"
		class="report_area_bg">
			<div class="row">
				<div class="col-12 col-md-12">
					<div class="form-group mb-0">
						<textarea class="form-control report_area" v-model="reportItem.description" name="example-textarea-input" rows="6" placeholder="Message"></textarea>
					</div>
				</div>
			</div>
			<div slot="footer">
				<button type="button" class="btn btn-danger" @click="modal1 = false">Cancel</button>
				<button type="button" class="btn btn-success" @click="report()">Submit</button>
			</div>
		</Modal>

		<!-- <router-view/> -->
		
    </div>
</template>

<script>
import moment from "moment";
// var moment =require('vue-moment');
export default {
   
    data(){
       return {
		   reportItem:{
			   reporter_id:'',
			   product_id:'',
			   description:'',
		   },
		   commentItem:{
			   user_id:'',
			   product_id:'',
			   description:'',
		   },
		   wishItem:{
                product_id:'',
                user_id:'',
                isTrue:'',
            },
		   product_id:'',
		   addsData:[],
		   commentData:[],
		   modal1:false,
		   countView:'',
		//    moment:moment
       }
	},
	 methods: {
		    async wishlists(item){
           	if(!window.authUser){ 
					return this.i("Please Login First  !")
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
            const res = await this.callApi('post','/add_wishlists',this.wishItem)
            if(res.status==201){
                this.s('This item added to your favorite list!')
                // this.wishItem={}  
            }
            else if(res.status==200){ 

            }
            else{
                this.swr()
            }

        },
			async report(){
				if(!window.authUser){
					return this.i("Please Login First  !")
				}
				if(this.reportItem.description.trim()=='') return this.i('Description is required!');
				this.reportItem.reporter_id=this.authUser.id
				this.reportItem.product_id = this.product_id
				const res=await this.callApi('post','report',this.reportItem);

				if(res.status==201){
					this.s("Report Successful");
					this.modal1=false
					this.reportItem.description = ''
				}
				else{
					this.swr();
				}
			},
			async comment(){
				if(!window.authUser){
					return this.i("Please Login First !")
				}
				if(this.commentItem.description.trim()=='') return this.i('Description is required!');
				this.commentItem.user_id=this.authUser.id
				this.commentItem.product_id = this.product_id
				const res=await this.callApi('post','post_comment',this.commentItem);

				if(res.status==200){
					this.s("Comment Successful");
					this.commentData.push(res.data)
					this.commentItem.description = ''
				}
				else{
					this.swr();
				}
			},
			isMonthDate(date) {
				return moment(date).format("MMM Do");
			},
			isTime(date) {
				return moment(date).format('h:mm a');
			},
			
		}, 
    async created(){
		var url = window.location.pathname;
		var get_id =url.split("/");
		this.product_id = parseInt(get_id[get_id.length-1])

		const [res1,res2,res3] = await Promise.all([ 
			this.callApi('get',`single_adds?product_id=${this.product_id}`),
			this.callApi('get',`get_comment?product_id=${this.product_id}`),
			this.callApi('get',`count_total_view?product_id=${this.product_id}`),
		])
		if(res1.status == 200 && res2.status == 200 && res3.status == 200) {
			this.addsData = res1.data[0]
			this.commentData = res2.data
			this.countView = res3.data
		}
		else{
			this.swr()
		}
		// console.log('window.authUser')
		// console.log(window.authUser)
		this.$store.commit('setAuthUser', (window.authUser));

    }
}
</script>

