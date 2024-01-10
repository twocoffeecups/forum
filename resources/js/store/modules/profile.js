import axios from "axios";
import {useToast} from "vue-toastification";
import api from "../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        topics: {},
        posts: {},
        topicBookmarks: {},
        postBookmarks: {},
        likes: {},
    },

    getters: {
        getTopics(state){
            return state.topics;
        },

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
                            commit('middleware/setCanReadAdminDashboard', response.data.userDetails.canReadAdminDashboard, {root: true});
                            commit('auth/setLoggedIn', true, {root: true});
                            commit('setTopics', response.data.userDetails.topics);
                            commit('setPosts', response.data.userDetails.posts);
                            commit('setLikes', response.data.userDetails.likes);
                            commit('setTopicBookmarks', response.data.userDetails.topicBookmarks);
                            commit('setPostBookmarks', response.data.userDetails.postBookmarks);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        updateProfile({dispatch}, user) {
            return new Promise((resolve, reject) => {
                let data = new FormData();
                data.append('_method', 'put')
                for (let [key, value] of Object.entries(user)) {
                    data.append(key, value);
                }
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
                api.post(`/api/client/${1}/profile/update-avatar`, data)
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
    },
}
