<template>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 mb-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">{{ $t('view.accountDetail.profile') }}</div>
                    <div class="card-body text-center">
                        <div class="d-flex flex-row">
                            <img class="img-account-profile rounded-circle mb-2"
                                 :src="userDetails.avatar" alt="">

                            <div class="w-100 ms-3">
                                <h4 class="my-0">{{ userDetails.name ?? userDetails.login }}</h4>
                                <p class="text-muted">{{ userDetails.email }}</p>
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
                            <div class="col-4 border-end border-light">
                                <h6 class="text-muted mt-1 mb-2 fw-normal">{{ $t('view.accountDetail.topics') }}</h6>
                                <h3 class="mb-0 fw-bold">{{ userDetails.stats.topics }}</h3>
                            </div>
                            <div class="col-4 border-end border-light">
                                <h6 class="text-muted mt-1 mb-2 fw-normal">{{ $t('view.accountDetail.posts') }}</h6>
                                <h3 class="mb-0 fw-bold">{{ userDetails.stats.posts }}</h3>
                            </div>
                            <div class="col-4">
                                <h6 class="text-muted mt-1 mb-2 fw-normal">{{ $t('view.accountDetail.carma') }}</h6>
                                <h3 class="mb-0 fw-bold">{{ userDetails.stats.carma }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <!-- Activity -->
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link  active" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-topic" type="button" role="tab"
                                        aria-controls="pills-topic" aria-selected="true">
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
                                        aria-selected="false"> Like
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
                            <div class="tab-pane fade" id="pills-topic" role="tabpanel"
                                 aria-labelledby="pills-topic-tab" tabindex="0">
                                <Topic  v-if="topics.length!==0" v-for="topic in topics" :topic="topic" />
                                <div v-if="userDetails.topics.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't created any topics.</h5>
                                </div>
                            </div>

                            <!-- Post -->
                            <div class="tab-pane fade" id="pills-post" role="tabpanel" aria-labelledby="pills-post-tab"
                                 tabindex="0">

                                <Post v-if="posts.length!==0" v-for="post in posts" :post="post" />

                                <div v-if="posts.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't written a post.</h5>
                                </div>
                            </div>

                            <!-- TODO: доделать -->
                            <!-- Liked  -->
                            <div class="tab-pane fade" id="pills-like" role="tabpanel" aria-labelledby="pills-like-tab"
                                 tabindex="0">
                                <Post v-if="likes.length!==0" v-for="like in likes" :post="like" />
                                <div v-if="likes.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't liked posts or topics.</h5>
                                </div>
                            </div>

                            <!-- Topic Bookmarks -->
                            <div class="tab-pane fade" id="pills-bookmarks" role="tabpanel"
                                 aria-labelledby="pills-bookmarks-tab" tabindex="0">
                                <Topic  v-if="topicBookmarks.length!==0" v-for="topic in topicBookmarks" :topic="topic" />
                                <div v-if="topicBookmarks.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't added any topics to your bookmarks list.</h5>
                                </div>
                            </div>

                            <!-- Post Bookmarks -->
                            <div class="tab-pane fade" id="pills-post-bookmarks" role="tabpanel"
                                 aria-labelledby="pills-post-bookmarks-tab" tabindex="0">
                                <!-- item -->
                                <template v-if="postBookmarks.length!==0" v-for="post in postBookmarks">
                                    <Post :post="post" />
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

export default {
    name: 'ProfileAccount',
    components: {Topic, Post},

    computed:{
        ...mapGetters({
            userDetails: 'auth/userDetails',
            topics: 'profile/getTopics',
            posts: 'profile/getPosts',
            likes: 'profile/getLikes',
            postBookmarks: 'profile/getPostBookmarks',
            topicBookmarks: 'profile/getTopicBookmarks',
        }),
    },
}
</script>

<style scoped>
.img-account-profile {
    height: 4rem;
}
</style>
