import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../../api/api";

const toast = useToast();

export default {

    actions: {
        createPost({dispatch, commit}, post) {
            return new Promise((resolve, reject) => {
                api.post(`/api/client/topic/${post.topicId}/post`, {
                    replyId: post.replyId,
                    message: post.message,
                    topicId: post.topicId,
                })
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            commit('topic/pushPost', response.data.post);
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

        likePost({dispatch}, postId) {
            return new Promise((resolve, reject) => {
                api.patch(`/api/client/post/${postId}/like`)
                    .then(res => {
                        if (res.data) {
                            resolve(res);
                            toast.success("Like post!");
                        } else {
                            reject(res);
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
                    .then(res => {
                        if (res.data) {
                            resolve(res);
                            toast.success("Post save in bookmarks.");
                        } else {
                            reject(res);
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
