export default function ({next, store}){
    if(!store.getters.auth.loginIn || !store.getters.isUser){
        return next({ name:'auth.signIn' });
    }

    return next()
}