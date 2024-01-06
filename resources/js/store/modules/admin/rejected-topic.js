import api from "../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        topics: {},
        topic: {},
    },

    getters: {
        getTopics(state){
            return state.topics;
        },

        getTopic(state){
            return state.topic;
        },

    },

    actions: {
        getTopics({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                api.get('/api/admin/rejected-topics')
                    .then(response => {
                        if (response.data) {
                            commit('setTopics', response.data.topics);
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

    }


}
