import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        forumName: null,
        logo: null,
        background: null,
        meta: null,
        showOnlyLogo: false,
        postsOnPage: null,
        topicsOnPage: null,
    },

    getters: {
        getForumName(state) {
            return state.forumName;
        },

        getMeta(state){
            return state.meta;
        },

        getLogo(state){
            return state.logo;
        },

        getBackground(state) {
            return state.background;
        },

        getShowOnlyLogo(state){
            return state.showOnlyLogo;
        },

        getPostsOnPage(state){
            return state.postsOnPage;
        },

        getTopicsOnPage(state){
            return state.topicsOnPage;
        }
    },

    actions: {
        getSettings({dispatch, commit}){
            return new Promise((resolve, reject) => {
                api.get('/api/admin/settings/get-all')
                    .then(response => {
                        if(response.data){
                            commit('setForumName', response.data.forumName);
                            commit('setMeta', response.data.meta);
                            commit('setLogo', response.data.logo);
                            commit('setBackground', response.data.background);
                            commit('setShowOnlyLogo', response.data.showOnlyLogo);
                            commit('setPostsOnPage', response.data.postsOnPage);
                            commit('setTopicsOnPage', response.data.topicsOnPage);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
        },

        changeForumName({dispatch}, name){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/settings/forum-name`, {
                    value: name,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },

        changeMeta({dispatch}, [description, keywords]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/settings/meta`, {
                    description: description,
                    keywords: keywords,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },

        changeTopicsOnPage({dispatch}, data){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/settings/topics-on-page`, {
                    value: data,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },

        changePostsOnPage({dispatch}, data){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/settings/posts-on-page`, {
                    value: data,
                })
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },

        updateLogo({dispatch}, data){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/settings/logo`, data)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            dispatch('getSettings','');
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },

        updateBackground({dispatch}, data){
            return new Promise((resolve, reject) => {
                api.post(`/api/admin/settings/background`, data)
                    .then(response => {
                        if(response.data){
                            resolve(response);
                            dispatch('getSettings','');
                            toast.success(response.data.message);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },

        changeShowSiteName({dispatch}, showOnlyLogo){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/settings/show-only-logo`, {
                    value: showOnlyLogo
                })
                    .then(response => {
                        if(response.data){
                            resolve(response);
                            toast.success(response.data.message);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message);
                        reject(error);
                    })
            });
        },
    },

    mutations: {
        setForumName(state, payload){
            state.forumName = payload;
        },

        setMeta(state, payload){
            state.meta = payload;
        },

        setPostsOnPage(state, payload){
            state.postsOnPage = payload;
        },

        setLogo(state, payload){
            state.logo = payload;
        },

        setBackground(state, payload){
            state.background = payload;
        },

        setShowOnlyLogo(state, payload){
            state.showOnlyLogo = payload;
        },

        setTopicsOnPage(state, payload){
            state.topicsOnPage = payload;
        }
    }
}
