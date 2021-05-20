import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

 const store = new Vuex.Store({
  state: {
    authUser:false,
  },
  getters: {

    getIsLoggedIn (state) {
      return !!state.authUser
    },
    getAuthUser (state) {
      return state.authUser
    },
  },

  mutations: {
    setAuthUser (state, data) {
      state.authUser = data
    },
  }
})

export default store;