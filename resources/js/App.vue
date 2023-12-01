<template>

    <Component :is="$route.meta.layout || 'div'" />

</template>

<script>
export default {
    name: "App",
}
</script>

<style scoped>

</style>
