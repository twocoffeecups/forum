<template>
    <div class="row">
        <div class="col-9">
            <div class="card my-3">
                <div class="card-header">
                    <h4>Forum details</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Name</dt>
                        <dd contenteditable class="col-sm-8" @input="updateContent($event, 'name')">{{
                                forum.name
                            }}
                        </dd>
                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ forum.type }}</dd>
                        <dt class="col-sm-4">Category</dt>
                        <dd class="col-sm-8">
                            {{ forum.parent }}
                            <span role="button" class="fa-pull-right text-primary mx-2"
                                  @click="this.showSelect = !this.showSelect">
                Change forum category
              </span>
                        </dd>
                        <dd v-if="showSelect" class="col-sm-8 offset-sm-4">
                            <select class="form-select fa-pull-right">
                                <option class="">Change parent forum</option>
                                <option class="">Forum category 1</option>
                                <option class="">Forum category 2</option>
                                <option class="">Forum category 3</option>
                            </select>
                        </dd>
                        <dt class="col-sm-4">Description</dt>
                        <dd contenteditable class="col-sm-8" @input="updateContent($event, 'description')">
                            {{ forum.description }}
                        </dd>
                        <dt class="col-sm-4">Author</dt>
                        <dd class="col-sm-8">{{ forum.author }}</dd>
                        <dt class="col-sm-4">Created AT</dt>
                        <dd class="col-sm-8">{{ forum.created_at }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card my-3">
                <div class="card-header">
                    <h4>Forum stats</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Forums</dt>
                        <dd class="col-sm-8">{{ forum.childrenForumCount }}</dd>
                        <dt class="col-sm-4">Posts</dt>
                        <dd class="col-sm-8">{{ forum.posts }}</dd>
                        <dt class="col-sm-4">Views</dt>
                        <dd class="col-sm-8">{{ forum.views }}</dd>
                        <dt class="col-sm-4">Unique users</dt>
                        <dd class="col-sm-8">{{ forum.uniqueUsers }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between my-2">
                    <h4>Children forum</h4>
                    <div>
                        <CreateForumModal/>
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
                        <tr v-for="forum in childrenForums">
                            <th scope="row">{{ forum.id }}</th>
                            <td>{{ forum.name }}</td>
                            <td>{{ forum.type }}</td>
                            <td>
                                {{ forum.description }}
                            </td>
                            <td>{{ forum.categories }}</td>
                            <td>{{ forum.topics }}</td>
                            <td>{{ forum.posts }}</td>
                            <td>{{ forum.createdAt }}</td>
                            <th>
                                <div class="btn-group  btn-group-sm" role="group"
                                     aria-label="Basic radio toggle button group"
                                     @change.prevent="changeVisibility($event, forum.id)">
                                    <input type="radio" class="btn-check" :name="forum.id+'isPublished'"
                                           :id="forum.id+'hide'" value="false" autocomplete="off"
                                           :checked="forum.visibility !== true">
                                    <label class="btn btn-outline-secondary" :for="forum.id+'hide'">Hide</label>

                                    <input type="radio" class="btn-check" :name="forum.id+'isPublished'"
                                           :id="forum.id+'published'" value="true" autocomplete="off"
                                           :checked="forum.visibility === true">
                                    <label class="btn btn-outline-success" :for="forum.id+'published'">Publish</label>
                                </div>

                            </th>
                            <td>

                                <EditForumModal :id="forum.id" :forum-name="forum.name"
                                                :forum-description="forum.description"/>

                                <span @click="deleteForum(forum.id)" role="button" class="text-danger mx-2"
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
    </div>
</template>

<script>
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
import EditForumModal from "../../components/admin/EditForumModal.vue";
import axios from "axios";
import {useToast} from "vue-toastification";

export default {
    name: "ForumDetail",
    components: {EditForumModal, CreateForumModal},

    setup() {
        return {
            t$: useToast(),
        }
    },

    data() {
        return {

            showSelect: false,

            forum: {
                id: 1,
                name: 'Forum 1',
                type: 'Forum',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.\n' +
                    'Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.\n' +
                    'Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                parent: 'Forum category 1',
                author: 'Admin Adminovich',
                created_at: '2023-09-11',
                childrenForumCount: 5,
                views: 36,
                posts: 123,
                uniqueUsers: 15,

            },

            childrenForums: [
                {
                    id: 1,
                    name: 'Forum 1',
                    type: 'Forum category',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    categories: 5,
                    topics: 14,
                    posts: 73,
                    visibility: true,
                    createdAt: '23.09.2023',
                },
            ],
        }
    },

    methods: {
        changeVisibility(event, forumId) {
            let visibility = event.target.value;
            console.log('Forum id: ', forumId)
            console.log('Visibility: ', visibility)
        },

        deleteForum(forumId) {
            console.log('delete forum');
        },

        updateContent(e, key) {
            let value = e.target.innerText
            axios.patch(`/api/admin/forum/${this.forum.id}/update`, {
                key: value,
            })
                .then(res => {
                    console.log(res);
                    this.t$.success('Successfully!')
                })
                .catch(error => {
                    console.log(error)
                    this.t$.error('Error!')
                })
        }
    }
}
</script>

<style scoped>

</style>
