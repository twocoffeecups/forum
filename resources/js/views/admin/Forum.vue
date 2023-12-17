<template>
    <div class="row mb-3">
        <div class="container-fluid">

            <!-- Table card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>All Forums</h4>
                        <div v-if="checkHasPermissions([AccessPermissions.CAN_CREATE_FORUM])">
                            <CreateForumModal :forums="this.forums"/>
                        </div>
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
                                <td>{{ forum.stat.children}}</td>
                                <td>{{ forum.stat.topics }}</td>
                                <td>{{ forum.stat.posts }}</td>
                                <td>{{ forum.created_at }}</td>
                                <th>
                                    <div class="btn-group  btn-group-sm" role="group"
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
                                    <EditForumModal :id="forum.id" :forum-name="forum.name"
                                                    :forum-description="forum.description"/>

                                    <span class="text-primary mx-2" title="Show">
                                        <router-link :to="{ name:'admin.forum.details', params:{id:forum.id} }">
                                          <i class="fas fa-eye"></i>
                                        </router-link>
                                    </span>


                                    <span v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_FORUM])" @click="deleteForum(forum.id)" role="button" class="text-danger mx-2"
                                          title="Edit">
                                      <i class="fas fa-trash"></i>
                                  </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
                        <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
                            <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 4 to 10 of
                                4
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
    </div>
</template>

<script>
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
import EditForumModal from "../../components/admin/EditForumModal.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

export default {
    name: "Forum",
    components: {EditForumModal, CreateForumModal},

    setup(){
        return{
            checkHasPermissions,
            AccessPermissions,
        }
    },

    mounted() {
        this.getForums();
    },

    data() {
        return {
            forums: [],
        }
    },

    methods: {

        getForums() {
            axios.get('/api/admin/forum', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access-token')}`
                }
            })
                .then(res => {
                    console.log(res);
                    this.forums = res.data.forums
                })
                .catch(error => {
                    console.log(error);
                })
        },

        changeVisibility(event, forumId) {
            let visibility = event.target.value;
            // console.log('Forum id: ', forumId)
            // console.log('Visibility: ', visibility)
            axios.patch(`/api/admin/forum/${forumId}/change-status`)
                .then(res => {
                    console.log(res);
                })
                .catch(error => {
                    console.log(error);
                })
        },

        deleteForum(forumId) {
            console.log('delete forum, id:', forumId);
            axios.delete(`/api/admin/forum/${forumId}`)
                .then(res => {
                    console.log(res);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }

}
</script>

<style scoped>

</style>
