<template>
    <!-- Topic bookmarks -->
    <template v-if="type==='topic'">
        <span v-if="userId!==authorId && isLoggedIn"
              @click.prevent="addTopicToBookmarks" role="button" class="mx-1 p-2">
            <i :class="checkIfHasBeenAddedTopicToBookmarks" style="cursor: pointer">
            </i>
        </span>
    </template>

    <!-- Post bookmarks -->
    <template v-if="type==='post'">
        <span v-if="userId!==authorId && isLoggedIn"
              @click.prevent="addPostToBookmarks" class="mx-1 p-2">
            <i :class="checkIfHasBeenAddedPostToBookmarks" style="cursor: pointer"></i>
        </span>
    </template >

</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "BookmarksButton",
    props: ['id', 'authorId', 'type'],

    computed: {
        ...mapGetters({
            isLoggedIn: "auth/isLoggedIn",
            userId: 'auth/getUserId',
            userTopicBookmarks: 'profile/getTopicBookmarks',
            userPostBookmarks: 'profile/getPostBookmarks',
        }),

        checkIfHasBeenAddedTopicToBookmarks(){
            return this.isLoggedIn && this.userTopicBookmarks.some(e => e.id == this.id) ? 'fas fa-bookmark' : 'far fa-bookmark';
        },

        checkIfHasBeenAddedPostToBookmarks(){
            return this.isLoggedIn && this.userPostBookmarks.some(e => e.id == this.id) ? 'fas fa-bookmark' : 'far fa-bookmark';
        }
    },

    methods: {
        addTopicToBookmarks() {
            this.$store.dispatch('topic/addToBookmarks', this.id);
        },

        addPostToBookmarks() {
            this.$store.dispatch('addPostToBookmarks', this.id);
        },
    },
}
</script>

<style scoped>

</style>
