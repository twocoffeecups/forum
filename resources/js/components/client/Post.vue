<template>
    <div class="container-fluid mt-100 m mb-2">
        <div class="card rounded-0">
            <div class="row g-0">
                <div class="col-md-3">

                    <div class="card-header h-100">

                        <div class="d-flex flex-row flex-sm-row flex-md-column flex-lg-column flex-xxl-column">

                            <div class="d-flex my-auto h-100">
                                <img v-if="avatar" :src="avatar" width="64" class="rounded-circle" alt="">
                                <img v-if="!avatar" src="../../assets/img/default-avatar.png" width="64" class="rounded-circle" alt="">
                            </div>


                            <div class="d-flex flex-column mx-1">
                                <div class="ml-3">
                                    <router-link v-if="post.author.id"
                                                 :to="{name:'user.profile', params:{id:post.author.id}}" data-abc="true">
                                        {{ post.author.name }}
                                    </router-link>
                                    <!-- online status -->
                                    <div class="text-muted small">
                                        <span v-if="post.author.status" class="badge bg-success">Online</span>
                                        <span v-if="!post.author.status" class="badge bg-danger">Offline</span>
                                    </div>
                                    <div class="text-muted small">Last visit: {{ post.author.lastVisit }}</div>
                                </div>
                                <div class="text-muted small ml-3">
                                    <div class="d-none">{{ $t('component.post.registerDate') }} <strong>{{
                                            post.author.register_at
                                        }}</strong></div>
                                    <div><strong>{{ post.author.totalPosts }}</strong> {{ $t('component.post.messages') }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card-body d-flex flex-column" style="height: 100%">
                        <div class="d-flex flex-column">
                            <p class="d-flex card-text text-muted"><small class="text-muted">Last updated: {{
                                    post.updated_at
                                }}</small></p>

                            <!-- Reply post -->
                            <div v-if="post.replyPost!==null"
                                 style="border: 1px solid #ccc4af; border-left: 5px solid #706a5a; font-style: italic">
                                <div class="d-flex justify-content-between mb-0" style="background-color: #ccc4af">
                                    <p class="mx-1">Reply: {{
                                            post.replyPost.author + ' @ ' + post.replyPost.created_at
                                        }}</p>
                                </div>
                                <p class="m-1" v-html="post.replyPost.message"></p>
                            </div>

                            <p class="card-text" v-html="post.message">

                            </p>

                            <!-- Images -->
                            <div v-if="post.images.length!==0" class="card">
                                <div class="card-header img-card-header" @click="toggleImageContainer(post.id)"
                                     style="background-color: #bab5a9">
                                    <i>Images</i>
                                </div>
                                <div :id="`post-img-container-${post.id}`" class="card-body hide">
                                    <!--                                    <img :src="/src/assets/img/nature.jpg" class="img-fluid mb-1">-->
                                </div>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between align-items-end" style="margin-top: auto">
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <LikeButton :id="post.id"
                                            :type="`post`"
                                            :author-id="post.author.id"
                                            :rating="post.rating"/>
                                <!-- TODO: сделать счётчик просмотров сообщения -->
<!--                                <span class="text-muted d-inline-flex align-items-center align-middle ml-4">-->
<!--                                  <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span-->
<!--                                    class="align-middle"> {{ post.views }}</span>-->
<!--                                </span>-->
                            </div>
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button v-if="userId!==post.author.id && isLoggedIn" @click.capture="report(post.id)"
                                        class="btn btn-sm btn-outline-danger mx-1"
                                        data-bs-toggle="modal" data-bs-target="#report-form">
                                    {{ $t('component.post.report') }}
                                </button>
                                <button v-if="userId!==post.author.id && isLoggedIn" @click.prevent="replyPost(post.id)"
                                        class="btn btn-sm btn-outline-primary mx-1">
                                    {{ $t('component.post.reply') }}
                                </button>

                                <BookmarksButton :id="post.id"
                                                 :type="`post`"
                                                 :author-id="post.author.id" />
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
import LikeButton from "./LikeButton.vue";
import BookmarksButton from "./BookmarksButton.vue";

export default {
    name: "Post",
    components: {BookmarksButton, LikeButton},
    props: ['post'],
    emits: ['reply', 'report',],

    computed: {
        ...mapGetters({
            userId: 'auth/getUserId',
            isLoggedIn: 'auth/isLoggedIn',
        }),
    },

    data() {
        return {
            avatar: this.post.author.avatar,
        }
    },

    methods: {
        toggleImageContainer(id) {
            let elem = document.querySelector(`#post-img-container-${id}`)
            elem.classList.toggle('hide');
        },

        replyPost(replyId) {
            this.$emit('reply', this.post)
        },

        report(reportId) {
            this.$emit('report', {id: reportId, type: 'post', userId: this.post.author.id})
        },
    }
}
</script>

<style scoped>
.hide {
    display: none;
}
</style>
