export default function ({next, store}){
    if(store.getters.auth.loginIn || store.getters.token){
        return next({ name:'profile' })
    }
    return next();
}