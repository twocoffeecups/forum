import { createStore } from 'vuex';
import middleware from "./modules/middleware";
import auth from "./modules/auth";
import profile from "./modules/profile";
import post from "./modules/post";
import topic from "./modules/topic"
import forum from "./modules/forum";
import forumCategory from "./modules/forum-category";
import createTopic from  "./modules/crete-topic";
import report from "./modules/report";
import adminForum from "./modules/admin/forum";
import adminTopic from "./modules/admin/topic";
import rejectType from "./modules/admin/reject-type";

const store =  createStore({
    //namespaced: true,
    modules:{
        middleware,
        auth,
        profile,
        post,
        topic,
        forum,
        forumCategory,
        createTopic,
        report,
        adminForum,
        adminTopic,
        rejectType,
    },
});

export default store;
