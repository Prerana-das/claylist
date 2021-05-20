<template>
    <div>
       <headerSection/>
    </div>
</template>

<script>
import headerSection from '../components/header.vue';
export default {
    components:{
      headerSection
   },
    data(){
       return {
   
       }
    }, 
    created(){
      //  this.$store.commit('setAuthUser', (window.authUser));
    }
}
</script>