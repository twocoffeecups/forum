<template>

    <!-- Header -->
    <Header/>
    <!-- ./ Header -->

    <!-- Sidebar -->
    <Sidebar/>
    <!-- ./ Sidebar -->

    <RouterView/>

    <!-- Main -->
<!--    <PageContent/>-->
</template>

<script>
import Sidebar from "../components/admin/Sidebar.vue";
import Footer from "../components/admin/Footer.vue";
import Header from "../components/admin/Header.vue";

import PageContent from "../components/admin/PageContent.vue";

export default {
    name: "Admin",
    components: {PageContent, Header, Footer, Sidebar},

    mounted() {
        this.getUserInfo();
    },

    methods: {
        getUserInfo(){
            if(this.$store.getters['middleware/token']){
                this.$store.dispatch('profile/getUserDetails');
            }
        },
    },


}
</script>

<style src="../assets/admin.css">

</style>
