/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'
import i18n from './i18n/i18n'
import {
    languages
} from './i18n/i18n'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: '/',
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    routes: [{
            path: "/",
            redirect: `/${i18n.locale}`
        },
        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '/',
            component: () => import('./layouts/main/Main.vue'),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: '/:locale',
                    name: 'home',
                    component: () => import('./views/Home.vue')
                },
                {
                    path: '/:locale/match/:region/:summoner_id/:match_id',
                    name: 'match',
                    component: () => import('./views/Match.vue')
                },
                {
                    path: '/:locale/champion/:champion',
                    name: 'champion',
                    component: () => import('./views/Champion.vue')
                }
            ]
        },
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '/',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '/:locale/pages/login',
                    name: 'page-login',
                    component: () => import('@/views/pages/Login.vue')
                },
                {
                    path: '/pages/error-404',
                    name: 'page-error-404',
                    component: () => import('@/views/pages/Error404.vue')
                }
            ]
        },
        //Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ]
})
// use beforeEach route guard to set the language
router.beforeEach((to, from, next) => {

    // use the language from the routing param or default language
    let language = to.params.locale;

    if (!languages.includes(language)) return next('en')
    // set the current language for vuex-i18n. note that translation data
    // for the language might need to be loaded first
    if (i18n.locale !== language) {
        localStorage.locale = language
        i18n.locale = language
    }

    return next();

});
router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = 'none'
    }
})

export default router
