<template>
    <div class="row mb-3">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card text-bg-primary bg-gradient mb-3 col" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>123</h2>
                            <span class="fst-italic">Rejected topics</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="fas fa-comments" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card text-bg-danger bg-gradient mb-3 col" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>21</h2>
                            <span class="fst-italic">NEW</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-flag" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-3">
        <div class="container-fluid">

            <!-- Table card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>All Forums</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div v-if="topics!==0"
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
                        <table v-if="topics!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Topic title</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Posts</th>
                                    <th scope="col">Created AT</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="topic in topics">
                                    <th scope="row">{{ topic.id }}</th>
                                    <td>{{ topic.title }}</td>
                                    <td>{{ topic.reason }}</td>
                                    <td>{{ topic.author }}</td>
                                    <td>{{ topic.posts }}</td>
                                    <td>{{ topic.created_at }}</td>
                                    <td>
                                        <router-link class="btn btn-success" :to="{name:'admin.topic.details', params:{id: topic.topicId}}">
                                            Show
                                        </router-link>
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

                        <div v-if="topics===0" class="text-center mx-1">
                            <h4>You haven't rejected topics.</h4>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";

export default {
    name: "RejectedTopic",
    components: {TablePagination},

    computed: {
        ...mapGetters({
            topics: 'rejectedTopic/getTopics',
            paginate: 'rejectedTopic/getPaginate',
        })
    },

    data() {
        return {
            entriesOnPage: 10,
        }
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('rejectedTopic/setEntriesOnPage', val);
            this.$store.dispatch('rejectedTopic/getTopics');
        }
    },

    mounted() {
        this.$store.dispatch('rejectedTopic/getTopics');
    },

    methods: {
        selectPage(page){
            this.$store.dispatch('rejectedTopic/getTopics', page);
        },
    }
}
</script>

<style scoped>

</style>
