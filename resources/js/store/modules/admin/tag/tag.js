import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        tags: {},
    },

    getters: {
        getTags(state){
            return state.tags;
        }
    },

    actions: {
        getTags({dispatch, commit}){
            return new Promise((resolve, reject) => {
                api.get('/api/admin/tag')
                    .then(response => {
                        if(response.data){
                            commit('setTags', response.data.tags)
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
                api.post('/api/admin/tag', {
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
    }
}
