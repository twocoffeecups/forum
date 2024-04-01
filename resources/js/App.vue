<template>

    <Component :is="$route.meta.layout || 'div'" />

</template>

<script>

export default {
    name: "App",

    created() {
        this.getSettings();
        this.getUserInfo();
    },

    mounted() {
        this.$store.dispatch('report/getReportType');
        this.checkUserInState();
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
