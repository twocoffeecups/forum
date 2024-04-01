import api from "../../../../api/api";
import {useToast} from "vue-toastification";

const toast = useToast();
export default {
    namespaced: true,

    state: {
        banList: {},
        paginate: {},

        entriesOnPage: 10,
    },

    getters: {
        getBanList(state){
            return state.banList;
        },

        getPaginate(state){
            return state.paginate;
        }
    },

    actions: {
        getUsers({dispatch, commit, state}, page = 1){
            return new Promise((resolve, reject) => {
                api.post('/api/admin/ban-list', {
                    page: page,
                    entriesOnPage: state.entriesOnPage,
                })
                    .then(response => {
                        if(response.data){
                            commit('setBanList', response.data.data);
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
        setBanList(state, payload){
            state.banList = payload;
        },

        setPaginate(state, payload){
            state.paginate = payload;
        },

        setEntriesOnPage(state, payload){
            state.entriesOnPage = payload;
        }
    }
}
