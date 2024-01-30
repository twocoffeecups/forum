<template>
    <div class="alert alert-light d-flex justify-content-between" role="alert">
        <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                Пользователь <router-link v-if="notification.data.userId" :to="{name:'user.profile', params:{id: notification.data.userId}}" class="inner-link">{{ notification.data.userName }}</router-link> положительно оценил вашу
                тему
                <router-link v-if="notification.data.topicId" :to="{ name:'topic', params:{id: notification.data.topicId}}" class="inner-link">
                    {{ notification.data.topicTitle }}
                </router-link>
            </div>
        </div>
        <div v-if="close" class="d-flex fa-pull-right">
            <i class="fas fa-times" role="button"></i>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TopicLiked',
    props: ['notification', 'close'],
}
</script>

<style scoped>

</style>
