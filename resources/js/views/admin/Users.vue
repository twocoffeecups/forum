<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3><i class="fas fa-users"></i> Users list</h3>
                <CreateUserModal/>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-1">
                <div v-if="users!==0"
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
                <table v-if="users!==0" class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr></tr>
                    <tr>
                        <th scope="col">Avatar</th>
                        <th scope="col">Login</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Last visit</th>
                        <th scope="col">Status</th>
                        <th scope="col">Topics</th>
                        <th scope="col">Posts</th>
                        <th scope="col">Reports</th>
                        <th scope="col">In Ban List</th>
                        <th scope="col">Role</th>
                        <th scope="col">Email verified AT</th>
                        <th scope="col">Register AT</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <th scope="row">
                            <img :src="user.avatar" class="img-thumbnail" width="70">
                        </th>
                        <td>{{ user.login }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.lastVisit }}</td>
                        <td>
                            <span v-if="user.status" class="badge bg-success">Online</span>
                            <span v-if="!user.status" class="badge bg-danger">Offline</span>
                        </td>
                        <td>{{ user.stats.topics }}</td>
                        <td>{{ user.stats.posts }}</td>
                        <td>{{ user.stats.reports ?? 0 }}</td>
                        <td>{{ user.inBanList ? 'Yes' : 'No' }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill ">
                                {{ user.role }}
                            </span>
                        </td>
                        <td>{{ user.email_verified_at }}</td>
                        <td>{{ user.register_at }}</td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <router-link class="btn btn-success" :to="{ name:'admin.user.details', params:{id:user.id} }">
                                    Show
                                </router-link>
                                <button class="btn btn-danger">
                                    Ban
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div v-if="users===0" class="text-center mx-1">
                    <h4>You haven't users.</h4>
                </div>

                <TablePagination
                    @selectPageEmit="selectPage"
                    :total-entries="paginate.total"
                    :total-pages="paginate.last_page"
                    :links="paginate.links"
                    :current-page="paginate.current_page"
                    :last-page="paginate.last_page" />
            </div>

        </div>
    </div>
</template>

<script>
import api from "../../api/api";
import CreateUserModal from "../../components/admin/CreateUserModal.vue";
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";

export default {
    name: "Users",
    components: {TablePagination, CreateUserModal},

    computed: {
        ...mapGetters({
            users: 'adminUsers/getUsers',
            paginate: 'adminUsers/getPaginate',
        }),
    },

    data() {
        return {
            entriesOnPage: 3,
        }
    },

    mounted() {
        this.getUsers();
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('adminUsers/setEntriesOnPage', val);
            this.$store.dispatch('adminUsers/getUsers')
        }
    },

    methods: {
        getUsers() {
            this.$store.dispatch('adminUsers/getUsers');
        },

        selectPage(page){
            this.$store.dispatch('adminUsers/getUsers', page)
        }
    },
}
</script>

<style scoped>

</style>
