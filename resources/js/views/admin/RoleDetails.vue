<template>
    <div class="row">
        <div class="card my-3">
            <div class="card-header">
                <h4>Role details</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Name</dt>
                    <dd contenteditable @focusout.prevent="renameRole($event, role.name)" class="col-sm-8">
                        {{ role.name }}
                    </dd>
                    <dt class="col-sm-4">Permissions</dt>
                    <dd class="col-sm-8">
                        <VueMultiselect
                            v-if="permissions"
                            id="permissions"
                            v-model="selectedPermissions"
                            :options="permissions"
                            :multiple="true"
                            :close-on-select="false"
                            placeholder="Add role permissions"
                            label="option"
                            track-by="option"
                            @close="changePermissions"
                            @remove="changePermissions"
                        />
                    </dd>
                    <dt class="col-sm-4">Created AT</dt>
                    <dd class="col-sm-8">{{ role.created_at }}</dd>
                    <dt class="col-sm-4">Actions</dt>
                    <dd class="col-sm-8">
                        <button @click.prevent="deleteRole()" role="button" class="btn btn-danger">
                            Delete
                        </button>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between my-2">
                    <h4>Users</h4>
                </div>
            </div>
            <div v-if="role.users!=0" class="card-body">
                <div class="table-responsive mb-1">
                    <div
                        class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                        <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                        <span class="form-text">
                          Users
                        </span>
                            <select class="form-select form-select-sm mx-2" aria-label="Select entries">
                                <option value="10" selected>10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                            </select>
                            <span class="form-text">entries</span>
                        </div>
                        <div class="d-flex mx-2 my-2">
                            <label class="form-text mx-1">Search: </label>
                            <input type="search" class="form-control" id="search" style="max-height: 20px;"/>
                        </div>
                    </div>

                    <!-- Table -->
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-primary">
                        <tr></tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">login</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col">Register AT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in role.users">
                            <th scope="row"></th>
                            <td>{{ user.login }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                {{ user.role }}
                            </td>
                            <td>{{ user.register_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
                    <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
                        <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 4 to 10 of 4
                            entries
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <nav>
                            <ul class="pagination" style="color: black">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Предыдущая">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Следующая">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div v-if="role.users==0" class="card-body">
                <div>
                    There are no users who have this role.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
import EditForumModal from "../../components/admin/EditForumModal.vue";
import VueMultiselect from "vue-multiselect";
import {useToast} from "vue-toastification";
import api from "../../api/api";
import {mapGetters} from "vuex";

export default {
    name: "ForumDetail",
    components: {EditForumModal, CreateForumModal, VueMultiselect,},

    computed: {
        ...mapGetters({
            role: 'role/getRole',
            selectedPermissions: 'role/getRolePermissions',
        }),
    },

    setup() {
        return {
            t$: useToast(),
        }
    },

    mounted() {
        this.getRole();
        this.getPermissions();
    },

    data() {
        return {
            permissions: [],
        }
    },

    methods: {
        getRole() {
            this.$store.dispatch('role/getRole', this.$route.params.id);
        },

        getPermissions() {
            return new Promise((resolve, reject) => {
                api.get('/api/admin/permission/permission-for-form')
                    .then(response => {
                        if(response.data){
                            this.permissions = response.data.permissions;
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error)
                    })
            });
        },

        renameRole(event, roleName) {
            let name = event.target.innerText;
            if (name === roleName) return;
            if (name.length < 3) {
                this.t$.error("Min length 3.");
                return;
            }
            this.$store.dispatch('role/renameRole', [this.$route.params.id, name]);
        },

        changePermissions() {
            const isEqual = JSON.stringify(this.role.permissions) === JSON.stringify(this.selectedPermissions);
            // if role permissions and selected permissions equal function stop.
            if (isEqual) return;
            let data = new FormData();
            let permissions = this.selectedPermissions;
            permissions.forEach(permission => {
                data.append("permissions[]", permission.value)
            })
            data.append('_method', 'put');
            this.$store.dispatch('role/changeRolePermissions', [this.$route.params.id, data]);
        },

        deleteRole() {
            if (this.role.users != 0) {
                this.t$.error("You cannot delete this role because there are users associated with it. Assign users a different role.");
                return;
            }
            this.$store.dispatch('role/deleteRole', this.role.id);
        },
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
