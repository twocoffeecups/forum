<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="../../../../public/assets/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">FORUM</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../../../public/assets/adminlte/img/user.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Admin Adminovich</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <SidebarNavItem v-for="item in navItems" :label="item.label" :icon="item.icon" :path="item.path" :pages="item.pages" />

                    <li class="nav-item">
                        <router-link :to="{name:'report.index'}" class="nav-link">
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Reports
                                <span class="right badge badge-danger">5</span>
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fab fa-forumbee nav-icon"></i>
                            <p>
                                Forum
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul ref="utree" class="nav nav-treeview" style="display: none; height: 129.6px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-tag nav-icon"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-hashtag nav-icon"></i>
                                    <p>Tags</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Topics</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-comment nav-icon"></i>
                                    <p>Posts</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
import SidebarNavItem from "./SidebarNavItem.vue";
export default {
    name: "Sidebar",
    components: {SidebarNavItem},

    mounted(){
        $('[data-widget="treeview"]').Treeview('init');
    },

    data(){
        return{
            navItems:[
                {
                    label:'Dashboard',
                    path:'admin.index',
                    icon: 'fas fa-home'
                },
                {
                    label:'Users',
                    icon: 'fas fa-user',
                    pages:[
                        {
                            label: 'Roles',
                            path: 'user.role',
                            icon: 'fas fa-user-tag'
                        },
                        {
                            label: 'Users',
                            path:'user.users',
                            icon: 'fas fa-users'
                        },
                        {
                            label: 'Banned users',
                            path:'user.banned',
                            icon: 'fas fa-users-slash'
                        },
                    ],

                },
                // {
                //     label:'Reports',
                //     path:'report.index',
                //     icon: 'fas fa-file'
                // },
            ]
        }
    }
}
</script>

<style scoped>
.sidebar{
    height: 100%;
    overflow-y: visible;
}
</style>
