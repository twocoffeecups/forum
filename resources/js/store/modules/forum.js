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

        filterOrderBy: 'desc',
        filterTags: [],
        filterBy: '',
        topicsCount: 0,
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
        },

        getTopicsCount(state) {
            return state.topics;
        }
    },

    actions: {
        getForum({dispatch, state, commit}, id){
            return new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('filterBy', state.filterBy);
                data.append('orderBy', state.filterOrderBy);
                state.filterTags.forEach(tag => {
                    data.append('tags[]', tag.value);
                });

                axios.post(`/api/client/forum/${id}`, data)
                    .then(response => {
                        if(response.data){
                            commit('setForum', response.data.forum);
                            commit('setChildrenForums', response.data.forum.children);
                            commit('setTopics', response.data.topics);
                            commit('setTopicsCount', response.data.topics.length);
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            });
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
        },

        setFilterTags(state, payload) {
            state.filterTags = payload;
        },

        setFilterOrderBy(state, payload) {
            state.filterOrderBy = payload;
        },

        setFilterBy(state, payload){
            state.filterBy = payload;
        },

        setTopicsCount(state, payload){
            state.topicsCount = payload;
        }
    }
}
