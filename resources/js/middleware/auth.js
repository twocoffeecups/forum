export default function ({next, store}){
    if(!store.getters.auth.isLoggedIn || !store.getters.token){
        return next({ name:'auth.signIn' })
    }

    return next();
}
