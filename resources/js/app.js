require('./bootstrap');
window.Vue = require('vue')
import router from './router'
import store from './store'
import ViewUI from 'view-design';


Vue.use(ViewUI);
import common from './common'
Vue.mixin(common)


import iView from 'iview';
import 'iview/dist/styles/iview.css';
import locale from 'iview/dist/locale/en-US';
Vue.use(iView, { locale });
import Vue from 'vue';

// import store from './store'
import Vuex from 'vuex';
Vue.use(Vuex);

import moment from 'moment'
Vue.use(moment);
// Vue.use(VueMoment, {
//   moment,
// })
// Vue.use(require('vue-moment'));
import VueGeolocation from 'vue-browser-geolocation';
Vue.use(VueGeolocation);

let userType = window.authUser.userType
console.log(userType)
router.beforeEach((to, from, next) => {
  let path = window.location.pathname;
  let pathArray = path.split('/');
  if(path != '/' && pathArray[1] !='listing_details'){
    document.title = to.meta.title;
  } 
  if(to.meta){
      if(to.meta.guest == true) return next();
      let allowed = to.meta.allowedUserType;
      console.log('allowed')
      console.log(to.meta)
      for(let a of allowed){
          if(a==userType){
            return next(); 
          }
      }
      window.location = '/login';
  }
  return;
});

// router.beforeEach((to, from, next) => {
//     if(to.name == 'add_post'){
//         if(window.authUser){
//             return next();
//         }else{
//             window.location = '/login';
//         }
//      }
//     return next();
//   });
  

Vue.component('mainapp', require('./components/mainapp.vue').default)
Vue.component('mainapp_header', require('./components/mainapp_header.vue').default)
Vue.component('mainapp_footer', require('./components/mainapp_footer.vue').default)
Vue.component('comment', require('./components/details_page/comment.vue').default)
// Vue.component('mainapp_sidebar', require('./components/mainapp_sidebar.vue').default)

const app = new Vue({
    el: '#app', 
    router, 
    store
})