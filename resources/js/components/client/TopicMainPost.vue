<template>
    <TopicMainPostHeader :topic-title="mainPost.title" :created-at="mainPost.created_at" categoryTitle="News"/>

    <div class="container-fluid mt-100 mb-2">
        <div class="card rounded-0">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="card-header h-100">
                        <div v-if="mainPost.author" class="media flex-wrap w-100 align-items-center">
                            <img v-if="mainPost.author.avatar" :src="mainPost.author.avatar" width="64" class="d-block ui-w-40 rounded-circle"
                                 alt="Avatar">
                            <img v-if="!mainPost.author.avatar" src="../../assets/img/default-avatar.png" width="64" class="d-block ui-w-40 rounded-circle"
                                 alt="Avatar">
                            <div class="media-body ml-3">
                                <router-link v-if="mainPost.author.id"
                                             :to="{name:'user.profile', params:{id:mainPost.author.id}}" data-abc="true">
                                    {{ mainPost.author.name }}
                                </router-link>
                                <div class="text-muted small">
                                    <span v-if="mainPost.author.status" class="badge bg-success">Online</span>
                                    <span v-if="!mainPost.author.status" class="badge bg-danger">Offline</span>
                                </div>
                            </div>
                            <div class="text-muted small ml-3">
                                <div>{{ $t('component.post.registerDate') }} <strong>{{
                                        mainPost.author.register_at
                                    }}</strong>
                                </div>
                                <div>
                                    <strong>{{ mainPost.author.totalPosts }}</strong> {{ $t('component.post.messages') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body d-flex flex-column">
                        <p class="d-flex card-text text-muted"><small class="text-muted">Last updated {{
                                mainPost.updated_at
                            }}</small></p>

                        <p class="d-flex card-text" v-html="mainPost.content"></p>

                        <div v-if="images.length!==0" class="card d-flex">
                            <div class="card-header img-card-header" role="button" @click="toggleImageContainer()"
                                 style="background-color: #bab5a9">
                                <i>Images</i>
                            </div>
                            <div v-if="showImg" class="card-body hide">
                                <img v-for="image in images" :src="image.imageUrl" class="img-fluid mb-1">
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mt-1 mx-2 mb-1">
                            <div class="text-sm op-5">
                                <span v-for="tag in mainPost.tags" class="text-black px-1 mr-2">#{{ tag.name }}</span>
                            </div>
                        </div>

                        <div class="mt-auto d-flex justify-content-between">
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <LikeButton :id="this.$route.params.id"
                                            :type="`topic`"
                                            :author-id="topicAuthor.id"
                                            :rating="mainPost.rating" />
                                <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                                    <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span
                                    class="align-middle"> {{ mainPost.views }}</span>
                              </span>
                            </div>
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button v-if="userId!==topicAuthor.id && isLoggedIn &&  mainPost.type!==1"
                                        @click.capture="report(mainPost.id)" class="btn btn-sm btn-outline-danger mx-1"
                                        data-bs-toggle="modal" data-bs-target="#report-form">
                                    {{ $t('component.post.report') }}
                                </button>

<!--                                <button v-if="userId!==topicAuthor.id && isLoggedIn"-->
<!--                                        class="btn btn-sm btn-outline-primary mx-1">{{-->
<!--                                        $t('component.post.reply')-->
<!--                                    }}-->
<!--                                </button>-->
                                <router-link v-if="userId===topicAuthor.id && isLoggedIn"
                                             :to="{name:'topic.edit', params:{id:this.$route.params.id}}"
                                             class="btn btn-sm btn-outline-secondary mx-1">{{
                                        $t('component.post.edit')
                                    }}
                                </router-link>

                                <BookmarksButton :id="this.$route.params.id"
                                                 :type="`topic`"
                                                 :author-id="topicAuthor.id" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopicMainPostHeader from './TopicMainPostHeader.vue';
import {mapGetters,} from "vuex";
import LikeButton from "./LikeButton.vue";
import BookmarksButton from "./BookmarksButton.vue";

export default {
    name: "TopicMainPost",
    components: {BookmarksButton, LikeButton, TopicMainPostHeader},
    props: ['mainPost', 'images'],
    emits: ['report'],

    computed: {
        ...mapGetters({
            topicAuthor: 'topic/getTopicAuthor',
            userId: 'auth/getUserId',
            isLoggedIn: 'auth/isLoggedIn',
            userTopicsLikes: 'profile/getLikedTopics',
        }),
    },

    data() {
        return {
            showImg: false,
        }
    },

    methods: {
        toggleImageContainer() {
            this.showImg = !this.showImg;
        },

        report(reportId) {
            this.$emit('report', {id: reportId, type: 'topic', userId: this.topicAuthor.id});
        },
    }
}
</script>
