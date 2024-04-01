<template>
    <TopicMainPostHeader :topic-title="topic.title" :created-at="topic.created_at" categoryTitle="News"/>

    <div class="container-fluid mt-100 mb-2">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="card-header h-100">
                        <div class="media flex-wrap w-100 align-items-center">
                            <img :src="topic.author.avatar" width="64" class="d-block ui-w-40 rounded-circle" alt="Avatar">
                            <div class="media-body ml-3">
                                <a v-if="topic.author.id" :href="`/user-profile/${topic.author.id}`" data-abc="true">{{ topic.author.name }}</a>
                                <div class="text-muted small">Offline</div>
                            </div>
                            <div class="text-muted small ml-3">
                                <div>{{ $t('component.post.registerDate') }} <strong>{{ topic.author.register_at }}</strong></div>
                                <div><strong>{{ topic.author.totalPosts }}</strong> {{ $t('component.post.messages') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <p class="card-text text-muted"><small class="text-muted">Last updated {{ topic.updated_at }}</small></p>

                        <p class="card-text" v-html="topic.content">

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
                                <span v-for="tag in topic.tags" class="text-black px-1 mr-2">#{{ tag.name }}</span>
                            </div>
                        </div>

                        <div class="mt-2 d-block d-md-flex d-lg-flex d-xl-flex justify-content-between">
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button class="btn btn-xs text-muted has-icon"><i class="far fa-heart"></i>
                                    {{ topic.rating }}
                                </button>
                                <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                                    <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"> {{ topic.views }}</span>
                              </span>
                            </div>
                            <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                                <button class="btn btn-secondary">Edit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TopicMainPostHeader from '../../components/client/TopicMainPostHeader.vue';
import {mapGetters,} from "vuex";
export default {
    name: "TopicMainPostComponent",
    components: {TopicMainPostHeader},
    props: ['topic', 'images'],

    data(){
        return{
            showImg: false,
        }
    },

    methods: {
        toggleImageContainer() {
            this.showImg = !this.showImg;
        },
    }
}
</script>
