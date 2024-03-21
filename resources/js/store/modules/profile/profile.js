import axios from "axios";
import {useToast} from "vue-toastification";
import api from "../../../api/api";
import store from "../../index";
import router from "../../../router/forum";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        topics: {},
        posts: {},
        topicBookmarks: {},
        postBookmarks: {},
        likes: {},
        likedTopics: {},
        unapprovedTopic: {},
    },

    getters: {
        getTopics(state){
            return state.topics;
        },

        // getUnapprovedTopic(state){
        //     return state.unapprovedTopic;
        // },

        getPosts(state){
            return state.posts;
        },

        getTopicBookmarks(state){
            return state.topicBookmarks;
        },

        getPostBookmarks(state){
            return state.postBookmarks;
        },

        getLikes(state){
            return state.likes;
        },

        getLikedTopics(state){
            return state.likedTopics;
        }
    },

    actions: {
        getUserDetails({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/profile`, {
                    headers:{
                        Authorization: `Bearer ${localStorage.getItem('access-token')}`,
                    }
                })
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            commit('auth/setUserDetails', response.data.userDetails, {root: true});
                            commit('middleware/setPermissions', response.data.userDetails.permissions, {root: true});
                            commit('auth/setLoggedIn', true, {root: true});
                            commit('setTopics', response.data.userDetails.topics);
                            commit('setUnapprovedTopic', response.data.userDetails.unapprovedTopic);
                            commit('setPosts', response.data.userDetails.posts);
                            commit('setLikes', response.data.userDetails.likes);
                            commit('setLikedTopics', response.data.userDetails.likedTopics);
                            commit('setTopicBookmarks', response.data.userDetails.topicBookmarks);
                            commit('setPostBookmarks', response.data.userDetails.postBookmarks);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        localStorage.removeItem('access-token');
                        // store.dispatch('auth/setLoggedInstate');
                        store.dispatch('auth/logout');
                        router.push({name:'main'});
                        reject(error);
                    })
            });
        },

        updateProfile({dispatch}, data) {
            return new Promise((resolve, reject) => {
                api.post(`/api/client/profile/profile-update`, data)
                    .then(res => {
                        if (res.data) {
                            toast.success('You have successfully registered!');
                            resolve(res);
                        } else {
                            reject(res);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        createNewPassword({dispatch}, user) {
            return new Promise((resolve, reject) => {
                let data = new FormData();
                data.append('_method', 'put')
                for (let [key, value] of Object.entries(user)) {
                    data.append(key, value);
                }
                api.post(`/api/client/profile/edit-password`, data)
                    .then(res => {
                        if (res.data) {
                            toast.success('Password update successfully!');
                            resolve(res);
                        } else {
                            reject(res);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error)
                    })


            });
        },

        updateAvatar({dispatch}, avatar) {
            return new Promise((resolve, reject) => {
                let data = new FormData();
                data.append('avatar', avatar);
                data.append('_method', 'patch');
                api.post(`/api/client/profile/update-avatar`, data)
                    .then(res => {
                        if (res.data) {
                            toast.success(res.data.message);
                            resolve(res);
                        } else {
                            reject(res);
                        }

                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },
    },

    mutations: {
        setTopics(state, payload){
            state.topics = payload;
        },

        setPosts(state, payload){
            state.posts = payload;
        },

        setTopicBookmarks(state, payload){
            state.topicBookmarks = payload;
        },

        setPostBookmarks(state, payload){
            state.postBookmarks = payload;
        },

        setLikes(state, payload){
            state.likes = payload;
        },

        setLikedTopics(state, payload){
            state.likedTopics = payload;
        },

        setUnapprovedTopic(state, payload){
            state.unapprovedTopic = payload;
        },
    },
}
