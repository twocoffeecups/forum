<template>
    <div class="row mb-3">
        <div class="col-md-8 mb-3">
            <!-- Table card -->
            <div class="card" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Rejected types list</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div v-if="rejectTypes.length!==0">
                        <div class="table-responsive mb-1">
                            <div v-if="rejectTypes!==0"
                                 class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                                <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                                    <span class="form-text">
                                      Show
                                    </span>
                                    <select v-model="entriesOPage" class="form-select form-select-sm mx-2" aria-label="Select entries">
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
                            <table v-if="rejectTypes!==0" class="table table-striped table-hover table-bordered">
                                <thead class="table-primary">
                                <tr></tr>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Status</th>
                                        <th v-if="checkHasPermissions([AccessPermissions.CAN_UPDATE_TOPIC_REJECT_TYPE])" scope="col">Change status</th>
                                        <th scope="col">Created AT</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="type in rejectTypes">
                                        <th scope="row">{{ type.id }}</th>
                                        <td contenteditable @focusout.prevent="updateRejectType($event, type.id, type.title)">
                                            {{ type.title }}
                                        </td>
                                        <td>{{ type.author }}</td>
                                        <td><b>{{ type.status ? 'Published' : 'Unpublished' }}</b></td>
                                        <td>{{ type.created_at }}</td>
                                        <td v-if="checkHasPermissions([AccessPermissions.CAN_UPDATE_TOPIC_REJECT_TYPE])">
                                            <div class="btn-group  btn-group-sm" role="group"
                                                 aria-label="Basic radio toggle button group"
                                                 @change.prevent="changeStatus(type.id)">
                                                <input type="radio" class="btn-check" :name="type.id+'isPublished'"
                                                       :id="type.id+'hide'" value="false" autocomplete="off"
                                                       :checked="type.status != true">
                                                <label class="btn btn-outline-secondary" :for="type.id+'hide'">Hide</label>

                                                <input type="radio" class="btn-check" :name="type.id+'isPublished'"
                                                       :id="type.id+'published'" value="true" autocomplete="off"
                                                       :checked="type.status == true">
                                                <label class="btn btn-outline-success"
                                                       :for="type.id+'published'">Publish</label>
                                            </div>
                                        </td>
                                        <td>
                                            <button v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_TOPIC_REJECT_TYPE])" @click.prevent="deleteRejectType(type.id)" class="btn btn-danger mx-2"
                                                  title="Delete">
                                                Delete
                                            </button>
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

                            <div v-if="rejectTypes.length===0" class="text-center">
                                <h4>It's empty here...</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <CreateTopicRejectTypeCard />
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";
import CreateTagCard from "../../components/admin/CreateTagCard.vue";
import CreateTopicRejectTypeCard from "../../components/admin/CreateTopicRejectTypeCard.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";
export default {
    name: "Role",
    components: {CreateTopicRejectTypeCard, CreateTagCard, TablePagination,},

    computed: {
        ...mapGetters({
            rejectTypes: 'rejectType/getRejectTypes',
            paginate: 'rejectType/getPaginate',
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
            entriesOPage: 3,
        }
    },

    watch: {
        entriesOPage(val){
            this.$store.commit('rejectType/setEntriesOnPage', val);
            this.$store.dispatch("rejectType/getRejectTypes");
        }
    },

    mounted() {
        this.$store.dispatch("rejectType/getRejectTypes");
    },

    methods: {
        selectPage(page){
            this.$store.dispatch("rejectType/getRejectTypes", page);
        },

        changeStatus(id) {
            this.$store.dispatch('rejectType/changeStatus', id);
        },

        deleteRejectType(id) {
            this.$store.dispatch('rejectType/delete', id);
        },

        updateRejectType(event, id, oldTitle) {
            if(!checkHasPermissions([AccessPermissions.CAN_UPDATE_TOPIC_REJECT_TYPE])){
                return false;
            }
            let title = event.target.innerText;
            if (title == oldTitle) return;
            if (title.length < 6) {
                this.t$.error("Min length 6.");
                return;
            }
            this.$store.dispatch('rejectType/update', [id, title]);
        },
    },
}
</script>

<style>

</style>
