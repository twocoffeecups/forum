import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        rejectTypes: {},
        paginate: {},
        entriesOnPage: 10,
    },

    getters: {
        getRejectTypes(state){
            return state.rejectTypes;
        },

        getPaginate(state){
            return state.paginate;
        },
    },

    actions: {
        createRejectType({dispatch, commit}, data){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/topic-reject-type/store', data)
                    .then(response => {
                        if(response.data){
                            commit('push', response.data.rejectedType);
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

        getRejectTypes({dispatch, commit, state}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/topic-reject-type', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if(response.data){
                            commit('setRejectTypes', response.data.data);
                            commit('setPaginate', response.data.meta);
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
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        },

        push(state, payload){
            state.rejectTypes.push(payload);
        },
    },
}
