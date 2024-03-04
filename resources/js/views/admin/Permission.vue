<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Permissions list</h4>
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
                                <select v-model="entriesOnPage" class="form-select form-select-sm mx-2" aria-label="Select entries">
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
                                    <button v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_PERMISSION])" @click="deletePermission(permission.id)" class="btn btn-danger bg-gradient mx-2"
                                          title="Delete">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <TablePagination
                            @selectPageEmit="selectPage"
                            :total-entries="paginate.total"
                            :total-pages="paginate.last_page"
                            :links="paginate.links"
                            :current-page="paginate.current_page"
                            :last-page="paginate.last_page" />

                        <div v-if="permissions===0" class="text-center mx-1">
                            <h4>You haven't permissions.</h4>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-4">
            <CreatePermissionComponent v-if="checkHasPermissions([AccessPermissions.CAN_CREATE_PERMISSION])" />
        </div>
    </div>

</template>

<script>
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";
import CreatePermissionComponent from "../../components/admin/CreatePermissionComponent.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "Role",
    components: {CreatePermissionComponent, TablePagination},

    computed: {
        ...mapGetters({
            permissions: 'permissions/getPermission',
            paginate: 'permissions/getPaginate',
        })
    },

    setup() {
        return {
            checkHasPermissions,
            AccessPermissions,
        }
    },

    mounted() {
        this.getPermissions();
    },

    data() {
        return {
            entriesOnPage: 10,
        }
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('permissions/setEntriesOnPage', val);
            this.$store.dispatch('permissions/getPermissions');
        }
    },

    methods: {
        getPermissions() {
            this.$store.dispatch('permissions/getPermissions');
        },

        selectPage(page){
            this.$store.dispatch('permissions/getPermissions', page);
        },

        renamePermission(event, id, permissionName) {
            if(!checkHasPermissions([AccessPermissions.CAN_UPDATE_PERMISSION])){
                return false;
            }
            let name = event.target.innerText;
            if (name == permissionName) return;
            if (name.length < 6) {
                this.t$.error("Min length 6.");
                return;
            }
            this.$store.dispatch('permissions/renamePermission', name);
        },

        deletePermission(id) {
            this.$store.dispatch('permissions/deletePermission', id);
        },
    }
}
</script>

<style>

</style>
