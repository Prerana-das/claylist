
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)

import home from './components/pages/home'
import register from './components/pages/register'
import login from './components/pages/login'
import add_post from './components/pages/add_post'
import classifieds_list from './components/pages/classifieds_list'
import forgot_password from './components/pages/forgot_password'
import reset_password from './components/pages/reset_password'
import coming_soon from './components/pages/coming_soon'
import activation from './components/pages/account-activation'
import p_user_profile from './components/pages/p_user_profile'


import edit_profile from './components/pages/userProfile/edit_profile'
import my_listing from './components/pages/userProfile/my_listing'
import my_favorite from './components/pages/userProfile/my_favorite'
import test1 from './components/pages/test1'

let All = ['User','Admin'];

const routes = [
    //projects routes....

    {
        path: '/', 
        component: home, 
        name: 'home',
        meta: {
            guest: true,
            
            title: 'Hoofbarter - Home',
        }
       
    },
    {
        path: '/test1', 
        component: test1, 
        name: 'test1',
        meta: {
            guest: true,
            
            title: 'Hoofbarter - test1',
        }
       
    },
    {
        path: '/register', 
        component: register, 
        name: 'register',
        meta: {
            guest: true,
            title: 'Hoofbarter - Register',
        }
    },
    {
        path: '/activation', 
        component: activation, 
        name: 'activation',
        meta: {
            guest: true,
            title: 'Hoofbarter - Activation',
        }
    },
    {
        path: '/login', 
        component: login, 
        name: 'login',
        meta: {
            guest: true,
            title: 'Hoofbarter - Login',
        }
    },
    {
        path: '/add-post', 
        component: add_post, 
        name: 'add_post',
        meta: {
            guest: false,
            allowedUserType: All,
            title: 'Hoofbarter - Add_post',
        }
    },
    {
        path: '/classifieds_list', 
        component: classifieds_list, 
        name: 'classifieds_list',
        meta: {
            guest: true,
            title: 'Hoofbarter - Classifieds_list',
        }
    },
    {
        path: '/forgot_password', 
        component: forgot_password, 
        name: 'forgot_password',
        meta: {
            guest: true,
            title: 'Hoofbarter - Forgot password',
        }
    },
    {
        path: '/reset_password', 
        component: reset_password, 
        name: 'reset_password',
        meta: {
            guest: true,
            title: 'Hoofbarter - Reset password',
        }
    },
    {
        path: '/coming-soon', 
        component: coming_soon, 
        name: 'coming_soon',
        meta: {
            guest: true,
            title: 'Hoofbarter - Coming soon',
        }
    },
    {
        path: '/user-profile/:id', 
        component: p_user_profile, 
        name: 'p_user_profile',
        meta: {
            guest: true,
            title: 'Hoofbarter - User Profile',
        }
    },


    {
        path: '/user_profile/edit-profile', 
        component: edit_profile, 
        name: 'edit_profile',
        meta: {
            guest: false,
            allowedUserType: All,
            title: 'Hoofbarter - Edit_profile',
        }
    },
    {
        path: '/user_profile/my-listing', 
        component: my_listing, 
        name: 'my_listing',
        meta: {
            guest: false,
            allowedUserType: All,
            title: 'Hoofbarter - My_listing',
        }
    },
    {
        path: '/user_profile/my-favorite', 
        component: my_favorite, 
        name: 'my_favorite',
        meta: {
            guest: true,
            title: 'Hoofbarter - My_favorite',
        }
    },
    

]



export default new Router({
    mode: 'history', 
    routes

})