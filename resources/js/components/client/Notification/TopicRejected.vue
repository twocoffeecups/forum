<template>
    <div class="alert alert-light d-flex justify-content-between" role="alert">
        <div class="d-flex align-items-center">
            <div class="bi flex-shrink-0 me-2">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                <span>Публикация вашей темы <router-link :to="{name:'topic.unapproved', params:{id:notification.data.topic.id}}">{{ notification.data.topic.title }}</router-link> была отклонена модератором.</span>
                <span>Причина <b>{{ notification.data.topic.reason }}</b>.</span>
                <span v-if="showMessage" class="mt-2">
                    Сообщение:
                    <i>{{ notification.data.message }}.</i>
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
    name: 'TopicRejected',
    props: ['notification', 'close', 'showMessage'],
}
</script>

<style scoped>

</style>
