<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between my-2">
                <h4>All Roles</h4>
                <div class="d-flex">
                    <CreatePermissionModal />

                    <AddRoleModal/>
                </div>
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
                            <td class="flex-row d-flex">
                                <span class="d-flex mx-1 p-1 bg-success bg-gradient text-white rounded-1" v-for="permission in role.permissions">{{ permission.option }}</span>
                            </td>
                            <td>{{ role.created_at }}</td>
                            <td>
                                <span class="text-primary mx-2" title="Show">
                                    <router-link :to="{ name:'admin.role.details', params:{id:role.id} }">
                                        <i class="fas fa-eye"></i>
                                    </router-link>
                                </span>
                                <span @click="deleteRole(role.id)" role="button" class="text-danger mx-2" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div v-if="roles===0" class="text-center mx-1">
                    <h4>You haven't done a roles.</h4>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import AddRoleModal from "../../components/admin/AddRoleModal.vue";
import VueMultiselect from "vue-multiselect";
import CreatePermissionModal from "../../components/admin/CreatePermissionModal.vue";
import {mapGetters} from "vuex";

export default {
    name: "Role",
    components: {CreatePermissionModal, VueMultiselect, AddRoleModal},

    computed: {
        ...mapGetters({
            roles: 'role/getRoles'
        }),
    },

    mounted() {
        this.getRoles();
    },

    methods: {
        getRoles() {
            this.$store.dispatch('role/getRoles');
        },

        deleteRole(id) {
            this.$store.dispatch('role/deleteRole', id)
        },
    }
}
</script>

<style>

</style>
