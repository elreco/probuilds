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
import axiosRouter from './axiosRouter'

import checkAuth from './middleware/check-auth';

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
            redirect: `/${i18n.locale}`,

        },
        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '/',
            component: () => import('./layouts/main/Main.vue'),

            children: [

                // =============================================================================
                // Home Route
                // =============================================================================
                {
                    path: '/:locale',
                    name: 'home',
                    meta: {
                        middleware: checkAuth,
                    },
                    component: () => import('./views/main/Home.vue')
                },
                // =============================================================================
                // Probuilds Routes
                // =============================================================================
                {
                    path: '/:locale/probuilds',
                    name: 'probuilds',
                    meta: {
                        middleware: checkAuth,
                    },
                    component: () => import('./views/probuilds/Home.vue')
                },
                {
                    path: '/:locale/matches/:region/:summonerId/:matchId/:champion/:participantId',
                    name: 'matches',
                    meta: {
                        middleware: checkAuth,
                    },
                    component: () => import('./views/probuilds/Match.vue'),
                },
                {
                    path: '/:locale/champions/:champion',
                    name: 'champions',
                    meta: {
                        middleware: checkAuth,
                    },
                    component: () => import('./views/probuilds/Champion.vue')
                },
                // =============================================================================
                // Community Routes
                // =============================================================================
                {
                    path: '/:locale/community',
                    name: 'community',
                    meta: {
                        middleware: checkAuth,
                    },
                    component: () => import('./views/community/Home.vue')
                },
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
                    component: () => import('@/views/main/pages/Login.vue')
                },
                {
                    path: '/:locale/pages/error/:code/:message',
                    name: 'page-error',
                    component: () => import('@/views/main/pages/Error.vue'),
                },
                // =============================================================================
                // Login
                // =============================================================================
                {
                    path: '/:locale/auth/social-callback',
                    name: 'social-callback',
                    component: () => import('./views/main/pages/auth/SocialCallback.vue')
                },
            ]
        },
        //Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/:locale/pages/error/404/Page not Found'
        }
    ]
})
// use beforeEach route guard to set the language
router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware];
        const context = {
            from,
            next,
            router,
            to,

        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({
            ...context,
            next: nextMiddleware
        });
    }
    // use the language from the routing param or default language
    let language = to.params.locale;

    if (!languages.includes(language)) return next('en')
    // set the current language for vuex-i18n. note that translation data
    // for the language might need to be loaded first
    if (i18n.locale !== language) {
        localStorage.locale = language
        i18n.locale = language
    }

    if (to.params.champion && to.params.locale) {
        checkChampion(to.params.champion, to.params.locale);
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

function nextFactory(context, middleware, index) {

    const subsequentMiddleware = middleware[index]; // If no subsequent Middleware exists,
    // the default `next()` callback is returned.

    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters); // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.

        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({
            ...context,
            next: nextMiddleware
        });
    };
}

function checkChampion(champion, locale) {
    axiosRouter.get("champions-check", {
            params: {
                name: champion,
                locale: locale
            }
        })
        .then(function (response) {
            if (response.data == false) {
                next({
                    name: "page-error",
                    params: {
                        code: "404",
                        message: "Champion not found"
                    }
                });
            }
        }).catch(function (error) {
            next({
                name: "page-error",
                params: {
                    code: error.response.status,
                    message: error.response.data.message
                }
            });
        });
}

export default router
