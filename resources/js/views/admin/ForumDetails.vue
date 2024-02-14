<template>
    <div class="row">
        <div class="col-12 col-md-9 col-lg-9 col-xl-9">
            <div class="card my-3">
                <div class="card-header">
                    <h4>Forum details</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Name</dt>
                        <dd contenteditable class="col-sm-8" @focusout.prevent="updateContent($event, 'name')">{{
                                forum.name
                            }}
                        </dd>
                        <div class="row" id="type-changed-field">
                            <dt class="col-sm-4">Type</dt>
                            <dd class="col-sm-8">
                                <span>{{ forum.type===0 ? 'Category' : 'Forum' }}</span>
                                <span role="button" class="fa-pull-right text-primary mx-2"
                                      @click="this.showChangeType = !this.showChangeType">
                                    Change forum type
                                </span>
                            </dd>
                            <dd v-if="showChangeType" class="col-sm-8 offset-sm-4 d-flex flex-row">
                                <select v-model="selectedType" class="form-select fa-pull-right">
                                    <option :selected="forum.type===0" value="0">Category</option>
                                    <option :selected="forum.type===1" value="1">Forum</option>
                                </select>
                                <div>
                                <span @click="changeForumType" role="button" class="text-primary mx-2 fs-4" title="Save">
                                    <i class="fas fa-save"></i>
                                </span>
                                </div>
                            </dd>
                        </div>

<!--                        <div class="row" id="parent-changed-field" v-if="parentForum!==null && forum.type===1">-->
                        <div class="row" id="parent-changed-field" v-if="forum.type===1">
                            <dt class="col-sm-4">Parent</dt>
                            <dd class="col-sm-8">
                                <span v-if="parentForum!==null">{{ parentForum.name }}</span>
                                <span v-if="parentForum===null">Not parent forum</span>

                                <span role="button" class="fa-pull-right text-primary mx-2"
                                      @click="this.showSelect = !this.showSelect">
                                    Change forum category
                                </span>
                            </dd>
                            <dd v-if="showSelect" class="col-sm-8 offset-sm-4 d-flex flex-row">
                                <select v-model="selectedForum" class="form-select fa-pull-right">
<!--                                    <ForumOptionTree v-for="forumOption in forums" :is-selected="parentForum.id" :name="forumOption.name" :id="forumOption.id" :forum-id="forum.id" :children="forumOption.children" :indent="0" />-->
                                    <ForumOptionTree v-for="forumOption in forums" :name="forumOption.name" :id="forumOption.id" :forum-id="forum.id" :children="forumOption.children" :indent="0" />
                                </select>
                                <div>
                                <span @click="changeParentCategory" role="button" class="text-primary mx-2 fs-4" title="Save">
                                    <i class="fas fa-save"></i>
                                </span>
                                </div>
                            </dd>
                        </div>

                        <div class="row">
                            <dt class="col-sm-4">Description</dt>
                            <dd contenteditable class="col-sm-8" @focusout.prevent="updateContent($event, 'description')">
                                {{ forum.description }}
                            </dd>
                        </div>

                        <dt class="col-sm-4">Author</dt>
                        <dd class="col-sm-8">{{ forum.author }}</dd>
                        <dt class="col-sm-4">Created AT</dt>
                        <dd class="col-sm-8">{{ forum.created_at }}</dd>
                        <dt class="col-sm-4">Change visibility status</dt>
                        <dd class="col-sm-8">
                            <div class="btn-group" role="group"
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
                        </dd>
                        <dt class="col-sm-4">Actions</dt>
                        <dd class="col-sm-8">
                            <button @click.prevent="deleteForum" class="btn btn-danger bg-gradient">Delete</button>

                            <a v-if="forum.type===1" :href="`/forum/${this.$route.params.id}`" class="btn btn-primary bg-gradient mx-1">Show on site</a>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-lg-3 col-xl-3">
            <div class="card my-3">
                <div class="card-header">
                    <h4>Forum stats</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Forums</dt>
                        <dd class="col-sm-8">{{ forumStats.children }}</dd>
                        <dt class="col-sm-4">Topics</dt>
                        <dd class="col-sm-8">{{ forumStats.topics }}</dd>
                        <dt class="col-sm-4">Posts</dt>
                        <dd class="col-sm-8">{{ forumStats.posts }}</dd>
                        <dt class="col-sm-4">Views</dt>
                        <dd class="col-sm-8">{{ forumStats.views }}</dd>
<!--                        <dt class="col-sm-4">Unique users</dt>-->
<!--                        <dd class="col-sm-8">{{ forum.uniqueUsers }}</dd>-->
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
                        <CreateForumModal :forums="forums" :parent-id="forum.id"/>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-if="childrenForums.length!==0" class="table-responsive mb-1">
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

                <div  v-if="childrenForums.length===0" class="text-center">
                    <h4>Do not children forums.</h4>
                </div>

                <div  v-if="childrenForums.length!==0" class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
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
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";
import ForumOptionTree from "../../components/admin/ForumOptionTree.vue";
import api from "../../api/api";

export default {
    name: "ForumDetails",
    components: {ForumOptionTree, EditForumModal, CreateForumModal},

    setup() {
        return {
            t$: useToast(),
        }
    },

    computed: {
        ...mapGetters({
            forum: 'adminForum/getForum',
            forums: 'adminForum/getForums',
            childrenForums: 'adminForum/getChildrenForums',
            forumStats: 'adminForum/getForumStats',
            parentForum: 'adminForum/getParentForum',
        }),
    },

    mounted() {
        this.$store.dispatch('adminForum/getForum', this.$route.params.id);
        this.getForums();
        this.getForums();

    },

    data() {
        return {
            showSelect: false,
            showChangeType: null,
            selectedForum: null,
            selectedType: null,
        }
    },

    methods: {
        changeVisibility(event) {
            this.$store.dispatch('adminForum/changeForumVisibility', this.$route.params.id)
        },

        deleteForum() {
            this.$store.dispatch('adminForum/deleteForum', this.$route.params.id);
        },

        updateContent(e, key) {
            let value = e.target.innerText
            let data = new FormData();
            data.append(key, value);
            data.append('_method', 'patch');
            this.$store.dispatch('adminForum/updateForumContent', [this.$route.params.id, data]);
        },

        changeParentCategory(){
            console.log("change forum category: ", this.selectedForum);
            //let parentId = this.isChild && this.type!=0 ? this.selectedForum : null;
            this.$store.dispatch('adminForum/changeParentCategory', [this.$route.params.id, this.selectedForum])
        },

        getForums(){
            this.$store.dispatch('adminForum/getForums');
        },

        changeForumType(){
            this.$store.dispatch('adminForum/changeForumType', [this.$route.params.id, this.selectedType]);
        }
    }
}
</script>

<style scoped>

</style>
