import store from '../store/store'

export default async ({
    next
}) => {
    if (!store.getters['auth/check'] && store.getters['auth/token']) {

        try {
            console.log(await store.dispatch('auth/fetchUser'))
        } catch (e) {
            console.log(e);
        }
    }
    return next()
}
