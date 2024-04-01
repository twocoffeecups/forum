<template>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card rounded-0" style="border-top: 5px solid #0c63e4">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" id="role-details-nav-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0 active" id="role-tab" data-bs-toggle="tab" data-bs-target="#role-details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="true">Details</button>
                        </li>
                        <li v-if="checkHasPermissions([AccessPermissions.CAN_CHANGE_ROLE_PERMISSION])" class="nav-item" role="presentation">
                            <button class="nav-link rounded-0" id="actions-tab" data-bs-toggle="tab" data-bs-target="#role-actions-tab-pane" type="button" role="tab" aria-controls="actions-tab-pane" aria-selected="false">Actions</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="topic-details-tab">
                        <!-- Details -->
                        <div class="tab-pane fade show active" id="role-details-tab-pane" role="tabpanel" aria-labelledby="role-details-tab" tabindex="0">
                            <div class="container">
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
                                <div v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_ROLE])" class="row align-items-start mb-2">
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
                        <!-- Actions -->
                        <div v-if="checkHasPermissions([AccessPermissions.CAN_CHANGE_ROLE_PERMISSION])" class="tab-pane fade" id="role-actions-tab-pane" role="tabpanel" aria-labelledby="role-actions-tab" tabindex="0">
                            <div class="container">
                                <div class="container">
                                    <div class="row">
                                        <h4>Change role permission</h4>
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
                                        </div>
                                    </div>
                                    <div class="">
                                        <button @click.prevent="changePermissions" class="btn btn-primary bg-gradient">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card mb-3" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Users</h4>
                    </div>
                </div>
                <div v-if="users" class="card-body">
                    <div class="table-responsive mb-1">
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
import EditForumModal from "../../components/admin/EditForumModal.vue";
import VueMultiselect from "vue-multiselect";
import {useToast} from "vue-toastification";
import api from "../../api/api";
import {mapGetters} from "vuex";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "ForumDetail",
    components: {EditForumModal, VueMultiselect,},

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
            checkHasPermissions,
            AccessPermissions,
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
            if(!checkHasPermissions([AccessPermissions.CAN_UPDATE_ROLE])){
                return false;
            }
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
