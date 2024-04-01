<template>
    <footer class="text-center text-lg-start bg-white text-muted">
        <div class="text-center p-4 bg-body-tertiary">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="#">{{ forumName }}</a>
        </div>
    </footer>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Footer",
    computed: {
        ...mapGetters({
            forumName: 'forumSettings/getForumName',
        }),
    }
}
</script>

<style scoped>
footer {
    /*flex: 0 0 auto;*/
    margin-top: auto;
}
</style>
