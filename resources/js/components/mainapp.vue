<template>
    <div>

       <span v-if="this.$route.path=='/coming-soon' || this.$route.path=='/test1'">
         <router-view/>
       </span>
       <span v-else>
         <headerSection/>
            <span v-if="this.$route.path=='/user_profile/edit-profile' || this.$route.path=='/user_profile/my-listing'|| this.$route.path=='/user_profile/my-favorite'">
               <mainappSidebar/>
               <!-- <router-view/> -->
            </span>
            <span v-else>
               <router-view/>
            </span>
         <footerSection/>
       </span>
    </div>
</template>

<script>
import headerSection from '../components/header.vue';
import footerSection from '../components/footer.vue';
import mainappSidebar from '../components/mainapp_sidebar.vue';
export default {
    components:{
      headerSection,
      footerSection,
      mainappSidebar,
   },
    data(){
       return {
   
       }
    }, 
    created(){

       this.$store.commit('setAuthUser', (window.authUser));
    }
}
</script>