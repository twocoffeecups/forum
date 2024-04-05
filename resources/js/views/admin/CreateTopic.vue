<template>
    <div class="row">
        <div class="mx-auto col-md-12">
            <div class="card rounded-0 mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Create topic</h4>
                </div>
                <div class="card-body p-2">
                    <!-- Create topic form -->
                    <div class="row">
                        <div class="col-12">
                            <!-- Topic preview -->
                            <TopicPreview :title="topic.title" :content="topic.content" :category="topic.selectCategory"
                                          :tags="topic.selectedTags"/>

                            <!-- Form -->
                            <form class="container pe-2">
                                <!-- Title -->
                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="topic.title" name="title"
                                               id="title">
                                    </div>
                                </div>

                                <!-- Topic type -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Topic type</label>
                                    <div class="col-sm-10">
                                        <select v-model="topic.type" class="form-select">
                                            <option value="1">The administration topic</option>
                                            <option value="0">The usual topic</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Prohibits comment -->
                                <div class="mb-3 row" v-if="topic.type==1">
                                    <label for="closeComments" class="col-sm-2 col-form-label">Close the comments</label>
                                    <div class="col">
                                        <input v-model="topic.closeComments" class="form-check-input mt-2" type="checkbox" id="closeComments">
                                    </div>
                                </div>

                                <!-- Categories tree -->
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Select forum category</label>
                                    <div class="col-sm-10">
                                        <div class="tree-menu card">
                                            <div role="button" @click.prevent="toggleCategoryTree" class="card-header p-2 text-center">
                                                Select category.
                                            </div>
                                            <CategoryTree v-if="showCategoryTree"
                                                          @selectCategoryEmit="selectCategoryEmit"
                                                          v-for="category in categories"
                                                          :is-selected="topic.selectCategory.id" :name="category.name"
                                                          :root="category.root" :id="category.id"
                                                          :children="category.children" :indent="0"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="mb-3 row">
                                    <label for="tags" class="col-sm-2 col-form-label">Select topic tags</label>
                                    <div class="col-sm-10">
                                        <VueMultiselect
                                            id="tags"
                                            v-model="selectedTags"
                                            :options="tags"
                                            :multiple="true"
                                            :close-on-select="false"
                                            placeholder="Add tags to the topic."
                                            label="option"
                                            track-by="option"
                                        />
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-5 row">
                                    <label for="description" class="col-sm-2 col-form-label">Topic content</label>
                                    <div class="col-sm-10 mb-3">
                                        <QuillEditor v-model:content="topic.content" contentType="html" id="description"
                                                     theme="snow"/>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3 row">
                                    <label for="published" class="col-sm-2 col-form-label">Published</label>
                                    <div class="col">
                                        <input v-model="topic.status" class="form-check-input mt-2" type="checkbox" id="published">
                                    </div>
                                </div>

                                <!-- Private -->
                                <div class="mb-3 row">
                                    <label for="private" class="col-sm-2 col-form-label">Private</label>
                                    <div class="col">
                                        <input v-model="topic.private" class="form-check-input mt-2" type="checkbox" id="private">
                                    </div>
                                </div>

                                <!-- Users -->
                                <div v-if="topic.private" class="mb-3 row">
                                    <label for="users" class="col-sm-2 col-form-label">Add users</label>
                                    <div class="col">
                                        <VueMultiselect
                                            id="users"
                                            v-model="topic.selectedUsers"
                                            :options="users"
                                            :multiple="true"
                                            :close-on-select="false"
                                            placeholder="Add users."
                                            label="name"
                                            track-by="name"
                                        />
                                    </div>
                                </div>

                                <!-- Dropzone -->
                                <div class="mb-3 row">
                                    <label for="images" class="col-sm-2 col-form-label">Images</label>
                                    <div class="col-sm-10">
                                            <span ref="dropzone" class="btn btn-primary"
                                                  id="images">Upload images</span>

                                        <div ref="dropzone-preview-content"
                                             class="row dropzone-container mt-2 mb-2">

                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row my-2 pe-2 mx-auto">
                        <div class="col-md-12 d-flex justify-content-sm-end justify-content-center">
                            <div class="btn-group">
                                <button @click.prevent="createTopic" class="btn btn-primary">
                                    Create
                                </button>
                                <button @click.prevent="togglePreviewContainer" class="btn btn-secondary">
                                    Preview
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import TopicPreview from "../../components/client/TopicPreview.vue";
import CategoryTree from "../../components/client/CategoryTree.vue";
import Dropzone from "dropzone";
import VueMultiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";
import api from "../../api/api";

