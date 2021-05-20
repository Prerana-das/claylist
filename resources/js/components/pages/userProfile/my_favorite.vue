<template>
  <div>
	
	<div class="card mb-0">
		<div class="card-header">
			<h3 class="card-title">My Favorite Listing</h3>
		</div>
		<div class="card-body">
			<template v-if="pagination.total==0">
				<div class="alert alert-secondary" role="alert">
					<p class="_1card_header_title text-center _padd30 no_data">No data found</p>
				</div>
			</template>
			<template v-else-if="loading==true">
				<div class="alert alert-secondary" role="alert">
					<p class="_1card_header_title text-center _padd30 no_data">Loading...</p>
				</div>
			</template>
			<template v-else>
				<div class="my-favadd table-responsive border-top userprof-tab">
					<table class="table table-bordered table-hover mb-0 text-nowrap">
						<thead>
							<tr>
								<th>Item</th>
								<th>Category</th>
								<th>Price</th>
								<th>Listing Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item,index) in favoriteData" :key="index">
								<td>
									<div class="media mt-0 mb-0">
										<div class="card-aside-img">
											<template v-if="item.product.all_images.length>0">
												<span v-for="(i,index2) in item.product.all_images.slice(0,1)" :key="index2">
													<img :src="item.product.all_images[index2=0].image" alt="img" class="cover-image">
												</span>
											</template>
										</div>
										<div class="media-body">
											<div class="card-item-desc ml-4 p-0">
												<h4 class="font-weight-semibold">
													<span v-if="item.product">{{item.product.title}}</span>
												</h4>
												<p>
													<i class="fa fa-clock-o mr-1"></i><span v-if="item.product">{{isMonthDate(item.created_at)}}</span>
												</p>
												<a :href="`/listing_details/${item.product.id}`"><i class="fa fa-tag mr-1"></i> Open</a>
											</div>
										</div>
									</div>
								</td>
								<td>
									<span v-if="item.product">
										<span v-if="item.product.category">
										{{item.product.category.name}}
										</span>
									</span>
								</td>
								<td class="font-weight-semibold fs-16">
									<span v-if="item.product">${{item.product.price}}</span>
								</td>
								<td>
									<span v-if="item.product">
										<p class="badge badge-warning">{{item.product.status}}</p>
									</span>
								</td>
								<td>
									<p class="btn btn-info btn-sm text-white" @click="cancelWishlist(item,index)"><i class="fa fa-trash"></i></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div style="text-align:center;" class="pagination_div _mar_t30 mt-3">
					<Page :current="pagination.current_page" :total="pagination.total" @on-change="getpaginate" :page-size="parseInt(pagination.per_page)" />
				</div>
			</template>
		</div>
	</div>
  </div>
</template>

<script>
import moment from 'moment';
    export default {
        data () {
            return {
				favoriteData:[],
				page:1,
				total:"7",
				pagination: {},
				loading:false,
			}
        },
        methods: {
			async getpaginate(page = 1){
				this.loading=true
				const res  = await this.callApi('get',`get_favorite_list?page=${page}&total=${ parseInt(this.total)}&user_id=${this.authUser.id}`)
				if(res.status == 200){
					this.favoriteData = res.data.data
					this.pagination = res.data
				}
				else{
					this.swr()
				}
				this.loading=false
			},
			isMonthDate(date) {
				return moment(date).format("MMM Do");
			},
			async cancelWishlist(item,index){
				if(!confirm("Are you sure to remove this item")){
				return;
			}
				let ob = {
					id:item.id,
					user_id:this.authUser.id
				}
				this.loading = true
				const res = await this.callApi('post',`cancelWishlist?total=${this.total}`,ob)
				if(res.status == 200){
					this.i('This item have been removed from favorite list!')
					this.favoriteData.splice(index,1)
					this.favoriteData = res.data.data
					this.pagination = res.data
					this.loading = false
				}
				else{
					this.swr();
				}
			}
			
		},
		 async created(){
			 
			this.loading=true
			const res = await this.callApi('get',`get_favorite_list?total=${this.total}&user_id=${this.authUser.id}`)
			if(res.status == 200){
				this.favoriteData = res.data.data
				this.pagination = res.data
			}
			else{
				this.swr()
			}
			this.loading=false
    	}
    }
</script>