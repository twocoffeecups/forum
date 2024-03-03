export default function ({next, store}) {
    if (store.getters['middleware/token']) {
        console.log("TOKEN:", store.getters['middleware/token'])
        return next({name: 'main'})
    }
    return next();
}
