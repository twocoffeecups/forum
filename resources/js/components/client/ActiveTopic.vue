<template>
    <div class="pos-relative px-3 py-3">
        <h6 class="text-primary text-sm">
            <router-link :to="{ name:'topic', params:{id:1}}" class="text-primary">Lorem ipsum dolor sit amet </router-link>
        </h6>
        <p class="mb-0 text-sm">
            <span class="op-6">Posted</span> 
            <a class="text-black" href="#">39 minutes</a> 
            <span class="op-6">ago by</span> 
            <a class="text-black" href="#">Alex</a>
        </p>
    </div>
    <hr class="m-0" />
</template>

<script>
export default{
    name:'ActiveTopic',

}
</script>

<style scoped>

</style>