import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        permissions: {},
        paginate: {},
        entriesOnPage: 10,
    },

    getters: {
        getPermission(state){
            return state.permissions;
        },

        getPaginate(state){
            return state.paginate;
        },
    },

    actions: {
        getPermissions({dispatch, commit, state}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/permission', {
                    page: page,
                    entriesOnPage: state.entriesOnPage
                })
                    .then(response => {
                        if(response.data){
                            commit('setPermissions', response.data.data);
                            commit('setPaginate', response.data.meta)
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

        createPermission({dispatch, commit}, name){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/permission/store', {
                    name: name
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            commit('pushPermission', response.data.permission);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.data.message ?? "Error!");
                        reject(error);
                    })
            });
        },

        renamePermission({dispatch}, name){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/permission/${id}`, {
                    name: name,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Permission rename successfully.");
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

        deletePermission({dispatch}, id){
            return new Promise((resolve, reject) => {
                api.delete(`/api/admin/permission/${id}`)
                    .then(response => {
                        if(response.data){
                            dispatch('getPermissions');
                            toast.success(response.data.message ?? "Permission delete successfully.");
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
    },

    mutations: {
        setPermissions(state, payload){
            state.permissions = payload;
        },

        pushPermission(state, payload){
            state.permissions.push(payload);
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        },
    },
}
