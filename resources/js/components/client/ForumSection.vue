<template>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ forumCategory.name }}</h3>
<!--                             <span class="d-flex align-items-center">{{ $t('view.main.totalPosts') }}: 320,800</span>-->
                        </div>

                        <template v-if="forumCategory.children.length !==0">
                            <ForumItem v-for="childForum in forumCategory.children" :forum="childForum"/>
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
export default {
    name: "ForumSection",
    components: {ForumItem},
    props: ['forumCategory'],
}
</script>

<style scoped>
.card-header{
    background-color: white;
}
</style>
