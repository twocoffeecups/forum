<template>
    <div class="row mb-3">
        <div class="container-fluid">

            <!-- Table card -->
            <div class="card" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>Reports list</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div
                            class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <!-- Change showing count entries -->
                            <div v-if="reports.length!==0" class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                                <span class="form-text">
                                  Show
                                </span>
                                <select v-model="entriesOnPage" class="form-select form-select-sm mx-2"
                                        aria-label="Select entries">
                                    <option value="10" selected>10</option>
                                    <option value="20">30</option>
                                    <option value="30">50</option>
                                </select>
                                <span class="form-text">entries</span>
                            </div>
                            <!-- ./ -->
                        </div>

                        <!-- Table -->
                        <table v-if="reports.length!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Object</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Sender</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="report in reports">
                                    <th scope="row">{{ report.id }}</th>
                                    <td>{{ report.type }}</td>
                                    <td>
                                        <a v-if="report.type=='topic'" :href="`/topic/${report.object.id}`">{{ report.object.title }}</a>
                                        <a v-if="report.type=='post'" href="#">Post for topic</a>
                                    </td>
                                    <td>{{ report.reason.name }}</td>
                                    <td>{{ report.sender.login }}</td>
                                    <td>
                                        <span :class="`badge ${!report.closed ? 'bg-danger' : 'bg-success'}`">{{ !report.closed ? 'New' : 'Closed' }}</span>
                                    </td>
                                    <td>{{ report.created_at }}</td>
                                    <td>
                                        <div class="flex-row">
                                            <router-link class="btn btn-success" :to="{ name:'admin.report.details', params:{id:report.id} }">
                                                Show
                                            </router-link>
                                            <button role="button" class="btn btn-danger mx-2" title="Edit">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="reports.length===0" class="text-center mx-1">
                            <h4>You haven't been sent reports.</h4>
                        </div>
                    </div>

                    <TablePagination
                        v-if="paginate.last_page > 1"
                        @selectPageEmit="selectPage"
                        :total-entries="paginate.total"
                        :total-pages="paginate.last_page"
                        :links="paginate.links"
                        :current-page="paginate.current_page"
                        :last-page="paginate.last_page"/>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";

export default {
    name: "Report",
    components: {TablePagination},

    computed: {
        ...mapGetters({
            reports: 'adminReport/getReports',
            paginate: 'adminReport/getPaginate',
        }),
    },

    mounted() {
        this.$store.dispatch('adminReport/getReports')
    },

    data() {
        return {
            entriesOnPage: 10,
        }
    },

    watch: {
        entriesOnPage(val) {
            this.$store.commit('adminForum/setEntriesOnPage', val);
            this.$store.dispatch('adminReport/getReports');
        }
    },

    methods: {
        selectPage(page) {
            this.$store.dispatch('adminReport/getReports', page)
        },
    },
}
</script>

<style scoped>

</style>
