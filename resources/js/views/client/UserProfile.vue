<template>

    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-lg-9 mb-3">


                <div class="container px-4 mt-2">

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 mb-4">
                                <!-- Profile picture card-->
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">{{ $t('view.accountDetail.profile') }}</div>
                                    <div class="card-body text-center">
                                        <div class="d-flex flex-row">
                                            <img class="img-account-profile rounded-circle mb-2"
                                                 :src="userDetails.avatar" alt="">

                                            <div class="w-100 ms-3">
                                                <h4 class="my-1">{{ userDetails.name ?? userDetails.login }}</h4>
                                                <p class="text-muted">{{ userDetails.email }}</p>
                                                <p>Register: {{ userDetails.register_at }} </p>
                                            </div>
                                        </div>
                                        <!-- Profile picture image-->

                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="card mt-3 mb-4 mb-xl-0">
                                    <div class="card-header">{{ $t('view.accountDetail.accountStats') }}</div>
                                    <div class="card-body text-center">
                                        <div class="row">
                                            <div class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <div class="col-4 border-end border-light">
                                                    <h6 class="text-muted mt-1 mb-2 fw-normal">
                                                        {{ $t('view.accountDetail.topics') }}</h6>
                                                    <h3 class="nav-btn" id="pills-user-topics-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-user-topics" type="button" role="tab"
                                                        aria-controls="pills-user-topics" aria-selected="false">
                                                        <span class="mb-0 h3 fw-bold">{{ userStats.topics }}</span>
                                                    </h3>
                                                </div>
                                                <div class="col-4 border-end border-light">
                                                    <h6 class="text-muted mt-1 mb-2 fw-normal">
                                                        {{ $t('view.accountDetail.posts') }}</h6>
                                                    <h3 class="nav-btn" id="pills-user-posts-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-user-posts" type="button" role="tab"
                                                        aria-controls="pills-user-posts" aria-selected="false">
                                                        <span class="mb-0 h3 fw-bold">{{ userStats.posts }}</span>
                                                    </h3>
                                                </div>
                                                <div class="col-4">
                                                    <h6 class="text-muted mt-1 mb-2 fw-normal">
                                                        {{ $t('view.accountDetail.carma') }}</h6>
                                                    <h3 class="mb-0 fw-bold">{{ userStats.carma }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card mt-3 mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade" id="pills-user-topics" role="tabpanel"
                                                     aria-labelledby="pills-user-topics-tab" tabindex="0">
                                                    <Topic v-if="topics.length!==0" v-for="topic in topics"
                                                           :topic="topic"/>
                                                    <Pagination v-if="topicsPaginate.last_page > 1"
                                                                @selectPageEmit="selectTopicPage"
                                                                :total-pages="topicsPaginate.last_page"
                                                                :links="topicsPaginate.links"
                                                                :id="this.$route.params.id"
                                                                :current-page="topicsPaginate.current_page"
                                                                :last-page="topicsPaginate.last_page"/>

                                                    <div v-if="topics.length===0" class="text-center m-1 p-1">
                                                        <h5>You haven't created any topics.</h5>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="pills-user-posts" role="tabpanel"
                                                     aria-labelledby="pills-user-posts-tab"
                                                     tabindex="0">
                                                    <Post v-if="posts.length!==0" v-for="like in posts" :post="like"/>
                                                    <Pagination v-if="postsPaginate.last_page > 1"
                                                                @selectPageEmit="selectPostPage"
                                                                :total-pages="postsPaginate.last_page"
                                                                :links="postsPaginate.links"
                                                                :id="this.$route.params.id"
                                                                :current-page="postsPaginate.current_page"
                                                                :last-page="postsPaginate.last_page"/>
                                                    <div v-if="posts.length===0" class="text-center m-1 p-1">
                                                        <h5>You haven't liked posts or topics.</h5>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
import {mapGetters} from "vuex";
import Sidebar from "../../components/client/Sidebar.vue";
import UnapprovedTopic from "../../components/client/UnapprovedTopic.vue";
import Topic from "../../components/client/Topic.vue";
import Post from "../../components/client/Post.vue";
import Pagination from "../../components/client/Pagination.vue";

export default {
    name: 'ProfileDetails',
    components: {Pagination, Post, Topic, UnapprovedTopic, Sidebar},

    computed: {
        ...mapGetters({
            userDetails: 'userProfile/getUserDetails',
            userStats: 'userProfile/getUserStats',
            topics: 'userProfile/getTopics',
            topicsPaginate: 'userProfile/getTopicPaginate',
            posts: 'userProfile/getPosts',
            postsPaginate: 'userProfile/getPostPaginate',
        }),
    },

    data() {
        return{
            showCard: false,
        }
    },

    mounted() {
        this.$store.dispatch('userProfile/getUserProfile', this.$route.params.id);
        this.getUserPosts();
        this.getUserTopics();
    },

    methods: {
        getUserPosts() {
            this.$store.dispatch('userProfile/getUserPosts', this.$route.params.id);
        },

        getUserTopics() {
            this.$store.dispatch('userProfile/getUserTopics', this.$route.params.id);
        },

        selectTopicPage(page) {
            this.$store.dispatch('userProfile/getUserTopics', [this.$route.params.id, page]);
        },

        selectPostPage(page) {
            this.$store.dispatch('userProfile/getUserPosts', [this.$route.params.id, page]);
        },
    }
}
</script>

<style scoped>
.img-account-profile {
    height: 4rem;
}

.nav-btn {
    color: #0a53be;
}
</style>
