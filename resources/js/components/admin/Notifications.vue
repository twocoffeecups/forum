<template>

    <div class="notifications-list">

        <div class="dropdown d-flex d-none d-sm-none d-md-none d-lg-block d-xl-block">
<!--            <a class="nav-link dropdown-toggle-split" role="button"  data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">-->
<!--                <i class="far fa-bell" style="font-size: 1.3em"></i>-->
<!--            </a>-->
            <a class="nav-link dropdown-toggle-split" role="button"  data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                <i class="far fa-bell position-relative" style="font-size: 1.3em">
                    <span v-if="notifications && notifications.length!==0" class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
                </i>
            </a>

            <ul v-if="notifications && notifications.length!==0" class="dropdown-menu notifications overflow-x-hidden" style="position: absolute">
                <li class="notifications-header">
                    <div class="text-center" style="padding-bottom: 4px">{{ $t('component.notificationsList.youHave') }}
                        <b v-if="notifications">{{ notifications.length }}</b> {{ $t('component.notificationsList.unreadMess') }}
                    </div>
                </li>

                <li v-if="notifications" v-for="notification in notifications.slice(0, 3)">
                    <div class="notification">
                        <NewReportNotification v-if="notification.type==='CreateNewReport'" :notification="notification" />
                        <NewTopicNotification v-if="notification.type==='CreateNewTopic'" :notification="notification "/>
                    </div>
                </li>
                <li v-if="notifications.length!==0" class="notifications-footer mt-1">
                    <div class="text-center mt-2" style="padding-bottom: 4px">
                        <router-link :to="{name:'admin.notifications'}">
                            Notifications
                        </router-link>
                    </div>
                </li>
            </ul>

            <ul v-if="notifications && notifications.length===0" class="dropdown-menu notifications overflow-x-hidden" style="position: absolute">
                <li class="my-2 mx-2 p-1 text-center">
                    <h5>You don't have notifications.</h5>
                </li>
            </ul>
        </div>

        <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none">
            <router-link class="text-dark" :to="{name:'admin.notifications'}">
                <i class="far fa-bell" style="font-size: 1.3em"></i>
            </router-link>

        </div>
    </div>


</template>

<script>
import {mapGetters} from "vuex";
import NewReportNotification from "./notifications/NewReportNotification.vue";
import NewTopicNotification from "./notifications/NewTopicNotification.vue";

export default {
    name: "Notifications",
    components: {NewTopicNotification, NewReportNotification},

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
