<template>
    <div class="container" id="notifications">
        <div v-if="notifications && notifications.length!==0" class="card mb-4 rounded-0">
            <div class="card-body">

                <!-- Notification messages -->
                <!-- TODO: Сделать один динамический компонент -->
                <div v-if="notifications" v-for="notification in notifications" class="p-1 mb-3">
                    <TopicLiked v-if="notification.type==='TopicLiked'" :notification="notification" :close="true"/>
                    <PostLiked v-if="notification.type==='PostLiked'" :notification="notification" :close="true"/>
                    <ReplyPost v-if="notification.type==='ReplyPost'" :notification="notification" :close="true"/>
                    <ReportRejected v-if="notification.type==='ReportRejected'" :notification="notification" :close="true" :show-message="true"/>
                    <ReportProcessed v-if="notification.type==='ReportProcessed'" :notification="notification" :close="true" :show-message="true"/>
                    <ViolatedSiteRules v-if="notification.type==='ViolatedSiteRules'" :notification="notification" :close="true" :show-message="true"/>
                    <TopicRejected v-if="notification.type==='TopicRejected'" :notification="notification" :close="true" :show-message="true"/>
                </div>

            </div>
        </div>
        <div v-if="!notifications || notifications.length===0" class="my-4 text-center">
            <h4>You don't have any notifications.</h4>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import PostLiked from "../../components/client/Notification/PostLiked.vue";
import TopicLiked from "../../components/client/Notification/TopicLiked.vue";
import ReplyPost from "../../components/client/Notification/ReplyPost.vue";
import ReportRejected from "../../components/client/Notification/ReportRejected.vue";
import ViolatedSiteRules from "../../components/client/Notification/ViolatedSiteRules.vue";
import ReportProcessed from "../../components/client/Notification/ReportProcessed.vue";
import TopicRejected from "../../components/client/Notification/TopicRejected.vue";
export default {
    name: "ProfileNotification",
    components: {TopicRejected, ReportProcessed, ViolatedSiteRules, ReportRejected, ReplyPost, PostLiked, TopicLiked,},

    computed: {
        ...mapGetters({
            notifications: 'auth/getNotifications',
        })
    }
}
</script>

<style scoped>

</style>
