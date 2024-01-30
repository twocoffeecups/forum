<template>
    <div class="row mb-3">
        <div class="container-fluid">

            <!-- Table card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>Reports</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div
                            class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <!-- Change showing count entries -->
                            <div v-if="reports!==0" class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
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
                            <div class="d-flex mx-2 my-2">
                                <label class="form-text mx-1">Search: </label>
                                <input type="search" class="form-control" id="search" style="max-height: 20px;"/>
                            </div>
                        </div>

                        <!-- Table -->
                        <table v-if="reports!==0" class="table table-striped table-hover table-bordered">
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
<!--                                    <span v-if="report.object">-->
<!--                                        <router-link v-if="report.type=='topic'"-->
<!--                                                                            :to="{name:'topic', params:{id:report.object.id}}">{{-->
<!--                                            report.object.title-->
<!--                                        }}</router-link></span>-->
                                    <a v-if="report.type=='topic'" :href="`/topic/${report.object.id}`">{{ report.object.title }}</a>
                                    <a v-if="report.type=='post'" href="#">Post for topic</a>
                                </td>
                                <td>{{ report.reason.name }}</td>
                                <td>{{ report.sender.login }}</td>
                                <td>{{ !report.closed ? 'New' : 'Closed' }}</td>
                                <td>{{ report.created_at }}</td>
                                <td>
                                        <span class="text-primary mx-2" title="Show">
                                            <router-link :to="{ name:'admin.report.details', params:{id:report.id} }">
                                              <i class="fas fa-eye"></i>
                                            </router-link>
                                        </span>
                                    <span role="button" class="text-danger mx-2" title="Edit">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div v-if="reports===0" class="text-center mx-1">
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
