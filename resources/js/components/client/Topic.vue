<template>
    <!--    <div class="card row-hover pos-relative py-3 px-3 border-top-0 border-right-0 border-left-0 rounded-0">-->
    <!--        <div class="row align-items-center">-->
    <!--            <div class="col-md-9 mb-sm-0">-->
    <!--                <h5>-->
    <!--                    <router-link :to="{name:'topic', params:{id:1}}" class="text-primary">Lorem ipsum dolor sit amet</router-link>-->
    <!--                </h5>-->
    <!--                <p class="text-sm"><span class="op-6">{{ $t('component.topic.posted') }}</span> <a class="text-black" href="#">20 minutes</a> -->
    <!--                    <span class="op-6">ago by</span> <a class="text-black" href="#">Tod Howard</a>-->
    <!--                </p>-->
    <!--                <div class="text-sm op-5"> -->
    <!--                    <a class="text-black mr-2" href="#">#Java</a> <a class="text-black mr-2" href="#">#PHP</a>-->
    <!--                    <a class="text-black mr-2" href="#">#JS</a> </div>-->
    <!--                </div>-->
    <!--                <div class="col-md-3 op-7">-->
    <!--                    <div class="row text-center op-7">-->
    <!--                        <div class="col px-1">-->
    <!--                          <span><i class="fas fa-heart" :title="$t('component.topic.votes')"></i> 141</span>-->
    <!--                        </div>-->
    <!--                        <div class="col px-1">-->
    <!--                          <span><i class="fas fa-comment" :title="$t('component.topic.posts')"></i> 122</span>-->
    <!--                        </div>-->
    <!--                        <div class="col px-1">-->
    <!--                          <span><i class="fas fa-eye" :title="$t('component.topic.views')"></i> 290</span>-->
    <!--                        </div>-->
    <!--&lt;!&ndash;                        <div class="col px-1">&ndash;&gt;-->
    <!--&lt;!&ndash;                          <span><i class="fas fa-columns" :title="$t('component.topic.pages')"></i> 7</span>&ndash;&gt;-->
    <!--&lt;!&ndash;                        </div>&ndash;&gt;-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--    </div>-->

    <div class="forum-item py-2 px-3 mb-0 border-bottom ">
        <div class="row">
            <div class="col-md-7 col-lg-7 d-flex flex-column align-content-between">
                <router-link :to="{name:'topic', params:{id: topic.id}}" class="forum-nav-link" style="font-size: 1.2em">
                    {{ topic.title }}
                </router-link>
                <p class="text-sm"><span class="op-6">{{ $t('component.topic.created') }}</span>
                    <a class="text-black" href="#">{{ topic.created_at }}</a>
                    <span class="op-6"> by</span> <a class="" href="#">{{ topic.author.name }}</a>
                </p>
                <div class="text-sm op-5 my-auto">
                    <a v-for="tag in topic.tags" class="text-black mr-2" href="#">#{{ tag.name }}</a>
                </div>

            </div>

            <div class="col-md-2 col-lg-2 mt-3 mt-lg-0">
                <h4 class="h6 font-weight-bold text-center d-none d-md-block d-lg-block">Stats: </h4>
                <div class="d-flex justify-content-between text-center op-7">
                    <div class="col px-1">
                        <span><i class="fas fa-heart" :title="$t('component.topic.votes')"></i> {{ topic.rating }}</span>
                    </div>
                    <div class="col px-1">
                        <span><i class="fas fa-comment" :title="$t('component.topic.posts')"></i> {{ topic.postsCount }}</span>
                    </div>
                    <div class="col px-1">
                        <span><i class="fas fa-eye" :title="$t('component.topic.views')"></i> {{ topic.views }}</span>
                    </div>
                </div>
            </div>

            <div v-if="topic.latestPost!==null" class="col-md-3 col-lg-3 mt-3 mt-lg-0 d-flex flex-row flex-md-column flex-lg-column">
                <h4 class="h6 font-weight-bold">Latest comment: </h4>
                <!--          <h6 class="h6 mb-0 font-weight-bold"><router-link :to="{name:'topic', params:{id:1}}">Post name</router-link></h6>-->
                <div>by <a href="#0">{{ topic.latestPost.author.name }}</a></div>
                <div>{{ topic.latestPost.created_at}} </div>
            </div>

            <div v-if="topic.latestPost===null" class="col-md-3 col-lg-3 mt-3 mt-lg-0 d-flex flex-row flex-md-column flex-lg-column">
                <h6>There are no posts on this topic.</h6>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Topic',
    props: ['topic', 'latestPost'],
}
</script>

<style scoped>

</style>
