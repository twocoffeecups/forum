export default function ({next, store}) {
    if(!store.getters['middleware/canReadAdminDashboard'] || !store.getters['middleware/token']){
        return next({name:'main'});
    }
    return next();
}
