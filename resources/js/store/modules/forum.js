import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        forum: {},
        childrenForums: {},
        topics: {},
    },

    getters: {
        getForum(state) {
            return state.forum;
        },

        getChildrenForums(state) {
            return state.childrenForums;
        },

        getTopics(state) {
            return state.topics;
        }
    },

    actions: {
        getForum({dispatch, commit}, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/forum/${id}`)
                    .then(response => {
                        if(response.data){
                            commit('setForum', response.data.forum);
                            commit('setChildrenForums', response.data.forum.children);
                            commit('setTopics', response.data.forum.topics);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        }
    },

    mutations: {
        setForum(state, payload) {
            state.forum = payload;
        },

        setChildrenForums(state, payload) {
            state.childrenForums = payload;
        },

        setTopics(state, payload) {
            state.topics = payload;
        }
    }
}
