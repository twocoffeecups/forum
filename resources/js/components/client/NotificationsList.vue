<template>

    <div class="notifications-list">

        <div class="dropdown d-flex d-none d-sm-none d-md-none d-lg-block d-xl-block">
            <i class="fas fa-bell dropdown-toggle-split mx-2" style="font-size: 1.2em" role="button"
               data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></i>

            <ul class="dropdown-menu notifications overflow-x-hidden" style="position: absolute">
                <li class="notifications-header">
                    <div class="text-center" style="padding-bottom: 4px">{{ $t('component.notificationsList.youHave') }}
                        <b v-if="notifications">{{ notifications.length }}</b> {{ $t('component.notificationsList.unreadMess') }}
                    </div>
                </li>

                <!-- TODO: Сделать один динамический компонент -->
                <li v-if="notifications" v-for="notification in notifications.slice(0, 3)">
                    <div class="notification">
                        <!--        <router-link class="overlay-link" :to="{ name:'profile.details' }"-->
                        <!--                     title="overlay"></router-link>-->
                        <TopicLiked v-if="notification.type==='TopicLiked'" :notification="notification" />
                        <PostLiked v-if="notification.type==='PostLiked'" :notification="notification" />
                        <ReplyPost v-if="notification.type==='ReplyPost'" :notification="notification" />
                        <ReportRejected v-if="notification.type==='ReportRejected'" :notification="notification"/>
                        <ReportProcessed v-if="notification.type==='ReportProcessed'" :notification="notification"/>
                        <ViolatedSiteRules v-if="notification.type==='ViolatedSiteRules'" :notification="notification"/>
                        <TopicRejected v-if="notification.type==='TopicRejected'" :notification="notification"/>
                    </div>
                </li>

                <li class="notifications-footer mt-1">
                    <div class="text-center mt-2" style="padding-bottom: 4px">
                        <router-link :to="{name:'profile.notification'}">
                            {{ $t('component.notificationsList.viewAll') }}
                        </router-link>
                    </div>
                </li>
            </ul>
        </div>

        <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" data-bs-dismiss="offcanvas">
            <router-link class="nav-link d-flex align-items-center" :to="{name:'profile.notification'}">
                <i class="fas fa-bell d-sm-block mx-2 d-md-block d-lg-none"></i>
                {{ $t('component.notificationsList.notifications') }}
            </router-link>
        </div>
    </div>


</template>

<script>
import {mapGetters} from "vuex";
import PostLiked from "./Notification/PostLiked.vue";
import TopicLiked from "./Notification/TopicLiked.vue";
import ReplyPost from "./Notification/ReplyPost.vue";
import ReportRejected from "./Notification/ReportRejected.vue";
import ViolatedSiteRules from "./Notification/ViolatedSiteRules.vue";
import ReportProcessed from "./Notification/ReportProcessed.vue";
import TopicRejected from "./Notification/TopicRejected.vue";

export default {
    name: "NotificationsList",
    components: {TopicRejected, ReportProcessed, ViolatedSiteRules, ReportRejected, ReplyPost, TopicLiked, PostLiked,},

    computed: {
        ...mapGetters({
            notifications: 'auth/getUnreadNotifications',
        })
    }
}
</script>

<style scoped>
.notifications {
    position: absolute;
    top: 30px;
    //padding: 10px;
    min-width: 100%;
}

.notifications-header {
    border-bottom: 1px solid black;
}

.notifications-footer {
    border-top: 1px solid black;
}

.notification {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: inherit !important;
    position: relative;
}

.notification .overlay-link {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
}

.notification .inner-link {
    position: relative;
    pointer-events: all;
    z-index: 1;
}

.notification:hover {
    border-left: 5px solid #0b5ed7;
}

.text-small {
    font-size: 12px;
}

@media screen and (min-width: 960px) {
    .notifications {
        min-width: 500px;
        max-height: 500px;
        left: 100%;
        top: 65px;
        transform: translateX(-100%);
    }

}

</style>
