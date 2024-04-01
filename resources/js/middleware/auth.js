export default function ({next, store}) {
    if (!store.getters['auth/isLoggedIn'] && !store.getters['middleware/token']) {
        return next({name: 'auth.signIn'})
    }
    return next();
}
