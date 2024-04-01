<template>
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-lg-9 mb-3">

                <!-- Forum list  -->
                <template v-for="forumCategory in forumCategories">
                    <ForumSection :forum-category="forumCategory"/>
                </template>

            </div>

            <!-- Sidebar content -->
            <div class="col-lg-3 ml-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                <Sidebar/>
            </div>


        </div>
    </div>
</template>

<script>
import FilterTopics from '../../components/client/FilterTopics.vue';
import Sidebar from '../../components/client/Sidebar.vue';
import Topic from '../../components/client/Topic.vue';
import Pagination from "../../components/client/Pagination.vue";
import ForumItem from "../../components/client/ForumItem.vue";
import ForumSection from "../../components/client/ForumSection.vue";
import { mapGetters } from "vuex";

export default {
    name: "Main",
    components: {ForumSection, Pagination, Sidebar, Topic, FilterTopics, ForumItem},

    computed: {
        ...mapGetters({
            forumCategories: 'forumCategory/getForumCategories',
        })
    },

    mounted() {
        this.$store.dispatch('forumCategory/getForumCategories');
    },
}
</script>

<style scoped>

</style>
