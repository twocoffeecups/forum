<template>

    <Component :is="$route.meta.layout || 'div'" />

</template>

<script>

export default {
    name: "App",

    created() {
        this.checkUserInState();
        this.getUserInfo()
    },

    methods:{
        checkUserInState(){
            this.$store.dispatch('auth/setLoggedInstate');
        },

        getUserInfo(){
            this.$store.dispatch('profile/getUserDetails');
        },
    },
}
</script>

<style scoped>

</style>
