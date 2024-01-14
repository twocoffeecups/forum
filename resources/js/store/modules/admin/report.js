import api from "../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        reports: {},
        paginate: {},
        entriesOnPage: 10,
        report: {},
    },

    getters: {
        getReports(state){
            return state.reports;
        },

        getReport(state){
            return state.report;
        },

        getPaginate(state){
            return state.paginate;
        }
    },

    actions: {
        getReports({dispatch, state, commit}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/report', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if (response.data) {
                            commit('setReports', response.data.data);
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

        getReport({dispatch, commit}, id){
            return new Promise((resolve, reject) => {
                api.get(`/api/admin/report/${id}`)
                    .then(response => {
                        if (response.data) {
                            commit('setReport', response.data.report);
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
    },

    mutations: {
        setReports(state, payload) {
            state.reports = payload;
        },

        setReport(state, payload){
            state.report = payload;
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        },
    },
}
