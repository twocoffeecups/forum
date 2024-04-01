<template>
    <div class="row">
        <div class="col-12">
            <div class="card rounded-0" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3><i class="fas fa-users"></i> Ban list</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div v-if="banList!==0"
                             class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <div v-if="banList.length > 10" class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
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
                        <table v-if="banList.length!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                                <tr></tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Report</th>
                                    <th scope="col">Ban start</th>
                                    <th scope="col">Ban End</th>
                                    <th scope="col">Ban exclude</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ban in banList">
                                    <th scope="row">
                                        {{ ban.id }}
                                    </th>
                                    <td>
                                        <router-link :to="{name:'admin.user.details', params:{id:ban.user.id}}">
                                            {{ ban.user.name }}
                                        </router-link>
                                    </td>
                                    <td>{{ ban.email ?? 'No' }}</td>
                                    <td>{{ ban.reason.name }}</td>
                                    <td>
                                        <router-link :to="{name:'admin.report.details', params:{id:ban.reportId}}">
                                            Show
                                        </router-link>
                                    </td>
                                    <td>{{ ban.banStart }}</td>
                                    <td>{{ ban.banStart }}</td>
                                    <td>
                                        <span v-if="ban.banExclude" class="badge bg-success">Yes</span>
                                        <span v-if="!ban.banExclude" class="badge bg-danger">No</span>
                                    </td>
                                    <td>
                                        Actions
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="banList===0" class="text-center mx-1">
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
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "BanList",
    components: {TablePagination},

    computed: {
        ...mapGetters({
            banList: 'banList/getBanList',
            paginate: 'banList/getPaginate',
        }),
    },

    setup() {
        return {
            checkHasPermissions,
            AccessPermissions,
        }
    },

    data() {
        return {
            entriesOnPage: 3,
        }
    },

    mounted() {
        this.getBanList();
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('banList/setEntriesOnPage', val);
            this.$store.dispatch('banList/getUsers')
        }
    },

    methods: {
        getBanList() {
            this.$store.dispatch('banList/getUsers');
        },

        selectPage(page){
            this.$store.dispatch('banList/getUsers', page)
        }
    },
}
</script>

<style scoped>

</style>
