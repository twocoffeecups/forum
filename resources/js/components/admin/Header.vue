<template>
    <header class="p-3 mb-3 border-bottom bg-light bg-gradient">
        <div class="container-fluid">
            <div class="header d-flex flex-wrap align-items-center justify-content-between">

                <div class="nav-item d-sm-none d-md-block">
                    <a href="#" class="nav-link px-2 link-body-emphasis" data-bs-toggle="offcanvas"
                       data-bs-target="#sidebar" aria-controls="sidebar">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>

                <ul class="nav me-lg-auto mb-2 justify-content-sm-start justify-content-md-start mb-md-0">
                    <li class="nav-item">
                        <router-link :to="{name:'forum.main'}" href="#" class="nav-link px-2 link-body-emphasis">
                            Go to Forum
                        </router-link>
<!--                        <a href="/" class="nav-link px-2 link-body-emphasis">-->
<!--                            Go to Forum-->
<!--                        </a>-->
                    </li>
                </ul>


                <!-- TODO: сделать показ уведомлений и поиск -->
                <div class="d-flex flex-row">
<!--                    <div class="nav-item mx-2">-->
<!--                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">-->
<!--                            <i class="far fa-comments" style="font-size: 1.3em"></i>-->
<!--                        </a>-->
<!--                    </div>-->

                    <div class="nav-item mx-2">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="far fa-bell" style="font-size: 1.3em"></i>
                        </a>
                    </div>

                    <div class="nav-item mx-2">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-search" style="font-size: 1.3em"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
}
</script>

<style scoped>
@import "../../assets/admin.css";
</style>
