<template>
    <nav class="nav nav-borders mx-auto py-2" style="background-color: white; max-width: 1250px; border-radius: 0.5rem">
        <router-link class="nav-link" :to="{name:'profile.detail'}">{{ $t('component.accountNavigation.profile') }}</router-link>
        <router-link class="nav-link" :to="{name:'profile.edit'}">{{ $t('component.accountNavigation.editProfile') }}</router-link>
        <router-link class="nav-link" :to="{name:'profile.notification'}">{{ $t('component.accountNavigation.notifications') }}</router-link>
    </nav>
</template>

<script>
export default{
  name:'ProfileNavigation',

}
</script>

<style scoped>

</style>