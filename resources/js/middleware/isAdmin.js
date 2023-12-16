export default function ({next, store}) {
    if(!store.getters['auth/isAdmin'] || !store.getters.token){
        console.log('if isAdmin false:', store.getters['auth/isAdmin'])
        return next({ name:'main' });

    }
    console.log('if isAdmin true:', store.getters['auth/isAdmin'])

    return next();
}
