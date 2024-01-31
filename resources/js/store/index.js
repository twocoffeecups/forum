import {createStore} from 'vuex';
import middleware from "./modules/auth/middleware";
import auth from "./modules/auth/auth";
import profile from "./modules/profile/profile";
import post from "./modules/post/post";
import topic from "./modules/topic/topic"
import forum from "./modules/forum/forum";
import forumCategory from "./modules/forum/forum-category";
import createTopic from "./modules/topic/crete-topic";
import report from "./modules/report/report";
import adminForum from "./modules/admin/forum/forum";
import adminTopic from "./modules/admin/topic/topic";
import rejectType from "./modules/admin/topic/reject-type";
import unapprovedTopic from "./modules/topic/unapproved-topic";
import rejectedTopic from "./modules/admin/topic/rejected-topic";
import editTopic from "./modules/topic/edit-topic";
import forumTopics from "./modules/forum/forum-topics";
import userProfile from "./modules/profile/user-profile";
import adminReport from "./modules/admin/report/report";
import reportReason from "./modules/admin/report/report-reason-types";
import dashboardProfile from  "./modules/admin/profile/profile";
import search from "./modules/forum/search";

const store = createStore({
    //namespaced: true,
    modules: {
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
        userProfile,
        adminReport,
        reportReason,
        dashboardProfile,
        search,
    },
});

export default store;
