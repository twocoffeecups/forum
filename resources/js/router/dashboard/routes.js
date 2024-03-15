// admin dashboard routes
const routes = [
    {
        path: '/admin',
        component: () => import('../../views/admin/Dashboard.vue'),
        children: [
            {path: '', name: 'dashboard.index', component: () => import('../../views/admin/Main.vue')},
            {
                path: 'users',
                name: 'admin.users',
                component: () => import('../../views/admin/Users.vue'),
            },
            {
                path: 'notifications',
                name: 'admin.notifications',
                component: () => import('../../views/admin/Notifications.vue'),
            },
            {
                path: 'users/:id',
                name: 'admin.user.details',
                component: () => import('../../views/admin/UserDetails.vue'),
            },
            {
                path: 'role',
                name: 'admin.role',
                component: () => import('../../views/admin/Role.vue'),
            },
            {
                path: 'role/:id',
                name: 'admin.role.details',
                component: () => import('../../views/admin/RoleDetails.vue'),
            },
            {
                path: 'permission',
                name: 'admin.permission',
                component: () => import('../../views/admin/Permission.vue'),
            },
            {
                path: 'forum',
                name: 'admin.forum',
                component: () => import('../../views/admin/Forum.vue'),
            },
            {
                path: 'forum/:id',
                name: 'admin.forum.details',
                component: () => import('../../views/admin/ForumDetails.vue'),
            },
            {
                path: 'tag',
                name: 'admin.tag',
                component: () => import('../../views/admin/Tag.vue'),
            },
            {
                path: 'topic',
                name: 'admin.topic',
                component: () => import('../../views/admin/Topic.vue'),
            },
            {
                path: 'topic/create',
                name: 'admin.topic.create',
                component: () => import('../../views/admin/CreateTopic.vue'),
            },
            {
                path: 'topic/:id',
                name: 'admin.topic.details',
                component: () => import('../../views/admin/TopicDetails.vue'),
            },
            {
                path: 'rejected-topic',
                name: 'admin.topic.rejected',
                component: () => import('../../views/admin/RejectedTopic.vue'),
            },
            {
                path: 'reject-type',
                name: 'admin.reject-type',
                component: () => import('../../views/admin/TopicRejectType.vue'),
            },
            {
                path: 'reports',
                name: 'admin.reports',
                component: () => import('../../views/admin/Report.vue'),
            },
            {
                path: 'reports/:id',
                name: 'admin.report.details',
                component: () => import('../../views/admin/ReportDetails.vue'),
            },
            {
                path: 'report-reason',
                name: 'admin.reports.reason',
                component: () => import('../../views/admin/ReportReasonTypes.vue'),
            },
            {
                path: 'settings',
                name: 'dashboard.settings',
                component: () => import('../../views/admin/Settings.vue'),
            },
        ],
    },
    {
        path: "/",
        name: "forum.main",
        beforeEnter: () => {
            window.location.href = import.meta.env.FRONT_URL;
        }
    }
];

export default routes;
