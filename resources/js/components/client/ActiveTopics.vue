<template>
    <div class="bg-white mx-4 mb-3">
        <h4 class="px-3 py-4 op-5 m-0">
            {{ $t('component.activeTopics') }}
        </h4>
        <hr class="m-0">
        <template v-for="topic in topics">
            <ActiveTopic :topic-id="topic.id" :title="topic.title" :author="topic.author" :created_at="topic.created_at" />
        </template>
    </div>
</template>

<script>
import ActiveTopic from './ActiveTopic.vue';
export default{
    name:'ActiveTopics',
    components:{ActiveTopic},

    mounted() {
        this.getActiveTopics();
    },

    data(){
        return{
            topics: {},
        }
    },

    methods: {
        getActiveTopics() {
            axios.get('/api/client/active-topics')
                .then(response => {
                    this.topics = response.data.topics;
                })
        }
    }
}
</script>

<style scoped>

</style>
