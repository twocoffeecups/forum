<template>

    <aside class="sidebar offcanvas offcanvas-start bg-dark bg-gradient" data-bs-scroll="true" data-bs-backdrop="false"
           tabindex="-1" id="sidebar" aria-labelledby="sidebar" style="width: 270px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" style="color: white; font-size: 1.8em;">Dashboard</h5>
        </div>


        <div class="offcanvas-body">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <!-- Dashboard main page -->
                <li class="nav-item w-100">
                    <router-link :to="{name:'admin.index'}" class="nav-link sidebar_nav_link align-middle px-0">
                        <i class="fas fa-home"></i> <span class="ms-1">Dashboard</span>
                    </router-link>
                </li>

                <!-- Statistics -->
                <!-- TODO: Сделать страницу -->
<!--                <li class="nav-item w-100">-->
<!--                    <a href="#" class="nav-link sidebar_nav_link align-middle px-0">-->
<!--                        <i class="fas fa-signal"></i> <span class="ms-1 d-sm-inline">Statistics</span>-->
<!--                    </a>-->
<!--                </li>-->

                <!-- Forum -->
                <li class="nav-item w-100">
                    <a class="nav-link sidebar_nav_link align-middle px-0" data-bs-toggle="collapse" href="#sub_menu1"
                       role="button" aria-expanded="false" aria-controls="sub_menu1">
                        <i class="fab fa-forumbee"></i> <span class="ms-1 d-sm-inline">Forum</span>
                        <span class="fa-pull-right sidebar_icon"><i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div class="collapse" id="sub_menu1">
                        <ul class="collapse ps-3 show nav flex-column ms-1">
                            <li class="w-100">
                                <router-link :to="{name:'admin.forum'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Forums
                                </router-link>
                            </li>
<!--                            <li class="w-100">-->
<!--                                <router-link :to="{name:'admin.forumsTree'}" class="nav-link sidebar_nav_link px-0"><i-->
<!--                                    class="fas fa-hashtag"></i> Forums tree-->
<!--                                </router-link>-->
<!--                            </li>-->
                            <li>
                                <router-link :to="{name:'admin.tag'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Tags
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'admin.topic'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Topics
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name:'admin.reject-type'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Topics reject type
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Role and Permission -->
                <li class="nav-item w-100">
                    <a class="nav-link sidebar_nav_link  align-middle px-0" data-bs-toggle="collapse" href="#sub_menu2"
                       role="button" aria-expanded="false" aria-controls="sub_menu2">
                        <i class="fab fa-forumbee"></i> <span class="ms-1 d-sm-inline">Roles & Permissions</span>
                        <span class="fa-pull-right sidebar_icon"><i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div class="collapse" id="sub_menu2">
                        <ul class="collapse ps-3 show nav flex-column ms-1">
                            <li class="w-100">
                                <router-link :to="{ name:'admin.role' }" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Roles
                                </router-link>
                            </li>
                            <li class="w-100">
                                <router-link :to="{ name: 'admin.permission' }" class="nav-link sidebar_nav_link px-0">
                                    <i class="fas fa-hashtag"></i> Permissions
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Users -->
                <li class="nav-item w-100">
                    <router-link :to="{ name:'admin.users' }" class="nav-link sidebar_nav_link align-middle px-0">
                        <i class="fas fa-users"></i> <span class="ms-1 d-sm-inline">Users</span>
                    </router-link>
                </li>

                <!-- Reports -->
                <li class="nav-item w-100">
                    <router-link :to="{ name:'admin.reports' }" class="nav-link sidebar_nav_link px-0 align-middle">
                        <i class="fas fa-flag"></i> <span class="ms-1 d-sm-inline">Reports </span>
                        <span class="small position-absolute badge bg-danger rounded-pill" style="font-size: 10px">
                           9+
                        </span>
                    </router-link>
                </li>

                <!-- Settings -->
                <!-- TODO: сделать страницу -->
<!--                <li class="nav-item w-100">-->
<!--                    <a href="#" class="nav-link sidebar_nav_link px-0 align-middle">-->
<!--                        <i class="fas fa-cog"></i> <span class="ms-1e d-sm-inline">Settings</span> </a>-->
<!--                </li>-->

            </ul>
        </div>
    </aside>

</template>

<script>
export default {
    name: "Sidebar"
}
</script>

<style scoped>
@import "../../assets/admin.css";
</style>
