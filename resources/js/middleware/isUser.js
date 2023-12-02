export default function ({next, store}){
    if(!store.getters.auth.isLoggedIn || !store.getters.isUser){
        return next({ name:'auth.signIn' });
    }

    return next()
}
