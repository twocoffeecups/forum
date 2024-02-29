
export default {
    namespaced: true,

    state: {
        forumName: null,
        logo: null,
        background: null,
        showOnlyLogo: false,
    },

    getters: {
        getForumName(state) {
            return state.forumName.value;
        },

        getLogo(state){
            return state.logo;
        },

        getBackground(state) {
            return state.background;
        },

        getShowOnlyLogo(state){
            return state.showOnlyLogo.value;
        }
    },

    actions: {
        getSettings({dispatch, commit}){
            return new Promise((resolve, reject) => {
                axios.get('/api/settings')
                    .then(response => {
                        commit('setForumName', response.data.forumName);
                        commit('setLogo', response.data.logo);
                        commit('setBackground', response.data.background);
                        commit('setShowOnlyLogo', response.data.showOnlyLogo);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            });

        },
    },

    mutations: {
        setForumName(state, payload){
            state.forumName = payload;
        },

        setLogo(state, payload){
            state.logo = payload;
        },

        setBackground(state, payload){
            state.background = payload;
        },

        setShowOnlyLogo(state, payload){
            state.showOnlyLogo = payload;
        }
    }
}
