<template>
    <div>
        <Header />

        <router-view />
    </div>
</template>

<script>
import Header from "./component/Header.vue";
export default {
    name: "App",
    components: {Header}
}
</script>

<style scoped>

</style>
