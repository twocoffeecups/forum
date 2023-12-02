export default function ({next, from, store}){
    if(!store.getters.auth.isLoggedIn && store.getters.user.isUserBanned){
        return from();
    }

    return next();
}
