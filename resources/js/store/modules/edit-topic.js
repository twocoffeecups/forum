import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../api/api";
import router from '../../router';

const toast = useToast();

export default {
    namespaced: true,

    state: {
        topic: {},
        images: {},
        tags: {},
        selectedForum: {},
    },

    getters: {
        getTopic(state) {
            return state.topic;
        },

        getImages(state) {
            return state.images;
        },

        getTags(state) {
            return state.tags;
        },

        getSelectedForum(state) {
            return state.selectedForum;
        }
    },

    actions: {
        getTopic({dispatch, commit}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/topic/${id}/edit`)
                    .then(response => {
                        if (response.data) {
                            commit('setTopic', response.data.topic);
                            commit('setTags', response.data.topic.tags);
                            commit('setImages', response.data.topic.images);
                            commit('setSelectedForum', response.data.topic.forum);
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 404) {
                            router.push({name: 'main'});
                        }
                        reject(error);
                    })
            });
        },

        updateTopic({dispatch}, [id, data]) {
            return new Promise((resolve, reject) => {
                api.post(`/api/client/topic/${id}`, data)
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            toast.success(response.data.message ?? "updated.");
                            if (response.data.topic.status == 1) {
                                router.push({name: 'topic', params: {id: response.data.topic.id}})
                            } else {
                                router.push({name: 'topic.unapproved', params: {id: response.data.topic.id}})
                            }
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error(error.response.data.message ?? "Error!");
                    })
            })
        },
    },

    mutations: {
        setTags(state, payload) {
            state.tags = payload;
        },

        setTopic(state, payload) {
            state.topic = payload;
        },

        setImages(state, payload) {
            state.images = payload;
        },

        setSelectedForum(state, payload) {
            state.selectedForum = payload;
        }

    }
}
