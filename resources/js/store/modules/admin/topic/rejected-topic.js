import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        topics: {},
        topic: {},
        entriesOnPage: 10,
        paginate: {},
    },

    getters: {
        getTopics(state){
            return state.topics;
        },

        getTopic(state){
            return state.topic;
        },

        getPaginate(state){
            return state.paginate;
        },

    },

    actions: {
        getTopics({dispatch, commit, state}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/rejected-topics', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if (response.data) {
                            commit('setTopics', response.data.data);
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
    },

    mutations: {
        setTopics(state, payload) {
            state.topics = payload;
        },

        setTopic(state, payload){
            state.topic = payload;
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        },
    }


}
