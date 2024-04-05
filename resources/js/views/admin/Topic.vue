<template>
    <!-- Info cards -->
    <div class="row mb-3">
        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-primary bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>123</h2>
                            <span class="fst-italic">Published topic</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="fas fa-comments" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-secondary bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>43</h2>
                            <span class="fst-italic">Rejected</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-user" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-6 col-lg-3">
            <div class="card text-bg-danger bg-gradient mb-3 col mx-auto" style="max-width: 360px; max-height: 145px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="col">
                            <h2>21</h2>
                            <span class="fst-italic">New topics</span>
                        </div>
                        <div class="col d-flex justify-content-center align-items-center">
                            <i class="far fa-flag" style="font-size: 2.3em"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Topics  list -->
    <div class="row mb-3">
        <div class="container-fluid">

            <!-- Table card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>All Topics</h4>
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
                                    <th scope="col">Forum</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Posts</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Attributes</th>
                                    <th scope="col">Created AT</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="topic in topics">
                                    <th scope="row">{{ topic.id }}</th>
                                    <td>{{ topic.forum }}</td>
                                    <td>{{ topic.title }}</td>
                                    <td>{{ topic.author }}</td>
                                    <td>{{ topic.posts }}</td>
                                    <td>
                                        <span v-if="topic.status===1" class="badge bg-primary">Published</span>
                                        <span v-if="topic.status!==1" class="badge bg-secondary">Unpublished</span>
                                    </td>
                                    <td>
                                        <span v-if="topic.private" class="badge bg-danger">Private</span>
                                        <span v-if="topic.commentsClosed" class="badge bg-primary">Comments Closed</span>
                                        <span v-if="topic.administrationTopic" class="badge bg-danger">Administration Topic</span>
                                    </td>
                                    <td>{{ topic.created_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start mx-auto">
                                            <router-link class="btn btn-primary mx-2" :to="{name:'admin.topic.details', params:{id: topic.id}}">
                                                Show
                                            </router-link>
                                            <button v-if="checkHasPermissions(AccessPermissions.CAN_DELETE_TOPIC)" class="btn btn-danger mx-2">
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

                        <div v-if="topics===0" class="text-center mx-1">
                            <h4>You haven't topics.</h4>
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
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "Topic",
    components: {TablePagination},

    setup() {
        return {
            checkHasPermissions,
            AccessPermissions,
        }
    },

    computed: {
        ...mapGetters({
            topics: 'adminTopic/getTopics',
            paginate: 'adminTopic/getPaginate',
        })
    },

    data() {
        return {
            entriesOnPage: 10,
        }
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('adminTopic/setEntriesOnPage', val);
            this.$store.dispatch('adminTopic/getTopics');
        },
    },

    mounted() {
        this.$store.dispatch('adminTopic/getTopics');
    },

    methods: {
        selectPage(page){
            this.$store.dispatch('adminTopic/getTopics', page);
        }
    }
}
</script>

<style scoped>

</style>
