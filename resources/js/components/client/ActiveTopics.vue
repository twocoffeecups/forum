<template>
    <div class="bg-white mx-4 mb-3">
        <h4 class="px-3 py-4 op-5 m-0">
            {{ $t('component.activeTopics') }}
        </h4>
        <hr class="m-0">
        <template v-for="topic in activeTopics">
            <ActiveTopic />
        </template>
    </div>
</template>

<script>
import ActiveTopic from './ActiveTopic.vue';
export default{
    name:'ActiveTopics',
    components:{ActiveTopic},

    data(){
        return{
            activeTopics: 4,
        }
    },
}
</script>

<style scoped>

</style>