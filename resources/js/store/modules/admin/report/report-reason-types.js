import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        reportReasonTypes: {},
        paginate: {},
        entriesOnPage: 10,
    },

    getters: {
        getReportReasonType(state){
            return state.reportReasonTypes;
        },

        getPaginate(state){
            return state.paginate;
        }
    },

    actions: {
        getReportReasonType({dispatch, state, commit}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/report-reason-type', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if (response.data) {
                            commit('setReportReasonTypes', response.data.data);
                            commit('setPaginate', response.data.meta);
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        create({dispatch, commit}, data){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/report-reason-type/store`, data)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            commit('push', response.data.reportReason);
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            });
        },

        update({dispatch}, [id, name]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/report-reason-type/${id}`, {
                    name: name,
                })
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            });
        },

        delete({dispatch}, id){
            return new Promise((resolve, reject) => {
                api.delete(`/api/admin/report-reason-type/${id}`, {
                    name: name,
                })
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Deleted.");
                            dispatch('getReportReasonType');
                            resolve(response);
                        } else {
                            reject(response);
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
                api.patch(`/api/admin/report-reason-type/${id}/change-status`, {
                    name: name,
                })
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        } else {
                            reject(response);
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
        setReportReasonTypes(state, payload) {
            state.reportReasonTypes = payload;
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        },

        push(state, payload){
            state.reportReasonTypes.push(payload);
        }
    },
}
