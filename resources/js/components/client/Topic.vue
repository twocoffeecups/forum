<template>
    <div class="forum-item py-2 px-3 mb-0 border-bottom ">
        <div class="d-flex flex-fill flex-column flex-md-column flex-lg-row flex-xl-row flex-xxl-row justify-content-between">
            <div class="d-flex flex-column mx-3" style="min-width: 450px">
                <div class="row">
                    <router-link :to="{name:'topic', params:{id: topic.id}}" class="forum-nav-link" style="font-size: 1.2em">
                        {{ topic.title }}
                    </router-link>
                    <p class="text-sm"><span class="op-6">{{ $t('component.topic.created') }}</span>
                        <a class="text-black" href="#">{{ topic.created_at }}</a>
                        <span class="op-6"> by</span> <a class="" href="#">{{ topic.author.name }}</a>
                    </p>
                </div>
                <div class="d-flex text-sm my-auto">
                    <a v-for="tag in topic.tags" class="text-black mr-2" href="#">#{{ tag.name }}</a>
                </div>
            </div>
            <div class="d-flex mx-3 mt-3 mt-lg-0 text-center op-7 justify-content-between flex-row flex-sm-row flex-md-row flex-lg-column flex-xl-row flex-xxl-row">
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-heart" :title="$t('component.topic.votes')"></i>
                    </span>
                    <span class=" mx-auto my-auto">{{ topic.rating }}</span>
                </div>
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-comment" :title="$t('component.topic.posts')"></i>
                    </span>
                    <span class=" mx-auto my-auto">{{ topic.postsCount }}</span>
                </div>
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-eye mx-auto" :title="$t('component.topic.views')"></i>
                    </span>
                    <span class=" mx-auto my-auto">{{ topic.views }}</span>
                </div>
            </div>
            <div class="d-flex mx-3 align-items-start justify-content-between mt-3 mt-lg-0 d-none d-sm-none d-md-flex d-xl-flex d-xxl-flex flex-row   flex-row flex-md-row flex-lg-column flex-xl-column flex-xxl-column" style="min-width: 300px">
                <h4 class="h6 font-weight-bold"><b>Latest comment: </b></h4>
                <div v-if="topic.latestPost" class="mb-auto font-weight-bold">
                    <router-link :to="{name:'topic', params:{id:topic.latestPost.topic.id}}">{{ topic.latestPost.topic.name.substring(0, 15) }}... </router-link>
                    <span>by <router-link :to="{name:'user.profile', params:{id:topic.latestPost.author.id}}"> {{ topic.latestPost.author.name }} </router-link></span>
                    <span> {{ topic.latestPost.created_at }}</span>
                </div>
                <div class="mb-auto" v-if="!topic.latestPost">There are no posts on this forum.</div>
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
