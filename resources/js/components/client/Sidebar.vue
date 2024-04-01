<template>
    <div class="card rounded-0 mb-3">
        <div class="card-body">
            <div class="py-2 pe-3 mb-3"
                 style="top: 85px; background-color: white; border-radius: 1rem;  margin-top: 6px;">
                <div class="">
                    <!-- Create topic btn -->
                    <CreateTopic/>

                    <!-- Active topics -->
                    <ActiveTopics/>

                    <!-- Stats -->
                    <Stats/>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
import ActiveTopics from './ActiveTopics.vue';
import Stats from './Stats.vue';
import CreateTopic from "./CreateTopic.vue";

export default {
    name: "Sidebar",
    components: {CreateTopic, Stats, ActiveTopics}
}
</script>

<style scoped>

</style>
