<template>
    <div class="client-bg" :style="`background: url('${background.imageUrl}')`">
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

export default {
    name: "Client",
    components: {Footer, Header},

    computed: {
        ...mapGetters({
            background: 'forumSettings/getBackground',
        })
    }
}
</script>

<style scoped>
.page-body {
    padding-top: 50px;
}

.client-bg {
    display: flex;
    flex-direction: column;
}
</style>
