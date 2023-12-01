export default {
    state:{
        user:{
            loginIn: false,
            isUser: false,
            isAdmin: false,
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

        loginIn(state){
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
