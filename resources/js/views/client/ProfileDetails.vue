<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col-xl-6 mb-4">
                <!-- Profile picture card-->
                <div class="card rounded-0 mb-4 mb-xl-0" style="min-height: 162px">
                    <div class="card-header">{{ $t('view.accountDetail.profile') }}</div>
                    <div class="card-body text-center">
                        <div class="d-flex flex-row">
                            <img v-if="userDetails.avatar" class="img-account-profile rounded-circle mb-2"
                                 :src="userDetails.avatar" alt="">
                            <img v-if="!userDetails.avatar" class="img-account-profile rounded-circle mb-2"
                                 src="../../assets/img/default-avatar.png" alt="">
                            <div class="w-100 ms-3">
                                <h4 class="my-1">{{ userDetails.name ?? userDetails.login }}</h4>
                                <div>
                                    <p class="text-muted">{{ userDetails.email }}</p>
                                    <p class="small" v-if="!userDetails.isEmailVerified">Your mail not verified. <a @click.prevent="resendVerifyMail" href="#">Verify?</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="col-xl-6 mb-4">
                <div class="card rounded-0 mb-4 mb-xl-0" style="min-height: 162px">
                    <div class="card-header">{{ $t('view.accountDetail.accountStats') }}</div>
                    <div class="card-body text-center">
                        <div class="row" >
                            <div class="col-4 border-end border-light">
                                <h6 class="text-muted mt-1 mb-2 fw-normal">{{ $t('view.accountDetail.topics') }}</h6>
                                <h3 v-if="userDetails.stats" class="mb-0 fw-bold">{{ userDetails.stats.topics }}</h3>
                            </div>
                            <div class="col-4 border-end border-light">
                                <h6 class="text-muted mt-1 mb-2 fw-normal">{{ $t('view.accountDetail.posts') }}</h6>
                                <h3 v-if="userDetails.stats" class="mb-0 fw-bold">{{ userDetails.stats.posts }}</h3>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted mt-1 mb-2 fw-normal">{{ $t('view.accountDetail.carma') }}</h6>
                                <h3 v-if="userDetails.stats" class="mb-0 fw-bold">{{ userDetails.stats.carma }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="container-fluid">
                <div class="card rounded-0 mb-4">
                    <div class="card-header d-flex justify-content-center">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-topics-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-topics" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">
                                    {{ $t('view.accountDetail.topics') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-posts-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-post" type="button" role="tab" aria-controls="pills-post"
                                        aria-selected="false">{{ $t('view.accountDetail.posts') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-like-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-like" type="button" role="tab" aria-controls="pills-like"
                                        aria-selected="false">Like
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-like-topics-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-like-topics" type="button" role="tab"
                                        aria-controls="pills-like-topics"
                                        aria-selected="false">Like topics
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bookmarks-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bookmarks" type="button" role="tab"
                                        aria-controls="pills-notifications" aria-selected="false">
                                    {{ $t('view.accountDetail.bookmarks') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-post-bookmarks-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-post-bookmarks" type="button" role="tab"
                                        aria-controls="pills-post-bookmarks" aria-selected="false"> Post bookmarks
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">

                            <!-- Topics -->
                            <div class="tab-pane fade show active" id="pills-topics" role="tabpanel" aria-labelledby="pills-topics-tab" tabindex="0">

                                <template  v-if="topics.length!==0" v-for="topic in topics">
                                    <Topic  :topic="topic"/>
                                </template>

                                <div
                                    v-if="(!userDetails.topics && !unapprovedTopic) || (userDetails.topics.length===0  && unapprovedTopic.length===0)"
                                    class="text-center m-1 p-1">
                                    <h5>You haven't created any topics.</h5>
                                </div>
                            </div>

                            <!-- Post -->
                            <div class="tab-pane fade" id="pills-post" role="tabpanel" aria-labelledby="pills-post-tab"
                                 tabindex="0">

                                <Post v-if="posts.length!==0" v-for="post in posts" :post="post"/>

                                <div v-if="posts.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't written a post.</h5>
                                </div>
                            </div>

                            <!-- TODO: доделать -->
                            <!-- Liked posts  -->
                            <div class="tab-pane fade" id="pills-like" role="tabpanel" aria-labelledby="pills-like-tab"
                                 tabindex="0">
                                <Post v-if="likes.length!==0" v-for="like in likes" :post="like"/>
                                <div v-if="likes.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't liked posts or topics.</h5>
                                </div>
                            </div>

                            <!-- Liked topics  -->
                            <div class="tab-pane fade" id="pills-like-topics" role="tabpanel"
                                 aria-labelledby="pills-like-topics-tab"
                                 tabindex="0">
                                <Topic v-if="likedTopics.length!==0" v-for="topic in likedTopics" :topic="topic"/>
                                <div v-if="likedTopics.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't added any topics to your bookmarks list.</h5>
                                </div>
                            </div>

                            <!-- Topic Bookmarks -->
                            <div class="tab-pane fade" id="pills-bookmarks" role="tabpanel"
                                 aria-labelledby="pills-bookmarks-tab" tabindex="0">
                                <Topic v-if="topicBookmarks.length!==0" v-for="topic in topicBookmarks" :topic="topic"/>
                                <div v-if="topicBookmarks.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't added any topics to your bookmarks list.</h5>
                                </div>
                            </div>

                            <!-- Post Bookmarks -->
                            <div class="tab-pane fade" id="pills-post-bookmarks" role="tabpanel"
                                 aria-labelledby="pills-post-bookmarks-tab" tabindex="0">
                                <!-- item -->
                                <template v-if="postBookmarks.length!==0" v-for="post in postBookmarks">
                                    <Post :post="post"/>
                                </template>
                                <div v-if="postBookmarks.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't added any posts to your bookmarks list.</h5>
                                </div>
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
import Post from "../../components/client/Post.vue";
import Topic from "../../components/client/Topic.vue";
import UnapprovedTopic from "../../components/client/UnapprovedTopic.vue";

export default {
    name: 'ProfileDetails',
    components: {UnapprovedTopic, Topic, Post},

    computed: {
        ...mapGetters({
            userDetails: 'auth/userDetails',
            topics: 'profile/getTopics',
            // unapprovedTopic: 'profile/getUnapprovedTopic',
            posts: 'profile/getPosts',
            likes: 'profile/getLikes',
            likedTopics: 'profile/getLikedTopics',
            postBookmarks: 'profile/getPostBookmarks',
            topicBookmarks: 'profile/getTopicBookmarks',
        }),
    },

    methods: {
        resendVerifyMail(){
            this.$store.dispatch('auth/resendVerifyMail');
        }
    }
}
</script>

<style scoped>
.img-account-profile {
    height: 4rem;
}

h6 {
    font-size: 0.9em;
}
</style>
