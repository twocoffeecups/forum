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
import unapprovedTopic from "./modules/unapproved-topic";
import rejectedTopic from "./modules/admin/rejected-topic";
import editTopic from "./modules/edit-topic";
import forumTopics from "./modules/forum-topics";

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
        unapprovedTopic,
        rejectedTopic,
        editTopic,
        forumTopics,
    },
});

export default store;
