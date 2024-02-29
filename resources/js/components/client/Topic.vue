<template>
    <div class="forum-item py-1 px-2 mb-0 border-bottom ">
        <div class="d-flex flex-column my-2 flex-md-column flex-lg-row flex-xl-row flex-xxl-row justify-content-between">
            <div class="d-flex flex-column mx-3" style="width: 350px;">
                <div class="row">
                    <router-link :to="{name:'topic', params:{id: topic.id}}" class="forum-nav-link text-dark" style="font-size: 1.2em">
                        {{ topic.title.substring(0, 100) }}
                    </router-link>
                    <p class="text-sm"><span class="op-6">{{ $t('component.topic.created') }}</span>
                        <a class="text-black" href="#">{{ topic.created_at }}</a>
                        <span class="op-6"> by</span> <router-link v-if="topic.author" class="text-muted" :to="{name:'user.profile', params:{id:topic.author.id}}">{{ topic.author.name }}</router-link>
                    </p>
                </div>
                <div class="d-flex text-sm">
                    <a v-for="tag in topic.tags" class="text-black mr-2" href="#">#{{ tag.name }}</a>
                </div>
            </div>
            <div class="d-flex mx-3 mt-3 mt-lg-0 text-center op-7 justify-content-between flex-row flex-sm-row flex-md-row flex-lg-column flex-xl-row flex-xxl-row">
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-heart" :title="$t('component.topic.votes')"></i>
                    </span>
                    <span class="mx-auto mb-auto">{{ topic.rating }}</span>
                </div>
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-comment" :title="$t('component.topic.posts')"></i>
                    </span>
                    <span class="mx-auto mb-auto">{{ topic.postsCount }}</span>
                </div>
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-eye mx-auto" :title="$t('component.topic.views')"></i>
                    </span>
                    <span class=" mx-auto mb-auto">{{ topic.views }}</span>
                </div>
            </div>
            <div class="mx-2 d-flex" style="width: 350px">
                <div v-if="topic.latestPost" class="mx-3">
                    <img v-if="topic.latestPost.author.avatar" :src="topic.latestPost.author.avatar" class="rounded-circle" width="40" alt="avatar">
                    <img v-if="!topic.latestPost.author.avatar" src="../../assets/img/default-avatar.png" class="rounded-circle" width="40" alt="avatar">
                </div>
                <div class="d-flex flex-column align-items-start justify-content-between mt-3 mt-lg-0 d-none d-sm-none d-md-flex d-xl-flex d-xxl-flex flex-row flex-md-none flex-lg-column flex-xl-column flex-xxl-column">
                    <h4 class="h6 font-weight-bold"><b>Latest comment: </b></h4>
                    <div class="mb-auto">
                        <h6 v-if="topic.latestPost" class="h6 mb-1 font-weight-bold">
                            <router-link class="text-muted" :to="{name:'topic', params:{id:topic.latestPost.topic.id}}">{{ topic.latestPost.topic.name.substring(0, 15) }}... </router-link>
                            <span>by <router-link class="text-muted" :to="{name:'user.profile', params:{id:topic.latestPost.author.id}}"> {{ topic.latestPost.author.name }} </router-link> </span>
                            <span> {{' ' + topic.latestPost.created_at }}</span>
                        </h6>
                        <h6 v-if="!topic.latestPost">There are no posts on this forum.</h6>
                    </div>
                </div>
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
