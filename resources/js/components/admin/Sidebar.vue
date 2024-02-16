<template>

    <aside class="sidebar offcanvas offcanvas-start bg-dark" data-bs-scroll="true" data-bs-backdrop="true"
           tabindex="-1" id="sidebar" aria-labelledby="sidebar" style="width: 270px">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" style="color: white; font-size: 1.8em;">Dashboard</h5>
        </div>

        <SidebarProfileItem />

        <div class="offcanvas-body">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                <h5 class="text-muted mt-3 mb-2">Core</h5>
                <!-- Dashboard main page -->
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{name:'dashboard.index'}" class="nav-link sidebar_nav_link align-middle px-0">
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
                <h5 class="text-muted mt-3 mb-2">Forum</h5>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{name:'admin.forum'}" class="nav-link sidebar_nav_link px-0"><i
                        class="fas fa-hashtag"></i> Forums
                    </router-link>
                </li>
                <li class="nav-item w-100">
                    <a class="nav-link sidebar_nav_link align-middle px-0" data-bs-toggle="collapse" href="#topic-sub-menu"
                       role="button" aria-expanded="false" aria-controls="sub_menu1">
                        <i class="fab fa-forumbee"></i> <span class="ms-1 d-sm-inline">Topics</span>
                        <span class="fa-pull-right sidebar_icon"><i class="fas fa-chevron-down"></i></span>
                    </a>
                    <div class="collapse" id="topic-sub-menu">
                        <ul class="collapse ps-3 show nav flex-column ms-1">
                            <li data-bs-dismiss="offcanvas">
                                <router-link :to="{name:'admin.topic'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Topics
                                </router-link>
                            </li>
                            <li data-bs-dismiss="offcanvas">
                                <router-link :to="{name:'admin.topic.rejected'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Rejected topics
                                </router-link>
                            </li>
                            <li data-bs-dismiss="offcanvas">
                                <router-link :to="{name:'admin.reject-type'}" class="nav-link sidebar_nav_link px-0"><i
                                    class="fas fa-hashtag"></i> Topics reject type
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{name:'admin.tag'}" class="nav-link sidebar_nav_link px-0"><i
                        class="fas fa-hashtag"></i> Tags
                    </router-link>
                </li>


                <!-- Role and Permission -->
                <h5 class="text-muted mt-3 mb-2">Roles and Permissions</h5>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{ name:'admin.role' }" class="nav-link sidebar_nav_link px-0"><i
                        class="fas fa-hashtag"></i> Roles
                    </router-link>
                </li>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{ name: 'admin.permission' }" class="nav-link sidebar_nav_link px-0">
                        <i class="fas fa-hashtag"></i> Permissions
                    </router-link>
                </li>

                <!-- Users -->
                <h5 class="text-muted mt-3 mb-2">Users</h5>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{ name:'admin.users' }" class="nav-link sidebar_nav_link align-middle px-0">
                        <i class="fas fa-users"></i> <span class="ms-1 d-sm-inline">Users</span>
                    </router-link>
                </li>

                <!-- Reports -->
                <h5 class="text-muted mt-3 mb-2">Reports</h5>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{ name:'admin.reports.reason' }" class="nav-link sidebar_nav_link px-0 align-middle">
                        <i class="fas fa-flag"></i> <span class="ms-1 d-sm-inline">Report types</span>
                    </router-link>
                </li>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{ name:'admin.reports' }" class="nav-link sidebar_nav_link px-0 align-middle">
                        <i class="fas fa-flag"></i> <span class="ms-1 d-sm-inline">All Reports</span>
                        <span class="small position-absolute badge bg-danger rounded-pill" style="font-size: 10px">
                                       9+
                                    </span>
                    </router-link>
                </li>

                <!-- Settings -->
                <h5 class="text-muted mt-3 mb-2">Settings</h5>
                <li class="nav-item w-100" data-bs-dismiss="offcanvas">
                    <router-link :to="{name: 'dashboard.settings'}" class="nav-link sidebar_nav_link px-0 align-middle">
                        <i class="fas fa-cog"></i> <span class="ms-1e d-sm-inline">Settings</span>
                    </router-link>
                </li>

            </ul>
        </div>
    </aside>

</template>

<script>
import SidebarProfileItem from "./SidebarProfileItem.vue";

export default {
    name: "Sidebar",
    components: {SidebarProfileItem}
}
</script>

<style scoped>
@import "../../assets/admin.css";
</style>
