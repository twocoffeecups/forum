import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        tags: {},
        paginate: {},
        entriesOnPage: 10,
    },

    getters: {
        getTags(state){
            return state.tags;
        },

        getPaginate(state){
            return state.paginate;
        },
    },

    actions: {
        getTags({dispatch, commit, state}, page = 1){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/tag', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if(response.data){
                            commit('setTags', response.data.data);
                            commit('setPaginate', response.data.meta);
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

        createTag({dispatch, commit}, [name, description]){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/tag/store', {
                    name: name,
                    description: description
                })
                    .then(response => {
                        if(response.data){
                            commit('pushTag', response.data.tag);
                            toast.success("Tag create successfully");
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            });
        },

        renameTag({dispatch}, [id, name]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/tag/${id}`, {
                    name: name,
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
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            });
        },

        changeVisibility({dispatch}, [id, value]){
            return new Promise((resolve, reject) => {
                api.patch(`/api/admin/tag/${id}/status`, {
                    visibility: value,
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
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            });
        },

        deleteTag({dispatch}, id){
            return new Promise((resolve, reject) => {
                api.delete(`/api/admin/tag/${id}`)
                    .then(response => {
                        if(response.data){
                            toast.success(response.data.message);
                            dispatch('getTags');
                            resolve(response);
                        }else{
                            reject(response);
                        }

                    })
                    .catch(error => {
                        toast.error(error.response.data.message ?? "Error!");
                        reject(error);
                    })
            });
        }
    },

    mutations: {
        setTags(state, payload){
            state.tags = payload;
        },

        pushTag(state, payload){
            state.tags.push(payload);
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        },
    }
}
