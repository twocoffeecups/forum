<template>
    <div class="forum-item py-2 px-2 mb-0 border-bottom" style="font-size: 0.8em">
        <div class="d-flex flex-column flex-md-column flex-lg-row flex-xl-row flex-xxl-row justify-content-between">
            <div class="d-flex mx-2 p-1" style="min-width: 300px">
                <div class="d-flex my-auto mx-3">
                    <span class="text-muted" style="font-size: 1.7em"><i class="fas fa-bullhorn"></i></span>
                </div>
                <router-link :to="{name:'forum', params:{ id: forum.id}}" class="forum-nav-link my-auto"
                             style="font-size: 1.2em">
                    {{ forum.name }}
                </router-link>
            </div>
            <div class="d-flex my-auto mx-2 mt-lg-0 text-center op-7 justify-content-between flex-row flex-sm-row flex-md-row flex-lg-column flex-xl-row flex-xxl-row" style="width: 190px">
                <div class="d-flex text-start flex-column mx-1">
                    <h4 class="h6 font-weight-bold">
                        {{ $t('component.childForum.categories') }}
                    </h4>
                    <span>141</span>
                </div>
                <div class="d-flex text-start flex-column mx-1">
                    <h4 class="h6 font-weight-bold">
                        {{ $t('component.childForum.posts') }}
                    </h4>
                    <span>122</span>
                </div>
                <div class="d-flex text-start flex-column mx-1">
                    <h4 class="h6 font-weight-bold">
                        {{ $t('component.childForum.views') }}
                    </h4>
                    <span>290</span>
                </div>
            </div>


            <div class="mx-2 d-flex" style="width: 380px">
                <div class="mx-2 my-auto">
                    <img src="../../assets/img/default-avatar.png" class="rounded-circle" width="40" alt="avatar">
                </div>
                <div class="d-flex flex-column  align-items-start justify-content-between mt-3 mt-lg-0 d-sm-none d-md-flex d-xl-flex d-xxl-flex flex-row flex-md-none flex-lg-column flex-xl-column flex-xxl-column">
                    <h4 class="h6 font-weight-bold"><b>Latest comment: </b></h4>
                    <div>
                        <h6 v-if="forum.latestPost" class="h6 mb-1 font-weight-bold">
                            <router-link class="text-muted" :to="{name:'topic', params:{id:forum.latestPost.topic.id}}">{{ forum.latestPost.topic.name.substring(0, 15) }}... </router-link>
                            <span>by <router-link class="text-muted" :to="{name:'user.profile', params:{id:forum.latestPost.author.id}}"> {{ forum.latestPost.author.name }} </router-link> </span>
                            <span> {{' ' + forum.latestPost.created_at }}</span>
                        </h6>
                        <h6 v-if="!forum.latestPost">There are no posts on this forum.</h6>
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

    data() {
        return {
            forum: this.forum,
        }
    },

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
