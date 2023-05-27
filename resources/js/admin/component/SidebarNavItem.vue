<template>
    <li class="nav-item">
        <router-link :to="{name:this.path}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>{{ label }}</p>
        </router-link>
    </li>
</template>

<script>
export default {
    name: "SidebarNavItem",

    props:['label','path'],
}
</script>

<style scoped>

</style>
