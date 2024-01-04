import api from "../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        topics: {},
        topic: {},
        topicTags: {},
    },

    getters: {
        getTopics(state){
            return state.topics;
        },

        getTopic(state){
            return state.topic;
        },

        getTopicTags(state){
            return state.topicTags;
        }
    },

    actions: {
        getTopics({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                api.get('/api/admin/topic')
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

        getTopic({dispatch, commit}, id){
            return new Promise((resolve, reject) => {
                api.get(`/api/admin/topic/${id}`)
                    .then(response => {
                        if (response.data) {
                            commit('setTopic', response.data.topic);
                            commit('setTopicTags', response.data.topic.tags);
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

        deleteTopic({dispatch}, [id, reason]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/topic/${id}`, {
                    reason: reason
                })
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Deleted.");
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            })
        },

        rejectTopic({dispatch}, [id, data]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/topic/${id}/reject`, data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            dispatch('getTopic', id);
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

        resolveTopic({dispatch}, id){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/topic/${id}/resolve`)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            dispatch('getTopic', id);
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
    },

    mutations: {
        setTopics(state, payload) {
            state.topics = payload;
        },

        setTopic(state, payload){
            state.topic = payload;
        },

        setTopicTags(state, payload){
            state.topicTags = payload;
        },
    }


}
