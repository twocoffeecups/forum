<template>
<!--    <div class="container-fluid mt-100 m mb-2">-->
<!--        <div class="card">-->
<!--            <div class="row g-0">-->
<!--                <div class="col-md-3">-->
<!--                    <div class="card-header h-100">-->
<!--                        <div class="media flex-wrap w-100 align-items-center"><img-->
<!--                            src="https://i0.wp.com/www.celebrity-cutouts.com/wp-content/uploads/2018/11/todd-howard-smile-celebrity-mask.png?resize=450%2C450&ssl=1"-->
<!--                            width="64" class="d-block ui-w-40 rounded-circle" alt="">-->
<!--                            <div class="media-body ml-3"><a href="javascript:void(0)" data-abc="true">Tod Howard</a>-->
<!--                                <div class="text-muted small">Offline</div>-->
<!--                            </div>-->
<!--                            <div class="text-muted small ml-3">-->
<!--                                <div>{{ $t('component.post.registerDate') }} <strong>01/1/2019</strong></div>-->
<!--                                <div><strong>134</strong> {{ $t('component.post.messages') }}</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-9">-->
<!--                    <div class="card-body">-->
<!--                        <p class="card-text text-muted"><small class="text-muted">Last updated 3 mins ago</small></p>-->
<!--                        <p class="card-text">-->
<!--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut-->
<!--                            labore et dolore magna aliqua.-->
<!--                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea-->
<!--                            commodo consequat.-->
<!--                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla-->
<!--                            pariatur.-->
<!--                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit-->
<!--                            anim id est laborum.-->
<!--                        </p>-->
<!--                        <div class="card">-->
<!--                            <div class="card-header img-card-header" @click="toggleImageContainer(post)"-->
<!--                                 style="background-color: #bab5a9">-->
<!--                                <i>Images</i>-->
<!--                            </div>-->
<!--                            <div :id="`post-img-container-${post}`" class="card-body hide">-->
<!--                                <img src="/src/assets/img/nature.jpg" class="img-fluid mb-1">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="mt-2 d-block d-md-flex d-lg-flex d-xl-flex justify-content-between">-->
<!--                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">-->
<!--                                <button @click.prevent="likePost" class="btn btn-xs text-muted has-icon"><i-->
<!--                                    class="far fa-heart"></i> 1-->
<!--                                </button>-->
<!--                                <span class="text-muted d-inline-flex align-items-center align-middle ml-4">-->
<!--                        <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"> 112</span>-->
<!--                      </span>-->
<!--                            </div>-->
<!--                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">-->
<!--                                <button @click.capture="report(post)" class="btn btn-sm btn-outline-danger mx-1"-->
<!--                                        data-bs-toggle="modal" data-bs-target="#report-form">-->
<!--                                    {{ $t('component.post.report') }}-->
<!--                                </button>-->
<!--                                <button @click.prevent="replyPost(post)" class="btn btn-sm btn-outline-primary mx-1">-->
<!--                                    {{ $t('component.post.reply') }}-->
<!--                                </button>-->
<!--                                &lt;!&ndash;                <button class="btn btn-sm btn-outline-secondary mx-1">{{ $t('component.post.edit') }}</button>&ndash;&gt;-->
<!--                                <span @click.prevent="addPostToBookmarks" class="mx-1 p-2"> <i class="far fa-bookmark"-->
<!--                                                                                               style="cursor: pointer"></i></span>-->
<!--                            </div>-->

<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="container-fluid mt-100 m mb-2">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="card-header h-100">
                        <div class="media flex-wrap w-100 align-items-center">
                            <img :src="avatar" width="64" class="d-block ui-w-40 rounded-circle" alt="">
                            <div class="media-body ml-3"><a href="javascript:void(0)" data-abc="true">{{ post.author.name }}</a>
                                <div class="text-muted small">Offline</div>
                            </div>
                            <div class="text-muted small ml-3">
                                <div>{{ $t('component.post.registerDate') }} <strong>{{ post.author.register_at }}</strong></div>
                                <div><strong>{{ post.author.totalPosts }}</strong> {{ $t('component.post.messages') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <p class="card-text text-muted"><small class="text-muted">Last updated: {{ post.updated_at }}</small></p>

                        <!-- Reply post -->
                        <div v-if="post.replyPost!==null" style="border: 1px solid #ccc4af; border-left: 5px solid #706a5a; font-style: italic">
                            <div class="d-flex justify-content-between mb-0" style="background-color: #ccc4af">
                                <p class="mx-1">Reply: {{ post.replyPost.author +' @ '+post.replyPost.created_at  }}</p>
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
                                <img src="/src/assets/img/nature.jpg" class="img-fluid mb-1">
                            </div>
                        </div>

                        <div class="mt-2 d-block d-md-flex d-lg-flex d-xl-flex justify-content-between">
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button @click.prevent="likePost" class="btn btn-xs text-muted has-icon"><i
                                    class="far fa-heart"></i> {{ post.rating }}
                                </button>
                                <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                                  <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"> {{ post.views }}</span>
                                </span>
                            </div>
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button @click.capture="report(post.id)" class="btn btn-sm btn-outline-danger mx-1"
                                        data-bs-toggle="modal" data-bs-target="#report-form">
                                    {{ $t('component.post.report') }}
                                </button>
                                <button @click.prevent="replyPost(post.id)" class="btn btn-sm btn-outline-primary mx-1">
                                    {{ $t('component.post.reply') }}
                                </button>
                                <!--                <button class="btn btn-sm btn-outline-secondary mx-1">{{ $t('component.post.edit') }}</button>-->
                                <span @click.prevent="addPostToBookmarks(post.id)" class="mx-1 p-2"> <i class="far fa-bookmark"
                                                                                               style="cursor: pointer"></i></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    props: ['post'],
    emits: ['reply', 'report',],

    data() {
        return {
            postId: 1,
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
            this.$emit('report', reportId)
        },

        likePost() {
            this.$store.dispatch('likePost', this.post.id);
        },

        addPostToBookmarks() {
            this.$store.dispatch('addPostToBookmarks', this.post.id);
        }


    }
}
</script>

<style scoped>
.hide {
    display: none;
}
</style>
