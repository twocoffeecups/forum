<template>
    <div class="alert alert-light d-flex justify-content-between" role="alert">
        <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                <span>Вами были нарушенны правила сайта: <b>{{ notification.data.reason }}</b></span>

                <!-- topic -->
                <span v-if="notification.data.object==='topic'">
                    Ваша тема
                    <router-link v-if="notification.data.topic.id" :to="{ name:'topic', params:{id: notification.data.topic.id}}" class="inner-link">
                        {{ notification.data.topic.title }}
                    </router-link>.
                    была удаллена.
                </span>

                <!-- post -->
                <span v-if="notification.data.object==='post'">
                    Ваш пост в теме
                    <router-link v-if="notification.data.post.topicId" :to="{ name:'topic', params:{id: notification.data.post.topicId}}" class="inner-link">
                        {{ notification.data.post.topicTitle }}
                    </router-link>
                    был удалён.
                </span>

                <!-- warning -->
                <span v-if="notification.data.warn">
                    Т.к. это ваше первое нарушение, то вам было вынесенно предупреждение.
                    При следующем нарущении вы будете внесены в бан лист.
                </span>

                <!-- ban  -->
                <span v-if="notification.data.ban">
                    Вы были внесенны в бан лист в срок до : {{ notification.data.ban.banEnd }}.
                    Вы не можете создавать темы и сообщения до оканчания блокироваки.
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
    name: 'ViolatedSiteRules',
    props: ['notification', 'close', 'showMessage',]
}
</script>

<style scoped>

</style>
