<template>
    <TopicMainPostHeader :topic-title="mainPost.title" :created-at="mainPost.created_at" categoryTitle="News"/>

    <div class="container-fluid mt-100 mb-2">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="card-header h-100">
                        <div class="media flex-wrap w-100 align-items-center">
                            <img :src="topicAuthor.avatar" width="64" class="d-block ui-w-40 rounded-circle" alt="">
<!--                            src="https://i0.wp.com/www.celebrity-cutouts.com/wp-content/uploads/2018/11/todd-howard-smile-celebrity-mask.png?resize=450%2C450&ssl=1"-->
                            <div class="media-body ml-3"><a href="javascript:void(0)"
                                                            data-abc="true">{{ topicAuthor.name }}</a>
                                <div class="text-muted small">Offline</div>
                            </div>
                            <div class="text-muted small ml-3">
                                <div>{{ $t('component.post.registerDate') }} <strong>{{ topicAuthor.register_at }}</strong></div>
                                <div><strong>{{ topicAuthor.totalPosts }}</strong> {{ $t('component.post.messages') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <p class="card-text text-muted"><small class="text-muted">Last updated {{ mainPost.updated_at }}</small></p>

                        <p class="card-text" v-html="mainPost.content">

                        </p>

                        <div v-if="images.length!==0" class="card">
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

                        <div class="mt-2 d-block d-md-flex d-lg-flex d-xl-flex justify-content-between">
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button class="btn btn-xs text-muted has-icon"><i class="far fa-heart"></i>
                                    {{ mainPost.rating }}
                                </button>
                                <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                                    <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"> {{ mainPost.views }}</span>
                              </span>
                            </div>
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button @click.capture="report(mainPost.id)" class="btn btn-sm btn-outline-danger mx-1"
                                        data-bs-toggle="modal" data-bs-target="#report-form">
                                    {{ $t('component.post.report') }}
                                </button>
                                <button class="btn btn-sm btn-outline-primary mx-1">{{
                                        $t('component.post.reply')
                                    }}
                                </button>
                                <!--                      <button class="btn btn-sm btn-outline-secondary mx-1">{{ $t('component.post.edit') }}</button>-->
                                <span class="mx-1 p-2"> <i class="far fa-bookmark" style="cursor: pointer"></i></span>
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
import {mapGetters, mapState} from "vuex";

export default {
    name: "TopicMainPost",
    components: {TopicMainPostHeader},
    props: ['mainPost', 'images'],
    emits: ['report'],

    computed: {
        ...mapGetters({
            topicAuthor: 'topic/getTopicAuthor',
        }),
    },

    data(){
        return{
            showImg: false,
        }
    },

    methods: {
        toggleImageContainer() {
            this.showImg = !this.showImg;
        },

        report(reportId) {
            this.$emit('report', {id: reportId, type: 'topic'})
        },
    }
}
</script>
