import {useToast} from "vue-toastification";
import axios from "axios";
import api from "../../api/api";

const toast = useToast();

export default {
    namespaced: true,

    state: {
        forumCategories: {},
    },

    getters: {
        getForumCategories(state) {
            return state.forumCategories;
        }
    },

    actions: {
        getForumCategories({dispatch, commit}) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/client/forum`)
                    .then(response => {
                        if(response.data){
                            commit('setForumCategories', response.data.forums)
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
        setForumCategories(state, payload) {
            state.forumCategories = payload;
        }
    }
}
