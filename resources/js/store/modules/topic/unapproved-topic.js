import {useToast} from "vue-toastification";
import api from "../../../api/api";
import router from "../../../router/forum";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        topic: {},
        topicAuthor: {},
        images: {},
        reason: {},
    },

    getters: {
        getTopic(state){
            return state.topic;
        },

        getImages(state){
            return state.images;
        },

        getTopicAuthor(state) {
            return state.topicAuthor;
        },

        getRejectedReason(state){
            return state.reason;
        }
    },

    actions: {
        getTopic({dispatch, commit}, id) {
            return new Promise((resolve, reject) => {
                api.get(`/api/topic/unapproved/${id}`)
                    .then(response => {
                        if (response.data) {
                            commit('setTopic', response.data.topic);
                            commit('topic/setTopicAuthor', response.data.topic.author, {root: true});
                            commit('setImages', response.data.topic.images);
                            commit('setRejectedReason', response.data.topic.isRejected);
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        if(error.response.status===404){
                            router.push({ name:'main' });
                        }
                        reject(error);
                    })
            });
        },
    },

    mutations: {
        setTopic(state, payload) {
            state.topic = payload;
        },

        setTopicAuthor(state, payload) {
            state.topicAuthor = payload;
        },

        setImages(state, payload){
            state.images = payload;
        },

        setRejectedReason(state, payload){
            state.reason = payload;
        },
    },
}
