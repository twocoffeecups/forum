import { createStore } from 'vuex';
import middleware from "./modules/middleware";
import auth from "./modules/auth";
import profile from "./modules/profile";
import post from "./modules/post";
import topic from "./modules/topic"

const store =  createStore({
    //namespaced: true,

    modules:{
        middleware,
        auth,
        profile,
        post,
        topic,
    },
});

export default store;
