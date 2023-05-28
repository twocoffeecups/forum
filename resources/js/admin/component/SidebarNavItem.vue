<template>
    <li class="nav-item">
        <router-link :to="{name:this.path}" class="nav-link">
            <i :class="`${icon} nav-icon`"></i>
            <p>
                {{ label }}
                <i v-if="pages" class="right fas fa-angle-left"></i>
            </p>
        </router-link>
        <ul v-if="pages" class="nav nav-treeview" style="display: none;">
            <li v-for="page in pages" class="nav-item">
                <router-link :to="{name:page.path}" class="nav-link">
                    <i :class="`${page.icon} nav-icon`"></i>
                    <p>{{ page.label }}</p>
                </router-link>
            </li>
        </ul>
    </li>
</template>

<script>
export default {
    name: "SidebarNavItem",

    props:['label','path', 'pages', 'icon'],
}
</script>

<style scoped>

</style>
