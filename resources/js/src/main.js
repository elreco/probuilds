/*=========================================================================================
  File Name: main.js
  Description: main vue(js) file
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import App from './App.vue'
import moment from 'moment'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

// Vuesax Component Framework
import Vuesax from 'vuesax'

Vue.use(Vuesax, {
    theme: {
        colors: {
            gold: 'rgb(255, 193, 7)',
        }
    }
})

// Theme Configurations
import '../themeConfig.js'


// Globally Registered Components
import './globalComponents.js'

// Vue Router
import router from './router'

// axios
import axios from './axios.js'
Vue.prototype.$http = axios

// Vuex Store
import store from './store/store'

// i18n
import i18n from './i18n/i18n'

// vue tooltip
import VTooltip from 'v-tooltip'
Vue.use(VTooltip)

// vue select
/* import vSelect from "vue-select";
Vue.component("v-select", vSelect); */

// Vuejs - Vue wrapper for hammerjs
import {
    VueHammer
} from 'vue2-hammer'
Vue.use(VueHammer)

// Vue Meta
import VueMeta from 'vue-meta'
Vue.use(VueMeta)

// Vue Moment
import VueMoment from 'vue-moment'
Vue.use(VueMoment, {
    moment
})


// PrismJS
import 'prismjs'
import 'prismjs/themes/prism-tomorrow.css'


Vue.config.productionTip = false

new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount('#app')
