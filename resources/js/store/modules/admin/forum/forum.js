import api from "../../../../api/api";
import {useToast} from "vue-toastification";
import axios from "axios";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        forums: {},
        forum: {},
        parentForum: {},
        childrenForums: {},
        forumStats: {},

        paginate: {},
        entriesOnPage: 10,
    },

    getters: {
        getForums(state) {
            return state.forums;
        },

        getForum(state) {
            return state.forum;
        },

        getParentForum(state) {
            return state.parentForum;
        },

        getChildrenForums(state) {
            return state.childrenForums;
        },

        getForumStats(state) {
            return state.forumStats;
        },

        getPaginate(state){
            return state.paginate;
        }
    },

    actions: {
        getForums({dispatch, state, commit}, page = 1) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/forum/all', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if (response.data) {
                            commit('setForums', response.data.data);
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

        getForum({dispatch, commit}, id) {
            return new Promise((resolve, reject) => {
                api.get(`/api/admin/forum/${id}`)
                    .then(response => {
                        if (response.data) {
                            commit('setForum', response.data.forum);
                            commit('setChildrenForums', response.data.forum.children);
                            commit('setForumStats', response.data.forum.stats);
                            commit('setParentForum', response.data.forum.parent);
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

        createForum({dispatch, commit}, data) {
            return new Promise((resolve, reject) => {
                api.post('/api/admin/forum/store', data)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            commit('pushForum', response.data.forum);
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            });
        },

        changeForumVisibility({dispatch}, id) {
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/forum/${id}/change-status`)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.")
                        reject(error);
                    })
            });
        },

        updateForumContent({dispatch}, [id, data]) {
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/forum/${id}`, data)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? 'Successfully!');
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? 'Error!');
                        reject(error);
                    })
            });
        },

        changeParentCategory({dispatch}, [id, parentId]) {
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/forum/${id}/change-parent-forum`, {
                    parentId: parentId
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            })
        },

        changeForumType({dispatch}, [id, type]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/forum/${id}/change-type`, {
                    type: type
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.");
                        reject(error);
                    })
            })
        },

        deleteForum({dispatch}, id) {
            return new Promise((resolve, reject) => {
                api.delete(`/api/admin/forum/${id}`)
                    .then(response => {
                        if (response.data) {
                            toast.success(response.data.message ?? "Success.");
                            resolve(response);
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error.")
                        reject(error);
                    })
            });
        }
    },

    mutations: {
        setForums(state, payload) {
            state.forums = payload;
        },

        setForum(state, payload) {
            state.forum = payload;
        },

        setParentForum(state, payload) {
            state.parentForum = payload;
        },

        setChildrenForums(state, payload) {
            state.childrenForums = payload;
        },

        setForumStats(state, payload) {
            state.forumStats = payload;
        },

        pushForum(state, payload) {
            state.forums.push(payload);
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        }
    },


}
