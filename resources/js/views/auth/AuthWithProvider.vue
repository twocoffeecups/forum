<template>
    <div class="my-5">
        <h3>Login with {{ this.$route.params.provider }}. Pleas wait...</h3>
    </div>
</template>

<script>
export default {
    name: "AuthWithProvider",

    created() {
        this.checkUserInState();

    },

    mounted() {
        this.authWithSocial();
    },

    methods: {

        checkUserInState(){
            this.$store.dispatch('auth/setLoggedInstate', this.user);
        },

        authWithSocial(){
            this.$store.dispatch('auth/authWithSocial', [this.$route.params.provider, this.$route.query.code]);
        },
    }
}
</script>

<style scoped>

</style>
