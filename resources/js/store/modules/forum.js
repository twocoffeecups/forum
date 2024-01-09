import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        forum: {},
        childrenForums: {},
        totalTopics: 0,
    },

    getters: {
        getForum(state) {
            return state.forum;
        },

        getChildrenForums(state) {
            return state.childrenForums;
        },

        getTotalTopics(state) {
            return state.totalTopics;
        }
    },

    actions: {
        getForum({dispatch, commit}, id){
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/forum/${id}`)
                    .then(response => {
                        if(response.data){
                            commit('setForum', response.data.forum);
                            commit('setChildrenForums', response.data.forum.children);
                            commit('setTotalTopics', response.data.forum.totalTopics);
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
    },

    mutations: {
        setForum(state, payload) {
            state.forum = payload;
        },

        setChildrenForums(state, payload) {
            state.childrenForums = payload;
        },

        setTotalTopics(state, payload){
            state.totalTopics = payload;
        }
    }
}
