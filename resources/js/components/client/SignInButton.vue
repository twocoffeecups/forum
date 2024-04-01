<template>
    <div class="d-flex justify-content-center mt-5 mt-sm-5 mt-md-5 mt-lg-0 mt-xl-0 mx-auto">
        <router-link :to="{name:'auth.signIn'}" type="button" class="btn btn-primary bg-gradient rounded-3 p-1">
            {{ $t('component.profileDropdown.signIn') }}
        </router-link>
    </div>
</template>

<script>
export default {
    name: "SignInButton"
}
</script>

<style scoped>

</style>
