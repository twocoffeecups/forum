import axios from "axios";
import {useToast} from "vue-toastification";
import api from "../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        userDetails: {},
        stats: {},
        topics: {},
        posts: {},
        topicsPaginate: {},
        postsPaginate: {},
    },

    getters: {
        getUserDetails(state){
            return state.userDetails;
        },

        getUserStats(state){
            return state.stats;
        },

        getTopics(state){
            return state.topics;
        },

        getPosts(state){
            return state.posts;
        },

        getTopicPaginate(state){
            return state.topicsPaginate;
        },

        getPostPaginate(state){
            return state.postsPaginate;
        }
    },

    actions: {
        getUserProfile({dispatch, commit}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/user-profile/${id}`)
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            commit('setUserDetails', response.data.userDetails);
                            commit('setUserStats', response.data.userDetails.stats);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        getUserTopics({dispatch, commit}, [id, page = 1]){
            return new Promise((resolve, reject) => {
                axios.post(`/api/client/user-profile/${id}/topics`, {
                    page: page,
                })
                    .then(response => {
                        if(response.data){
                            commit('setTopics', response.data.data);
                            commit('setTopicPaginate', response.data.meta);
                            resolve(response);
                        }else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        getUserPosts({dispatch, commit}, [id, page = 1]){
            return new Promise((resolve, reject) => {
                axios.post(`/api/client/user-profile/${id}/posts`, {
                    page: page,
                })
                    .then(response => {
                        if(response.data){
                            commit('setPosts', response.data.data);
                            commit('setPostPaginate', response.data.meta);
                            resolve(response);
                        }else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        }
    },

    mutations: {
        setUserDetails(state, payload){
            state.userDetails = payload;
        },

        setUserStats(state, payload){
            state.stats = payload;
        },

        setTopics(state, payload){
            state.topics = payload;
        },

        setPosts(state, payload){
            state.posts = payload;
        },

        setTopicPaginate(state, payload){
            state.topicsPaginate = payload;
        },

        setPostPaginate(state, payload){
            state.postsPaginate = payload;
        },
    },
}
