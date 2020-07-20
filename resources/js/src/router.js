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

import checkAuth from './middleware/check-auth';
import locale from './middleware/locale';



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
            // MAIN ROUTES
            // =============================================================================
            path: '/:locale',
            component: () => import('./layouts/main/Main.vue'),
            children: [

                // =============================================================================
                // Home Route
                // =============================================================================
                {
                    path: '',
                    name: 'home',
                    meta: {
                        middleware: [checkAuth, locale],
                    },
                    component: () => import('./views/main/Home.vue')
                },
                // =============================================================================
                // Spectate Route
                // =============================================================================
                {
                    path: 'spectate/:region?',
                    name: 'spectate',
                    meta: {
                        middleware: [checkAuth, locale],
                    },
                    component: () => import('./views/spectate/Spectate.vue')
                },
            ]
        },
        {
            // =============================================================================
            // Probuilds Routes
            // =============================================================================
            path: '/:locale/probuilds',
            component: () => import('./layouts/main/Main.vue'),
            children: [{
                path: ':lane?/:region?',
                name: 'probuilds',
                meta: {
                    middleware: [checkAuth, locale],
                },
                component: () => import('./views/probuilds/Probuilds.vue')
            }, {
                path: 'matches/:region/:summonerId/:matchId/:champion/:participantId',
                name: 'probuilds.matches',
                meta: {
                    middleware: [checkAuth, locale],
                },
                component: () => import('./views/probuilds/Match.vue'),
            }, {
                path: 'champions/:champion',
                name: 'probuilds.champions',
                meta: {
                    middleware: [checkAuth, locale],
                },
                component: () => import('./views/probuilds/Champion.vue')
            }],
        },
        // =============================================================================
        // Community Routes
        // =============================================================================
        {
            path: '/:locale/community',
            component: () => import('./layouts/main/Main.vue'),
            children: [{
                path: '',
                name: 'community',
                meta: {
                    middleware: [checkAuth, locale],
                },
                component: () => import('./views/community/Home.vue')
            }]
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
                    meta: {
                        middleware: locale,
                    },
                    component: () => import('@/views/main/pages/Login.vue')
                },
                {
                    path: '/:locale/pages/error/:code/:message',
                    name: 'page-error',
                    meta: {
                        middleware: locale,
                    },
                    component: () => import('@/views/main/pages/Error.vue'),
                },
                // =============================================================================
                // Login
                // =============================================================================
                {
                    path: '/:locale/auth/social-callback',
                    name: 'social-callback',
                    meta: {
                        middleware: locale,
                    },
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

export default router
