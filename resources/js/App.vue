<template>

    <Component :is="$route.meta.layout || 'div'" />

</template>

<script>

export default {
    name: "App",

    beforeCreate() {
        //this.getSettings();
    },

    created() {
        this.getSettings();
        this.checkUserInState();
        this.getUserInfo();
    },

    methods:{
        checkUserInState(){
            this.$store.dispatch('auth/setLoggedInstate');
        },

        getUserInfo(){
            if(this.$store.getters['middleware/token']){
                this.$store.dispatch('profile/getUserDetails');
            }
        },

        getSettings(){
            this.$store.dispatch('forumSettings/getSettings');
        },
    },
}
</script>

<style scoped>

</style>
