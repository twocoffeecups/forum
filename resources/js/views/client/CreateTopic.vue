<template>
    <div class="container">

        <div class="row">
            <!-- Main content -->
            <div class="col-lg-9 mb-3">

                <div class="card py-4">
                    <!-- Create topic form -->
                    <div class="container mt-2">
                        <div class="row">

                            <div class="col-12">
                                <div class="row text-center mb-3">
                                    <h3>{{ $t('view.createTopic.create') }}</h3>
                                </div>

                                <!-- Topic preview -->
                                <TopicPreview :title="topic.title" :content="topic.content" :category="topic.selectCategory"
                                              :tags="topic.selectedTags"/>

                                <!-- Form -->
                                <form class="container pe-2">
                                    <!-- Title -->
                                    <div class="row mb-3">
                                        <label for="title" class="col-sm-2 col-form-label">{{
                                                $t('view.createTopic.title')
                                            }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" v-model="topic.title" name="title"
                                                   id="title">
                                        </div>
                                    </div>

                                    <!-- Categories tree -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label">{{
                                                $t('view.createTopic.category')
                                            }}</label>
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
                                        <label for="tags" class="col-sm-2 col-form-label">{{
                                                $t('view.createTopic.tags')
                                            }}</label>
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
                                        <label for="description" class="col-sm-2 col-form-label">{{
                                                $t('view.createTopic.description')
                                            }}</label>
                                        <div class="col-sm-10 mb-3">
                                            <QuillEditor v-model:content="topic.content" contentType="html" id="description"
                                                         theme="snow"/>
                                        </div>
                                    </div>

                                    <!-- Dropzone -->
                                    <div class="mb-3 row">
                                        <label for="images" class="col-sm-2 col-form-label">{{
                                                $t('view.createTopic.images')
                                            }}</label>
                                        <div class="col-sm-10">
                                            <span ref="dropzone" class="btn btn-primary"
                                                  id="images">Upload images</span>

                                            <div ref="dropzone-preview-content"
                                                 class="row dropzone-container mt-2 mb-2">

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Files -->
                                    <!--                  <div class="mb-3 row">-->
                                    <!--                    <label for="files" class="col-sm-2 col-form-label">{{ $t('view.createTopic.files') }}</label>-->
                                    <!--                    <div class="col-sm-10">-->
                                    <!--                      <input disabled type="file" class="form-control" id="files">-->
                                    <!--                    </div>-->
                                    <!--                  </div>-->

                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row my-2 pe-2 mx-auto">
                        <div class="col-md-12 d-flex justify-content-sm-end justify-content-center">
                            <div class="btn-group">
                                <button @click.prevent="createTopic" class="btn btn-primary">
                                    {{ $t('view.createTopic.create') }}
                                </button>
                                <button @click.prevent="togglePreviewContainer" class="btn btn-secondary">
                                    {{ $t('view.createTopic.preview') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar content -->
            <div class="col-lg-3 ml-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                <Sidebar/>
            </div>

        </div>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

import Sidebar from "../../components/client/Sidebar.vue";
import Dropzone from 'dropzone';
import Emoji from "../../components/client/Emoji.vue";
import TopicPreview from "../../components/client/TopicPreview.vue";
import CategoryTree from "../../components/client/CategoryTree.vue";
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";
export default {
    name: "CreateTopic",
    components: {CategoryTree, TopicPreview, Emoji, Sidebar, VueMultiselect},

    setup() {
        return {
            t$: useToast(),
        }
    },

    computed: {
        ...mapGetters({
            categories: 'createTopic/getForumTree',
        }),
    },

    mounted() {
        this.$store.dispatch('createTopic/getTopicFormResources');
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

            title: null,
            content: null,
            selectCategory: [],
            selectedTags: [],
            tags: [],

            topic: {
                title: null,
                content: null,
                forumId: null,
                selectCategory: [],
            },
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

            this.$store.dispatch('createTopic/createTopic', data);
        },

        // TODO: переделать в getter
        getTags(){
            axios.get('/api/client/topic/tags')
                .then(response => {
                    if(response.data){
                        this.tags = response.data.tags;
                    }
                })
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
.hide-preview {
    display: none;
}
</style>
