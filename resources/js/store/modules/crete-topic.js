import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../api/api";
import router from '../../router';

const toast = useToast();

export default {
    namespaced: true,

    state: {
        forumTree: {},
        tags: {},
    },

    getters: {
        getForumTree(state) {
            return state.forumTree;
        },

        getTags(state){
            return state.tags;
        }
    },

    actions: {
        getTopicFormResources({dispatch, commit}){
            return new Promise((resolve, reject) => {
                axios.get('/api/client/topic/form-resources')
                    .then(response => {
                        if(response.data){
                            commit('setForumTree', response.data.forums);
                            commit('setTags', response.data.tags);
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

        createTopic({dispatch}, data) {
            return new Promise((resolve, reject) => {
                api.post(`/api/client/topic`, data)
                    .then(response => {
                        if (response.data) {
                            resolve(response);
                            toast.success(response.data.message ?? "Created.");
                            router.push({ name:'topic.unapproved', params:{id:response.data.topicId} })
                        } else {
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                        toast.error( error.response.data.message ?? "Error!");
                    })
            });
        },
    },

    mutations: {
        setForumTree(state, payload){
            state.forumTree = payload;
        },

        setTags(state, payload){
            state.tags = payload;
        }
    }
}
