export default function ({next, store}) {
    if(!store.getters['auth/isAdmin'] || !store.getters['middleware/token']){
        return next({ name:'main' });

    }
    return next();
}
