<template>


    <div class="client-bg" :style="`background: url('${background.imageUrl}')`">
        <div v-if="checkHasPermissions([AccessPermissions.CAN_READ_DASHBOARD])" class="bg-danger bg-gradient d-flex justify-content-between" style="z-index: 100; width: 100%">
            <h5 class="mx-3 text-white my-2">You can login to the forum control panel.</h5>
            <a href="/admin" class="mx-3 my-1 text-white">Go to dashboard</a>
        </div>

        <Header/>

        <div class="page-body">
            <RouterView />
        </div>

        <Footer/>
    </div>

</template>

<script>
import Header from "../components/client/Header.vue";
import Footer from "../components/client/Footer.vue";
import {mapGetters} from "vuex";
import {checkHasPermissions} from "../access/service";
import AccessPermissions from "../access/permissions";
export default {
    name: "Client",
    components: {Footer, Header},

    setup() {
        return {
            checkHasPermissions,
            AccessPermissions,
        }
    },

    computed: {
        ...mapGetters({
            isLoggedIn: 'auth/isLoggedIn',
            background: 'forumSettings/getBackground',
        })
    }
}
</script>

<style scoped>
div {
    font-family: 'Roboto', sans-serif;
}

.page-body {
    padding-top: 50px;
}

.client-bg {
    display: flex;
    flex-direction: column;
}
</style>
