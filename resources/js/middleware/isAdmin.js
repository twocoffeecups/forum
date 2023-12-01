export default function ({next, store}) {
    if(!store.getters.auth.loginIn || !store.getters.isAdmin || !store.getters.auth.token){
        return next({ name:'404' });
    }

    return next();
}