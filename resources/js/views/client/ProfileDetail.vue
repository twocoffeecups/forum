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
                                <Topic  v-if="userDetails.topics.length!==0" v-for="topic in userDetails.topics" :topic="topic" />
                                <div v-if="userDetails.topics.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't created any topics.</h5>
                                </div>
                            </div>

                            <!-- Post -->
                            <div class="tab-pane fade" id="pills-post" role="tabpanel" aria-labelledby="pills-post-tab"
                                 tabindex="0">

                                <Post v-if="userDetails.posts.length!==0" v-for="post in userDetails.posts" :post="post" />

                                <div v-if="userDetails.posts.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't written a post.</h5>
                                </div>
                            </div>

                            <!-- TODO: доделать -->
                            <!-- Liked  -->
                            <div class="tab-pane fade" id="pills-like" role="tabpanel" aria-labelledby="pills-like-tab"
                                 tabindex="0">
                                <div class="card">
                                    <div class="row g-0">
                                        <div class="col-md-3">
                                            <div class="card-header h-100">
                                                <div class="media flex-wrap w-100 align-items-center"><img
                                                    src="https://i.imgur.com/iNmBizf.jpg"
                                                    class="d-block ui-w-40 rounded-circle" alt="">
                                                    <div class="media-body ml-3"><a href="javascript:void(0)"
                                                                                    data-abc="true">Tod Howard</a>
                                                        <div class="text-muted small">Offline</div>
                                                    </div>
                                                    <div class="text-muted small ml-3">
                                                        <div>Register date <strong>01/1/2019</strong></div>
                                                        <div><strong>134</strong> Messages</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <p class="card-text text-muted"><small class="text-muted">Last updated 3
                                                    mins ago</small></p>

                                                <p class="card-text">
                                                    For me, getting my business website made was a lot of tech wizardry
                                                    things.
                                                    Thankfully i get an ad on Facebook ragarding commence website.
                                                    I get connected with BBB team. They made my stunning website live in
                                                    just 3 days.
                                                    With the increase demand of online customers. I had to take my
                                                    business online.
                                                    BBB Team guided me at each step and enabled me to centralise my work
                                                    and have control on all aspect of my online business.
                                                </p>

                                                <div class="mt-2 d-flex justify-content-between">
                                                    <div class="d-flex">
                                                        <button class="btn btn-xs text-muted has-icon"><i
                                                            class="fa fa-heart" aria-hidden="true"></i>1
                                                        </button>
                                                        <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                                                            <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle">14532</span>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <button class="btn btn-sm btn-danger mx-1">Complain</button>
                                                        <button class="btn btn-sm btn-secondary mx-1">Reply</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Topic Bookmarks -->
                            <div class="tab-pane fade" id="pills-bookmarks" role="tabpanel"
                                 aria-labelledby="pills-bookmarks-tab" tabindex="0">
                                <Topic  v-if="userDetails.topicBookmarks.length!==0" v-for="topic in userDetails.topicBookmarks" :topic="topic" />
                                <div v-if="userDetails.topicBookmarks.length===0" class="text-center m-1 p-1">
                                    <h5>You haven't added any topics to your bookmarks list.</h5>
                                </div>
                            </div>

                            <!-- Post Bookmarks -->
                            <div class="tab-pane fade" id="pills-post-bookmarks" role="tabpanel"
                                 aria-labelledby="pills-post-bookmarks-tab" tabindex="0">
                                <!-- item -->
                                <template v-if="userDetails.postBookmarks.length!==0" v-for="post in userDetails.postBookmarks">
                                    <Post :post="post" />
                                </template>
                                <div v-if="userDetails.postBookmarks.length===0" class="text-center m-1 p-1">
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
import Topic from "../admin/Topic.vue";
export default {
    name: 'ProfileAccount',
    components: {Topic, Post},

    computed:{
        ...mapGetters({
            userDetails: 'auth/userDetails',
        }),
    },
}
</script>

<style scoped>
.img-account-profile {
    height: 4rem;
}
</style>
