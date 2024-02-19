import axios from "axios";
import {useToast} from "vue-toastification";
import router from '../../../router/forum';
import api from "../../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        userDetails: {},
        isLoggedIn: false,
    },

    getters: {
        userDetails(state) {
            return state.userDetails;
        },

        isLoggedIn(state) {
            return state.isLoggedIn;
        },

        isAdmin(state) {
            return state.userDetails.role === 'admin';
        },

        role(state) {
            return state.userDetails.role;
        },

        avatar(state) {
            return state.userDetails.avatar;
        },

        getUserId(state){
            return state.userDetails.id;
        },

        getNotifications(state){
            return state.userDetails.notifications;
        },

        getUnreadNotifications(state){
            return state.userDetails.unreadNotifications;
        },
    },

    actions: {
        register({dispatch, commit}, data) {
            return new Promise((resolve, reject) => {
                axios.get('/sanctum/csrf-cookie')
                    .then(res => {
                        axios.post('/register', data)
                            .then(response => {
                                toast.success('You have successfully registered!');
                                commit('middleware/setToken', response.config.headers['X-XSRF-TOKEN'], {root: true});
                                commit('setLoggedIn', true);
                                router.push({name: 'main'});
                                resolve(response);
                            })
                            .catch(error => {
                                this.t$.error(error.response.data.message ?? 'Error!');
                                reject(error)
                            })
                    })
                    .catch(err => {
                        reject(err);
                    })
            })
        },

        redirectToSocial({dispatch, commit}, provider){
            return new Promise((resolve, reject) => {
                axios.get(`/api/authorize/${provider}/redirect`)
                    .then(response => {
                        if(response.data.url){
                            window.location.href = response.data.url;
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Access error!');
                        reject(error);
                    })
            });
        },

        authWithSocial({dispatch, commit}, [provider, code]){
            return new Promise((resolve, reject) => {
                axios.get(`/api/authorize/${provider}/callback`, {
                    params: {code: code}
                })
                    .then(response => {
                        if(response.data.accessToken){
                            toast.success('Login successfully!');
                            commit('middleware/setToken', response.data.accessToken, {root: true});
                            commit('setLoggedIn', true);
                            dispatch('profile/getUserDetails', '',{root: true});
                            router.push({name: 'main'});
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        login({dispatch, commit}, user) {
            return new Promise((resolve, reject) => {
                axios.get('/sanctum/csrf-cookie')
                    .then(res => {
                        axios.post('/login', {
                            email: user.email,
                            password: user.password
                        })
                            .then(response => {
                                toast.success('Login successfully!');
                                commit('middleware/setToken', response.config.headers['X-XSRF-TOKEN'], {root: true});
                                commit('setLoggedIn', true);
                                dispatch('profile/getUserDetails', '',{root: true})
                                router.push({name: 'main'});
                                resolve(response);
                            })
                            .catch(error => {
                                toast.error(error.response.data.message ?? 'Error!');
                                reject(error);
                            })
                    })
                    .catch(err => {
                        reject(err);
                    })
            });

        },

        forgotPassword({dispatch}, email) {
            return new Promise((resolve, reject) => {
                axios.post('/password/email', {
                    email: email
                })
                    .then(response => {
                        router.push({name: 'main'});
                        toast.info( response.data.message ?? 'An email was sent to the specified email address with a link to create a new password.');
                        resolve(response);
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        resetPassword({dispatch, commit}, data) {
            return new Promise((resolve, reject) => {
                axios.get('/sanctum/csrf-cookie')
                    .then(res => {
                        axios.post('/password/reset', data)
                            .then(response => {
                                commit('middleware/setToken', response.config.headers['X-XSRF-TOKEN'], {root: true});
                                commit('setLoggedIn', true);
                                dispatch('profile/getUserDetails', '',{root: true})
                                toast.success( response.data.message ?? 'Password has been successfully changed. Sign in to your account.');
                                router.push({name: 'main'});
                                resolve(response);
                            })
                            .catch(error => {
                                toast.error(error.response.data.message ?? 'Error!');
                                reject(error);
                            })
                    })
                    .catch(err => {
                        reject(err);
                    })

            });
        },

        logout({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/logout')
                    .then(response => {
                        router.push({name: 'main'});
                        localStorage.removeItem('access-token');
                        commit('setLoggedIn', false);
                        commit('setUserDetails', {});
                        commit('middleware/setPermissions', null, {root: true});
                        //toast.success("You have successfully logout.")
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error)
                    })
            });
        },

        setLoggedInstate({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                if (localStorage.getItem('access-token')) {
                    commit('setLoggedIn', true);
                    resolve(true);
                } else {
                    commit('setLoggedIn', false);
                    commit('setUserDetails', {});
                    commit('middleware/setPermissions', null, {root: true});
                    resolve(false);
                }
            });
        },

    },

    mutations: {
        setLoggedIn(state, payload) {
            state.isLoggedIn = payload;
        },

        setUserDetails(state, payload) {
            state.userDetails = payload;
        },
    },

}
