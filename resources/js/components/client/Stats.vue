<template>
    <div class="bg-white mx-4 text-sm">
        <h4 class="px-3 py-4 op-5 m-0 roboto-bold text-center">
            {{ $t('component.stats.stats') }}
        </h4>
        <hr class="my-0">
        <div class="row text-center d-flex flex-row op-7 mx-0">
            <div class="text-center col-sm-6 flex-ew text-center py-3 border-bottom border-right">
                <a class="d-block text-muted lead font-weight-bold" href="#">{{ stats.topics }}</a> <span>{{ $t('component.stats.topics') }}</span>
            </div>
            <div class="col-sm-6 text-center col flex-ew text-center py-3 border-bottom mx-0">
                <a class="d-block text-muted lead font-weight-bold" href="#">{{ stats.posts }}</a> <span>{{ $t('component.stats.posts') }}</span>
            </div>
        </div>
        <div class="row text-center d-flex flex-row op-7">
            <div class="col-sm-6 flex-ew text-center py-3 border-right mx-0">
                <span class="mt-auto">{{ $t('component.stats.members') }}</span>
                <a class="d-block text-muted lead font-weight-bold" href="#">{{ stats.users }}</a>
            </div>
            <div class="col-sm-6 flex-ew text-center py-3 mx-0">
                <span class="mt-auto">{{ $t('component.stats.newMember') }}</span>
                <a class="d-block text-muted lead font-weight-bold" href="#">{{ lastUser.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name:'Stats',

    mounted() {
        this.getStats();
    },

    data(){
        return{
            stats: [],
            lastUser: [],
        }
    },

    methods: {
        getStats() {
            axios.get('/api/forum/sidebar/stats')
                .then(res => {
                    this.stats = res.data.stats;
                    this.lastUser = res.data.stats.lastUser;
                })
        }
    }
}
</script>

<style scoped>
span {
    font-size: 0.9em;
}
</style>
