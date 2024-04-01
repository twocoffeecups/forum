import api from "../../../../api/api";
import {useToast} from "vue-toastification";
import axios from "axios";
import router from "../../../../router/dashboard";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        //userDetails: {},
        token: !!localStorage.getItem('access-token') ?? '',
    },

    getters: {
        getToken(state) {
            return state.token;
        },
    },

    actions: {
        logout({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                axios.post('/logout')
                    .then(response => {
                        router.push({name:'forum.main'});
                        localStorage.removeItem('access-token');
                        commit('auth/setLoggedIn', false, {root: true});
                        commit('auth/setUserDetails', {}, {root: true});
                        commit('middleware/setPermissions', null, {root: true});
                        toast.success("You have successfully logout.")
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error)
                    })
            });
        },

        getUserDetails({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/profile`, {
                    headers:{
                        Authorization: `Bearer ${localStorage.getItem('access-token')}`,
                    }
                })
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            commit('auth/setUserDetails', response.data.userDetails, {root: true});
                            commit('middleware/setPermissions', response.data.userDetails.permissions, {root: true});
                            commit('auth/setLoggedIn', true, {root: true});
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },
    },
}
