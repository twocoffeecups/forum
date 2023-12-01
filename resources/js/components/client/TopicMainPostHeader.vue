<template>
    <div class="container-fluid">
        <div class="card" style="border-bottom: none;">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex">
                <h5 class="card-text">{{ topicTitle }}</h5> <small class="mx-2 p-1" style="font-size: 0.8em">{{ $t('component.topicHeader.byCategory') }} {{ categoryTitle }}</small>
                </div>
                <span class="card-text d-flex">{{ $t('component.topicHeader.created') }}: 01/01/2023</span>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:'TopicMainPostHeader',

    props:['topicTitle', 'categoryTitle',]
}
</script>

<style scoped>

</style>