<template>
    <div class="forum-item p-0 mb-0 border-bottom">
        <div v-if="topic.status===0" class="row my-0 mx-auto">
            <div class="alert alert-danger p-0 mx-0 text-sm" role="alert">
                <span>Эта тема ещё не утверждена модератором!</span>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-column flex-md-row flex-lg-row flex-xl-row flex-xxl-row">
            <div class="d-flex flex-column flex-grow-1 my-auto mx-3" style="width: 350px;">
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
            <div class="d-flex my-auto d-none d-sm-none d-md-flex d-lg-flex d-xl-flex mx-3 mt-3 mt-lg-0 text-center op-7 flex-row">
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-heart" :title="$t('component.topic.votes')"></i>
                    </span>
                    <span class="mb-auto">{{ topic.rating }}</span>
                </div>
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-comment" :title="$t('component.topic.posts')"></i>
                    </span>
                    <span class="mb-auto">{{ topic.postsCount }}</span>
                </div>
                <div class="d-flex flex-column mx-1">
                    <span>
                        <i class="fas fa-eye mx-auto" :title="$t('component.topic.views')"></i>
                    </span>
                    <span class="mb-auto">{{ topic.views }}</span>
                </div>
            </div>

            <div class="d-inline-flex mb-auto mx-1" style="min-width: 250px;">
                <!--                <div class="row">-->
                <!--                    <h4 class="h6 font-weight-bold"><b>Latest comment: </b></h4>-->
                <!--                </div>-->
                <div class="d-flex flex-row mx-md-auto mx-lg-auto mx-xl-auto" style="">
                    <div v-if="topic.latestPost" class="mx-2 my-auto">
                        <img v-if="topic.latestPost.author.avatar" :src="topic.latestPost.author.avatar" class="rounded-circle" width="40" alt="avatar">
                        <img v-if="!topic.latestPost.author.avatar" src="../../assets/img/default-avatar.png" class="rounded-circle" width="40" alt="avatar">
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-between mt-3 mt-lg-0 d-flex d-sm-flex
                                    d-md-flex d-xl-flex d-xxl-flex flex-row flex-md-none flex-lg-column flex-xl-column flex-xxl-column">
                        <div class="mb-auto">
                            <div v-if="topic.latestPost" class="h6 mb-1 font-weight-bold">
                                <router-link class="text-muted" :to="{name:'topic', params:{id:topic.latestPost.topic.id}}">{{ topic.latestPost.topic.name.substring(0, 15) }}... </router-link>
                                <div>
                                    <span>by <router-link class="text-muted" :to="{name:'user.profile', params:{id:topic.latestPost.author.id}}"> {{ topic.latestPost.author.name }} </router-link> </span>
                                    <span> {{' ' + topic.latestPost.created_at }}</span>
                                </div>

                            </div>
                            <h6 v-if="!topic.latestPost">There are no topic on this forum.</h6>
                        </div>
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
