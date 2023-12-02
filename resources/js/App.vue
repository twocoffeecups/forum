<template>

    <Component :is="$route.meta.layout || 'div'" />

</template>

<script>
export default {
    name: "App",

    created() {
        this.checkUserInState();
    },

    methods:{
        checkUserInState(){
            this.$store.dispatch('setLoggedInstate');
        },
    },
}
</script>

<style scoped>

</style>
