<template>
    <hr class="border border-secondary border-1 opacity-50 mt-2 mb-3 mx-3">
    <div class="mx-3 my-2 text-white d-flex justify-content-between align-content-center" style="font-size: 1.1em;">
        <div class="d-flex">
            <img
                :src="avatar"
                alt="mdo" width="36" height="36" class="rounded-circle" title="To profile">
            <span class="mx-1 p-1">{{ user.name }}</span>
        </div>

        <div class="d-flex align-content-center">
                <span @click.prevent="logout" class="p-1" title="Logout" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </span>
        </div>
    </div>
    <hr class="border border-secondary border-1 opacity-50 mt-3 mb-2 mx-3">
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: 'SidebarProfileItem',

    computed: {
        ...mapGetters({
            avatar: 'auth/avatar',
            user: 'auth/userDetails',
        }),
    },

    methods: {
        logout() {
            //this.$store.dispatch('auth/logout');
            this.$store.dispatch('dashboardProfile/logout');
        }
    },
}
</script>

<style scoped>

</style>
