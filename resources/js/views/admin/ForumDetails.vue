<template>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Forum details</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Name</b>
                        </div>
                        <div class="col-7">
                            <span contenteditable @focusout.prevent="updateContent($event, 'name')">{{
                                    forum.name
                                }}
                            </span>
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Type</b>
                        </div>
                        <div class="col-7">
                            <div class="d-flex justify-content-between">
                                <span>{{ forum.type===0 ? 'Category' : 'Forum' }}</span>
                                <span role="button" class="fa-pull-right text-primary mx-2"
                                      @click="this.showChangeType = !this.showChangeType">
                                    Change <i class="fas fa-arrow-down"></i>
                                </span>
                            </div>
                            <div id="type-changed-field" v-if="showChangeType" class="d-flex flex-row">
                                <select v-model="forum.type" class="form-select fa-pull-right my-2">
                                    <option :selected="forum.type==0" value="0">Category</option>
                                    <option :selected="forum.type==1" value="1">Forum</option>
                                </select>
                                <div>
                                <span @click="changeForumType" role="button" class="text-primary mx-2 fs-4" title="Save">
                                    <i class="fas fa-save"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="forum.type===1" class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Parent</b>
                        </div>
                        <div class="col-7">
                            <div class="d-flex justify-content-between">
                                <span v-if="parentForum!==null">{{ parentForum.name }}</span>
                                <span v-if="parentForum===null">Not parent forum</span>

                                <span role="button" class="fa-pull-right text-primary mx-2"
                                      @click="this.showSelect = !this.showSelect">
                                    Change <i class="fas fa-arrow-down"></i>
                                </span>
                            </div>
                            <div v-if="showSelect" class="d-flex flex-row">
                                <select v-model="selectedForum" class="form-select fa-pull-right my-2">
                                    <!--                                    <ForumOptionTree v-for="forumOption in forums" :is-selected="parentForum.id" :name="forumOption.name" :id="forumOption.id" :forum-id="forum.id" :children="forumOption.children" :indent="0" />-->
                                    <ForumOptionTree v-for="forumOption in forums" :name="forumOption.name" :id="forumOption.id" :forum-id="forum.id" :children="forumOption.children" :indent="0" />
                                </select>
                                <div>
                                    <span @click="changeParentCategory" role="button" class="text-primary mx-2 fs-4" title="Save">
                                        <i class="fas fa-save"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Author</b>
                        </div>
                        <div class="col-7">
                            {{ forum.author }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Created AT</b>
                        </div>
                        <div class="col-7">
                            {{ forum.created_at }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Change status</b>
                        </div>
                        <div class="col-7">
                            <div class="btn-group btn-group-sm" role="group"
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
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Actions</b>
                        </div>
                        <div class="col-7">
                            <button @click.prevent="deleteForum" class="btn btn-danger bg-gradient">Delete</button>

                            <a v-if="forum.type===1" :href="`/forum/${this.$route.params.id}`" class="btn btn-primary bg-gradient mx-1">Show on site</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Forum stats</h4>
                </div>
                <div class="card-body">
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Forums</b>
                        </div>
                        <div class="col-7">
                            {{ forumStats.children }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Topics</b>
                        </div>
                        <div class="col-7">
                            {{ forumStats.topics }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Posts</b>
                        </div>
                        <div class="col-7">
                            {{ forumStats.posts }}
                        </div>
                    </div>
                    <div class="row align-items-start mb-2">
                        <div class="col-5">
                            <b>Views</b>
                        </div>
                        <div class="col-7">
                            {{ forumStats.views }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
            <div class="card mb-3" style="border-top: 5px solid green">
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
                                        <div class="d-flex justify-content-around">
                                            <EditForumModal :id="forum.id" :forum-name="forum.name"
                                                            :forum-description="forum.description"/>

                                            <button @click="deleteForum(forum.id)" class="btn btn-danger mx-2" title="Edit">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div  v-if="childrenForums.length===0" class="text-center">
                        <h4>Do not children forums.</h4>
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
        }
    },

    methods: {
        changeVisibility() {
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
            //let parentId = this.isChild && this.type!=0 ? this.selectedForum : null;
            this.$store.dispatch('adminForum/changeParentCategory', [this.$route.params.id, this.selectedForum])
        },

        getForums(){
            this.$store.dispatch('adminForum/getForums');
        },

        changeForumType(){
            this.$store.dispatch('adminForum/changeForumType', [this.$route.params.id, this.forum.type]);
        }
    }
}
</script>

<style scoped>

</style>
