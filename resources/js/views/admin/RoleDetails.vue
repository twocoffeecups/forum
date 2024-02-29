<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Role details</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Name</b>
                        </div>
                        <div class="col-7">
                            <span contenteditable @focusout.prevent="renameRole($event, role.name)" class="col-sm-8">
                                {{ role.name }}
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Permissions</b>
                        </div>
                        <div class="col-7">
                            <div class="flex-row">
                                <span v-if="selectedPermissions" v-for="permission in selectedPermissions" class="badge bg-success mx-1">{{ permission.option }}</span>
                            </div>

                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Created</b>
                        </div>
                        <div class="col-7">
                            {{ role.created_at }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Delete</b>
                        </div>
                        <div class="col-7">
                            <button @click.prevent="deleteRole()" role="button" class="btn btn-danger">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Change role permission</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-start mb-2">
                        <div class="row">
                            <b>Change permissions</b>
                        </div>
                        <div class="row">
                            <div class="flex-row mb-2">
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
                                />
<!--                                @close="changePermissions"-->
<!--                                @remove="changePermissions"-->
                            </div>
                        </div>
                        <div class="">
                            <button @click.prevent="changePermissions" class="btn btn-primary bg-gradient">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-3" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Users</h4>
                    </div>
                </div>
                <div v-if="users" class="card-body">
                    <div class="table-responsive mb-1">
<!--                        <div-->
<!--                            class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">-->
<!--                            <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">-->
<!--                                <span class="form-text">-->
<!--                                  Users-->
<!--                                </span>-->
<!--                                <select class="form-select form-select-sm mx-2" aria-label="Select entries">-->
<!--                                    <option value="10" selected>10</option>-->
<!--                                    <option value="30">30</option>-->
<!--                                    <option value="50">50</option>-->
<!--                                </select>-->
<!--                                <span class="form-text">entries</span>-->
<!--                            </div>-->
<!--                            <div class="d-flex mx-2 my-2">-->
<!--                                <label class="form-text mx-1">Search: </label>-->
<!--                                <input type="search" class="form-control" id="search" style="max-height: 20px;"/>-->
<!--                            </div>-->
<!--                        </div>-->

                        <!-- Table -->
                        <table v-if="users.length!=0" class="table table-striped table-hover table-bordered">
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
                            <tr v-for="user in users">
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

                    <div v-if="users.length==0" class="card-body text-center">
                        <h4>There are no users who have this role.</h4>
                    </div>
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
            users: 'role/getRoleUsers',
            rolePermissions: 'role/getRolePermissions',
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

    watch: {
        rolePermissions(val){
            this.selectedPermissions = val;
        }
    },

    data() {
        return {
            permissions: [],
            selectedPermissions: []
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
