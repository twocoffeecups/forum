<template>

    <div class="notifications-list">

        <div class="dropdown d-flex d-none d-sm-none d-md-none d-lg-block d-xl-block">
            <i class="fas fa-bell dropdown-toggle-split mx-2" style="font-size: 1.2em" role="button"
               data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false"></i>

            <ul class="dropdown-menu notifications overflow-x-hidden" style="position: absolute">
                <li class="notifications-header">
                    <div class="text-center" style="padding-bottom: 4px">{{ $t('component.notificationsList.youHave') }}
                        <b>5</b> {{ $t('component.notificationsList.unreadMess') }}
                    </div>
                </li>

                <li v-for="notification in 5">
                    <div class="notification">
                        <router-link class="overlay-link" :to="{ name:'profile.details' }"
                                     title="overlay"></router-link>
                        <div class="top-text-block">
                            <div class="top-text-heading">
                                <p>
                                    Пользователь <a href="/#" class="inner-link">Tod Howard</a> положительно оценил вашу
                                    запись
                                    <router-link :to="{ name:'topic', params:{id:1}}" class="inner-link">My first
                                        topic
                                    </router-link>
                                </p>
                            </div>
                            <div class="text-small">2 hours ago</div>
                        </div>
                    </div>

                </li>

                <li class="notifications-footer mt-3">
                    <div class="text-center mt-2" style="padding-bottom: 4px"><a
                        href="#">{{ $t('component.notificationsList.viewAll') }}</a></div>
                </li>
            </ul>
        </div>

        <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" data-bs-dismiss="offcanvas">
            <router-link class="nav-link d-flex align-items-center" :to="{name:'profile.details'}">
                <i class="fas fa-bell d-sm-block mx-2 d-md-block d-lg-none"></i>
                {{ $t('component.notificationsList.notifications') }}
            </router-link>
        </div>
    </div>


</template>

<script>
export default {
    name: "NotificationsList"
}
</script>

<style scoped>
.notifications {
    position: absolute;
    top: 30px;
    padding: 10px;
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
