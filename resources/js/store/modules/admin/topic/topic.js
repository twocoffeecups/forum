import api from "../../../../api/api";
import {useToast} from "vue-toastification";
import router from "../../../../router/dashboard";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        topics: {},
        topic: {},
        topicTags: {},
        paginate: {},
        entriesOnPage: 10,
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
        },

        getPaginate(state){
            return state.paginate;
        },
    },

    actions: {
        getTopics({dispatch, commit, state}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/topic', {
                   page: page,
                   entriesOnPage:  state.entriesOnPage,
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

        deleteTopic({dispatch}, [id, data]){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/topic/${id}`, data)
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

        createTopic({dispatch}, data) {
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/topic/store`, data)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Created.");
                            router.push({ name:'admin.topic.details', params:{id:response.data.topicId} });
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error(error.response.data.message ?? "Error!");
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

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        }
    }


}
