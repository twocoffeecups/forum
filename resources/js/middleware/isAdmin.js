export default function ({next, store}) {
    if(!store.getters.auth.isAdmin && !store.getters.token){
        return next({ name:'404' });
    }

    return next();
}
