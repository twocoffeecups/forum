<template>
    <div class="">
        <h3 class="h3 mt-5 mb-3 fw-bold">404</h3>

        <div class="mb-2">
            <p>Error!. Page not found.</p>
        </div>

        <div class="mb-2">
            <router-link :to="{ name:'main.index' }">Back to site.</router-link>
        </div>
    </div>

</template>

<script>
export default {
    name: "404",
}
</script>

<style scoped>

</style>
