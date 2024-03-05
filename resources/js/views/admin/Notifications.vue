<template>
    <div class="row">
        <div class="mx-auto col-md-7">
            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Notifications list</h4>
                </div>
                <div class="card-body">
                    <div v-if="notifications && notifications.length!==0" v-for="notification in notifications" class="">
                        <NewReportNotification v-if="notification.type==='CreateNewReport'" :notification="notification" :close="true"/>
                        <NewTopicNotification v-if="notification.type==='CreateNewTopic'" :notification="notification" :close="true" />
                    </div>
                    <div v-if="!notifications || notifications.length===0" class="">
                        No notifications
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import NewReportNotification from "../../components/admin/notifications/NewReportNotification.vue";
import NewTopicNotification from "../../components/admin/notifications/NewTopicNotification.vue";
import {not} from "@vuelidate/validators";

export default {
    name: "ForumDetail",
    methods: {not},
    components: {NewTopicNotification, NewReportNotification},

    computed: {
        ...mapGetters({
            notifications: 'auth/getNotifications',
        })
    },


}
</script>

<style>

</style>