export default {
    name: "ForumDetail",
    components: {CategoryTree, TopicPreview, VueMultiselect},

    computed: {
        ...mapGetters({
            notifications: 'auth/getNotifications',
            categories: 'createTopic/getForumTree',
        })
    },

    mounted() {
        this.$store.dispatch('createTopic/getTopicFormResources');
        this.getUsers();
        this.getTags();
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: '/',
            maxFiles: 9,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            autoProcessQueue: false,
            previewsContainer: this.$refs["dropzone-preview-content"],
            previewTemplate: this.dropzonePreviewTemplate,
            maxfilesexceeded: function (file) {
                this.removeFile(file)
            },
            init: function () {
                this.on("addedfile", (file) => {
                    let elem = document.querySelector('.dz-template-container')
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => {
                        elem.innerHTML += "<img id='img-uuid-" + file.upload.uuid + "'  src='" + reader.result + "' class='mt-1' style='max-width: 600px'>"
                    };
                });
                this.on("removedfile", (file) => {
                    let removeElem = document.getElementById('img-uuid-' + file.upload.uuid)
                    removeElem.remove()
                });
            },
        });
    },

    data() {
        return {
            topic: {
                title: null,
                content: null,
                forumId: null,
                selectCategory: [],
                type: 1,
                closeComments: false,
                status: false,
                private: false,
                selectedUsers: [],
            },

            users: [],
            title: null,
            content: null,
            selectCategory: [],
            selectedTags: [],
            tags: [],

            dropzone: null,
            showCategoryTree: false,
            dropzonePreviewTemplate: "<div class='dz-preview dz-file-preview m-1'>\n" +
                "  <div class=\"dz-details\" style='position: relative'>\n" +
                "    <img class='rounded-4 dz-img' data-dz-thumbnail />\n" +
                "    <div class='dz-delete-btn-container'>" +
                "       <span role='button' class='dz-delete-btn' data-dz-remove><i class=\"far fa-times-circle\"></i></span>" +
                "       <span class='dz-size' data-dz-size></span>" +
                "    </div>\n" +
                "  </div>\n" +

                "  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n" +
                "</div>",
        }
    },

    methods: {
        togglePreviewContainer() {
            let elem = document.querySelector('.preview-container');
            elem.classList.toggle('hide');
        },

        toggleCategoryTree() {
            this.showCategoryTree = !this.showCategoryTree
        },

        selectCategoryEmit(data) {
            this.topic.selectCategory = data;
            this.topic.forumId = data.id;
        },

        createTopic() {
            let data = new FormData();
            let images = this.dropzone.getAcceptedFiles();
            if(images.length>6){
                this.t$.error('You cannot upload more than 3 files in one message.');
                return false;
            }
            for (let [key, value] of Object.entries(this.topic)){
                data.append(key, value);
            }
            images.forEach((image) => {
                data.append('images[]', image);
            })
            let tags = this.selectedTags;
            tags.forEach((tag) => {
                data.append('tags[]', tag.value)
            })
            this.topic.selectedUsers.forEach((user) => {
                data.append('selectedUsers[]', user.value)
            })
            this.topic.closeComments===true ? data.append('closeComments', 1) : data.append('closeComments', 0)
            this.topic.status===true ? data.append('status', 1) : data.append('status', 0);
            this.topic.private===true ? data.append('private', 1) : data.append('private', 0)
            this.$store.dispatch('adminTopic/createTopic', data);
        },

        getTags() {
            axios.get('/api/client/topic/tags')
                .then(response => {
                    if (response.data) {
                        this.tags = response.data.tags;
                    }
                })
        },

        getUsers(){
            api.get('/api/admin/topic/get-users')
                .then(response => {
                    this.users = response.data.users
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
.hide-preview {
    display: none;
}
</style>
