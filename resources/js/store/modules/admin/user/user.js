import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        users: {},
        user: {},
        roles: {},
        paginate: {},

        entriesOnPage: 10,
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

        getUserPosts(state){
            return state.user.posts;
        },

        getUserReports(state){
            return state.user.reports;
        },

        getUserStats(state){
            return state.user.stats;
        },

        getUserPermissions(state){
            return state.user.permissions;
        },

        getRoles(state){
            return state.roles;
        },

        getPaginate(state){
            return state.paginate;
        }
    },

    actions: {
        getUsers({dispatch, commit, state}, page = 1){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/user', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if(response.data){
                            commit('setUsers', response.data.data);
                            commit('setPaginate', response.data.meta);
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

        updateProfile({dispatch, commit}, [id, data]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/user/${id}/update`, data)
                    .then(response => {
                        if(response.data){
                            commit('setUser', response.data.user);
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

        changeAvatar({dispatch, commit}, [id, data]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/user/${id}/change-avatar`, data)
                    .then(response => {
                        if(response.data){
                            commit('setUser', response.data.user);
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
                api.get('/api/admin/user/roles')
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
                api.post(`/api/admin/user/${id}/change-permissions`, data)
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

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        }
    }
}
