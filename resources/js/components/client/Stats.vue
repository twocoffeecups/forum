<template>
    <div class="bg-white mx-4 text-sm">
        <h4 class="px-3 py-4 op-5 m-0 roboto-bold text-center">
            {{ $t('component.stats.stats') }}
        </h4>                
        <hr class="my-0">
        <div class="row text-center d-flex flex-row op-7 mx-0">
            <div class="col-sm-6 flex-ew text-center py-3 border-bottom border-right"> <a class="d-block lead font-weight-bold" href="#">26</a> {{ $t('component.stats.topics') }} </div>
                <div class="col-sm-6 col flex-ew text-center py-3 border-bottom mx-0"> <a class="d-block lead font-weight-bold" href="#">123</a> {{ $t('component.stats.posts') }} </div>
            </div>
        <div class="row d-flex flex-row op-7">
            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0"> <a class="d-block lead font-weight-bold" href="#">56</a> {{ $t('component.stats.members') }} </div>
            <div class="col-sm-6 flex-ew text-center py-3 mx-0"> <a class="d-block lead font-weight-bold" href="#">Tod Howard</a> {{ $t('component.stats.newMember') }} </div>
        </div>
    </div>
</template>

<script>
export default{
    name:'Stats',
}
</script>

<style scoped>

</style>