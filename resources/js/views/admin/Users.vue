<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between my-2">
                <h4>All Users</h4>

                <CreateUserModal/>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-1">
                <div
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
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                    <tr></tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Login</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
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
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.login }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.stats.topics }}</td>
                        <td>{{ user.stats.posts }}</td>
                        <td>{{ user.stats.reports }}</td>
                        <td>{{ user.inBanList ? 'Yes' : 'No' }}</td>
                        <td>
                            <button disabled class="btn btn-primary">
                                {{ user.role }}
                            </button>
                        </td>
                        <td>{{ user.email_verified_at }}</td>
                        <td>{{ user.register_at }}</td>
                        <td>
                            <span class="text-primary mx-2" title="Show">
                                <router-link :to="{ name:'admin.userDetail', params:{id:user.id} }">
                                  <i class="fas fa-eye"></i>
                                </router-link>
                            </span>
                            <button class="btn btn-danger mx-2" title="Ban">
                                <i class="fas fa-ban"></i>
                            </button>

                        </td>
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
    </div>
</template>

<script>
import api from "../../api/api";
import CreateUserModal from "../../components/admin/CreateUserModal.vue";

export default {
    name: "Users",
    components: {CreateUserModal},

    mounted() {
        this.getUsers();
    },

    data() {
        return {
            users: [],
        }
    },

    methods: {
        getUsers() {
            api.get('/api/admin/user')
                .then(res => {
                    this.users = res.data.users;
                    console.log(res);
                })
        }
    },
}
</script>

<style scoped>

</style>
