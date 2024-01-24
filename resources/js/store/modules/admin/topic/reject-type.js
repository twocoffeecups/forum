import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        rejectTypes: {},
    },

    getters: {
        getRejectTypes(state){
            return state.rejectTypes;
        }
    },

    actions: {
        createRejectType({dispatch}, data){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/topic-reject-type', data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        }else{
                            resolve(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            });
        },

        getRejectTypes({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                api.get('/api/admin/topic-reject-type')
                    .then(response => {
                        if(response.data){
                            commit('setRejectTypes', response.data.rejectTypes);
                            resolve(response);
                        }else{
                            resolve(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },

        update({dispatch}, [id, title]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/topic-reject-type/${id}`, {
                    title: title
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        }else{
                            resolve(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            });
        },

        changeStatus({dispatch}, id){
            return new Promise((resolve, reject) => {
                //console.log("ID:", id);
                api.patch(`/api/admin/topic-reject-type/${id}/change-status`)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.")
                        reject(error);
                    })
            });

        },

        delete({dispatch}, id){
            return new Promise((resolve, reject) => {
                api.delete(`/api/admin/topic-reject-type/${id}`)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        }else{
                            resolve(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            });
        }
    },

    mutations: {
        setRejectTypes(state, payload){
            state.rejectTypes = payload;
        }
    },
}
