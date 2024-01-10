<template>
    <div class="row">
        <div class="card my-3">
            <div class="card-header">
                <h4>User profile</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <dl class="row">
                            <dt class="col-sm-4">Name</dt>
                            <dd class="col-sm-8">{{ user.name }}</dd>
                            <dt class="col-sm-4">Login</dt>
                            <dd class="col-sm-8">{{ user.login }}</dd>
                            <dt class="col-sm-4">Email</dt>
                            <dd class="col-sm-8">{{ user.email }}</dd>
                            <dt class="col-sm-4">Role</dt>
                            <dd class="col-sm-8">{{ user.role }}</dd>
                            <dt class="col-sm-4">Register AT</dt>
                            <dd class="col-sm-8">{{ user.register_at }}</dd>
                            <dt class="col-sm-4">Email verified</dt>
                            <dd class="col-sm-8">{{ user.email_verified_at }}</dd>
                        </dl>
                    </div>
                    <div class="col-6">
                        <dl class="row">
                            <dt class="col-sm-4">Carma</dt>
                            <dd class="col-sm-8">{{ stats.carma ?? 0 }}</dd>
                            <dt class="col-sm-4">Total topics</dt>
                            <dd class="col-sm-8">{{ stats.topics ?? 0 }}</dd>
                            <dt class="col-sm-4">Total posts</dt>
                            <dd class="col-sm-8">{{ stats.posts ?? 0 }}</dd>
                            <dt class="col-sm-4">Is warning</dt>
                            <dd class="col-sm-8">
                                {{ user.isWarning ? 'The user has already received a warning for violation.' : 'No' }}
                            </dd>
                            <dt class="col-sm-4">Bane count</dt>
                            <dd class="col-sm-8">{{ user.banCount ?? 0 }}</dd>
                            <dt class="col-sm-4">In Ban list</dt>
                            <dd class="col-sm-8">
                                {{ user.inBanList ? `Yes. End date of the ban: ${user.endBan}` : 'No' }}
                            </dd>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="card my-3">
            <div class="card-header">
                <h4>Actions</h4>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Change role:</label>
                    <div class="col-sm-9 mb-3">
                        <select @change="selectedRole = $event.target.value" class="form-select">
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
                        <span class="font-italic">Warning!</span>
                    </label>

                    <div class="col-sm-9 mb-3">
                        <VueMultiselect
                            id="permissions"
                            v-model="userPermissions"
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

    <div class="row" v-if="userTopics.length !==0">
        <div class="card my-3">
            <div class="card-header">
                <h4>User topics</h4>
            </div>
            <div class="card-body">
                <!-- Table -->
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Forum</th>
                        <th scope="col">Title</th>
                        <th scope="col">Posts</th>
                        <th scope="col">Created AT</th>
<!--                        <th scope="col">Allow | Disallow Publication</th>-->
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="topic in userTopics">
                        <th scope="row">{{ topic.id }}</th>
                        <td>{{ topic.forum }}</td>
                        <td>{{ topic.title }}</td>
                        <td>{{ topic.posts }}</td>
                        <td>{{ topic.created_at }}</td>
<!--                        <th>-->
<!--                            <div v-if="!topic.status" class="btn-group  btn-group-sm" role="group"-->
<!--                                 aria-label="Basic radio toggle button group">-->
<!--                                <input type="radio" class="btn-check" :name="topic.id+'isPublished'"-->
<!--                                       :id="topic.id+'hide'" value="false" autocomplete="off"-->
<!--                                       :checked="topic.status !== true">-->
<!--                                <label class="btn btn-outline-danger" :for="topic.id+'hide'">Reject Publication</label>-->

<!--                                <input type="radio" class="btn-check" :name="topic.id+'isPublished'"-->
<!--                                       :id="topic.id+'published'" value="true" autocomplete="off"-->
<!--                                       :checked="topic.status === true">-->
<!--                                <label class="btn btn-outline-success" :for="topic.id+'published'">Allow-->
<!--                                    Publication</label>-->
<!--                            </div>-->
<!--                            <span v-if="topic.status">Published</span>-->

<!--                        </th>-->
                        <td>
                            <span role="button" class="text-primary mx-2" title="Show">
                                <i class="far fa-eye"></i>
                            </span>
                            <span role="button" class="text-danger mx-2" title="Delete">
                                <i class="fas fa-trash"></i>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import {useToast} from "vue-toastification";
import api from "../../api/api";
import VueMultiselect from "vue-multiselect";

export default {
    name: "ForumDetails",
    components: {VueMultiselect,},

    setup() {
        return {
            t$: useToast(),
        }
    },

    mounted() {
        this.getUser();
        this.getRoles();
        this.getPermissions();
    },

    data() {
        return {
            user: [],
            userPermissions: [],
            userTopics: [],
            stats: [],
            roles: [],
            permissions: [],
            selectedRole: null,
        }
    },

    methods: {
        getUser() {
            api.get(`/api/admin/user/${this.$route.params.id}`)
                .then(res => {
                    this.user = res.data.user;
                    this.stats = res.data.user.stats;
                    this.userTopics = res.data.user.topics
                    this.userPermissions = res.data.user.permissions;
                })
        },

        getRoles() {
            api.get('/api/admin/role')
                .then(res => {
                    this.roles = res.data.roles;
                })
        },

        getPermissions() {
            api.get('/api/admin/permission/permission-for-form')
                .then(res => {
                    this.permissions = res.data.permissions;
                })
                .catch(error => {
                    console.log(error)
                })
        },

        changeRole() {
            if(this.selectedRole){
                api.patch(`/api/admin/user/${this.user.id}/${this.selectedRole}/change-role`, {
                    roleId: this.selectedRole,
                })
                    .then(res => {
                        console.log(res)
                        this.t$.success(res.data.message);
                    })
                    .catch(error => {
                        console.log(error);
                        this.t$.error(error.response.data.message ?? "Error!");
                    })
            }
        },

        changePermissions() {
            let data = new FormData();
            const permissions = this.userPermissions;
            permissions.forEach(permission => {
                data.append("permissions[]", permission.value);
            })
            data.append('_method', 'put')
            api.post(`/api/admin/user/${this.user.id}/change-permissions`, data)
                .then(res => {
                    this.t$.success(res.data.message);
                })
                .catch(error => {
                    this.t$.error(error.response.data.message ?? "Error!");
                })
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
