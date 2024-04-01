<template>
    <div class="pos-relative px-3 py-3" >
        <h5 class="text-primary">
            <router-link :to="{ name:'topic', params:{id:topicId}}" class="text-muted">{{ title }} </router-link>
        </h5>
        <p class="mb-0">
            <span class="op-6">Posted </span>
            <a class="text-black" href="#">{{ created_at }}</a>
        </p>
        <p>
            <span class="op-6"> by </span>
            <router-link v-if="authorId" class="text-muted" :to="{name:'user.profile', params:{id:authorId}}">{{ author }}</router-link>
        </p>
    </div>
    <hr class="m-0" />
</template>

<script>
export default{
    name:'ActiveTopic',
    props: ['topicId', 'title', 'author', 'created_at', 'authorId'],
}
</script>

<style scoped>

</style>
