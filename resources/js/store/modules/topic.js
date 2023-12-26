import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../api/api";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        topic: {},
        topicAuthor: {},
        posts: {},
        mainPost: {},
        images: {},
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

        getPosts(state) {
            return state.posts;
        },

        getMainPost(state) {
            return {
                title: state.topic.title,
                message: state.topic.content,
                forum: state.topic.forum.name,
                rating: state.topic.rating,
                views: state.topic.views,
                created_at: state.topic.created_at,
                updated_at: state.topic.updated_at,
            };
        }
    },

    actions: {
        getTopic({dispatch, commit}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/topic/${id}`)
                    .then(response => {
                        if (response.data) {
                            commit('setTopic', response.data.topic);
                            commit('setTopicAuthor', response.data.topic.author);
                            commit('setPosts', response.data.topic.posts);
                            commit('setImages', response.data.topic.images);
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
        setTopic(state, payload) {
            state.topic = payload;
        },

        setTopicAuthor(state, payload) {
            state.topicAuthor = payload;
        },

        setImages(state, payload){
            state.images = payload;
        },

        setPosts(state, payload) {
            state.posts = payload;
        },

        pushPost(state, payload) {
            state.posts.push(payload);
        },
    },
}
