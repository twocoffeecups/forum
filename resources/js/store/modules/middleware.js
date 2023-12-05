export default {
    state:{
        user:{
            loggedIn: true,
            isAdmin: true,
            userIsBanned: false,

        },

        token: !!localStorage.getItem('access-token') ?? ''
    },

    getters:{
        auth(state){
            return state.user;
        },
        

        loggedIn(state){
            return this.state.token == null;
        },

        isAdmin(state){
            return state.user.isAdmin;
        },

        isUserBanned(state){
            return state.user.userIsBanned;
        },

        token(state){
            return state.token ?? null;
        }
    }
}
