<template>
    <main class="mt-3 pe-3" style="height: 100%; overflow-y: visible">
        <div class="container-fluid m-0" style="height: 100%">

            <!-- Main header -->
            <MainHeader />
            <!-- ./ Main header -->

            <!-- Content -->
            <div class="container-fluid">

                <RouterView />

            </div>

            <!-- ./ Content -->

        </div>
    </main>
</template>

<script>
import MainHeader from "../../components/admin/MainHeader.vue";

export default {
    name: 'Dashboard',
    components: {MainHeader}

}
</script>

<style scoped>
@import "../../assets/admin.css";
</style>
