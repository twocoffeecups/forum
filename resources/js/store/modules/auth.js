import axios from "axios";
import {useToast} from "vue-toastification";
import router from '../../router';
import api from "../../api/api";

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
    },

    actions: {
        register({dispatch}, user) {
            return new Promise((resolve, reject) => {
                let data = new FormData();
                for (let [key, value] of Object.entries(user)) {
                    data.append(key, value);
                }
                axios.post('/api/auth/sign-up', data)
                    .then(response => {
                        if (response.data) {
                            router.push({name: 'auth.signIn'});
                            toast.success('You have successfully registered!');
                            resolve(response);
                        } else {
                            reject(response);
                        }

                    })
                    .catch(error => {
                        this.t$.error(error.response.data.message ?? 'Error!');
                        reject(error)
                    })
            })

        },

        login({dispatch, commit}, user) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/sign-in', {
                    email: user.email,
                    password: user.password
                })
                    .then(response => {
                        if (response.data) {
                            toast.success('Login successfully!');
                            commit('middleware/setToken', response.data.accessToken, {root: true});
                            commit('setLoggedIn', true);
                            commit('middleware/setCanReadAdminDashboard', response.data.userDetails.canReadAdminDashboard, {root: true});
                            commit('setUserDetails', response.data.userDetails);
                            commit('middleware/setPermissions', response.data.userDetails.permissions, {root: true});
                            localStorage.setItem('user-details', JSON.stringify(response.data.userDetails));
                            router.push({name: 'main'});
                            resolve(response);
                        } else {
                            reject(response);
                        }

                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });

        },

        forgotPassword({dispatch}, email) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/password/forgot', {
                    email: email
                })
                    .then(response => {
                        if (response.data) {
                            router.push({name: 'main'});
                            toast.info('An email was sent to the specified email address with a link to create a new password.');
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        resetPassword({dispatch}, user) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/password/reset', {
                    email: user.email,
                    password: user.password,
                    confirmPassword: user.confirmPassword,
                    hash: user.hash
                })
                    .then(response => {
                        if (response.data) {
                            toast.info('Password has been successfully changed. Sign in to your account.');
                            router.push({name: 'auth.signIn'});
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        logout({dispatch, state, commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/logout', {}, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('access-token')}`
                    }
                })
                    .then(response => {
                        if (response.data) {
                            localStorage.removeItem('access-token');
                            localStorage.removeItem('canRAD');
                            //state.middleware.setCanReadAdminDashboard = false;
                            commit('setLoggedIn', false);
                            commit('setUserDetails', {});
                            commit('middleware/setPermissions', null, {root: true});
                            commit('middleware/setCanReadAdminDashboard', false, {root: true});
                            toast.success("You have successfully logout.")
                            router.push({name: 'main'});
                            resolve(response);
                        } else {
                            reject(response)
                        }
                    })
                    .catch(error => {
                        reject(error)
                    })
            });
        },

        setLoggedInstate({commit}) {
            return new Promise((resolve, reject) => {
                if (localStorage.getItem('access-token')) {
                    commit('setLoggedIn', true);
                    resolve(true);
                } else {
                    commit('setLoggedIn', false);
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
