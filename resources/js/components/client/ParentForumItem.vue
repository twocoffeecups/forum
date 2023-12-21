<template>
    <div class="forum-item py-2 px-3 mb-0 border-bottom" style="font-size: 0.8em">
        <div class="d-flex flex-column flex-md-column flex-lg-row flex-xl-row flex-xxl-row justify-content-between">
            <div class="d-flex">
                <router-link :to="{name:'forum', params:{ id: forum.id}}" class="forum-nav-link"
                             style="font-size: 1.2em">
                    {{ forum.name }}
                </router-link>
            </div>

            <div
                class="d-flex mt-3 mt-lg-0 text-center op-7 justify-content-between flex-row flex-sm-row flex-md-row flex-lg-column flex-xl-row flex-xxl-row">
                <div class="d-flex flex-column text-center mx-1">
                    <h4 class="h6 font-weight-bold">
                        {{ $t('component.childForum.categories') }}
                    </h4>
                    <span>141</span>
                </div>
                <div class="d-flex flex-column text-center mx-1">
                    <h4 class="h6 font-weight-bold">
                        {{ $t('component.topic.posts') }}
                    </h4>
                    <span>122</span>
                </div>
                <div class="d-flex flex-column text-center mx-1">
                    <h4 class="h6 font-weight-bold">
                        {{ $t('component.topic.views') }}
                    </h4>
                    <span>290</span>
                </div>

            </div>

            <div
                class="align-items-start justify-content-between mt-3 mx-2 mt-lg-0 d-flex flex-row flex-md-row flex-lg-column flex-xl-column flex-xxl-column">
                <h4 class="h6 font-weight-bold">Latest comment: </h4>
                <h6 class="h6 mb-0 font-weight-bold">
                    <router-link :to="{name:'topic', params:{id:1}}">Post name</router-link>
                </h6>
                <div>by <a href="#0">Author name</a></div>
                <div>05 Apr 2017, 20:07</div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: "ParentForumItem",

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
