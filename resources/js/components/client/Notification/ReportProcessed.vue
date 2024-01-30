<template>
    <div class="alert alert-light d-flex justify-content-between" role="alert">
        <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                <span>Уважаеммый {{ notification.data.userName }}, ваша жалоба на </span>

                <!-- topic -->
                <span v-if="notification.data.object==='topic'">тему
                    <router-link v-if="notification.data.topic.id" :to="{ name:'topic', params:{id: notification.data.topic.id}}" class="inner-link">
                        {{ notification.data.topic.title }}
                    </router-link>.
                    <!-- author -->
                    пользователя
                    <router-link v-if="notification.data.author.id" :to="{name:'user.profile', params:{id:notification.data.author.id}}" class="inner-link">
                        {{ notification.data.author.name }}
                    </router-link>
                </span>

                <!-- post -->
                <span v-if="notification.data.object==='post'">сообщение темы
                    <router-link v-if="notification.data.post.topicId" :to="{ name:'topic', params:{id: notification.data.post.topicId}}" class="inner-link">
                        {{ notification.data.post.topicTitle }}
                    </router-link>.
                    <!-- author -->
                    пользователя
                    <router-link v-if="notification.data.author.id" :to="{name:'user.profile', params:{id:notification.data.author.id}}" class="inner-link">
                        {{ notification.data.author.name }}
                    </router-link>
                </span>
                <span>
                    из за нарушения правил форума: <b>{{ notification.data.reportReasonType }}</b>
                    была рассмотренна.
                </span>
                <span v-if="notification.data.object==='post'">
                    Сообщение было удаленно.
                </span>
                <span v-if="notification.data.object==='topic'">
                    Тема была удаленна.
                </span>
            </div>
        </div>
        <div v-if="close" class="d-flex fa-pull-right">
            <i class="fas fa-times" role="button"></i>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ReportProcessed',
    props: ['notification', 'close', 'showMessage',]
}
</script>

<style scoped>

</style>
