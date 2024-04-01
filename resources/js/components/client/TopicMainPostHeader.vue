<template>
    <div class="container-fluid">
        <div class="card rounded-0" style="border-bottom: none;">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex">
                <h5 class="card-text">{{ topicTitle }}</h5> <small class="mx-2 p-1" style="font-size: 0.8em">{{ $t('component.topicHeader.byCategory') }} {{ categoryTitle }}</small>
                </div>
                <span class="card-text d-flex">{{ $t('component.topicHeader.created') }}: {{ createdAt }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default{
    name:'TopicMainPostHeader',
    props:['topicTitle', 'categoryTitle', 'createdAt'],

    computed: {
        ...mapGetters({
            mainPost: 'topic/getMainPost',
        }),
    },
}
</script>

<style scoped>

</style>
