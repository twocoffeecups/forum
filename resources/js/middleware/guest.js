export default function ({next, store}) {
    if (store.getters.token) {
        return next({name: 'main'})
    }
    return next();
}
