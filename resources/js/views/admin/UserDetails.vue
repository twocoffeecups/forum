<template>
    <div class="row">
        <!-- User info -->
        <div class="col-md-3">
            <div class="card mb-2" style="border-top: 5px solid #0c63e4">
                <div class="card-body">
                    <div class="text-center">
                        <img :src="user.avatar" class="rounded-circle mb-2" alt="avatar" width="125">
                    </div>
                    <div class="text-center mb-4">
                        <h3>{{ user.name }}</h3>
                        <hr />
                    </div>
                    <div class="user-info">
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Login</b>
                            </div>
                            <div class="col">
                                {{ user.login }}
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Email</b>
                            </div>
                            <div class="col">
                                {{ user.email }}
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Role</b>
                            </div>
                            <div class="col">
                                <span class="badge bg-primary">{{ user.role }}</span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Registered</b>
                            </div>
                            <div class="col">
                                {{ user.register_at }}
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Email verified</b>
                            </div>
                            <div class="col">
                                {{ user.email_verified_at }}
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Last visits</b>
                            </div>
                            <div class="col">
                                {{ user.lastVisit }}
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col">
                                <b>Status</b>
                            </div>
                            <div class="col">
                                <span v-if="user.status" class="badge bg-success">Online</span>
                                <span v-if="!user.status" class="badge bg-danger">Offline</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div v-if="stats" class="card-body">
                    <div class="text-center">
                        <h4>Stats:</h4>
                    </div>
                    <hr />
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <b>Carma</b>
                        </div>
                        <div class="col">
                            {{ stats.carma ?? 0 }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <b>Total topics</b>
                        </div>
                        <div class="col">
                            {{ stats.topics ?? 0 }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <b>Total posts</b>
                        </div>
                        <div class="col">
                            {{ stats.posts ?? 0 }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <b>Is warning</b>
                        </div>
                        <div class="col">
                            {{ user.isWarning ? 'The user has already received a warning for violation.' : 'No' }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <b>Ban count</b>
                        </div>
                        <div class="col">
                            {{ user.banCount ?? 0 }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col">
                            <b>In Ban list</b>
                        </div>
                        <div class="col">
                            {{ user.inBanList ? `Yes. End date of the ban: ${user.endBan}` : 'No' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topics, Posts, Reports -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-topics-tab" data-bs-toggle="pill" data-bs-target="#pills-topics" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Topics</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-posts-tab" data-bs-toggle="pill" data-bs-target="#pills-posts" type="button" role="tab" aria-controls="pills-posts" aria-selected="false">Posts</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-reports-tab" data-bs-toggle="pill" data-bs-target="#pills-reports" type="button" role="tab" aria-controls="pills-reports" aria-selected="false">Reports</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-edit-tab" data-bs-toggle="pill" data-bs-target="#pills-edit" type="button" role="tab" aria-controls="pills-edit" aria-selected="false">Edit profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-access-tab" data-bs-toggle="pill" data-bs-target="#pills-access" type="button" role="tab" aria-controls="pills-access" aria-selected="false">Access Permissions</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Topics -->
                        <div class="tab-pane fade show active" id="pills-topics" role="tabpanel" aria-labelledby="pills-topics-tab" tabindex="0">
                            <TopicComponent v-if="userTopics" v-for="topic in userTopics" :topic="topic" :user="user"/>
                        </div>
                        <!-- Posts -->
                        <div class="tab-pane fade" id="pills-posts" role="tabpanel" aria-labelledby="pills-posts-tab" tabindex="0">
                            <PostComponent v-if="userPosts" v-for="post in userPosts" :post="post" />
                            <div v-if="!userPosts" class="my-3 mx-2 p-1">
                                <h4>The user dont write a post.</h4>
                            </div>
                        </div>
                        <!-- Reports -->
                        <div v-if="reports" class="tab-pane fade" id="pills-reports" role="tabpanel" aria-labelledby="pills-reports-tab" tabindex="0">
                            <table v-if="reports.length!=0" class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Report details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="report in reports">
                                    <th scope="row"></th>
                                    <td>{{ report.reason }}</td>
                                    <td>{{ report.message }}</td>
                                    <td>
                                        <span v-if="!report.status" class="badge bg-danger">New</span>
                                        <span v-if="report.status" class="badge bg-success">Closed</span>
                                    </td>
                                    <td>
                                        {{ report.created_at }}
                                    </td>
                                    <td>
                                        <router-link :to="{ name:'admin.report.details', params:{id:report.id}}" class="btn btn-sm btn-primary">
                                            Show
                                        </router-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div v-if="reports.length==0" class="my-4 text-center mx-2 p-1">
                                <h4>The user dont create any reports.</h4>
                            </div>
                        </div>
                        <!-- Edit profile -->
                        <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab" tabindex="0">
                            <div class="mb-3">
                                <div v-if="user" :class="{ error: v$.name.$errors.length }">
                                    <label for="firstName" class="col-form-label">User name:</label>
                                    <div class="row">
                                        <div class="">
                                            <input @blur="v$.name.$touch" type="text" v-model="user.name"
                                                   class="form-control" id="firstName">
                                            <div class="input-errors" v-for="error of v$.name.$errors"
                                                 :key="error.$uid">
                                                <div class="error-msg text-danger">{{ error.$message }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span @click.prevent="updateProfile" role="button" class="text-primary mx-auto my-auto p-3 fs-4" title="Save">
                                                <i class="fas fa-save"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="mb-3">-->
<!--                                <div v-if="user" :class="{ error: v$.lastName.$errors.length }">-->
<!--                                    <label for="lastName" class="col-form-label">Last name:</label>-->
<!--                                    <div class="d-flex">-->
<!--                                        -->
<!--                                        <span role="button" class="text-primary my-1 mx-3 fs-4" title="Save">-->
<!--                                            <i class="fas fa-save"></i>-->
<!--                                        </span>-->
<!--                                    </div>-->

<!--                                </div>-->
<!--                            </div>-->

                            <div class="mb-3">
                                <div v-if="user">
                                    <label for="avatar" class="col-form-label">Avatar:</label>
                                    <div class="d-flex">
                                        <input @change="changeAvatar($event)" type="file" class="form-control" id="avatar">
                                        <span @click.prevent="updateAvatar" role="button" class="text-primary my-1 mx-3 fs-4" title="Save">
                                            <i class="fas fa-save"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Access -->
                        <div class="tab-pane fade" id="pills-access" role="tabpanel" aria-labelledby="pills-access-tab" tabindex="0">
                            <div class="">
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Change role:</label>
                                    <div class="col-sm-9 mb-3">
                                        <select v-if="roles" @change="selectedRole = $event.target.value" class="form-select">
                                            <option v-for="role in roles" :value="role.id" :selected="role.id==user.roleId">{{
                                                    role.name
                                                }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <span @click="changeRole" role="button" class="text-primary mx-2 fs-4" title="Save">
                                            <i class="fas fa-save"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">
                                        Change permissions:
                                        <!--                        <div class="alert alert-warning d-flex align-items-center" role="alert">-->
                                        <!--                            <i class="fa fa-exclamation-triangle"></i>-->
                                        <!--                            <div>-->
                                        <!--                                Warning!-->
                                        <!--                            </div>-->
                                        <!--                        </div>-->
                                        <!--                        <span class="font-italic">Warning!</span>-->
                                    </label>

                                    <div class="col-sm-9 mb-3">
                                        <VueMultiselect
                                            id="permissions"
                                            v-if="permissions"
                                            v-model="selectedPermissions"
                                            :options="permissions"
                                            :multiple="true"
                                            :close-on-select="false"
                                            placeholder="Add user permissions"
                                            label="option"
                                            track-by="option"
                                        />
                                    </div>
                                    <div class="col-sm-1">
                                        <span @click="changePermissions" role="button" class="text-primary mx-2 fs-4" title="Save">
                                            <i class="fas fa-save"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import api from "../../api/api";
import VueMultiselect from "vue-multiselect";
import {mapGetters} from "vuex";
import PostComponent from "../../components/admin/PostComponent.vue";
import TopicComponent from "../../components/admin/TopicComponent.vue";
import {useVuelidate} from "@vuelidate/core";
import {email, maxLength, minLength, required} from "@vuelidate/validators";

export default {
    name: "ForumDetails",
    components: {TopicComponent, PostComponent, VueMultiselect,},

    setup() {
        return {
            v$: useVuelidate(),
        }
    },

    computed: {
        ...mapGetters({
            user: 'adminUsers/getUser',
            userTopics: 'adminUsers/getUserTopics',
            userPosts: 'adminUsers/getUserPosts',
            reports: 'adminUsers/getUserReports',
            stats: 'adminUsers/getUserStats',
            userPermissions: 'adminUsers/getUserPermissions',
            roles: 'adminUsers/getRoles',
        }),
    },

    mounted() {
        this.getUser();
        this.getRoles();
        this.getPermissions();
    },

    data() {
        return {
            permissions: [],
            selectedPermissions: [],
            selectedRole: null,
            newAvatar: null,
        }
    },

    watch: {
        userPermissions(val){
            this.selectedPermissions = val;
        }
    },

    validations() {
        return {
            name: {minLength:minLength(5), maxLength:maxLength(64)},
        }
    },

    methods: {
        getUser() {
            this.$store.dispatch('adminUsers/getUser', this.$route.params.id);
        },

        getRoles() {
            this.$store.dispatch('adminUsers/getRoles');
        },

        getPermissions() {
            return new Promise((resolve, reject) => {
                api.get('/api/admin/permission/permission-for-form')
                    .then(response => {
                        if(response.data){
                            this.permissions = response.data.permissions;
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },

        updateProfile(){
            const data = new FormData();
            data.append('name', this.user.name);
            data.append('_method', 'put');
            this.$store.dispatch('adminUsers/updateProfile', [this.$route.params.id, data]);
        },

        changeAvatar(event){
            this.newAvatar = event.target.files[0];
        },

        updateAvatar() {
            const data = new FormData();
            data.append('avatar', this.newAvatar);
            data.append('_method', 'patch');
            this.$store.dispatch('adminUsers/changeAvatar', [this.$route.params.id, data])
        },

        changeRole() {
            if(this.selectedRole){
                this.$store.dispatch('adminUsers/changeRole', [this.$route.params.id, this.selectedRole]);
            }
        },

        changePermissions() {
            let data = new FormData();
            const permissions = this.selectedPermissions;
            permissions.forEach(permission => {
                data.append("permissions[]", permission.value);
            })
            data.append('_method', 'put')
            this.$store.dispatch('adminUsers/changePermissions', [this.$route.params.id, data]);
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
