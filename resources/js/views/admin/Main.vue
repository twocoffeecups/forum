<template>
    <!-- Card -->
    <div v-if="stats" class="row mb-3">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-primary bg-gradient mb-3" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>{{ stats.forums }}</h2>
                            <span class="fst-italic">Forums</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="fas fa-comments" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">
                        <router-link class="text-white" :to="{name:'admin.forum'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-secondary bg-gradient mb-3" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>{{ stats.users }}</h2>
                            <span class="fst-italic">Users</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-user" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">
                        <router-link class="text-white" :to="{name:'admin.users'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-danger bg-gradient mb-3" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>{{ stats.reports }}</h2>
                            <span class="fst-italic">Reports</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-flag" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">
                        <router-link class="text-white" :to="{name:'admin.reports'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-success bg-gradient mb-3" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>{{ stats.users }}</h2>
                            <span class="fst-italic">Topics</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="fas fa-tags" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="card-text text-center" role="button">
                        <router-link class="text-white" :to="{name:'admin.topic'}">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="mb-3">Daily Visitors</h3>
                </div>
                <div class="card-body">
                    <Bar
                        v-if="show"
                        id="daily-visitors-chart"
                        :options="chartOptions"
                        :data="dailyVisitors"
                    />
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card rounded-0 h-100">
                <div class="card-header">
                    <h3>Most popular categories</h3>
                </div>
                <div class="card-body">
                    <div class="">
                        <Doughnut
                            v-if="show"
                            :data="topicForums"
                            :options="options"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row mb-3">
        <div class="col-md-7">
            <!-- Table card -->
            <div class="card rounded-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>New topics</h4>
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
                        </div>

                        <!-- Table -->
                        <table v-if="newTopics!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Forum</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created AT</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="topic in newTopics">
                                <th scope="row">{{ topic.id }}</th>
                                <td>{{ topic.forum }}</td>
                                <td>{{ topic.title }}</td>
                                <td>{{ topic.author }}</td>
                                <td>
                                    <span class="badge bg-danger">
                                        {{ topic.status ? 'Published' : 'Unpublished' }}
                                    </span>
                                </td>
                                <td>{{ topic.created_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-start mx-auto">
                                        <router-link class="btn btn-primary mx-2" :to="{name:'admin.topic.details', params:{id: topic.id}}">
                                            Show
                                        </router-link>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
                        <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
                            <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 1 to 10 of
                                57
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
        </div>

        <div class="col-md-5">
            <div class="card rounded-0 h-100">
                <div class="card-header">
                    <h4>Latest registered users</h4>
                </div>
                <div class="card-body">
                    <div v-if="latestUsers" class="table-responsive mb-1">
                        <!-- Table -->
                        <table v-if="latestUsers.length!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Last visit</th>
                                    <th scope="col">Register AT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in latestUsers">
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.status }}</td>
                                    <td>{{ user.lastVisit }}</td>
                                    <td>{{ user.register_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS,  ArcElement, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { Doughnut } from 'vue-chartjs'
import api from "../../api/api";

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)
export default {
    name: "Main",
    components: {Bar,Doughnut},

    mounted() {
        this.getStatistics();
    },

    methods: {
        async getStatistics(){
            this.show = false;
            try {
                const response  = await api.get('/api/admin/statistics');
                this.dailyVisitors = response.data.dailyVisitors;
                this.topicForums = response.data.topicForums;
                this.stats = response.data.stats;
                this.newTopics = response.data.newTopics;
                this.latestUsers = response.data.latestUsers
                this.show = true;
            } catch (error){
                console.log(error);
            }
        }
    },

    data() {
        return {
            show: false,
            dailyVisitors: null,
            topicForums: null,
            stats: null,
            newTopics: null,
            latestUsers: null,
            chartOptions: {
                responsive: true,
            },
            options: {
                responsive: true,
            },
        }
    }
}
</script>

<style scoped>

</style>
