export default {
    state:{
        user:{
            loggedIn: false,
            isUser: false,
            isAdmin: true,
            userIsBanned: false,

        },

        token: !!localStorage.getItem('access-token') ?? ''
    },

    getters:{
        auth(state){
            return state.user;
        },

        isUser(state){
            return state.user.isUser;
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
    }
}
