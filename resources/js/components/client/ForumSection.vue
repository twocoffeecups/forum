<template>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-2 mb-2">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ forumCategory.name }}</h3>
                            <!-- <span class="d-flex align-items-center">{{ $t('view.main.totalPosts') }}: 320,800</span>-->
                        </div>

                        <template v-if="forumCategory.children.length !==0">
                            <!-- <ForumItem :forum="childForum"/> -->
                            <ParentForumItem v-for="childForum in forumCategory.children" :forum="childForum"/>
                        </template>

                        <div v-if="forumCategory.children.length ===0" class="m-2 p-1 text-center">
                            <h4>There are no forums in this category.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
import ForumItem from "./ForumItem.vue";
import ParentForumItem from "./ParentForumItem.vue";

export default {
    name: "ForumSection",
    components: {ParentForumItem, ForumItem},
    props: ['forumCategory'],


}
</script>

<style scoped>

</style>
