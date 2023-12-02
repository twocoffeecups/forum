export default function ({next, store}) {
    if(!store.getters.isAdmin || !store.getters.auth.token){
        return next({ name:'404' });
    }

    console.log("You not Admin!");

    return next();
}
