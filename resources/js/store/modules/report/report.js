import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../../api/api";

const toast = useToast();

const POST_REPORT_URL = 'post'
const TOPIC_REPORT_URL = 'topic';
export default {
    namespaced: true,

    state: {
        reportTypes: {},
    },

    getters: {
        getReportTypes(state){
            return state.reportTypes;
        },
    },

    actions: {
        getReportType({dispatch, commit}){
            return new Promise((resolve,reject) => {
                axios.get('/api/client/report')
                    .then(response => {
                        if(response.data){
                            commit('setReportTypes', response.data.reportTypes);
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

        sendReport({dispatch}, [data, id]){
            return new Promise((resolve,reject) => {
                api.post(`/api/client/report`, data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.")
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
        setReportTypes(state, payload){
            state.reportTypes = payload;
        }
    },
}
