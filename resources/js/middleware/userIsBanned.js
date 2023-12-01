export default function ({next, from, store}){
    if(!store.getters.auth.loginIn && store.getters.user.isUserBanned){
        return from();
    }

    return next();
}