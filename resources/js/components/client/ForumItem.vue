<template>
    <div class="forum-item py-2 px-2 mb-0 border-bottom" style="font-size: 0.8em">

        <div class="d-flex flex-column flex-sm-column flex-md-row flex-lg-row flex-xl-row flex-xxl-row">

            <div class="d-flex my-auto" style="margin-left: 10px">
                <span class="text-muted" style="font-size: 1.7em"><i class="fas fa-bullhorn"></i></span>
            </div>

            <div class="d-flex flex-column flex-md-column flex-lg-row flex-xl-row flex-xxl-row justify-content-between flex-grow-1">
                <div class="d-flex mx-2 p-1" style="min-width: 150px; margin-right: auto">
                    <router-link :to="{name:'forum', params:{ id: forum.id}}" class="forum-nav-link my-auto"
                                 style="font-size: 1.2em">
                        {{ forum.name }}
                    </router-link>
                </div>

                <div class="d-inline-flex mx-2 mt-lg-0 text-center op-7 justify-content-between" style="width: 190px; margin-left: auto">
                    <div class="d-flex text-start flex-column mx-1">
                        <h4 class="h6 font-weight-bold">
                            {{ $t('component.childForum.categories') }}
                        </h4>
                        <span>{{ forum.forums }}</span>
                    </div>
                    <div class="d-flex text-start flex-column mx-1">
                        <h4 class="h6 font-weight-bold">
                            {{ $t('component.childForum.posts') }}
                        </h4>
                        <span>{{ forum.posts }}</span>
                    </div>
                    <div class="d-flex text-start flex-column mx-1">
                        <h4 class="h6 font-weight-bold">
                            {{ $t('component.childForum.views') }}
                        </h4>
                        <span>{{ forum.views }}</span>
                    </div>
                </div>
            </div>


            <div class="d-inline-flex" style="min-width: 250px;">
<!--                <div class="row">-->
<!--                    <h4 class="h6 font-weight-bold"><b>Latest comment: </b></h4>-->
<!--                </div>-->
                <div class="d-flex flex-row mx-md-auto mx-lg-auto mx-xl-auto" style="">
                    <div v-if="forum.latestPost" class="mx-2 my-auto">
                        <img v-if="forum.latestPost.author.avatar" :src="forum.latestPost.author.avatar" class="rounded-circle" width="40" alt="avatar">
                        <img v-if="!forum.latestPost.author.avatar" src="../../assets/img/default-avatar.png" class="rounded-circle" width="40" alt="avatar">
                    </div>
                    <div class="d-flex flex-column align-items-start justify-content-between mt-3 mt-lg-0 d-flex d-sm-flex
                                    d-md-flex d-xl-flex d-xxl-flex flex-row flex-md-none flex-lg-column flex-xl-column flex-xxl-column" style="min-width: ">
                        <div class="mb-auto">
                            <div v-if="forum.latestPost" class="h6 mb-1 font-weight-bold">
                                <router-link class="text-muted" :to="{name:'topic', params:{id:forum.latestPost.topic.id}}">{{ forum.latestPost.topic.name.substring(0, 15) }}... </router-link>
                                <div>
                                    <span>by <router-link class="text-muted" :to="{name:'user.profile', params:{id:forum.latestPost.author.id}}"> {{ forum.latestPost.author.name }} </router-link> </span>
                                    <span> {{' ' + forum.latestPost.created_at }}</span>
                                </div>

                            </div>
                            <h6 v-if="!forum.latestPost">There are no posts on this forum.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: "ForumItem",
    props: ['forum'],

}
</script>

<style scoped>
.topic-name {
    margin-right: auto;
    max-width: 560px;
}

.forum-item {
    margin: 10px 0;
    padding: 10px 0 20px;
    border-bottom: 1px solid #f1f1f1;
}

.number {
    font-size: 24px;
    line-height: 18px;
    font-weight: 400;
}

.forum-item small {
    color: #999;
}

.forum-item .category-description {
    color: #999;
    /*margin-left: 50px;*/
}

.forum-info {
    text-align: center;
}

a.forum-nav-link {
    color: black;
    display: block;
    font-size: 18px;
    font-weight: 600;
}

a.forum-nav-link:hover {
    color: #0b5ed7;
}

@media (max-width: 992px) {
    .forum-info {
        margin: 25px 0 10px 0;
    }
}
</style>
