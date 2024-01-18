<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between my-2">
                <h4>All Permissions</h4>
                <div class="d-flex">
                    <CreatePermissionModal/>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-1">
                <div
                    class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                    <div v-if="permissions!==0" class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                        <span class="form-text">
                          Show
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
                <table v-if="permissions!==0" class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Created AT</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="permission in permissions">
                        <th scope="row">{{ permission.id }}</th>
                        <td contenteditable @focusout.prevent="renamePermission($event, permission.id, permission.name)">{{ permission.name }}</td>
                        <td>{{ permission.slug }}</td>
                        <td class="flex-row d-flex">
                            <span class="d-flex mx-1 p-1 bg-primary bg-gradient text-white rounded-1" v-for="role in permission.roles">{{ role.name }}</span>
                        </td>
                        <td>{{ permission.created_at }}</td>
                        <td>
                            <span @click="deletePermission(permission.id)" role="button" class="text-danger mx-2"
                                  title="Delete">
                                <i class="fas fa-trash"></i>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div v-if="permissions===0" class="text-center mx-1">
                    <h4>You haven't permissions.</h4>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import AddRoleModal from "../../components/admin/AddRoleModal.vue";
import axios from "axios";
import api from "../../api/api";
import VueMultiselect from "vue-multiselect";
import {useToast} from "vue-toastification";
import CreatePermissionModal from "../../components/admin/CreatePermissionModal.vue";

export default {
    name: "Role",
    components: {CreatePermissionModal,},

    setup() {
        return {
            t$: useToast(),
        }
    },

    mounted() {
        this.getPermissions();
    },

    data() {
        return {
            permissions: [],
        }
    },


    methods: {
        getPermissions() {
            api.get('/api/admin/permission')
                .then(res => {
                    this.permissions = res.data.permissions;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        renamePermission(event, id, permissionName) {
            let name = event.target.innerText;
            if (name == permissionName) return;
            if (name.length < 6) {
                this.t$.error("Min length 6.");
                return;
            }
            api.patch(`/api/admin/permission/${id}`, {
                name: name,
            })
                .then(res => {
                    this.t$.success("Permission rename successfully.")
                })
                .catch(error => {
                    console.log(error)
                    this.t$.error("Error!");
                })
        },

        deletePermission(id) {
            api.delete(`/api/admin/permission/${id}`)
                .then(res => {
                    this.t$.success("Permission delete successfully.");
                    this.getPermissions();
                })
                .catch(error => {
                    this.t$.error(error.response.data.message ?? "Error!");
                })
        },
    }
}
</script>

<style>

</style>
