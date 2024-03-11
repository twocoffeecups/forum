<template>
    <div class="row mb-3">
        <div class="container-fluid">
            <!-- Table card -->
            <div class="card" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4><i class="fas fa-tag"></i> Forums list</h4>
                        <div>
                            <CreateForumModal v-if="checkHasPermissions([AccessPermissions.CAN_CREATE_FORUM])" :forums="this.forums"/>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div
                            class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <!-- Change showing count entries -->
                            <div class="d-flex">
                                <div v-if="forums.length > 10" class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
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
                            </div>

                            <!-- ./ -->
                            <div class="d-flex fa-pull-right mx-2 my-2">
                                <label class="form-text mx-1">Search: </label>
                                <input type="search" class="form-control" id="search" style="max-height: 20px;"/>
                            </div>
                        </div>

                        <!-- Table -->
                        <table v-if="forums!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Child forums</th>
                                <th scope="col">Topics</th>
                                <th scope="col">Posts</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Visibility</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="forum in forums">
                                <th scope="row">{{ forum.id }}</th>
                                <td>{{ forum.name }}</td>
                                <td>{{ forum.type }}</td>
                                <td>
                                    {{ forum.description }}
                                </td>
                                <td>{{ forum.stats.children}}</td>
                                <td>{{ forum.stats.topics }}</td>
                                <td>{{ forum.stats.posts }}</td>
                                <td>{{ forum.created_at }}</td>
                                <th>
                                    <div v-if="checkHasPermissions([AccessPermissions.CAN_UPDATE_FORUM])" class="btn-group  btn-group-sm" role="group"
                                         aria-label="Basic radio toggle button group"
                                         @change.prevent="changeVisibility($event, forum.id)">
                                        <input type="radio" class="btn-check" :name="forum.id+'isPublished'"
                                               :id="forum.id+'hide'" value="false" autocomplete="off"
                                               :checked="forum.status != true">
                                        <label class="btn btn-outline-secondary" :for="forum.id+'hide'">Hide</label>

                                        <input type="radio" class="btn-check" :name="forum.id+'isPublished'"
                                               :id="forum.id+'published'" value="true" autocomplete="off"
                                               :checked="forum.status == true">
                                        <label class="btn btn-outline-success"
                                               :for="forum.id+'published'">Publish</label>
                                    </div>
                                </th>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <EditForumModal v-if="checkHasPermissions([AccessPermissions.CAN_UPDATE_FORUM])" :id="forum.id" :forum-name="forum.name"
                                                        :forum-description="forum.description"/>

                                        <router-link class="btn btn-success mx-1" :to="{ name:'admin.forum.details', params:{id: forum.id} }">
                                            Show
                                        </router-link>

                                        <button v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_FORUM])"
                                              @click="deleteForum(forum.id)" class="btn btn-danger mx-1" title="Edit">
                                                Delete
                                        </button>
                                    </div>

                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div v-if="forums===0" class="text-center mx-1">
                            <h4>You haven't  forums.</h4>
                        </div>
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
</template>

<script>
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
import EditForumModal from "../../components/admin/EditForumModal.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";
import Pagination from "../../components/client/Pagination.vue";
import permissions from "../../access/permissions";

export default {
    name: "Forum",
    components: {Pagination, TablePagination, EditForumModal, CreateForumModal},

    computed: {
        ...mapGetters({
            forums: 'adminForum/getForums',
            paginate: 'adminForum/getPaginate',
        }),
    },

    setup(){
        return{
            checkHasPermissions,
            AccessPermissions,
        }
    },

    mounted() {
        this.$store.dispatch('adminForum/getForums');
    },

    data() {
        return {
            entriesOnPage: 10,
        }
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('adminForum/setEntriesOnPage', val);
            this.$store.dispatch('adminForum/getForums')
        }
    },
    methods: {
        changeVisibility(event, forumId) {
            let visibility = event.target.value;
            this.$store.dispatch('adminForum/changeForumVisibility', forumId)
        },

        deleteForum(forumId) {
            this.$store.dispatch('adminForum/deleteForum', forumId);
        },

        selectPage(page){
            this.$store.dispatch('adminForum/getForums', page);
        }
    }

}
</script>

<style scoped>

</style>
