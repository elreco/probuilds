import axios from '../../axios.js'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// cookie settings 
Cookies.defaults = {
    domain: ".elreco.fr",
    expires: 1,
};
// state
export const state = {
    user: null,
    token: Cookies.get('token')
}

// getters
export const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.user !== null
}

// mutations
export const mutations = {
    [types.SAVE_TOKEN](state, {
        token,
        remember
    }) {
        state.token = token

        Cookies.set('token', token)
    },

    [types.FETCH_USER_SUCCESS](state, {
        user
    }) {
        state.user = user
    },

    [types.FETCH_USER_FAILURE](state) {
        state.token = null
        Cookies.remove('token')
    },

    [types.LOGOUT](state) {
        state.user = null
        state.token = null

        Cookies.remove('token')
    },

    [types.UPDATE_USER](state, {
        user
    }) {
        state.user = user
    }
}
// actions
export const actions = {
    saveToken({
        commit,
        dispatch
    }, payload) {
        commit(types.SAVE_TOKEN, payload)
    },
    async fetchUser({
        commit
    }) {
        try {
            const {
                data
            } = await axios.get('/user');

            commit(types.FETCH_USER_SUCCESS, {
                user: data
            })
        } catch (e) {
            commit(types.FETCH_USER_FAILURE)
        }
    },

    updateUser({
        commit
    }, payload) {
        commit(types.UPDATE_USER, payload)
    },

    async logout({
        commit
    }) {
        try {
            await axios.post('/api/logout')
        } catch (e) {}

        commit(types.LOGOUT)
    },
}
