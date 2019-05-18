import Vue from 'vue'
import Vuex from 'vuex'
import loading from './modules/loading';
import user from './modules/user';
import router from './modules/router';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        loading,
        user,
        router
    },
})