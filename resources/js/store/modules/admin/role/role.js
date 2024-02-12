import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        roles: {},
        role: {},
        rolePermissions: {},
    },

    getters: {
        getRoles(state){
            return state.roles;
        },

        getRole(state){
            return state.role;
        },

        getRolePermissions(state){
            return state.rolePermissions;
        }
    },

    actions: {
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
            })
        },

        getRole({dispatch, commit}, id){
            return new Promise((resolve, reject) => {
                api.get(`/api/admin/role/${id}`)
                    .then(response => {
                        if(response.data){
                            commit('setRole', response.data.role);
                            commit('setRolePermissions', response.data.role.permissions);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },

        createRole({dispatch, commit}, data){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/role', data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            commit('pushRole', response.data.role);
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

        renameRole({dispatch}, [id, name]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/role/${id}`, {
                    name: name,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Role rename successfully.");
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error)
                    })
            });
        },

        changeRolePermissions({dispatch}, [id, data]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/role/${id}/change-permissions`, data)
                    .then(response => {
                        if(response.data){
                            toast.success("Permissions change successfully.");
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

        deleteRole({dispatch}, id){
            return new Promise((resolve, reject) => {
                api.delete(`/api/admin/role/${id}/`)
                    .then(response => {
                        if(response.data){
                            dispatch('getRoles');
                            toast.success(response.data.message ?? "Role delete successfully.");
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            })
        },
    },

    mutations: {
        setRoles(state, payload){
            state.roles = payload;
        },

        setRole(state, payload){
            state.role = payload;
        },

        setRolePermissions(state, payload){
            state.rolePermissions = payload;
        },

        pushRole(state, payload){
            state.roles.push(payload);
        },
    },
}
