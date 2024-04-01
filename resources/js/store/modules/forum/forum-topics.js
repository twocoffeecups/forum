import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        topics: {},
        filterOrderBy: 'desc',
        filterTags: [],
        filterBy: '',

        totalPages: 0,
        paginate: {},
    },

    getters: {
        getTopics(state) {
            return state.topics;
        },

        getTotalPages(state){
            return state.totalPages;
        },

        getPaginate(state){
            return state.paginate;
        }
    },

    actions: {
        getTopics({dispatch, state, commit}, [id, page = '1']){
            return new Promise((resolve, reject) => {
                const data = new FormData();
                data.append('filterBy', state.filterBy);
                data.append('orderBy', state.filterOrderBy);
                data.append('page', page);
                state.filterTags.forEach(tag => {
                    data.append('tags[]', tag.value);
                });

                axios.post(`/api/forum/${id}/topics`, data)
                    .then(response => {
                        if(response.data){
                            commit('setTopics', response.data.data);
                            commit('setTotalPages', response.data.meta.last_page);
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
    },

    mutations: {
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

        setTotalPages(state, payload){
            state.totalPages = payload;
        },

        setPaginate(state, payload){
            state.paginate = payload;
        }
    }
}
