import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        users: {},
        user: {},
        roles: {},
    },

    getters: {
        getUsers(state){
            return state.users;
        },

        getUser(state){
            return state.user;
        },

        getUserTopics(state){
            return state.user.topics;
        },

        getUserStats(state){
            return state.user.stats;
        },

        getUserPermissions(state){
            return state.user.permissions;
        },

        getRoles(state){
            return state.roles;
        }
    },

    actions: {
        getUsers({dispatch, commit}){
            return new Promise((resolve, reject) => {
                api.get('/api/admin/user')
                    .then(response => {
                        if(response.data){
                            commit('setUsers', response.data.users);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        getUser({dispatch, commit}, id){
            return new Promise((resolve, reject) => {
                api.get(`/api/admin/user/${id}`)
                    .then(response => {
                        if(response.data){
                            commit('setUser', response.data.user);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        createUser({dispatch}, data){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/user/register', data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            });
        },

        getRoles({dispatch, commit}){
            return new Promise((resolve, reject) => {
                api.get('/api/admin/role')
                    .then(response => {
                        if(response.data){
                            commit('setRoles', response.data.roles);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        changeRole({dispatch}, [id, roleId]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/user/${id}/${roleId}/change-role`, {
                    roleId: roleId,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            });
        },

        changePermissions({dispatch}, [id, data]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/user/${this.user.id}/change-permissions`, data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                    })
            })
        }
    },

    mutations: {
        setUsers(state, payload){
            state.users = payload;
        },

        setUser(state, payload){
            state.user = payload;
        },

        setRoles(state, payload){
            state.roles = payload;
        },
    }
}
