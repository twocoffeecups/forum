import api from "../../api/api";

export default {
    namespaced:true,

    state:{
        user:{
            loggedIn: true,
            isAdmin: true,
            userIsBanned: false,
        },
        token: !!localStorage.getItem('access-token') ?? '',
        permissions: null,
    },

    getters:{
        auth(state){
            return state.user;
        },

        loggedIn(state){
            return state.token == null;
        },

        isUserBanned(state){
            return state.user.userIsBanned;
        },

        token(state){
            return state.token;
        },

        permissions(state) {
            return state.permissions;
        },
    },

    mutations: {
        setToken(state, payload){
            state.token = !!payload ?? '';
            localStorage.setItem('access-token', payload);
        },

        setPermissions(state, payload){
            state.permissions = payload;
        },
    },

}
