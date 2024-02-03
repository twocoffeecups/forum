import {useToast} from "vue-toastification";
import axios from "axios";
const toast = useToast();

export default {
    namespaced: true,

    state: {
        results: [],
        totalFound: 0,
        paginate: [],
    },

    getters: {
        getResults(state){
            return state.results;
        },

        getPaginate(state){
            return state.paginate;
        },

        getTotalFound(state){
            return state.totalFound;
        }
    },

    actions: {
        search({dispatch, commit}, [search, page = 1]){
            return new Promise((resolve, reject) => {
                axios.post(`/api/forum/search`, {
                    page: page,
                    search: search,
                })
                    .then(response => {
                        if(response.data){
                            commit('setResults', response.data.results);
                            commit('setPaginate', response.data.paginate);
                            commit('setTotalFound', response.data.totalFound);
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
        setResults(state, payload){
            state.results = payload;
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setTotalFound(state, payload){
            state.totalFound = payload;
        }
    }
}
