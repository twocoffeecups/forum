<template>
    <!-- Like topic -->
    <button v-if="type==='topic'" @click.prevent="likeTopic()"
            class="btn btn-xs text-muted has-icon"><i :class="checkIsLikedTopic"></i>
        {{ rating }}
    </button>
    <!-- Like post -->
    <button v-if="type==='post'" @click.prevent="likePost()"
            class="btn btn-xs text-muted has-icon"><i :class="checkIsLikedPost"></i>
        {{ rating }}
    </button>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "LikeButton",
    props: ['id', 'type', 'authorId', 'rating'],

    computed: {
        ...mapGetters({
            isLoggedIn: 'auth/isLoggedIn',
            userId: 'auth/getUserId',
            userTopicsLikes: 'profile/getLikedTopics',
            userPostsLikes: 'profile/getLikes',
        }),
        checkIsLikedTopic() {
            return this.isLoggedIn && this.userTopicsLikes.some(e => e.id == this.id) ? 'fas fa-heart text-danger' : 'far fa-heart';
        },

        checkIsLikedPost() {
            return this.isLoggedIn && this.userPostsLikes.some(e => e.id == this.id) ? 'fas fa-heart text-danger' : 'far fa-heart';
        }
    },

    methods: {
        likeTopic() {
            if (this.userId === this.authorId || !this.isLoggedIn) return;
            this.$store.dispatch('topic/likeTopic', this.id);
        },

        likePost() {
            if (this.userId === this.authorId || !this.isLoggedIn) return;
            this.$store.dispatch('likePost', this.id);
        },
    }
}
</script>

<style scoped>

</style>
