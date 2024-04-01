<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>All Roles</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div v-if="roles!==0"
                             class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
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
                        <table v-if="roles!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Users count</th>
                                <th scope="col">Permissions</th>
                                <th scope="col">Created AT</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="role in roles">
                                    <th scope="row">{{ role.id }}</th>
                                    <td>{{ role.name }}</td>
                                    <td>{{ role.usersCount }}</td>
                                    <td>
                                        <div class="flex-row">
                                            <span class="badge mx-1 p-1 bg-primary bg-gradient" v-for="permission in role.permissions">{{ permission.option }}</span>
                                        </div>
                                    </td>
                                    <td>{{ role.created_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <router-link class="btn btn-success" :to="{ name:'admin.role.details', params:{id:role.id} }">
                                                Show
                                            </router-link>
                                            <button v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_ROLE])" @click="deleteRole(role.id)" role="button" class="btn btn-danger mx-2">
                                                Delete
                                            </button>
                                        </div>

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

                        <div v-if="roles===0" class="text-center mx-1">
                            <h4>You haven't done a roles.</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <CreateRoleComponent />
        </div>
    </div>

</template>

<script>
import VueMultiselect from "vue-multiselect";
import CreatePermissionModal from "../../components/admin/CreatePermissionComponent.vue";
import {mapGetters} from "vuex";
import CreateRoleComponent from "../../components/admin/CreateRoleComponent.vue";
import TablePagination from "../../components/admin/TablePagination.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "Role",
    components: {TablePagination, CreateRoleComponent, CreatePermissionModal, VueMultiselect},

    computed: {
        ...mapGetters({
            roles: 'role/getRoles',
            paginate: 'role/getPaginate',
        }),
    },

    setup() {
        return {
            checkHasPermissions,
            AccessPermissions,
        }
    },

    mounted() {
        this.getRoles();
    },

    data() {
        return {
            entriesOnPage: 10,
        }
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('role/setEntriesOnPage', val);
            this.$store.dispatch('role/getRoles');
        },
    },

    methods: {
        getRoles() {
            this.$store.dispatch('role/getRoles');
        },

        deleteRole(id) {
            this.$store.dispatch('role/deleteRole', id)
        },

        selectPage(page){
            this.$store.dispatch('role/getRoles', page);
        }
    },
}
</script>

<style>

</style>
