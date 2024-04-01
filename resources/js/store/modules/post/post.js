import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../../api/api";
import router from "../../../router/forum";
const toast = useToast();

export default {

    actions: {
        createPost({dispatch, commit, getters}, post) {
            return new Promise((resolve, reject) => {
                api.post(`/api/client/topic/${post.topicId}/post`, {
                    replyId: post.replyId,
                    message: post.message,
                    topicId: post.topicId,
                })
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            const lastPage = getters['topic/getPaginate'].last_page;
                            dispatch('topic/getTopicPosts', [post.topicId, lastPage], {root: true});
                            toast.success( response.data.message ?? "Post created.");
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

        likePost({dispatch, commit}, postId) {
            return new Promise((resolve, reject) => {
                api.patch(`/api/client/post/${postId}/like`)
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            commit('topic/updatePostRating', response.data.post, {root: true})
                            dispatch('profile/getUserDetails', '', {root: true})
                            toast.success("Like post!");
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error("Error!");
                    })
            })
        },

        addPostToBookmarks({dispatch}, postId) {
            return new Promise((resolve, reject) => {
                api.patch(`/api/client/post/${postId}/bookmarks`)
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            dispatch('profile/getUserDetails', '', {root: true})
                            toast.success("Post save in bookmarks.");
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error("Error!");
                    })
            })
        }

    },

}
