<template>
    <div class="row">
        <div class="col-md-5">
            <!-- Forum general settings -->
            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>General settings</h4>
                </div>
                <div class="card-body">
                    <!-- Forum name -->
                    <div class="mb-3 row">
                        <label for="forum-name" class="col-sm-2 h5">Forum name:</label>
                        <div class="col-sm-10">
                            <div class="mb-2">
                                <input type="text" v-if="forumName" v-model="forumName.value" class="form-control" id="forum-name">
                            </div>
                            <div class="mt-1">
                                <button @click.prevent="changeForumName" class="btn btn-primary bg-gradient" type="button" id="addName">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="forum-name" class="col-sm-2 h5">Show only logo:</label>
                        <div class="col-sm-10">
                            <input v-model="showOnlyLogo.value" class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="text-muted text-small mx-2" for="flexCheckChecked">
                                Name will not be displayed in the forum's header.
                            </label>
                            <div class="mt-1">
                                <button @click.prevent="changeShowSiteName" class="btn btn-primary bg-gradient" type="button" id="addName">Save</button>
                            </div>
                        </div>
                    </div>
                    <!-- Meta -->
                    <div class="mb-3 row">
                        <label for="meta-keywords" class="col-sm-2 h5">Meta:</label>
                        <div class="col-sm-10">
                            <!-- Description -->
                            <div class="form-floating mb-2">
                                <input type="text" v-if="meta" v-model="meta.description" class="form-control" id="meta-description" placeholder="Max range - 255">
                                <label for="meta-description" class="text-muted">Description</label>
                            </div>
                            <!-- Keywords -->
                            <div class="form-floating mb-2">
                                <input type="text" v-if="meta" v-model="meta.keywords" class="form-control" id="meta-keywords" placeholder="Max range - 255">
                                <label for="meta-keywords" class="text-muted">Keywords</label>
                            </div>
                            <div class="">
                                <button @click.prevent="changeMeta" class="btn btn-primary bg-gradient">Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <!-- Logo -->
            <div class="card mb-3" style="border-top: 5px solid green">
                <div class="card-header">
                    <h4>Upload new logo:</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 h5">Logo:</label>
                        <div class="col-sm-10">
                            <div class=" input-group">
                                <input @change="addLogo" type="file" class="form-control" id="logo"
                                       aria-describedby="updateLogo" aria-label="Upload">
                                <button :disabled="logo==null" @click.prevent="updateLogo" class="btn btn-primary bg-gradient" type="button" id="updateLogo">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2 ">
                            <label for="inputPassword" class="h5">Image info:</label>
                            <ul v-if="currentLogo" class="list-unstyled mt-3">
                                <li><b>Name</b>: {{ currentLogo.data.imageName }}</li>
                                <li><b>Dir</b>: {{ currentLogo.data.imagePath }}</li>
                                <li><b>Uploaded</b>:  {{ currentLogo.updated_at }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-10 d-flex justify-content-center">
                            <div>
                                <img v-if="currentLogo" :src="currentLogo.data.imageUrl" class="img-fluid">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <!-- Topics and Posts settings -->
            <div class="card mb-3" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Topics and Posts settings</h4>
                </div>
                <div class="card-body">
                    <!-- Max topics on page -->
                    <div class="mb-3 row">
                        <label for="topic-post-on-page" class="col-sm-2 h5">Topics on page:</label>
                        <div class="col-sm-10">
                            <div class="mb-2">
                                <input v-if="topicsOnPage" v-model="topicsOnPage.value" type="number" min="10" max="50" class="form-control" id="topic-post-on-page">
                            </div>
                            <div class="">
                                <button @click.prevent="changeTopicsOnPage" class="btn btn-primary bg-gradient" type="button" id="addName">Save</button>
                            </div>
                        </div>
                    </div>
                    <!-- Max posts on page -->
                    <div class="mb-3 row">
                        <label for="topic-post-on-page" class="col-sm-2 h5">Posts on page:</label>
                        <div class="col-sm-10">
                            <div class="mb-2">
                                <input v-if="postsOnPage" v-model="postsOnPage.value" type="number" min="10" max="50" class="form-control" id="topic-post-on-page">
                            </div>
                            <div class="">
                                <button @click.prevent="changePostsOnPage" class="btn btn-primary bg-gradient" type="button" id="addName">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <!-- Background -->
            <div class="card mb-3" style="border-top: 5px solid green">
                <div class="card-header">
                    <h4>Background</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="forum-background" class="col-sm-2 h5">Forum background:</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input @change="addBackground" type="file" class="form-control" id="forum-background"
                                       aria-describedby="addBackground" aria-label="Upload">
                                <button :disabled="background==null" @click.prevent="updateBackground" class="btn btn-primary bg-gradient" type="button" id="addBackground">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2 ">
                            <label for="inputPassword" class="h5">Image info:</label>
                            <ul v-if="currentBackground" class="list-unstyled mt-3">
                                <li><b>Name</b>: {{ currentBackground.data.imageName }}</li>
                                <li><b>Dir</b>: {{ currentBackground.data.imagePath }}</li>
                                <li><b>Uploaded</b>: {{ currentBackground.updated_at }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-10 d-flex justify-content-center">
                            <div>
                                <img v-if="currentBackground" :src="currentBackground.data.imageUrl" class="img-fluid">
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

export default {
    name: "Settings",

    data() {
        return {
            logo: null,
            background: null,
        }
    },

    created() {
        this.$store.dispatch('adminSettings/getSettings');
    },

    computed: {
        ...mapGetters({
            forumName: 'adminSettings/getForumName',
            showOnlyLogo: 'adminSettings/getShowOnlyLogo',
            meta: 'adminSettings/getMeta',
            currentLogo: 'adminSettings/getLogo',
            currentBackground: 'adminSettings/getBackground',
            postsOnPage: 'adminSettings/getPostsOnPage',
            topicsOnPage: 'adminSettings/getTopicsOnPage',
        })
    },

    methods: {
        changeForumName(){
            this.$store.dispatch('adminSettings/changeForumName', this.forumName.value);
        },

        changeMeta(){
            this.$store.dispatch('adminSettings/changeMeta', [this.meta.description, this.meta.keywords]);
        },

        addLogo(event){
            this.logo = event.target.files[0];
        },

        changePostsOnPage(){
            this.$store.dispatch('adminSettings/changePostsOnPage', this.postsOnPage.value);
        },

        changeTopicsOnPage(){
            this.$store.dispatch('adminSettings/changeTopicsOnPage', this.topicsOnPage.value);
        },

        updateLogo(){
            const data = new FormData();
            data.append('logo', this.logo);
            data.append('_method', 'patch');
            this.$store.dispatch('adminSettings/updateLogo', data);
        },

        addBackground(event){
            this.background = event.target.files[0];
        },

        updateBackground(){
            const data = new FormData();
            data.append('background', this.background);
            data.append('_method', 'patch');
            this.$store.dispatch('adminSettings/updateBackground', data);
        },

        changeShowSiteName(){
            this.$store.dispatch('adminSettings/changeShowSiteName', this.showOnlyLogo.value);
        }
    }
}
</script>

<style scoped>

</style>
