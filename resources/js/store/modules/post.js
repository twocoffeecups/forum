import {useToast} from "vue-toastification";
import axios from "axios";

const toast = useToast();

export default {

    actions: {

        createPost({dispatch}, post) {
            return new Promise((resolve, reject) => {
                axios.post(`/api/client/${1}/topic/${post.topicId}/post`, {
                    replyId: post.replyId,
                    message: post.message,
                    topicId: post.topicId,
                })
                    .then(res => {
                        if (res.data) {
                            resolve(res);
                            toast.success("Post created");
                        } else {
                            reject(res);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error("Error!");
                    })
            });
        },

        likePost({dispatch}, postId) {
            return new Promise((resolve, reject) => {
                axios.post(`/api/client/${1}/post/${postId}/like`)
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
                axios.post(`/api/client/${1}/post/${postId}/bookmarks`)
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
